<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categorie".
 *
 * @property integer $id_categorie
 * @property string $nom
 * @property string $type
 * @property string $ville
 *
 * @property Produit[] $produits
 */
class Categorie extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categorie';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nom', 'type', 'ville'], 'required'],
            [['nom'], 'string', 'max' => 30],
            [['type', 'ville'], 'string', 'max' => 60],
            ['type', 'in', 'range'=>['repas', 'boisson', 'cocktail', 'tabac']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_categorie' => 'Id Categorie',
            'nom' => 'Nom',
            'type' => 'Type',
            'ville' => 'Ville',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduits()
    {
        return $this->hasMany(Produit::className(), ['id_categorie' => 'id_categorie']);
    }

    /**
     * @inheritdoc
     * @return CategorieQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategorieQuery(get_called_class());
    }
}
