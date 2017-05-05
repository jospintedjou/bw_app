<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "commande_stock".
 *
 * @property integer $id_commande
 * @property integer $id_succursale
 * @property integer $id_magasin
 * @property string $code
 * @property string $date
 * @property string $lu
 * @property string $affiche
 *
 * @property Succursale $idSuccursale
 * @property CommandeStockBoisson[] $commandeStockBoissons
 * @property Boisson[] $idBoissons
 * @property Boisson[] $idBoissons0
 * @property Livraison[] $livraisons
 */
class CommandeStock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'commande_stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_succursale', 'id_magasin', 'code', 'date'], 'required'],
            [['id_succursale', 'id_magasin'], 'integer'],
            [['date'], 'safe'],
            [['code'], 'string', 'max' => 100],
            [['code'], 'string', 'min' => 14], // forme: djeuga_1_2016-16-01
            [['lu', 'affiche'], 'in', 'range' => ['oui', 'non']],
            [['id_succursale'], 'exist', 'skipOnError' => true, 'targetClass' => Succursale::className(), 'targetAttribute' => ['id_succursale' => 'id_succursale']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_commande' => 'Id Commande',
            'id_succursale' => 'Id Succursale',
            'id_magasin' => 'Id Magasin',
            'code' => 'Code',
            'date' => 'Date',
            'lu' => 'Lu',
            'affiche' => 'Affiche',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSuccursale()
    {
        return $this->hasOne(Succursale::className(), ['id_succursale' => 'id_succursale']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommandeStockBoissons()
    {
        return $this->hasMany(CommandeStockBoisson::className(), ['id_commande' => 'id_commande']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBoissons()
    {
        return $this->hasMany(Boisson::className(), ['id_boisson' => 'id_boisson'])->viaTable('commande_stock_boisson', ['id_commande' => 'id_commande']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBoissons0()
    {
        return $this->hasMany(Boisson::className(), ['id_boisson' => 'id_boisson'])->viaTable('commande_stock_boisson', ['id_commande' => 'id_commande']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLivraisons()
    {
        return $this->hasMany(Livraison::className(), ['id_commande' => 'id_commande']);
    }

    /**
     * @inheritdoc
     * @return CommandeStockQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommandeStockQuery(get_called_class());
    }
}
