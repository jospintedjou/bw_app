<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lire_publ".
 *
 * @property integer $id_publ
 * @property integer $id_user
 * @property string $affiche
 * @property string $lu
 *
 * @property Publication $publ
 * @property User $user
 */
class LirePubl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lire_publ';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_publ', 'id_user'], 'required'],
            [['id_publ', 'id_user'], 'integer'],
            [['affiche', 'lu'], 'string', 'max' => 3],
            [['affiche', 'lu'], 'default', 'value'=>'non' ],
            [['id_publ'], 'exist', 'skipOnError' => true, 'targetClass' => Publication::className(), 'targetAttribute' => ['id_publ' => 'id_publ']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_publ' => 'Id Publ',
            'id_user' => 'Id User',
            'affiche' => 'Affiche',
            'lu' => 'Lu',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPubl()
    {
        return $this->hasOne(Publication::className(), ['id_publ' => 'id_publ']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
