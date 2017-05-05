<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Magasin]].
 *
 * @see Magasin
 */
class MagasinQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Magasin[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Magasin|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
