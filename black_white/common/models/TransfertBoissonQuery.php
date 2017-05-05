<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TransfertBoisson]].
 *
 * @see TransfertBoisson
 */
class TransfertBoissonQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TransfertBoisson[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TransfertBoisson|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
