<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "livraison_stock_boisson".
 *
 * @property integer $id_livraison
 * @property integer $id_boisson
 * @property integer $nb_btlle
 *
 * @property Livraison $idLivraison
 */
class LivraisonStockBoisson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'livraison_stock_boisson';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_livraison', 'id_boisson', 'nb_btlle'], 'required'],
            [['id_livraison', 'id_boisson', 'nb_btlle'], 'integer'],
            [['id_livraison'], 'exist', 'skipOnError' => true, 'targetClass' => Livraison::className(), 'targetAttribute' => ['id_livraison' => 'id_livraison']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_livraison' => 'Id Livraison',
            'id_boisson' => 'Id Boisson',
            'nb_btlle' => 'Nb Btlle',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLivraison()
    {
        return $this->hasOne(Livraison::className(), ['id_livraison' => 'id_livraison']);
    }

    /**
     * @inheritdoc
     * @return LivraisonStockBoissonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LivraisonStockBoissonQuery(get_called_class());
    }
}
