<?php

/**
 *  CustomerForm
 */

namespace frontend\modules\customerMarket\models;

use yii\base\Model;
use common\models\Client;

/**
 * Description of CustomerForm
 *
 * @author miguel
 */
class CustomerForm extends Model {

    Public $denomination;
    Public $raison_sociale;
    Public $localisation;
    Public $telephone;
    Public $boite_postale;
    Public $adresse_web;
    Public $type;
    Public $email;
    Public $personne_source;
    Public $telephone_source;
    Public $id_user;

    public function rules() {
        return [
            ['denomination', 'filter', 'filter' => 'trim'],
            ['denomination', 'required', 'message' => 'champ vide veuillez remplir!!'],
            ['denomination', 'string', 'min' => 2, 'max' => 100],
            ['adresse_web', 'filter', 'filter' => 'trim'],
            [['personne_source','telephone_source','adresse_web','email'], 'string', 'max' => 255],
            ['email', 'email'],
            ['id_user', 'integer'],                      
            [['raison_sociale'], 'required', 'message' => 'champ vide veuillez le remplir'],
            [['raison_sociale'], 'string', 'max' => 20],
            ['raison_sociale', 'in', 'range' => ['Inc.', 'Corp.','SARL','&Co.','Co.','Ets','SA','SENC','SEC','Aucune'], 'message' =>'Type de raison sociale incorrect' ],
            ['localisation', 'required', 'message' => 'champ vide veuillez remplir!!'],
            ['localisation', 'string', 'min' => 6],
            ['telephone', 'string', 'min' => 9],
            ['boite_postale', 'string', 'min' => 4],
            ['type', 'in', 'range' => ['public', 'prive'], 'message' =>'Type de client incorrect' ],
            ['type', 'string'],
        ];
    }

    public function attributeLabels() {
        return [
            'denomination' => 'Nom client',
            'personne_source' => 'Personne Source',
            'telephone_source' => 'telephone source',
            'adresse_web' => 'Adresse Web',
            'raison_sociale' => 'Raison Sociale',
            'localisation' => 'Localisation',
            'telephone' => 'Tel Client',
            'boite_postale' => 'PO-Box',
            'type' => 'Type Client',
            'email' => 'Email',
            'email' => 'Email',
        ];
    }

    /*     * *
     * this fonction creta new instance of model Client and save information of this 
     * instance in database
     */

    public function registercustomer() {
        
        if ($this->validate()) {
            if ($this->id_user != null) {
                $customer = Client::findOne($this->id_user);
            } else {
                $customer = new Client();
            }
           
            $customer->denomination = $this->denomination;
            $customer->localisation = $this->localisation;
            $customer->raison_sociale = $this->raison_sociale;
            $customer->type = $this->type;
            $customer->email = $this->email;
            $customer->boite_postale = $this->boite_postale;
            $customer->adresse_web = $this->adresse_web;
            $customer->telephone = $this->telephone;
            $customer->telephone_source = $this->telephone_source;
            $customer->personne_source = $this->personne_source;
            if ($customer->save()) {
                return true;
            }
        }
        return null;
    }
}
