<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Conso]].
 *
 * @see Conso
 */
class ConsoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Conso[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Conso|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
