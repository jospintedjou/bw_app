<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[FaireTache]].
 *
 * @see FaireTache
 */
class FaireTacheQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return FaireTache[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FaireTache|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
