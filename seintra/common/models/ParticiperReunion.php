<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "participer_reunion".
 *
 * @property integer $id_user
 * @property integer $id_reunion
 * @property string $ajoute_apres
 *
 * @property User $idUser
 * @property Reunion $idReunion
 */
class ParticiperReunion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'participer_reunion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_reunion'], 'integer'],
            [['id_reunion', 'ajoute_apres'], 'required'],
            [['ajoute_apres'], 'string', 'max' => 3],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_reunion'], 'exist', 'skipOnError' => true, 'targetClass' => Reunion::className(), 'targetAttribute' => ['id_reunion' => 'id_reunion']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'id_reunion' => 'Id Reunion',
            'ajoute_apres' => 'Ajoute Apres',
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
    public function getIdReunion()
    {
        return $this->hasOne(Reunion::className(), ['id_reunion' => 'id_reunion']);
    }

    /**
     * @inheritdoc
     * @return ParticiperReunionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ParticiperReunionQuery(get_called_class());
    }
}
