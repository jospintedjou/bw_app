<?php

namespace frontend\modules\meeting\models;
use yii\base\Model;
use common\models\ParticiperReunion;
use common\models\User;
use yii\helpers\ArrayHelper;
class partForm extends Model {

    public $participant;
    public $Id_reunion;

// version mise a jours 21/09/2016
    public function rules() {
        return [
                      
            ['participant','each', 'rule'=>['integer']],
            ['Id_reunion', 'integer'],
            ['Id_reunion', 'safe'],
        ];
    }
    
    public function getParticipantDropDown() {
        
       $listParticipants   = [];
       $list   = ArrayHelper::map( $listParticipants,'id','nom');
        return $list;
        
    }
    public function entrypart() {        

        if (!$this->validate()) {
             
            return false;
        }
        if(!empty($this->participant)){
                      
            foreach ($this->participant as $value){

                $reunionpart = new ParticiperReunion();
                $reunionpart->id_user = $value;
                $reunionpart->id_reunion = $this->Id_reunion;
                $reunionpart->ajoute_apres = 'oui';
                $reunionpart->save();
            }
            
        }    
            return true;
    }
}
