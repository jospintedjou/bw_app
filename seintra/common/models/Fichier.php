<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fichier".
 *
 * @property integer $id_fichier
 * @property integer $id_user
 * @property string $nom
 * @property string $type
 *
 * @property Activite[] $activites
 * @property User $idUser
 * @property Projet[] $projets
 * @property Tache[] $taches
 */
class Fichier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fichier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['id_user', 'nom', 'type'], 'required'],
            [['nom', 'type'], 'required'],
            [['id_user'], 'integer'],
            [['nom'], 'string'],
            [['type'], 'string', 'max' => 20],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_fichier' => 'Id Fichier',
            'id_user' => 'Id User',
            'nom' => 'Nom',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivites()
    {
        return $this->hasMany(Activite::className(), ['id_fichier' => 'id_fichier']);
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
    public function getProjets()
    {
        return $this->hasMany(Projet::className(), ['id_fichier' => 'id_fichier']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaches()
    {
        return $this->hasMany(Tache::className(), ['id_fichier' => 'id_fichier']);
    }

    /**
     * @inheritdoc
     * @return FichierQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FichierQuery(get_called_class());
    }
}
