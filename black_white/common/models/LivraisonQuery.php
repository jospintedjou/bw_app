<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Livraison]].
 *
 * @see Livraison
 */
class LivraisonQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Livraison[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Livraison|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
