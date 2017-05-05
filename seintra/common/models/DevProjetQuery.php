<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[DevProjet]].
 *
 * @see DevProjet
 */
class DevProjetQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return DevProjet[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return DevProjet|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
