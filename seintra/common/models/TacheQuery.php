<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Tache]].
 *
 * @see Tache
 */
class TacheQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Tache[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Tache|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
