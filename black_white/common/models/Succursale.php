<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "succursale".
 *
 * @property integer $id_succursale
 * @property string $nom
 * @property string $adresse
 * @property string $ville
 *
 * @property CommandeStock[] $commandeStocks
 * @property Livraison[] $livraisons
 * @property Transfert[] $transferts
 * @property Transfert[] $transferts0
 */
class Succursale extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'succursale';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nom'], 'required'],
            [['nom'], 'string', 'max' => 30],
            [['adresse', 'ville'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_succursale' => 'Id Succursale',
            'nom' => 'Nom',
            'adresse' => 'Adresse',
            'ville' => 'Ville',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommandeStocks()
    {
        return $this->hasMany(CommandeStock::className(), ['id_succursale' => 'id_succursale']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLivraisons()
    {
        return $this->hasMany(Livraison::className(), ['id_succursale' => 'id_succursale']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransferts()
    {
        return $this->hasMany(Transfert::className(), ['id_succ_dest' => 'id_succursale']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransferts0()
    {
        return $this->hasMany(Transfert::className(), ['id_succ_source' => 'id_succursale']);
    }

    /**
     * @inheritdoc
     * @return SuccursaleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SuccursaleQuery(get_called_class());
    }
}
