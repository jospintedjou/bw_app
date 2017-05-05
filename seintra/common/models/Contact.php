<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property integer $id_contact
 * @property integer $id_user
 * @property integer $id_client
 * @property string $date
 * @property string $motif
 * @property string $debouche
 * @property string $moyen
 *
 * @property User $idUser
 */
class Contact extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id_user', 'id_client', 'date', 'motif', 'debouche', 'moyen'], 'required'],
            [['id_user', 'id_client'], 'integer'],
            [['date'], 'safe'],
            [['motif', 'debouche'], 'string'],
            [['moyen'], 'string', 'max' => 20],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_contact' => 'Id Contact',
            'id_client' => 'Id Client',
            'id_user' => 'Id User',
            'date' => 'Date',
            'motif' => 'Motif',
            'debouche' => 'Debouche',
            'moyen' => 'Moyen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser() {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @inheritdoc
     * @return ContactQuery the active query used by this AR class.
     */
    public static function find() {
        return new ContactQuery(get_called_class());
    }

    

}
