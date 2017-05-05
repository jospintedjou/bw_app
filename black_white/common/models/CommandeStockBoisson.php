<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "commande_stock_boisson".
 *
 * @property integer $id_commande
 * @property integer $id_boisson
 * @property integer $nb_btlle
 *
 * @property Boisson $idBoisson
 * @property CommandeStock $idCommande
 * @property Boisson $idBoisson0
 */
class CommandeStockBoisson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'commande_stock_boisson';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_commande', 'id_boisson', 'nb_btlle'], 'required'],
            [['id_commande', 'id_boisson', 'nb_btlle'], 'integer'],
            [['id_boisson'], 'exist', 'skipOnError' => true, 'targetClass' => Boisson::className(), 'targetAttribute' => ['id_boisson' => 'id_boisson']],
            [['id_commande'], 'exist', 'skipOnError' => true, 'targetClass' => CommandeStock::className(), 'targetAttribute' => ['id_commande' => 'id_commande']],
            [['id_boisson'], 'exist', 'skipOnError' => true, 'targetClass' => Boisson::className(), 'targetAttribute' => ['id_boisson' => 'id_boisson']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_commande' => 'Id Commande',
            'id_boisson' => 'Id Boisson',
            'nb_btlle' => 'Nb Btlle',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBoisson()
    {
        return $this->hasOne(Boisson::className(), ['id_boisson' => 'id_boisson']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCommande()
    {
        return $this->hasOne(CommandeStock::className(), ['id_commande' => 'id_commande']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBoisson0()
    {
        return $this->hasOne(Boisson::className(), ['id_boisson' => 'id_boisson']);
    }

    /**
     * @inheritdoc
     * @return CommandeStockBoissonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommandeStockBoissonQuery(get_called_class());
    }
}
