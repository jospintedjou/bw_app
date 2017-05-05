<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CommandeProduit]].
 *
 * @see CommandeProduit
 */
class CommandeProduitQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CommandeProduit[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CommandeProduit|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
