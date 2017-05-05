<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bouteille".
 *
 * @property integer $id_bouteille
 * @property integer $id_boisson
 * @property double $nb_btlle
 * @property integer $prix_achat_btlle
 * @property integer $prix_vente_btlle
 * @property integer $prix_vente_demie
 *
 * @property Boisson $idBoisson
 */
class Bouteille extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bouteille';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_boisson', 'nb_btlle', 'prix_achat_btlle', 'prix_vente_btlle', 'prix_vente_demie', 'capacite'], 'required'],
            [['id_boisson', 'prix_achat_btlle', 'prix_vente_btlle', 'prix_vente_demie'], 'integer'],
            [['nb_btlle', 'capacite'], 'number'],
            [['id_boisson'], 'exist', 'skipOnError' => true, 'targetClass' => Boisson::className(), 'targetAttribute' => ['id_boisson' => 'id_boisson']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_bouteille' => 'Id Bouteille',
            'id_boisson' => 'Id Boisson',
            'nb_btlle' => 'Nb Btlle',
            'prix_achat_btlle' => 'Prix Achat Btlle',
            'prix_vente_btlle' => 'Prix Vente Btlle',
            'prix_vente_demie' => 'Prix Vente Demie',
            'capacite' => 'capacite',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBoisson()
    {
        return $this->hasOne(Boisson::className(), ['id_boisson' => 'id_boisson']);
    }

    /**
     * @inheritdoc
     * @return BouteilleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BouteilleQuery(get_called_class());
    }
}
