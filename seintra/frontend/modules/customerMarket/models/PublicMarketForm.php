<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\modules\customerMarket\models;

use yii\base\Model;
use common\models\MarchePublic;

/**
 * Description of PublicMarketForm
 *
 * @author miguel
 */
class PublicMarketForm extends Model {

    Public $intitule;
    Public $date_connaiss;
    Public $delai_prescript;
    Public $date_depot_dossier;
    Public $date_reponse;
    Public $etat;
    Public $client;
    Public $id_marche;

    public function rules() {
        return [
            [['intitule', 'etat','date_connaiss'], 'required', 'message' => 'champ vide veuillez remplir!!'],
            [ 'client', 'required', 'message' => "Veuillez tout d'abord enregistrer un client de type public s'il vous plait!!"],
            ['date_connaiss','default','value'=>date('yyyy-mm-dd')],
            [['intitule', 'etat'], 'string'],
            [['client', 'id_marche'], 'integer','message'=>"Celui ci n'est pas un client"],
            [['date_reponse', 'date_depot_dossier', 'delai_prescript', 'date_connaiss'], 'safe'],          
            [['date_reponse', 'date_depot_dossier', 'delai_prescript', 'date_connaiss'], 'date', 'format' => 'yyyy-mm-dd'],
            ['date_depot_dossier', 'compare','compareAttribute'=>'date_connaiss', 'operator'=>'>=','message'=>"la date d'introduction du dossier doit être supérieure ou égale à celle de la date de connaissance" ],
            ['date_reponse', 'compare','compareAttribute'=>'date_depot_dossier', 'operator'=>'>=','message'=>"la date de reponse doit être supérieure ou égale à celle du depot de cotation" ],
            ['delai_prescript', 'compare','compareAttribute'=>'date_depot_dossier', 'operator'=>'>=','message'=>"la date du delai de prescription doit être supérieure ou égale à celle de l'introduction du dossier" ],
            [['date_reponse','delai_prescript','date_depot_dossier'], 'required','message' => "Veuillez inserez une date s'il vous plait ", 'when' => function($model) {
                    return ($model->etat == 'gagne')||($model->etat=='perdu');
                },
                 'whenClient'=>"function(attribute,value){
                        return ($('#etat_public').val()=='gagne')||($('#etat_public').val()=='perdu')}"
                ],           
            ['etat', 'in', 'range' => ['gagne', 'perdu', 'en_attente'],'message'=>'Etat de Marche Invalide'],
        ];
    }

    public function attributeLabels() {
        return [
            'intitule' => 'Intiutlé Marché',
            'etat' => 'état Marché',
            'client' => 'Nom Client',
            'date_depot_dossier' => "date d'introduction du dossier",
            'delai_prescript' => 'delai de prescription',
            'date_reponse' => 'date de reponse admin public',
            'date_connaiss' => 'date de connaissance du marche',
        ];
    }

    public function registerpublicmarket() {

        if ($this->validate()) {
            if ($this->id_marche != null) {
                $publicmarket = MarchePublic::findOne($this->id_marche);
            } else {
                $publicmarket = new MarchePublic();
            }
            $publicmarket->intitule = $this->intitule;
            $publicmarket->id_client = $this->client;
            $publicmarket->date_connaiss = $this->date_connaiss;
            $publicmarket->date_depot_dossier = $this->date_depot_dossier;
            $publicmarket->date_prescript = $this->delai_prescript;
            $publicmarket->date_reponse = $this->date_reponse;
            $publicmarket->etat = $this->etat;


            if ($publicmarket->save()) {
                return true;
            }
        }
        return null;
    }

}
