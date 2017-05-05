<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Transfert]].
 *
 * @see Transfert
 */
class TransfertQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Transfert[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Transfert|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
