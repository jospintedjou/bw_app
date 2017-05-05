<?php

namespace backend\modules\stocks\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\providers\StockProvider;
use yii\data\ActiveDataProvider;
use common\providers\OurConnection;
use yii\db\Query;

class BranchStockController extends \yii\web\Controller
{
    
     public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['save-order', 'reset-checked', 'register-checked', 'index','delivry-product','order-product','tack-in','view'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index','delivry-product','order-product','tack-in','view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }
    
    
     public function actionIndex()
    {
        return $this->render('index');
    }
    
    /** Renders all branch products stock info**/
    public function actionView()
    {
        return $this->render('view-branch-stock');
    }
    
    /** Register checked products for command to warehouse**/
    public function actionRegisterChecked(){
        $keyList = Yii::$app->request->post('keyList');
        $total = Yii::$app->request->post('total');
        /** $keyLst is not cheked for technical reason**/
        if(isset($total)){
            $newList = $this->updateKeyList($keyList, $total);
            $res = json_encode(['status'=>'success', 'keyList'=>$newList]);
        }else{
             $res = json_encode(['status'=>'failed']);
        }
        echo $res;
    }
    
    /** This function put selected product for command ib session variable **/
    public function updateKeyList($keyList, $total){
        $session = Yii::$app->session;
        if(!$session->isActive){ 
            $session->open(); 
        }
        if( $session->get('orderKeyList', false) ){
                $sessionList = $session->get('orderKeyList');
        }else{
            $session->set('orderKeyList', $keyList);
            $sessionList = $session->get('orderKeyList');
        }
             
        $newList = $sessionList;
        for($i=0; $i<$total; $i++){
            $idVal = isset($newList[$i]['id']) ? $newList[$i]['id'] : '';
            $nbVal = isset($newList[$i]['nb']) && !empty($newList[$i]['nb']) ? $newList[$i]['nb'] : '';
            $id = !empty($keyList[$i]['id']) ? $keyList[$i]['id'] : $idVal;
            $nb = isset($keyList[$i]['nb']) && $keyList[$i]['nb']>0 ?  $keyList[$i]['nb'] : $nbVal;
            $newList[$i] = ['id'=>$id, 'nb'=>$nb];
        }
        //$newList = array_unique(array_merge((Array)$sessionList, (Array)$keyList));
        $session->set('orderKeyList', $newList);
        return $newList;
    }

    /** Reset session variable products for command to warehouse**/
    public function actionResetChecked(){
        $this->resetChecked();
        echo json_encode(['status'=>'success']);
    }
    
    /** This function reset selcted order products list in session **/
    public function resetChecked(){
        $session = Yii::$app->session;
        $session->open(); 
        $session->remove('orderKeyList');
    }
    /** Reset session variable products for command to warehouse**/
    public function actionSaveOrder(){
        $keyList = Yii::$app->request->post('keyList');
        $total = Yii::$app->request->post('total');
        $orderList = $this->updateKeyList($keyList, $total);
        $dbs = (new OurConnection())->getAllDatabases();
        $dbSucc=''; $dbMag=''; 
        $TYPEMAGASIN = 'magasin';
        $res = '';
        
        $dbSucc = (new OurConnection())->getDb();
        /** Look for wareHouse database  **/
        foreach($dbs as $db){
            if($db->type == $TYPEMAGASIN){
                $dbMag = $db;
            }
        }
        try{
            $transaction2 = $dbMag->beginTransaction();
            $transaction1 = $dbSucc->beginTransaction();
            (new StockProvider())->addOrder($dbMag, $orderList);
            (new StockProvider())->addOrder($dbSucc, $orderList);
            $transaction1->commit();
            $transaction2->commit();
            $res = json_encode(['status'=>'success']); 
        } catch (Exception $e){
            $transaction2->rollBack();
            if(isset($transaction1)){$transaction1->rollBack();}
            $res = json_encode(['status'=>'failed']);
        }
        $this->resetChecked();
        echo $res;
    }
    
    /** Renders a list of products to chose for order  to warehouse **/
    public function actionOrderProduct()
    {
        $page = (Yii::$app->request->get('page')) ? Yii::$app->request->get('page') : 1;
        if($page == 1){
            $query = (new StockProvider)->getBranchProducts();
        }else{
            $query = (new StockProvider)->getDrinks();
        }
        //$query = $q1->union($q2);
        $attribs = (new StockProvider)->getFormAttribs();
        //$query =  (new StockProvider)->getBranchProducts();
        $dataProvider  = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>25],    
            'totalCount'=>(new StockProvider)->getBranchProducts()->count(),
        ]);
       // $dataProvider->pagination = ['pageSize'=>100];
        
        return $this->render('order-product', [
                                               'dataProvider' => $dataProvider,
                                               'formAttribs' => $attribs,
                                               'total' => (new StockProvider)->getBranchProducts()->count(),
             //'query'=>$query
            ]);
    }
    
    public function actionDelivryProduct($id_order)
    {
        return $this->render('delivry-product');
    }

    public function actionTackIn()
    {
        return $this->render('tack-in');
    }

    

}
