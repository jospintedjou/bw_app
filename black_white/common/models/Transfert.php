<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transfert".
 *
 * @property integer $id_transfert
 * @property integer $id_succ_source
 * @property integer $id_succ_dest
 * @property string $code
 * @property string $date
 *
 * @property Succursale $idSuccDest
 * @property Succursale $idSuccSource
 * @property TransfertBoisson[] $transfertBoissons
 * @property Boisson[] $idBoissons
 */
class Transfert extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transfert';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_succ_source', 'id_succ_dest', 'code'], 'required'],
            [['id_succ_source', 'id_succ_dest'], 'integer'],
            [['date'], 'safe'],
            [['code'], 'string', 'max' => 100],
            [['id_succ_dest'], 'exist', 'skipOnError' => true, 'targetClass' => Succursale::className(), 'targetAttribute' => ['id_succ_dest' => 'id_succursale']],
            [['id_succ_source'], 'exist', 'skipOnError' => true, 'targetClass' => Succursale::className(), 'targetAttribute' => ['id_succ_source' => 'id_succursale']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_transfert' => 'Id Transfert',
            'id_succ_source' => 'Id Succ Source',
            'id_succ_dest' => 'Id Succ Dest',
            'code' => 'Code',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSuccDest()
    {
        return $this->hasOne(Succursale::className(), ['id_succursale' => 'id_succ_dest']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSuccSource()
    {
        return $this->hasOne(Succursale::className(), ['id_succursale' => 'id_succ_source']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransfertBoissons()
    {
        return $this->hasMany(TransfertBoisson::className(), ['id_transfert' => 'id_transfert']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBoissons()
    {
        return $this->hasMany(Boisson::className(), ['id_boisson' => 'id_boisson'])->viaTable('transfert_boisson', ['id_transfert' => 'id_transfert']);
    }

    /**
     * @inheritdoc
     * @return TransfertQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransfertQuery(get_called_class());
    }
}
