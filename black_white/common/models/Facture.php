<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "facture".
 *
 * @property integer $id_facture
 * @property integer $id_commande_client
 * @property integer $id_createur
 * @property string $code
 * @property string $paye
 * @property string $date
 *
 * @property User $idCreateur
 * @property CommandeClient $idCommandeClient
 */
class Facture extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'facture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_commande_client', 'id_createur', 'code', 'paye', 'date'], 'required'],
            [['id_commande_client', 'id_createur'], 'integer'],
            [['date'], 'safe'],
            [['code'], 'string', 'max' => 30],
            [['code'], 'string', 'min' => 4],
            [['paye'], 'string', 'max' => 3],
            [['paye'], 'in', 'range' => ['oui', 'non']],
            [['id_createur'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_createur' => 'id']],
            [['id_commande_client'], 'exist', 'skipOnError' => true, 'targetClass' => CommandeClient::className(), 'targetAttribute' => ['id_commande_client' => 'id_commande_client']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_facture' => 'Id Facture',
            'id_commande_client' => 'Id Commande Client',
            'id_createur' => 'Id Createur',
            'code' => 'Code',
            'paye' => 'Paye',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCreateur()
    {
        return $this->hasOne(User::className(), ['id' => 'id_createur']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCommandeClient()
    {
        return $this->hasOne(CommandeClient::className(), ['id_commande_client' => 'id_commande_client']);
    }

    /**
     * @inheritdoc
     * @return FactureQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FactureQuery(get_called_class());
    }
}
