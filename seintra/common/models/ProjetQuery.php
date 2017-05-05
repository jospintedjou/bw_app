<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Projet]].
 *
 * @see Projet
 */
class ProjetQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Projet[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Projet|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
