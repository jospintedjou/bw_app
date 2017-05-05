<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Bouteille]].
 *
 * @see Bouteille
 */
class BouteilleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Bouteille[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Bouteille|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
