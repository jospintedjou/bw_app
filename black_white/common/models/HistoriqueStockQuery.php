<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[HistoriqueStock]].
 *
 * @see HistoriqueStock
 */
class HistoriqueStockQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return HistoriqueStock[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return HistoriqueStock|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
