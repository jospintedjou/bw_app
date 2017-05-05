<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lire_comment".
 *
 * @property integer $id_comment
 * @property integer $id_user
 * @property string $affiche
 * @property string $lu
 *
 * @property Commenter $comment
 * @property User $user
 */
class LireComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lire_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_comment', 'id_user'], 'required'],
            [['id_comment', 'id_user'], 'integer'],
            [['affiche', 'lu'], 'string', 'max' => 3],
            [['affiche', 'lu'], 'default', 'value'=>'non' ],
            [['id_comment'], 'exist', 'skipOnError' => true, 'targetClass' => Commenter::className(), 'targetAttribute' => ['id_comment' => 'id_comment']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_comment' => 'Id Comment',
            'id_user' => 'Id User',
            'affiche' => 'Affiche',
            'lu' => 'Lu',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComment()
    {
        return $this->hasOne(Commenter::className(), ['id_comment' => 'id_comment']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
