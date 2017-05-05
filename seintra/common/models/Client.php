<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property integer $id_user
 * @property string $raison_sociale
 * @property string $localisation
 * @property string $telephone
 * @property string $boite_postale
 * @property string $adresse_web
 * @property string $type
 * @property string $email
 * @property string $denomination
 * @property string $telephone_source
 * @property string $personne_source
 *
 * @property BonCmde[] $bonCmdes
 * @property MarchePrive[] $marchePrives
 * @property MarchePublic[] $marchePublics
 */
class Client extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['raison_sociale', 'localisation', 'type', 'denomination'], 'required'],
            [['localisation', 'telephone', 'boite_postale', 'adresse_web'], 'string'],
            [['raison_sociale'], 'string', 'max' => 20],
            [['email'], 'email'],           
            [['email'], 'string', 'max' => 50],
            [['type'], 'string', 'max' => 10],
            [['type'], 'in', 'range' => ['public', 'prive']],
            ['type', 'string','skipOnError' => true],
            ['personne_source', 'string', 'max' => 255],
            ['telephone_source', 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_user' => 'Id User',
            'raison_sociale' => 'Raison Sociale',
            'localisation' => 'Localisation',
            'telephone' => 'Telephone',
            'boite_postale' => 'Boite Postale',
            'adresse_web' => 'Adresse Web',
            'type' => 'Type',
            'denomination' => 'Nom du client',
            'email' => 'Email',
            'personne_source'=>'Personne Source',
            'telephone_source'=>'telephone source',            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBonCmdes() {
        return $this->hasMany(BonCmde::className(), ['id_client' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarchePrives() {
        return $this->hasMany(MarchePrive::className(), ['id_client' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarchePublics() {
        return $this->hasMany(MarchePublic::className(), ['id_client' => 'id_user']);
    }

    /**
     * @inheritdoc
     * @return ClientQuery the active query used by this AR class.
     */
    public static function find() {
        return new ClientQuery(get_called_class());
    }
    
}
