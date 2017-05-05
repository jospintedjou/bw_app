<?php

/**
 *  CustomerForm
 */

namespace frontend\modules\customerMarket\models;

use yii\base\Model;
use common\models\Contact;

/**
 * Description of CustomerForm
 *
 * @author miguel
 */
class AppointmentForm extends Model {

    Public $motif;
    Public $debouche;
    Public $moyen;
    Public $date;
    Public $commercial_id;
    Public $id_client;

    public function rules() {
        return [
            [['motif', 'debouche', 'date', 'motif'], 'required', 'message' => 'champ vide veuillez remplir!!'],
            [['debouche', 'motif'], 'string'],
            [ 'id_client', 'integer','message'=>"Celui ci n'est pas un client"],           
            ['commercial_id', 'integer','message'=>"Celui ci n'est pas un commercial"],           
            ['date', 'safe'],
            ['date', 'date', 'format' => 'yyyy-mm-dd'],
            ['moyen', 'in', 'range' => ['email', 'rencontre', 'appel'],'message'=>'Moyen de contact invalide'],
        ];
    }

    public function attributeLabels() {
        return [
            'commercial_id' => 'Commercial',
            'moyen' => 'Moyen de contact'
        ];
    }

    public function registerappointment() {

        if ($this->validate()) {
            if ($this->id_client != null) {
                $appointment = new Contact();
                $appointment->motif = $this->motif;
                $appointment->debouche = $this->debouche;
                $appointment->date = $this->date;
                $appointment->moyen = $this->moyen;
                $appointment->id_user = $this->commercial_id;
                $appointment->id_client = $this->id_client;

                if ($appointment->save()) {
                    return true;
                }
            }
        }
        return null;
    }

}
