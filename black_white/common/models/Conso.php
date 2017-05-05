<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "conso".
 *
 * @property integer $id_conso
 * @property integer $id_boisson
 * @property double $nombre
 * @property integer $prix
 * @property double $capacite
 *
 * @property Boisson $idBoisson
 */
class Conso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_boisson', 'nombre', 'prix', 'capacite'], 'required'],
            [['id_boisson', 'prix'], 'integer'],
            [['nombre', 'capacite'], 'number'],
            [['id_boisson'], 'exist', 'skipOnError' => true, 'targetClass' => Boisson::className(), 'targetAttribute' => ['id_boisson' => 'id_boisson']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_conso' => 'Id Conso',
            'id_boisson' => 'Id Boisson',
            'nombre' => 'Nombre',
            'prix' => 'Prix',
            'capacite' => 'Capacite',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBoisson()
    {
        return $this->hasOne(Boisson::className(), ['id_boisson' => 'id_boisson']);
    }

    /**
     * @inheritdoc
     * @return ConsoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConsoQuery(get_called_class());
    }
}
