<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "marche_public".
 *
 * @property integer $id_marche
 * @property string $intitule
 * @property integer $id_client
 * @property string $etat
 * @property string $date_connaiss
 * @property string $date_prescript
 * @property string $date_depot_dossier
 * @property string $date_reponse
 *
 * @property Client $idClient
 */
class MarchePublic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marche_public';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['intitule'], 'string'],
            [['id_client', 'etat', 'date_connaiss'], 'required'],
            [['id_client'], 'integer'],
            [['date_connaiss', 'date_prescript', 'date_depot_dossier', 'date_reponse'], 'safe'],
            [['etat'], 'string', 'max' => 10],
            [['id_client'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['id_client' => 'id_user']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_marche' => 'Id Marche',
            'intitule' => 'Intitule',
            'id_client' => 'Id Client',
            'etat' => 'Etat',
            'date_connaiss' => 'Date Connaiss',
            'date_prescript' => 'Date Prescript',
            'date_depot_dossier' => 'Date Depot Dossier',
            'date_reponse' => 'Date Reponse',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdClient()
    {
        return $this->hasOne(Client::className(), ['id_user' => 'id_client']);
    }

    /**
     * @inheritdoc
     * @return MarchePublicQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MarchePublicQuery(get_called_class());
    }
    
     public function findnamepubliccustomer($id) {

        $customer = (new \yii\db\Query())
                ->select(['denomination', 'raison_sociale'])
                ->from('client')
                ->where(['id_user' => $id])
                ->one();
        if($customer['raison_sociale']=='Aucune'){
                      return $customer['denomination'];
		}
		else {
			return $customer['denomination'] . ' ' . $customer['raison_sociale'];
		}
    }
}
