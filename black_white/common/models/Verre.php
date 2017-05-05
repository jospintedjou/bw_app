<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "verre".
 *
 * @property integer $id_verre
 * @property integer $id_boisson
 * @property double $nb_btlle
 * @property integer $prix_btlle
 * @property integer $prix_demie
 *
 * @property Boisson $idBoisson
 */
class Verre extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'verre';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_boisson', 'nb_btlle', 'prix_btlle', 'prix_demie'], 'required'],
            [['id_boisson', 'prix_btlle', 'prix_demie'], 'integer'],
            [['nb_btlle'], 'number'],
            [['id_boisson'], 'exist', 'skipOnError' => true, 'targetClass' => Boisson::className(), 'targetAttribute' => ['id_boisson' => 'id_boisson']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_verre' => 'Id Verre',
            'id_boisson' => 'Id Boisson',
            'nb_btlle' => 'Nb Btlle',
            'prix_btlle' => 'Prix Btlle',
            'prix_demie' => 'Prix Demie',
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
     * @return VerreQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VerreQuery(get_called_class());
    }
}
