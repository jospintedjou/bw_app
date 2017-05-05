<?php

namespace common;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $nom
 * @property string $prenom
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $id_supp
 *
 * @property Contact[] $contacts
 * @property DevProjet[] $devProjets
 * @property Projet[] $projets
 * @property FaireActivite[] $faireActivites
 * @property FaireTache[] $faireTaches
 * @property Fichier[] $fichiers
 * @property LirePubl[] $lirePubls
 * @property ParticiperReunion[] $participerReunions
 * @property Publication[] $publications
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nom', 'username', 'auth_key', 'password_hash', 'email', 'role', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at', 'id_supp'], 'integer'],
            [['nom', 'prenom', 'username'], 'string', 'max' => 20],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 50],
            [['role'], 'string', 'max' => 15],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nom' => 'Nom',
            'prenom' => 'Prenom',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'role' => 'Role',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'id_supp' => 'Id Supp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevProjets()
    {
        return $this->hasMany(DevProjet::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjets()
    {
        return $this->hasMany(Projet::className(), ['id_projet' => 'id_projet'])->viaTable('dev_projet', ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaireActivites()
    {
        return $this->hasMany(FaireActivite::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaireTaches()
    {
        return $this->hasMany(FaireTache::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFichiers()
    {
        return $this->hasMany(Fichier::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLirePubls()
    {
        return $this->hasMany(LirePubl::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticiperReunions()
    {
        return $this->hasMany(ParticiperReunion::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublications()
    {
        return $this->hasMany(Publication::className(), ['id_user' => 'id']);
    }
}
