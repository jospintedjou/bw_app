<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "boisson".
 *
 * @property integer $id_boisson
 * @property integer $prix
 * @property integer $quantite
 *
 * @property BoissonCocktail[] $boissonCocktails
 * @property Cocktail[] $idCocktails
 * @property Bouteille[] $bouteilles
 * @property CommandeBoisson[] $commandeBoissons
 * @property CommandeStockBoisson[] $commandeStockBoissons
 * @property CommandeStockBoisson[] $commandeStockBoissons0
 * @property CommandeStock[] $idCommandes
 * @property CommandeStock[] $idCommandes0
 * @property Conso[] $consos
 * @property TransfertBoisson[] $transfertBoissons
 * @property Transfert[] $idTransferts
 * @property Verre[] $verres
 */
class Boisson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'boisson';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['dilluant', 'string', 'max'=>3],
            ['dilluant', 'in', 'range'=>['oui', 'non']],
            ['dilluant', 'default', 'value'=>'non'],
            [['id_boisson'], 'exist', 'skipOnError' => true, 'targetClass' => Produit::className(), 'targetAttribute' => ['id_boisson' => 'id_produit']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_boisson' => 'Id Boisson',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoissonCocktails()
    {
        return $this->hasMany(BoissonCocktail::className(), ['id_boisson' => 'id_boisson']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCocktails()
    {
        return $this->hasMany(Cocktail::className(), ['id_cocktail' => 'id_cocktail'])->viaTable('boisson_cocktail', ['id_boisson' => 'id_boisson']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBouteilles()
    {
        return $this->hasMany(Bouteille::className(), ['id_boisson' => 'id_boisson']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommandeBoissons()
    {
        return $this->hasMany(CommandeBoisson::className(), ['id_boisson' => 'id_boisson']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommandeStockBoissons()
    {
        return $this->hasMany(CommandeStockBoisson::className(), ['id_boisson' => 'id_boisson']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommandeStockBoissons0()
    {
        return $this->hasMany(CommandeStockBoisson::className(), ['id_boisson' => 'id_boisson']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCommandes()
    {
        return $this->hasMany(CommandeStock::className(), ['id_commande' => 'id_commande'])->viaTable('commande_stock_boisson', ['id_boisson' => 'id_boisson']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCommandes0()
    {
        return $this->hasMany(CommandeStock::className(), ['id_commande' => 'id_commande'])->viaTable('commande_stock_boisson', ['id_boisson' => 'id_boisson']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsos()
    {
        return $this->hasMany(Conso::className(), ['id_boisson' => 'id_boisson']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransfertBoissons()
    {
        return $this->hasMany(TransfertBoisson::className(), ['id_boisson' => 'id_boisson']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTransferts()
    {
        return $this->hasMany(Transfert::className(), ['id_transfert' => 'id_transfert'])->viaTable('transfert_boisson', ['id_boisson' => 'id_boisson']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVerres()
    {
        return $this->hasMany(Verre::className(), ['id_boisson' => 'id_boisson']);
    }

    /**
     * @inheritdoc
     * @return BoissonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BoissonQuery(get_called_class());
    }
}
