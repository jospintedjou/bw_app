<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "historique_stock".
 *
 * @property integer $id_historique_stock
 * @property string $date
 *
 * @property HistoriqueStockProduit[] $historiqueStockProduits
 * @property Produit[] $idProduits
 */
class HistoriqueStock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'historique_stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'required'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_historique_stock' => 'Id Historique Stock',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoriqueStockProduits()
    {
        return $this->hasMany(HistoriqueStockProduit::className(), ['id_historique_stock' => 'id_historique_stock']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProduits()
    {
        return $this->hasMany(Produit::className(), ['id_produit' => 'id_produit'])->viaTable('historique_stock_produit', ['id_historique_stock' => 'id_historique_stock']);
    }

    /**
     * @inheritdoc
     * @return HistoriqueStockQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HistoriqueStockQuery(get_called_class());
    }
}
