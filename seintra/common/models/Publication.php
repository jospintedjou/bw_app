<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "publication".
 *
 * @property integer $id_publ
 * @property integer $id_user
 * @property string $date_post
 * @property string $contenu
 * @property string $type
 *
 * @property LirePubl[] $lirePubls
 * @property User $idUser
 */
class Publication extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'publication';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id_user', 'contenu', 'type'], 'required'],
            [['id_user'], 'integer'],
            [['date_post'], 'safe'],
            ['date_post', 'default', 'value' => date('y-m-d H:i:s')],
            [['contenu'], 'string'],
            [['type'], 'string', 'max' => 20],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_publ' => 'Id Publ',
            'id_user' => 'Id User',
            'date_post' => 'Date Post',
            'contenu' => 'Contenu',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLirePubls() {
        return $this->hasMany(LirePubl::className(), ['id_publ' => 'id_publ']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser() {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @inheritdoc
     * @return PublicationQuery the active query used by this AR class.
     */
    public static function find() {
        return new PublicationQuery(get_called_class());
    }

    public function findnameuser($id) {

        $employe = (new \yii\db\Query())
                ->select(['nom', 'prenom'])
                ->from('user')
                ->where(['id' => $id])
                ->one();
        return $employe['nom'] . ' ' . $employe['prenom'];
    }

}
