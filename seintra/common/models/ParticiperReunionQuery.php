<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ParticiperReunion]].
 *
 * @see ParticiperReunion
 */
class ParticiperReunionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ParticiperReunion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ParticiperReunion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
