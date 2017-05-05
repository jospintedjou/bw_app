<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "magasin".
 *
 * @property integer $id_magasin
 * @property string $nom
 * @property string $adresse
 * @property string $ville
 *
 * @property Livraison[] $livraisons
 */
class Magasin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'magasin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nom'], 'string', 'max' => 30],
            [['adresse', 'ville'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_magasin' => 'Id Magasin',
            'nom' => 'Nom',
            'adresse' => 'Adresse',
            'ville' => 'Ville',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLivraisons()
    {
        return $this->hasMany(Livraison::className(), ['id_magasin' => 'id_magasin']);
    }

    /**
     * @inheritdoc
     * @return MagasinQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MagasinQuery(get_called_class());
    }
}
