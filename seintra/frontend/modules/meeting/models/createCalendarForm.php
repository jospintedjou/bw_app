<?php

namespace frontend\modules\meeting\models;

use yii\base\Model;
use common\models\Reunion;
use common\models\User;
use common\models\ParticiperReunion;
class createCalendarForm extends Model {

    public $titre;
    public $description;
    public $lieu;
    public $date;
    public $heuredebut;
    public $heurefin;
    public $participants;
    public $Id_reunion;
    public $selectedParts;
    public $protocole;
    
// version mise a jours 21/09/2016
    public function rules() {
        return [
            [['titre', 'description', 'lieu', 'date', 'heuredebut', 'heurefin'], 'required','message'=>'ce champ ne peut être vide'],
            ['date', 'date', 'format' => 'yyyy-mm-dd'],
            ['heurefin', 'compare', 'compareAttribute' => 'heuredebut','operator'=>'>','message'=>"l'heure de fin doit être supérieure à l'heure de debut"],
            ['titre', 'string', 'max' => 255],
            ['Id_reunion', 'integer'],
            ['protocole', 'file','extensions'=>['pdf','zip','rar'],'message'=>"bien vouloir insérer un fichier au format pdf,zip ou rar"],
            ['selectedParts', 'each', 'rule'=>['integer']],
            ['participants', 'each', 'rule'=>['integer']]
        ];
    }

    public function attributeLabels()
    {
        return [
            'description' => 'Description',
            'date' => 'Date',
            'heuredebut' => 'Heure Debut',
            'heurefin' => 'Heure Fin',
            'lieu' => 'Lieu',
        ];
    }
    
    public function entry() {        

        if (!$this->validate()) {
             
            return false;
        }

            $reunion = new Reunion();
            $reunion->id_fichier = -1;
            $reunion->description = $this->description;
            $reunion->lieu = $this->lieu;
            $reunion->date = $this->date;
            $reunion->heure_debut = $this->heuredebut;
            $reunion->heure_fin = $this->heurefin;
            $reunion->title = $this->titre;

        if ($reunion->save()) {
            
           return  true;
        } else {

            return false;
        }

    }
    

}
