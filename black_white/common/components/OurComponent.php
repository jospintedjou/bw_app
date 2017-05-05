<?php

namespace common\components;

use Yii;
use common\providers\OurConnection;
/**
 * The main role of this component is to set the actual branch in database at the app deployment
 *
 * @author jospin
 */
class OurComponent extends \yii\base\Component{
     public function init() {
        $db = (new OurConnection())->getDb();
        $tableSchema = ($db->type=='magasin') ?
                                               Yii::$app->db->schema->getTableSchema('magasin')
                                              :
                                               Yii::$app->db->schema->getTableSchema('succursale');
        try{
            if($db->type=='magasin' && $tableSchema !== null){
                $db->createCommand()->update('magasin', 
                                             ['actuel'=>'oui'], ['id_magasin'=>$db->id_magasin])->execute();  
            }else if($db->type=='succursale' && $tableSchema !== null){
                $db->createCommand()->update('succursale', ['actuelle'=>'oui'], 
                                                           ['id_succursale'=>$db->id_succursale])->execute();
            }
            parent::init();
        }catch(Exception $e){
            echo 'pas encore de table dans la BD';
        }
    }
}
