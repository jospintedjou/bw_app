<?php

namespace frontend\modules\purchaseOrder\models;

use yii\base\Model;
use common\models\BonCmde;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PurchaseOderForm
 *
 * @author miguel
 */
class PurchaseOderForm extends Model {

    Public $produit;
    Public $montant;
    Public $date_reception;
    Public $delai;
    Public $id_client;
    Public $id_bon;

    public function rules() {
        return [


            [['produit', 'montant', 'date_reception', 'delai'], 'required', 'message' => 'champ vide veuillez remplir!!'],
            [ 'id_client', 'required', 'message' => "Veuillez tout d'abord enregistrer un client s'il vous plait!!"],
            [['montant', 'produit'], 'string'],
            [['id_client', 'id_bon'], 'integer','message'=>"Celui ci n'est pas un client"],
            [['date_reception', 'delai'], 'safe'],
            [['date_reception', 'delai'], 'date', 'format' => 'yyyy-mm-dd'],
        ];
    }

    public function attributeLabels() {
        return [
            'id_client' => 'Nom du Client',
            'date_reception' => 'Date De Reception',
        ];
    }

    public function registerpurchaseorder() {

        if ($this->validate()) {
            if ( $this->id_bon != null) {
                  $purchaseorder = BonCmde::findOne($this->id_bon);
            } else {
                $purchaseorder = new BonCmde();
            }
            
            $purchaseorder->produit = $this->produit;
            $purchaseorder->montant = $this->montant;
            $purchaseorder->date_reception = $this->date_reception;
            $purchaseorder->delai = $this->delai;
            $purchaseorder->id_client = $this->id_client;


           if ($purchaseorder->save()){;

           return true;
           
           }
        }
        return null;
    }

}
