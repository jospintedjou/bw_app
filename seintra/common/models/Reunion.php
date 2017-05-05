<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reunion".
 *
 * @property integer $id_reunion
 * @property integer $id_fichier
 * @property string $description
 * @property string $date
 * @property string $heure_debut
 * @property string $heure_fin
 * @property string $lieu
 *
 * @property ParticiperReunion[] $participerReunions
 */
class Reunion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reunion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_fichier',  'heure_debut','date', 'heure_fin'], 'required'],
            [['id_fichier'], 'integer'],
            [['description'], 'string'],
            ['date', 'date','format'=>'yyyy-mm-dd'],
            [['heure_debut', 'heure_fin'],'date','format'=>'HH:mm:ss'],
            ['heure_fin', 'compare', 'compareAttribute' => 'heure_debut','operator'=>'>','message'=>"l'heure de fin doit être supérieure à l'heure de debut"],
            [['date', 'heure_debut', 'heure_fin'], 'safe'],
            [['lieu'], 'string', 'max' => 100],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_reunion' => 'Id Reunion',
            'id_fichier' => 'Id Fichier',
            'description' => 'Description',
            'date' => 'Date',
            'heure_debut' => 'Heure Debut',
            'heure_fin' => 'Heure Fin',
            'lieu' => 'Lieu',
            'title'=>"Libelle Reunion",
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticiperReunions()
    {
        return $this->hasMany(ParticiperReunion::className(), ['id_reunion' => 'id_reunion']);
    }

    /**
     * @inheritdoc
     * @return ReunionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReunionQuery(get_called_class());
    }
}
