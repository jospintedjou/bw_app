<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property integer $id_mess
 * @property string $contenu
 * @property string $date_post
 * @property string $affiche
 * @property string $lu
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contenu'], 'string'],
            [['date_post'], 'required'],
            [['date_post'], 'safe'],
            [['affiche', 'lu'], 'default', 'value'=>'non' ],
            [['affiche', 'lu'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_mess' => 'Id Mess',
            'contenu' => 'Contenu',
            'date_post' => 'Date Post',
            'affiche' => 'Affiche',
            'lu' => 'Lu',
        ];
    }
}
