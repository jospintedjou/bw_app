<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Repas]].
 *
 * @see Repas
 */
class RepasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Repas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Repas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
