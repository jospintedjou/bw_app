<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dev_projet".
 *
 * @property integer $id_projet
 * @property integer $id_user
 * @property string $role
 *
 * @property User $idUser
 * @property Projet $idProjet
 * @property Role $role
 */
class DevProjet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dev_projet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_projet', 'id_user', 'role'], 'required'],
            [['id_projet', 'id_user'], 'integer'],
            [['role'], 'string', 'max'=>20],
            [['role'], 'in', 'range'=>['dev', 'chef'] ],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_projet'], 'exist', 'skipOnError' => true, 'targetClass' => Projet::className(), 'targetAttribute' => ['id_projet' => 'id_projet']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_projet' => 'Id Projet',
            'id_user' => 'Id User',
            'role' => 'Role'
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
    public function getIdProjet()
    {
        return $this->hasOne(Projet::className(), ['id_projet' => 'id_projet']);
    }

    /**
     * @inheritdoc
     * @return DevProjetQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DevProjetQuery(get_called_class());
    }
}
