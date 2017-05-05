<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tache".
 *
 * @property integer $id_tache
 * @property integer $id_activite
 * @property integer $id_fichier
 * @property string $nom
 * @property string $description
 * @property string $prestataire
 * @property string $date_debut
 * @property string $date_fin
 * @property string $type
 * @property string $statut
 *
 * @property FaireTache[] $faireTaches
 * @property Fichier $idFichier
 * @property Activite $idActivite
 */
class Tache extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tache';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id_activite', 'date_debut', 'type', 'statut'], 'required'],
            [['id_activite', 'id_fichier'], 'integer'],
            [['description'], 'string'],
            [['date_debut', 'date_fin'], 'safe'],
            [['nom', 'prestataire'], 'string'],
            [['type', 'statut'], 'string', 'max' => 20],
            [['statut'], 'in', 'range' =>['en_cours','en_attente','termine','abandon', 'termine_attente']],
            [['id_fichier'], 'exist', 'skipOnError' => true, 'targetClass' => Fichier::className(), 'targetAttribute' => ['id_fichier' => 'id_fichier']],
            [['id_activite'], 'exist', 'skipOnError' => true, 'targetClass' => Activite::className(), 'targetAttribute' => ['id_activite' => 'id_activite']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_tache' => 'Id Tache',
            'id_activite' => 'Id Activite',
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
    public function getFaireTaches() {
        return $this->hasMany(FaireTache::className(), ['id_tache' => 'id_tache']);
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
    public function getIdActivite() {
        return $this->hasOne(Activite::className(), ['id_activite' => 'id_activite']);
    }

    /**
     * @inheritdoc
     * @return TacheQuery the active query used by this AR class.
     */
    public static function find() {
        return new TacheQuery(get_called_class());
    }

}
