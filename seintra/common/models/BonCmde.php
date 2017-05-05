<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bon_cmde".
 *
 * @property integer $id_bon
 * @property integer $id_client
 * @property string $produit
 * @property string $montant
 * @property string $date_reception
 * @property string $delai
 *
 * @property Client $idClient
 */
class BonCmde extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bon_cmde';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_client', 'date_reception', 'delai'], 'required'],
            [['id_client'], 'integer'],
            [['produit'], 'string'],
            [['date_reception', 'delai'], 'safe'],
            [['date_reception', 'delai'], 'date', 'format' => 'yyyy-mm-dd'],
            [['montant'], 'string'],
            [['id_client'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['id_client' => 'id_user']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_bon' => 'Id Bon',
            'id_client' => 'Id Client',
            'produit' => 'Produit',
            'montant' => 'Montant',
            'date_reception' => 'Date Reception',
            'delai' => 'Delai',
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
     * @return BonCmdeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BonCmdeQuery(get_called_class());
    }
    
     public function findnamecustomer($id) {

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
