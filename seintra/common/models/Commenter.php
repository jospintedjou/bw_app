<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "commenter".
 *
 * @property integer $id_user
 * @property integer $id_publ
 * @property string $date_post
 * @property string $contenu
 */
class Commenter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'commenter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_publ', 'date_post', 'contenu'], 'required'],
            [['id_user', 'id_publ'], 'integer'],
            [['date_post'], 'safe'],
            [['contenu'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'id_publ' => 'Id Publ',
            'date_post' => 'Date Post',
            'contenu' => 'Contenu',
        ];
    }

    /**
     * @inheritdoc
     * @return CommenterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommenterQuery(get_called_class());
    }
}
