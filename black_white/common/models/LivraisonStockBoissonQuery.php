<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[LivraisonStockBoisson]].
 *
 * @see LivraisonStockBoisson
 */
class LivraisonStockBoissonQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return LivraisonStockBoisson[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LivraisonStockBoisson|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
