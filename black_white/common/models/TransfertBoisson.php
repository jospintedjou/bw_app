<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transfert_boisson".
 *
 * @property integer $id_transfert
 * @property integer $id_boisson
 * @property integer $nb_btlle
 *
 * @property Boisson $idBoisson
 * @property Transfert $idTransfert
 */
class TransfertBoisson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transfert_boisson';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transfert', 'id_boisson', 'nb_btlle'], 'required'],
            [['id_transfert', 'id_boisson', 'nb_btlle'], 'integer'],
            [['id_boisson'], 'exist', 'skipOnError' => true, 'targetClass' => Boisson::className(), 'targetAttribute' => ['id_boisson' => 'id_boisson']],
            [['id_transfert'], 'exist', 'skipOnError' => true, 'targetClass' => Transfert::className(), 'targetAttribute' => ['id_transfert' => 'id_transfert']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_transfert' => 'Id Transfert',
            'id_boisson' => 'Id Boisson',
            'nb_btlle' => 'Nb Btlle',
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
     * @return \yii\db\ActiveQuery
     */
    public function getIdTransfert()
    {
        return $this->hasOne(Transfert::className(), ['id_transfert' => 'id_transfert']);
    }

    /**
     * @inheritdoc
     * @return TransfertBoissonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransfertBoissonQuery(get_called_class());
    }
}
