<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property integer $id_client
 * @property string $nom
 * @property string $prenom
 * @property string $sexe
 * @property string $telephone
 * @property string $email
 * @property string $date_anniv
 * @property string $date_anniv_epse
 *
 * @property CommandeClient[] $commandeClients
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nom', 'sexe', 'telephone', 'email'], 'required'],
            [['date_anniv', 'date_anniv_epse'], 'safe'],
            [['nom', 'prenom', 'email'], 'string', 'max' => 255],
            [['sexe'], 'string', 'max' => 5],
            [['telephone'], 'string', 'max' => 45],
            [['telephone'], 'unique'],
            ['sexe', 'in', 'range' => ['homme', 'femme']],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_client' => 'Id Client',
            'nom' => 'Nom',
            'prenom' => 'Prenom',
            'sexe' => 'Sexe',
            'telephone' => 'Telephone',
            'email' => 'Email',
            'date_anniv' => 'Date Anniv',
            'date_anniv_epse' => 'Date Anniv Epse',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommandeClients()
    {
        return $this->hasMany(CommandeClient::className(), ['id_client' => 'id_client']);
    }

    /**
     * @inheritdoc
     * @return ClientQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClientQuery(get_called_class());
    }
}
