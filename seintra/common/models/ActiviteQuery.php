<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Activite]].
 *
 * @see Activite
 */
class ActiviteQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Activite[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Activite|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
