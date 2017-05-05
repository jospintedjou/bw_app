<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "faire_activite".
 *
 * @property integer $id_activite
 * @property integer $id_user
 *
 * @property User $idUser
 * @property Activite $idActivite
 */
class FaireActivite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faire_activite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_activite', 'id_user'], 'required'],
            [['id_activite', 'id_user'], 'integer'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_activite'], 'exist', 'skipOnError' => true, 'targetClass' => Activite::className(), 'targetAttribute' => ['id_activite' => 'id_activite']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_activite' => 'Id Activite',
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
    public function getIdActivite()
    {
        return $this->hasOne(Activite::className(), ['id_activite' => 'id_activite']);
    }

    /**
     * @inheritdoc
     * @return FaireActiviteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FaireActiviteQuery(get_called_class());
    }
}
