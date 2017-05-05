<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Fichier]].
 *
 * @see Fichier
 */
class FichierQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Fichier[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Fichier|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
