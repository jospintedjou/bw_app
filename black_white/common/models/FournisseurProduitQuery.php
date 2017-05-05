<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[FournisseurProduit]].
 *
 * @see FournisseurProduit
 */
class FournisseurProduitQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return FournisseurProduit[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FournisseurProduit|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
