<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "commande_produit".
 *
 * @property integer $id_commande_client
 * @property integer $id_produit
 * @property integer $nombre
 * @property integer $nb_demi
 * @property integer $nb_conso
 * @property integer $nb_verre
 * @property integer $prix
 *
 * @property Produit $produit
 */
class CommandeProduit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'commande_produit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_commande_client', 'id_produit', 'prix'], 'required'],
            [['id_commande_client', 'id_produit', 'nombre', 'nb_demi', 'nb_conso', 'nb_verre', 'prix'], 'integer'],
            [['id_produit'], 'exist', 'skipOnError' => true, 'targetClass' => Produit::className(), 'targetAttribute' => ['id_produit' => 'id_produit']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_commande_client' => 'Id Commande Client',
            'id_produit' => 'Id Produit',
            'nombre' => 'Nombre',
            'nb_demi' => 'Nb Demi',
            'nb_conso' => 'Nb Conso',
            'nb_verre' => 'Nb Verre',
            'prix' => 'Prix',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduit()
    {
        return $this->hasOne(Produit::className(), ['id_produit' => 'id_produit']);
    }

    /**
     * @inheritdoc
     * @return CommandeProduitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommandeProduitQuery(get_called_class());
    }
}
