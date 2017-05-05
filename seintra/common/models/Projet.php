<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "projet".
 *
 * @property integer $id_projet
 * @property integer $id_fichier
 * @property string $nom
 * @property string $description
 * @property string $date_debut
 * @property string $date_fin
 * @property string $prestataire
 * @property string $type
 *
 * @property Activite[] $activites
 * @property DevProjet[] $devProjets
 * @property Fichier $idFichier
 */
class Projet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           [[ 'nom', 'date_debut', 'type'], 'required'],
            [['id_fichier'], 'integer'],
            [['description'], 'string'],
            [['date_debut', 'date_fin'], 'safe'],
            [['nom', 'prestataire'], 'string'],
            [['type','statut'], 'string', 'max' => 20],
            
            [['type'], 'in', 'range'=>['technique','adm_struct']],
            
            [['statut'], 'in', 'range' =>['en_cours','en_attente','termine','abandon', 'termine_attente']],
            
           // [['id_fichier'], 'exist', 'skipOnError' => true, 'targetClass' => Fichier::className(), 'targetAttribute' => ['id_fichier' => 'id_fichier']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_projet' => 'Id Projet',
            'id_fichier' => 'Id Fichier',
            'nom' => 'Nom',
            'description' => 'Description',
            'date_debut' => 'Date Debut',
            'date_fin' => 'Date Fin',
            'prestataire' => 'Prestataire',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivites()
    {
        return $this->hasMany(Activite::className(), ['id_projet' => 'id_projet']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevProjets()
    {
        return $this->hasMany(DevProjet::className(), ['id_projet' => 'id_projet']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFichier()
    {
        return $this->hasOne(Fichier::className(), ['id_fichier' => 'id_fichier']);
    }

    /**
     * @inheritdoc
     * @return ProjetQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjetQuery(get_called_class());
    }
}
