<?php

namespace frontend\modules\order\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use frontend\modules\order\models\AuthentificationCodeForm;
use frontend\modules\order\models\AuthentificationCodeDeleteForm;

/**
 * Description of AcceptOrder
 *
 * @author eric
 */
class AcceptOrderController extends \yii\web\Controller {
    //put your code here
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['logout', 'accept-serv-order','delete-order','authenticate-serv', 'add-table', 'order-entry', 'print-bill', 'index', 'print-delivry-order',
                            'view-presence-recap', 'is-order-add','view-sales-recap', 'infos', 'commande', 'conso', 'verre', 'erasepanier', 'demiebouteille', 'repas', 'tabac', 'listerclients', 'listertables', 'saveorder'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'accept-serv-order','delete-order','is-order-add','authenticate-serv', 'add-table', 'print-bill', 'index', 'print-delivry-order',
                            'view-presence-recap', 'view-sales-recap', 'validate', 'validate-delete'],
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
    public function beforeAction($action)
    {            
        $this->enableCsrfValidation = false;   
        return parent::beforeAction($action);
    }
    
   /*the action to authenticate somme server
   * 
   * *
   */
     public function actionAuthenticateServ() {
         $model = new AuthentificationCodeForm();
         $access = 1;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(($model->load(yii::$app->request->post()))&&($model->validate())){
            $user = (new \common\providers\UserByCode)->getUser($model->code);
            if (!($user == null)) {
               ( new \common\providers\UserByCode)->UpdateCommandeClient($model->idauthentication, $user['id']);  
            }
            else{
              $access = 0;
            }
        }
               return ['model'=>$model,'access'=>$access];
    }
    
    /*the action to authenticate somme server
   * 
   * *
   */
     public function actionDeleteOrder() {
     
         $modeldelete = new AuthentificationCodeDeleteForm();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax &&($modeldelete->load(yii::$app->request->post()))&&($modeldelete->validate())){
            $user = (new \common\providers\UserByCode)->getUser($modeldelete->code);
                 $accesse = 1;
            if (!($user == null)) {
               
               ( new \common\providers\UserByCode)->CancelCommandeClient($modeldelete->idauthentication,$user['id']); 
            }
            else{
               $accesse = 0;
            }
        }
        return ['model'=>$modeldelete];
    }
    /*
     * the action to accept-serv-order
   * *
   */
    public function actionAcceptServOrder($etat='attente') { 
        $model = new AuthentificationCodeForm();
        $modeldelete = new AuthentificationCodeDeleteForm();
        $etat1='servie';
        $acceptedcommandeClient = (new \common\providers\UserByCode)->SelectAcceptedCommandeClient($etat1);
        $commandeClient = (new \common\providers\UserByCode)->SelectCommandeClient($etat);
        $commandes=[];
        $commandes_=[];
        $index = 0;
        $bool = 0;
        $indexe=0;
        foreach ($commandeClient as $itencommande) {
            $bool++;
            if($bool===1){
                $test = $itencommande['id_commande_client'];
                $commandes[$index]['id_commande']= $itencommande['id_commande_client'];
                $commandes[$index]['client']= (new \common\providers\UserByCode)->SelectUserNameById($itencommande['id_client'])['nom'];
                $commandes[$index]['table']= (new \common\providers\UserByCode)->SelectTableNameById($itencommande['id_table'])['nom'];
                $commandes[$index]['code']= $itencommande['code'];
                $commandes[$index]['date']= $itencommande['date'];
                $commandes[$index]['produit'][$indexe]['nom']= $itencommande['nom'];
                $commandes[$index]['produit'][$indexe]['nb_bouteille']= $itencommande['nombre'];
                $commandes[$index]['produit'][$indexe]['nb_demi']= $itencommande['nb_demi'];
                $commandes[$index]['produit'][$indexe]['nb_conso']= $itencommande['nb_conso'];
                $commandes[$index]['produit'][$indexe]['nb_verre']= $itencommande['nb_verre'];
                $commandes[$index]['produit'][$indexe]['prix']= $itencommande['prix'];
                $commandes[$index]['produit'][$indexe]['code']= $itencommande['code'];
                $commandes[$index]['produit'][$indexe]['date']= $itencommande['date'];
               // $index++;
            }
            else{
                if($test === $itencommande['id_commande_client']){
                    $indexe++;  
                    $commandes[$index]['produit'][$indexe]['nom']= $itencommande['nom'];
                    $commandes[$index]['produit'][$indexe]['nb_bouteille']= $itencommande['nombre'];
                    $commandes[$index]['produit'][$indexe]['nb_demi']= $itencommande['nb_demi'];
                    $commandes[$index]['produit'][$indexe]['nb_conso']= $itencommande['nb_conso'];
                    $commandes[$index]['produit'][$indexe]['nb_verre']= $itencommande['nb_verre'];
                    $commandes[$index]['produit'][$indexe]['prix']= $itencommande['prix'];
                    $commandes[$index]['produit'][$indexe]['code']= $itencommande['code'];
                    $commandes[$index]['produit'][$indexe]['date']= $itencommande['date'];
                }
                else{
                    $index++; 
                    $test = $itencommande['id_commande_client'];
                    $commandes[$index]['id_commande']= $itencommande['id_commande_client'];
                    $commandes[$index]['client']= (new \common\providers\UserByCode)->SelectUserNameById($itencommande['id_client'])['nom'];
                    $commandes[$index]['table']= (new \common\providers\UserByCode)->SelectTableNameById($itencommande['id_table'])['nom'];
                    $commandes[$index]['code']= $itencommande['code'];
                    $commandes[$index]['date']= $itencommande['date'];
                    $commandes[$index]['produit'][$indexe]['nom']= $itencommande['nom'];
                    $commandes[$index]['produit'][$indexe]['nb_bouteille']= $itencommande['nombre'];
                    $commandes[$index]['produit'][$indexe]['nb_demi']= $itencommande['nb_demi'];
                    $commandes[$index]['produit'][$indexe]['nb_conso']= $itencommande['nb_conso'];
                    $commandes[$index]['produit'][$indexe]['nb_verre']= $itencommande['nb_verre'];
                    $commandes[$index]['produit'][$indexe]['prix']= $itencommande['prix'];
                    $commandes[$index]['produit'][$indexe]['code']= $itencommande['code'];
                    $commandes[$index]['produit'][$indexe]['date']= $itencommande['date'];
                }       
            }
        }
        foreach ($acceptedcommandeClient as $itencommande) {
            
            $bool++;
            if($bool===1){
                $test = $itencommande['id_commande_client'];
                $commandes_[$index]['id_commande']= $itencommande['id_commande_client'];
                $commandes_[$index]['client']= (new \common\providers\UserByCode)->SelectUserNameById($itencommande['id_client'])['nom'];
                $commandes_[$index]['table']= (new \common\providers\UserByCode)->SelectTableNameById($itencommande['id_table'])['nom'];
                $commandes_[$index]['code']= $itencommande['code'];
                $commandes_[$index]['date']= $itencommande['date'];
                $commandes_[$index]['produit'][$indexe]['nom']= $itencommande['nom'];
                $commandes_[$index]['produit'][$indexe]['nb_bouteille']= $itencommande['nombre'];
                $commandes_[$index]['produit'][$indexe]['nb_demi']= $itencommande['nb_demi'];
                $commandes_[$index]['produit'][$indexe]['nb_conso']= $itencommande['nb_conso'];
                $commandes_[$index]['produit'][$indexe]['nb_verre']= $itencommande['nb_verre'];
                $commandes_[$index]['produit'][$indexe]['prix']= $itencommande['prix'];
                
               // $index++;
            }
            else{
                if($test === $itencommande['id_commande_client']){
                    $indexe++;  
                    $commandes_[$index]['produit'][$indexe]['nom']= $itencommande['nom'];
                    $commandes_[$index]['produit'][$indexe]['nb_bouteille']= $itencommande['nombre'];
                    $commandes_[$index]['produit'][$indexe]['nb_demi']= $itencommande['nb_demi'];
                    $commandes_[$index]['produit'][$indexe]['nb_conso']= $itencommande['nb_conso'];
                    $commandes_[$index]['produit'][$indexe]['nb_verre']= $itencommande['nb_verre'];
                    $commandes_[$index]['produit'][$indexe]['prix']= $itencommande['prix'];
                    
                }
                else{
                    $index++; 
                    $test = $itencommande['id_commande_client'];
                    $commandes_[$index]['id_commande']= $itencommande['id_commande_client'];
                    $commandes_[$index]['client']= (new \common\providers\UserByCode)->SelectUserNameById($itencommande['id_client'])['nom'];
                    $commandes_[$index]['table']= (new \common\providers\UserByCode)->SelectTableNameById($itencommande['id_table'])['nom'];
                    $commandes_[$index]['code']= $itencommande['code'];
                    $commandes_[$index]['date']= $itencommande['date'];
                    $commandes_[$index]['produit'][$indexe]['nom']= $itencommande['nom'];
                    $commandes_[$index]['produit'][$indexe]['nb_bouteille']= $itencommande['nombre'];
                    $commandes_[$index]['produit'][$indexe]['nb_demi']= $itencommande['nb_demi'];
                    $commandes_[$index]['produit'][$indexe]['nb_conso']= $itencommande['nb_conso'];
                    $commandes_[$index]['produit'][$indexe]['nb_verre']= $itencommande['nb_verre'];
                    $commandes_[$index]['produit'][$indexe]['prix']= $itencommande['prix'];
                    
                }
                
            }
        }
        
        return $this->render('accept-serv-order',['model'=>$model,'modeldelete'=>$modeldelete, 'commande'=>$commandes,'commande_'=>$commandes_]);
    }
    /*the action to view order to print's bill 
   * 
   * *
   */
     public function actionIsOrderAdd() {
        
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $empty = (new \common\providers\UserByCode)->SelectAddCommandeClient();
        if($empty['cnt'] > 0){
           $empties = true; 
        }
        else{
            $empties = false;
        }
        return ['isEmpty'=>$empty['cnt']];
    }
    
    
  /*the action to add table
   * 
   * *
   */
    
    public function actionAddTable() {
        return $this->render('add-table');
    }

    public function actionIndex() {
        return $this->render('index');
    }
    
    
    /*
     * 
     */
    public function actionValidate() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new AuthentificationCodeForm();
        if (Yii::$app->request->isAjax && $model->load(yii::$app->request->post())){
            return \yii\bootstrap\ActiveForm::validate($model);
        }
    }
    /*
     * 
     */
    public function actionValidateDelete() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new AuthentificationCodeDeleteForm();
        if (Yii::$app->request->isAjax && $model->load(yii::$app->request->post())){
            return \yii\bootstrap\ActiveForm::validate($model);
        }
    }
}