<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cocktail".
 *
 * @property integer $id_cocktail
 * @property string $nom
 * @property integer $prix
 *
 * @property BoissonCocktail[] $boissonCocktails
 * @property Boisson[] $idBoissons
 */
class Cocktail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cocktail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nom', 'prix'], 'required'],
            [['prix'], 'integer'],
            [['nom'], 'string', 'max' => 30],
            [['id_cocktail'], 'exist', 'skipOnError' => true, 'targetClass' => Produit::className(), 'targetAttribute' => ['id_cocktail' => 'id_produit']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cocktail' => 'Id Cocktail',
            'nom' => 'Nom',
            'prix' => 'Prix',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoissonCocktails()
    {
        return $this->hasMany(BoissonCocktail::className(), ['id_cocktail' => 'id_cocktail']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBoissons()
    {
        return $this->hasMany(Boisson::className(), ['id_boisson' => 'id_boisson'])->viaTable('boisson_cocktail', ['id_cocktail' => 'id_cocktail']);
    }

    /**
     * @inheritdoc
     * @return CocktailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CocktailQuery(get_called_class());
    }
}
