<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fournisseur_produit".
 *
 * @property integer $id_fournisseur
 * @property integer $id_produit
 * @property double $nombre
 * @property string $date
 *
 * @property Produit $idProduit
 * @property Fournisseur $idFournisseur
 */
class FournisseurProduit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fournisseur_produit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_fournisseur', 'id_produit', 'nombre', 'date'], 'required'],
            [['id_fournisseur', 'id_produit'], 'integer'],
            [['nombre'], 'number'],
            [['date'], 'safe'],
            [['id_produit'], 'exist', 'skipOnError' => true, 'targetClass' => Produit::className(), 'targetAttribute' => ['id_produit' => 'id_produit']],
            [['id_fournisseur'], 'exist', 'skipOnError' => true, 'targetClass' => Fournisseur::className(), 'targetAttribute' => ['id_fournisseur' => 'id_fournisseur']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_fournisseur' => 'Id Fournisseur',
            'id_produit' => 'Id Produit',
            'nombre' => 'Nombre',
            'date' => 'Date',
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
    public function getIdFournisseur()
    {
        return $this->hasOne(Fournisseur::className(), ['id_fournisseur' => 'id_fournisseur']);
    }

    /**
     * @inheritdoc
     * @return FournisseurProduitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FournisseurProduitQuery(get_called_class());
    }
}
