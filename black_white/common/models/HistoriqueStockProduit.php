<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "historique_stock_produit".
 *
 * @property integer $id_historique_stock
 * @property integer $id_produit
 * @property double $nombre
 *
 * @property Produit $idProduit
 * @property HistoriqueStock $idHistoriqueStock
 */
class HistoriqueStockProduit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'historique_stock_produit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_historique_stock', 'id_produit', 'nombre'], 'required'],
            [['id_historique_stock', 'id_produit'], 'integer'],
            [['nombre'], 'number'],
            [['id_produit'], 'exist', 'skipOnError' => true, 'targetClass' => Produit::className(), 'targetAttribute' => ['id_produit' => 'id_produit']],
            [['id_historique_stock'], 'exist', 'skipOnError' => true, 'targetClass' => HistoriqueStock::className(), 'targetAttribute' => ['id_historique_stock' => 'id_historique_stock']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_historique_stock' => 'Id Historique Stock',
            'id_produit' => 'Id Produit',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProduit()
    {
        return $this->hasOne(Produit::className(), ['id_produit' => 'id_produit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdHistoriqueStock()
    {
        return $this->hasOne(HistoriqueStock::className(), ['id_historique_stock' => 'id_historique_stock']);
    }

    /**
     * @inheritdoc
     * @return HistoriqueStockProduitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HistoriqueStockProduitQuery(get_called_class());
    }
}
