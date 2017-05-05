<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CommandeStockBoisson]].
 *
 * @see CommandeStockBoisson
 */
class CommandeStockBoissonQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CommandeStockBoisson[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CommandeStockBoisson|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
