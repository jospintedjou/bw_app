<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "faire_tache".
 *
 * @property integer $id_tache
 * @property integer $id_user
 *
 * @property User $idUser
 * @property Tache $idTache
 */
class FaireTache extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faire_tache';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tache', 'id_user'], 'required'],
            [['id_tache', 'id_user'], 'integer'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_tache'], 'exist', 'skipOnError' => true, 'targetClass' => Tache::className(), 'targetAttribute' => ['id_tache' => 'id_tache']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tache' => 'Id Tache',
            'id_user' => 'Id User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTache()
    {
        return $this->hasOne(Tache::className(), ['id_tache' => 'id_tache']);
    }

    /**
     * @inheritdoc
     * @return FaireTacheQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FaireTacheQuery(get_called_class());
    }
}
