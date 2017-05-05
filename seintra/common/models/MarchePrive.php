<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "marche_prive".
 *
 * @property integer $id_marche
 * @property string $intitule
 * @property integer $id_client
 * @property string $etat
 * @property string $date_dmd_cotation
 * @property string $date_depot_cotation
 * @property string $date_reponse
 *
 * @property Client $idClient
 */
class MarchePrive extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marche_prive';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['intitule','etat','id_client'], 'required', 'message' => 'champ vide veuillez remplir!!'],                 
            [['intitule','etat'], 'string'],
            [['id_client'], 'integer'],
            [['date_dmd_cotation','date_depot_cotation','date_reponse'], 'date','format'=>'yyyy-mm-dd'],  
            [['date_dmd_cotation','date_depot_cotation','date_reponse'], 'safe'],
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
            'date_dmd_cotation' => 'Date Dmd Cotation',
            'date_depot_cotation' => 'Date Depot Cotation',
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
     * @return MarchePriveQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MarchePriveQuery(get_called_class());
    }
    
    /**
     * this method added return a customer denomination with her social reason 
     * @param type $id
     * @return string name : denomination+raison_sociale
     */
     public function findnameprivatecustomer($id) {

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
