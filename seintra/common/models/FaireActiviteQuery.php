<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[FaireActivite]].
 *
 * @see FaireActivite
 */
class FaireActiviteQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return FaireActivite[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FaireActivite|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
