<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "boisson_cocktail".
 *
 * @property integer $id_cocktail
 * @property integer $id_boisson
 * @property double $nb_btlle
 * @property double $nb_demie_btlle
 * @property double $nb_conso
 * @property double $nb_verre
 *
 * @property Cocktail $idCocktail
 * @property Boisson $idBoisson
 */
class BoissonCocktail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'boisson_cocktail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cocktail', 'id_boisson', 'nb_btlle', 'nb_demie_btlle', 'nb_conso', 'nb_verre'], 'required'],
            [['id_cocktail', 'id_boisson'], 'integer'],
            [['nb_btlle', 'nb_demie_btlle', 'nb_conso', 'nb_verre'], 'number'],
            [['id_cocktail'], 'exist', 'skipOnError' => true, 'targetClass' => Cocktail::className(), 'targetAttribute' => ['id_cocktail' => 'id_cocktail']],
            [['id_boisson'], 'exist', 'skipOnError' => true, 'targetClass' => Boisson::className(), 'targetAttribute' => ['id_boisson' => 'id_boisson']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cocktail' => 'Id Cocktail',
            'id_boisson' => 'Id Boisson',
            'nb_btlle' => 'Nb Btlle',
            'nb_demie_btlle' => 'Nb Demie Btlle',
            'nb_conso' => 'Nb Conso',
            'nb_verre' => 'Nb Verre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCocktail()
    {
        return $this->hasOne(Cocktail::className(), ['id_cocktail' => 'id_cocktail']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBoisson()
    {
        return $this->hasOne(Boisson::className(), ['id_boisson' => 'id_boisson']);
    }

    /**
     * @inheritdoc
     * @return BoissonCocktailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BoissonCocktailQuery(get_called_class());
    }
}
