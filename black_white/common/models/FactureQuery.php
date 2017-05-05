<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Facture]].
 *
 * @see Facture
 */
class FactureQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Facture[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Facture|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
