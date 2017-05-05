<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "produit".
 *
 * @property integer $id_produit
 * @property integer $id_categorie
 * @property integer $id_photo
 * @property string $nom
 *
 * @property Boisson $boisson
 * @property Cocktail $cocktail
 * @property CommandeProduit[] $commandeProduits
 * @property CommandeClient[] $idCommandeClients
 * @property FournisseurProduit[] $fournisseurProduits
 * @property Fournisseur[] $idFournisseurs
 * @property HistoriqueStockProduit[] $historiqueStockProduits
 * @property HistoriqueStock[] $idHistoriqueStocks
 * @property Categorie $idCategorie
 * @property Photo $idPhoto
 * @property Repas $repas
 * @property Tabac $tabac
 */
class Produit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'produit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_categorie', 'nom'], 'required'],
            [['id_categorie', 'id_photo'], 'integer'],
            [['nom'], 'string', 'max' => 60],
            [['id_categorie'], 'exist', 'skipOnError' => true, 'targetClass' => Categorie::className(), 'targetAttribute' => ['id_categorie' => 'id_categorie']],
            [['id_photo'], 'exist', 'skipOnError' => true, 'targetClass' => Photo::className(), 'targetAttribute' => ['id_photo' => 'id_photo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_produit' => 'Id Produit',
            'id_categorie' => 'Id Categorie',
            'id_photo' => 'Id Photo',
            'nom' => 'Nom',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoisson()
    {
        return $this->hasOne(Boisson::className(), ['id_boisson' => 'id_produit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCocktail()
    {
        return $this->hasOne(Cocktail::className(), ['id_cocktail' => 'id_produit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommandeProduits()
    {
        return $this->hasMany(CommandeProduit::className(), ['id_produit' => 'id_produit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCommandeClients()
    {
        return $this->hasMany(CommandeClient::className(), ['id_commande_client' => 'id_commande_client'])->viaTable('commande_produit', ['id_produit' => 'id_produit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFournisseurProduits()
    {
        return $this->hasMany(FournisseurProduit::className(), ['id_produit' => 'id_produit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFournisseurs()
    {
        return $this->hasMany(Fournisseur::className(), ['id_fournisseur' => 'id_fournisseur'])->viaTable('fournisseur_produit', ['id_produit' => 'id_produit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoriqueStockProduits()
    {
        return $this->hasMany(HistoriqueStockProduit::className(), ['id_produit' => 'id_produit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdHistoriqueStocks()
    {
        return $this->hasMany(HistoriqueStock::className(), ['id_historique_stock' => 'id_historique_stock'])->viaTable('historique_stock_produit', ['id_produit' => 'id_produit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategorie()
    {
        return $this->hasOne(Categorie::className(), ['id_categorie' => 'id_categorie']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPhoto()
    {
        return $this->hasOne(Photo::className(), ['id_photo' => 'id_photo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepas()
    {
        return $this->hasOne(Repas::className(), ['id_repas' => 'id_produit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabac()
    {
        return $this->hasOne(Tabac::className(), ['id_tabac' => 'id_produit']);
    }

    /**
     * @inheritdoc
     * @return ProduitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProduitQuery(get_called_class());
    }
}
