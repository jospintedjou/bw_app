<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "activite".
 *
 * @property integer $id_activite
 * @property integer $id_projet
 * @property integer $id_fichier
 * @property string $nom
 * @property string $description
 * @property string $prestataire
 * @property string $date_debut
 * @property string $date_fin
 * @property string $type
 * @property string $statut
 *
 * @property Fichier $idFichier
 * @property Projet $idProjet
 * @property FaireActivite[] $faireActivites
 * @property Tache[] $taches
 */
class Activite extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'activite';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
          //  [['id_projet', 'id_fichier', 'date_debut', 'type', 'statut'], 'required'],
            [['id_projet', 'id_fichier'], 'integer'],
            [['description'], 'string'],
            [['date_debut', 'date_fin'], 'safe'],
            [['nom', 'prestataire'], 'string'],
            [['type', 'statut'], 'string', 'max' => 20],
            [['statut'], 'in', 'range' =>['en_cours','en_attente','termine','abandon', 'termine_attente']],
        //    [['id_fichier'], 'exist', 'skipOnError' => true, 'targetClass' => Fichier::className(), 'targetAttribute' => ['id_fichier' => 'id_fichier']],
          //  [['id_projet'], 'exist', 'skipOnError' => true, 'targetClass' => Projet::className(), 'targetAttribute' => ['id_projet' => 'id_projet']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_activite' => 'Id Activite',
            'id_projet' => 'Id Projet',
            'id_fichier' => 'Id Fichier',
            'nom' => 'Nom',
            'description' => 'Description',
            'prestataire' => 'Prestataire',
            'date_debut' => 'Date Debut',
            'date_fin' => 'Date Fin',
            'type' => 'Type',
            'statut' => 'Statut',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFichier() {
        return $this->hasOne(Fichier::className(), ['id_fichier' => 'id_fichier']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProjet() {
        return $this->hasOne(Projet::className(), ['id_projet' => 'id_projet']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaireActivites() {
        return $this->hasMany(FaireActivite::className(), ['id_activite' => 'id_activite']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaches() {
        return $this->hasMany(Tache::className(), ['id_activite' => 'id_activite']);
    }

    /**
     * @inheritdoc
     * @return ActiviteQuery the active query used by this AR class.
     */
    public static function find() {
        return new ActiviteQuery(get_called_class());
    }

}
