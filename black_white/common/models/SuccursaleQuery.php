<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Succursale]].
 *
 * @see Succursale
 */
class SuccursaleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Succursale[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Succursale|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
