<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "photo".
 *
 * @property integer $id_photo
 * @property string $nom
 *
 * @property Produit[] $produits
 * @property User[] $users
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nom'], 'required'],
            [['nom'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_photo' => 'Id Photo',
            'nom' => 'Nom',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduits()
    {
        return $this->hasMany(Produit::className(), ['id_photo' => 'id_photo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id_photo' => 'id_photo']);
    }

    /**
     * @inheritdoc
     * @return PhotoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PhotoQuery(get_called_class());
    }
}
