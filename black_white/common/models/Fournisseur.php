<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fournisseur".
 *
 * @property integer $id_fournisseur
 * @property string $nom
 * @property string $adresse
 * @property string $telephone
 * @property string $ville
 *
 * @property FournisseurProduit[] $fournisseurProduits
 * @property Produit[] $idProduits
 */
class Fournisseur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fournisseur';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nom', 'adresse', 'telephone', 'ville'], 'required'],
            [['nom', 'adresse'], 'string', 'max' => 30],
            [['telephone', 'ville'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_fournisseur' => 'Id Fournisseur',
            'nom' => 'Nom',
            'adresse' => 'Adresse',
            'telephone' => 'Telephone',
            'ville' => 'Ville',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFournisseurProduits()
    {
        return $this->hasMany(FournisseurProduit::className(), ['id_fournisseur' => 'id_fournisseur']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProduits()
    {
        return $this->hasMany(Produit::className(), ['id_produit' => 'id_produit'])->viaTable('fournisseur_produit', ['id_fournisseur' => 'id_fournisseur']);
    }

    /**
     * @inheritdoc
     * @return FournisseurQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FournisseurQuery(get_called_class());
    }
}
