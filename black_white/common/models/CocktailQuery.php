<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Cocktail]].
 *
 * @see Cocktail
 */
class CocktailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Cocktail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Cocktail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
