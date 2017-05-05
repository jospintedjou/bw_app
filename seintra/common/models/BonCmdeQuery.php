<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BonCmde]].
 *
 * @see BonCmde
 */
class BonCmdeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return BonCmde[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BonCmde|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
