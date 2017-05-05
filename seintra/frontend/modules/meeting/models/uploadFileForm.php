<?php

namespace frontend\modules\meeting\models;

use yii\base\Model;
use common\models\Reunion;

class uploadFileForm extends Model {

    public $protocole;
    public $Id_meeting;
    
    public function rules() {
        return [
            [['protocole'],'file','skipOnEmpty' => false,'extensions' =>'pdf, zip, rar'],
            //[['protocole'],'safe'],
            ['Id_meeting', 'integer'],
            ['Id_meeting', 'safe'],
        ];
    }
}
