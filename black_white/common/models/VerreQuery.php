<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Verre]].
 *
 * @see Verre
 */
class VerreQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Verre[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Verre|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
