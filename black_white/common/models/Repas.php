<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "repas".
 *
 * @property integer $id_repas
 * @property integer $prix
 * @property integer $quantite
 *
 * @property CommandeRepas[] $commandeRepas
 */
class Repas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'repas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prix', 'quantite'], 'required'],
            [['prix', 'quantite'], 'integer'],
            [['id_repas'], 'exist', 'skipOnError' => true, 'targetClass' => Produit::className(), 'targetAttribute' => ['id_repas' => 'id_produit']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_repas' => 'Id Repas',
            'prix' => 'Prix',
            'quantite' => 'Quantite',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommandeRepas()
    {
        return $this->hasMany(CommandeRepas::className(), ['id_repas' => 'id_repas']);
    }

    /**
     * @inheritdoc
     * @return RepasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RepasQuery(get_called_class());
    }
}
