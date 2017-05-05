<?php

/**
 *  PrivateMarketForm
 */

namespace frontend\modules\customerMarket\models;

use yii\base\Model;
use \common\models\MarchePrive;

/**
 * Description of CustomerForm
 *
 * @author miguel
 */
class PrivateMarketForm extends Model {

    Public $intitule;
    Public $date_dmd_cotation;
    Public $date_depot_cotation;
    Public $date_reponse;
    Public $etat;
    Public $client;
    Public $id_marche;

    public function rules() {
        return [
            [['intitule', 'etat'],'required', 'message' => 'champ vide veuillez remplir!!'],
            [ 'client', 'required', 'message' => "Veuillez tout d'abord enregistrer un client de type prive s'il vous plait!!"],
            [['intitule', 'etat'], 'string'],
            [['client'], 'integer','message'=>"Celui ci n'est pas un client"],
            [['id_marche'], 'integer','message'=>"Marche inconnu"],
            [['date_dmd_cotation', 'date_depot_cotation', 'date_reponse'], 'safe'],
            ['date_depot_cotation', 'compare','compareAttribute'=>'date_dmd_cotation', 'operator'=>'>=','message'=>'la date de depot de cotation doit être supérieure à la date de demande de cotation' ],
            ['date_reponse', 'compare','compareAttribute'=>'date_depot_cotation', 'operator'=>'>=','message'=>'la date de reponse de cotation doit être supérieure à la date de depot de cotation' ],
            [['date_dmd_cotation', 'date_depot_cotation', 'date_reponse'], 'date', 'format' => 'yyyy-mm-dd'],
            [['date_dmd_cotation', 'date_depot_cotation', 'date_reponse'], 'required','message' => "Veuillez inserez une date  s'il vous plait", 'when' => function($model) {
                    return ($model->etat=='gagne')||($model->etat=='perdu');
                },
                        'whenClient'=>"function(attribute,value){
                        return ($('#etat_private').val()=='gagne')||($('#etat_private').val()=='perdu');}"
                        ],
            ['etat', 'in', 'range' => ['gagne', 'perdu', 'en_attente'],'message'=>'Etat de Marche Invalide'],
        ];
    }

    public function attributeLabels() {
        return [
            'intitule' => 'Intiutlé Marché',
            'etat' => 'état Marché',
            'client' => 'Nom Client',
            'date_depot_cotation' => 'date de depot de cotation',
            'date_dmd_cotation' => 'date de demande de cotation',
            'date_reponse' => 'date de reponse',
        ];
    }

    public function registerprivatemarket() {

        if ($this->validate()) {
            if ($this->id_marche != null) {
                $privatemarket = MarchePrive::findOne($this->id_marche);
            } else {
                $privatemarket = new MarchePrive();
            }
            $privatemarket->intitule = $this->intitule;
            $privatemarket->id_client = $this->client;
            $privatemarket->date_depot_cotation = $this->date_depot_cotation;
            $privatemarket->date_dmd_cotation = $this->date_dmd_cotation;
            $privatemarket->date_reponse = $this->date_reponse;
            $privatemarket->etat = $this->etat;


         if($privatemarket->save()){
             return true;
         }
          
        }
        return null;
    }

}
