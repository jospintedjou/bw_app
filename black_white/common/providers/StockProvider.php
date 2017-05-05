<?php
/*
 * This class retrieves products stocks datas from database
 */

namespace common\providers;
use kartik\builder\TabularForm;
use yii\db\Query;
use common\providers\OurConnection;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
/**
 * @author jospin
 */
class StockProvider {
   /** This function gets all product in the current  branch**/
    public function getBranchProducts(){
        //return (new Query())->select("*")->from('produit ');
        $drinks =  $this->getDrinks();
        $foods = $this->getFoods();
        $smooks =  $this->getSmooking();
       // $dataProvider =  $this->getSmooking();
        $dataProvider = $drinks->union($smooks)->distinct()->orderby('p.nom');
        
        return $dataProvider;
    }
    
    /** This function gets all product in the current  warehouse**/
    public function getWarehouseProducts(){
        //return (new Query())->select("p.nom, ")->indexBy('id_produit');
    }
    
    public function getDrinks(){
         return (new Query())->select("p.id_produit, p.nom, b.nb_btlle qte_stock")
                             ->from('produit p')
                             ->innerJoin('bouteille b', 'b.id_boisson=p.id_produit')
                             ->orderby('p.nom');
    }
    private function getFoods(){
         return (new Query())->select("p.id_produit, p.nom, r.quantite qte_stock")
                             ->from('produit p')
                             ->innerJoin('repas r', 'r.id_repas=p.id_produit')
                             ->orderby('p.nom');
    }
    private function getSmooking(){
         return (new Query())->select("p.id_produit, p.nom, t.quantite qte_stock")
                             ->from('produit p')
                             ->innerJoin('tabac t', 't.id_tabac=p.id_produit')
                             ->orderby('p.nom');
    }
    
    /** insert a new order to waregouse in the database **/
    public function addOrder($db, $orderList){
        $localDb = (new OurConnection)->getDb();
        /** The branch info are always fetches from actual branh database**/
        $branch =   $localDb->createCommand("select id_succursale, nom from succursale where actuelle='oui'")
                           ->queryOne();
        $lastOrderId = $localDb->createCommand("select max(id_commande) from commande_stock")
                      ->queryScalar();
        $wareHouseId = $localDb->createCommand("select id_magasin from magasin")->queryScalar();
        $date = date('Y-m-d H:i'); //actual dateTime. This is to make sure order date is similar to string date in order code
        $date2 = str_replace(' ', '-', $date);
        $branchName = substr($branch['nom'], 0, 2).'_'.$lastOrderId.'_'.$date2;
        $db->createCommand()->insert('commande_stock', 
                                                ['id_succursale'=>$branch['id_succursale'],
                                                 'id_magasin'=>$wareHouseId,
                                                 'code'=> $branchName ,
                                                 'lu'=>'non',
                                                 'affiche'=>'non',
                                                 'date'=> $date])
                                     ->execute();
                $CurrentOrderId = $db->createCommand("select max(id_commande) from commande_stock")
                              ->queryScalar();
        foreach($orderList as $order){
            if(isset($order['nb']) && !empty($order['nb']) && $order['nb']>0){
                    $nb = $order['nb'];
                    $id = $order['id'];
                $db->createCommand()->insert('commande_stock_boisson', 
                                             ['id_commande'=>$CurrentOrderId,
                                              'id_boisson'=>$id,
                                              'nb_btlle'=>$nb ])
                                    ->execute();
            }
        }
        return true;
    }
    /** Return colums name of the order product form **/
    public function getFormAttribs() {
        return [
             //primary key column
            'id_produit'=>[ // primary key attribute
                'type'=>TabularForm::INPUT_HIDDEN, 
                'columnOptions'=>['hidden'=>true]
            ], 
            'nom'=>[
                'type'=>TabularForm::INPUT_STATIC, 
                'label'=>'Nom', 
                'options'=>['disabled'=>'disabled'],
                'columnOptions'=>['width'=>'30%'],],
            'qte_stock'=>[
                'type' =>  TabularForm::INPUT_STATIC,
                'value'     => function ($data) {
                    return empty($data['qte_stock'])  ? 0 : $data['qte_stock'];
                },
                //'options'=>['disabled'=>'disabled'],
                //'widgetClass'=>\kartik\widgets\DatePicker::classname(), 
               // 'options'=> ,
                'columnOptions'=>['width'=>'20%',]
            ],
            'qte_commande'=>[
                                'type'=>TabularForm::INPUT_WIDGET, 
                                //'widgetClass'=>\kartik\widgets\ColorInput::classname(),
                                'widgetClass'=>  \kartik\widgets\Touchspin::classname(),
                                
                                'options'=>[
                                     
                                     //'disabled'=>'disabled', 
                                    ],
                               // 'max'=>6,
                                //'pluginOptions'=>['height'=>'20px', 'max' =>4, 'prefix' => '$'],

                                'columnOptions'=>['width'=>'25%' ],
                'style'=>[]
            ]
        ];
    }
    
    
    
    
    
    
}
