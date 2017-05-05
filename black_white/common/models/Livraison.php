<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "livraison".
 *
 * @property integer $id_livraison
 * @property integer $id_magasin
 * @property integer $id_succursale
 * @property integer $id_commande
 * @property string $code
 * @property string $date
 * @property string $livre
 *
 * @property Magasin $magasin
 * @property Succursale $succursale
 * @property CommandeStock $commande
 * @property LivraisonStockBoisson[] $livraisonStockBoissons
 */
class Livraison extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'livraison';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_magasin', 'id_succursale', 'id_commande', 'code', 'date', 'livre'], 'required'],
            [['id_magasin', 'id_succursale', 'id_commande'], 'integer'],
            [['date'], 'safe'],
            [['code'], 'string', 'max' => 255],
            [['livre'], 'string', 'max' => 3],
            [['id_magasin'], 'exist', 'skipOnError' => true, 'targetClass' => Magasin::className(), 'targetAttribute' => ['id_magasin' => 'id_magasin']],
            [['id_succursale'], 'exist', 'skipOnError' => true, 'targetClass' => Succursale::className(), 'targetAttribute' => ['id_succursale' => 'id_succursale']],
            [['id_commande'], 'exist', 'skipOnError' => true, 'targetClass' => CommandeStock::className(), 'targetAttribute' => ['id_commande' => 'id_commande']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_livraison' => 'Id Livraison',
            'id_magasin' => 'Id Magasin',
            'id_succursale' => 'Id Succursale',
            'id_commande' => 'Id Commande',
            'code' => 'Code',
            'date' => 'Date',
            'livre' => 'Livre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMagasin()
    {
        return $this->hasOne(Magasin::className(), ['id_magasin' => 'id_magasin']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuccursale()
    {
        return $this->hasOne(Succursale::className(), ['id_succursale' => 'id_succursale']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommande()
    {
        return $this->hasOne(CommandeStock::className(), ['id_commande' => 'id_commande']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLivraisonStockBoissons()
    {
        return $this->hasMany(LivraisonStockBoisson::className(), ['id_livraison' => 'id_livraison']);
    }

    /**
     * @inheritdoc
     * @return LivraisonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LivraisonQuery(get_called_class());
    }
}
