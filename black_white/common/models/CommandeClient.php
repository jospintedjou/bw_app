<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "commande_client".
 *
 * @property integer $id_commande_client
 * @property integer $id_serveur
 * @property integer $id_preneur
 * @property integer $id_client
 * @property string $code
 * @property string $paye
 * @property string $date
 *
 * @property Client $idClient
 * @property User $idServeur
 * @property User $idPreneur
 * @property Facture[] $factures
 */
class CommandeClient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'commande_client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'id_preneur', 'id_client', 'code', 'paye', 'date'], 'required'],
            [['id_serveur', 'id_preneur', 'id_client'], 'integer'],
            [['date'], 'safe'],
            [['code'], 'string', 'max' => 30],
            [['code'], 'string', 'min' => 4],
            [['paye'], 'string', 'max' => 3],
            [['etat'], 'in', 'range' => ['servi', 'attente', 'annule']],
            [['id_client'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['id_client' => 'id_client']],
            [['id_serveur'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_serveur' => 'id']],
            [['id_preneur'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_preneur' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_commande_client' => 'Id Commande Client',
            'id_serveur' => 'Id Serveur',
            'id_preneur' => 'Id Preneur',
            'id_client' => 'Id Client',
            'code' => 'Code',
            'paye' => 'Paye',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdClient()
    {
        return $this->hasOne(Client::className(), ['id_client' => 'id_client']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdServeur()
    {
        return $this->hasOne(User::className(), ['id' => 'id_serveur']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPreneur()
    {
        return $this->hasOne(User::className(), ['id' => 'id_preneur']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFactures()
    {
        return $this->hasMany(Facture::className(), ['id_commande_client' => 'id_commande_client']);
    }

    /**
     * @inheritdoc
     * @return CommandeClientQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommandeClientQuery(get_called_class());
    }
}
