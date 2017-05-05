<?php
namespace frontend\modules\project\models;

use Yii;
use yii\base\Model;
use common\models\Activite;
use common\models\Projet;
use common\models\FaireActivite;
use yii\db\Query;
use frontend\modules\project\controllers\ProjectController;

/**
 * ContactForm is the model behind the contact form.
 */
class ActivityForm extends Model
{
    public $title;
    public $provider;
    public $description;
    public $devs;
    public $selectedDevs;
    public $dateStart; //For create.
    public $dateStart2; //Because Kartik-datePicker get conflicts when using only $dateStart. For update.
    public $dateEnd; //For create
    public $dateEnd2; //To avoid Kartik-datePicker conflits when using this model. For update.
    public $type;
    public $activityId;
    public $taskId;
    public $projectId;
    
    /** get the project id **/
    public function getProjectId(){
        return $this->projectId;
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        $devsInfo =  ProjectController::getAllDevs();
        $devs = [];
        foreach($devsInfo as $dev){
            $devs[] = $dev['id'];
        }
       // $projectId = $this->getProjectId();
        return [
            [['title', 'description'], 'required'],
            ['dateStart', 'required', 
                'when'=>function($model){ return empty($model->dateStart2); } ,
                       'whenClient'=>'function(attribute, value){ return $("#activityform-datestart2") !== null; }' 
            ],
            ['dateStart2', 'required', 
                'when'=>function($model){ return empty($model->dateStart); } ,
                       'whenClient'=>'function(attribute, value){ return $("#activityform-datestart") !== null; }' 
            ],
            ['dateEnd', 'required', 
                'when'=>function($model){ return empty($model->dateEnd2); } ,
                       'whenClient'=>'function(attribute, value){ return $("#activityform-dateend2") !== null; }' 
            ],
            ['dateEnd2', 'required', 
                'when'=>function($model){ return empty($model->dateEnd); } ,
                       'whenClient'=>'function(attribute, value){ return $("#activityform-dateend") !== null; }' 
            ],
            [['activityId', 'projectId','taskId', 'title', 'provider', 'description', 'type'], 'string'],
            ['selectedDevs', 'required', 
                'when'=>function($model){ return !empty($model->selectedDevs); } ,
                 //      'whenClient'=>'function(attribute, value){ return $("#chiefID") !== null; }' 
                    ],
                        
           // [['dateStart', 'dateStart2'], 'checkStartDate', 'skipOnEmpty' => false, 'params'=>['projectId'=>$projectId],'skipOnError' => false ],
          //  [['dateEnd', 'dateEnd2'], 'checkEndDate', 'params'=>['projectId'=>$projectId], 'skipOnEmpty' => false, 'skipOnError' => false ],
            [['dateStart', 'dateStart2', 'dateEnd', 'dateEnd2'], 'safe' ],
            ['dateEnd', 'compare','compareAttribute'=>'dateStart','operator'=>'>=',
             'message'=>'La date de fin doit être supérieure à la date de début '
            ],
            ['dateEnd2', 'compare','compareAttribute'=>'dateStart2','operator'=>'>=',
             'message'=>'La date de fin doit être supérieure à la date de début '
            ],
            ['selectedDevs', 'each', 'rule'=>['integer']],
            ['selectedDevs', 'each', 'rule'=>['in', 'range'=>$devs]],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'title' => 'Le titre',
            'description' => 'La description',
            'dateStart' => 'La date de début',
            'dateStart2' => 'La date de début',
            'dateEnd' => 'La date de fin',
            'dateEnd2' => 'La date de fin',
            'provider' => 'Le prestataire',
            'selectedDevs' => 'La liste des devs. ',
        ];
    }
    
    /** 
     * This function checks if the activity start date is greather than its  project start date interval
     * 
     * **/
    public function checkStartDate($attribute, $params){
        
    if(!empty($params['projectId'] ) ){
            $project = Projet::findOne(['id_projet'=>$params['projectId']]);
            $pDebut = $project->date_debut;
           $this->addError($attribute, "La date de début est inférieure à celle du projet");
            if(!$pDebut > $this->$attribute){
                $this->addError($attribute, "La date de début est inférieure à celle du projet");
                return false;
            }
        }
        return true;
    }
    
     /** 
     * This function checks if the activity start date is greather than its  project start date interval
     * 
     * **/
    public function checkEndDate($attribute, $params){
        if(!empty($params['projectId']) ){
            $project = Projet::findOne(['id_projet'=>$params['projectId']]);
            $pFin = $project->date_fin;
           
            if(!$pFin < $this->$attribute){
                $this->addError($attribute, "La date de fin dépasse celle du projet");
            } 
        }
    }
    
    /** 
     * This function insert a new activity in the data base after validating datas
     * 
     * **/
    public function newActivity(){
        if (!$this->validate()) {
            return null;
        }
        
        if( $activity = $this->saveActivity() ){
            if($this->type == 'technique'){
                if(!$this->saveDevs()){ 
                    return null;
                }
            } 
            return $activity;   
        }
        return null; 
    }
     
     /** 
     * This function updates a project in the data base after validating datas
     * 
     * **/
    public function updateActivity(){
        if (!$this->validate()){
            return null;
        }
        if(  $this->saveActivity()){
            return true;          
        }
        return null; 
    }
    
    /** 
     * This function saves an activity in the data base 
     * **/
    public function saveActivity(){
         
        if( !empty($this->activityId) ){
           $activity = Activite::findOne(['id_activite'=>$this->activityId]);
        }else{
          $activity = new Activite();
        }
        $activity->nom = $this->title;
        $activity->description = $this->description;
        $activity->date_debut = (!empty($this->dateStart)) 
                                ? Yii::$app->formatter->asDate($this->dateStart, 'yyyy-MM-dd') 
                                : Yii::$app->formatter->asDate($this->dateStart2, 'yyyy-MM-dd');
        $activity->date_fin = (!empty($this->dateEnd)) 
                              ? Yii::$app->formatter->asDate($this->dateEnd, 'yyyy-MM-dd')
                              : Yii::$app->formatter->asDate($this->dateEnd2, 'yyyy-MM-dd');
        $activity->prestataire = $this->provider;
        $activity->type = $this->type;
       if( !empty($this->projectId) ){
           $activity->id_projet = $this->projectId;
       }
        $today = strtotime(Yii::$app->formatter->asDate('now', 'yyyy-MM-dd'));
        $start = strtotime(Yii::$app->formatter->asDate( $activity->date_debut , 'yyyy-MM-dd'));
        if($today < $start ){
             $activity->statut = 'en_attente';
        }else{
             $activity->statut = 'en_cours';
        }
       // if(isset($this->activityId)){$activity->id_activite = $this->activityId ;}
        if($activity->save()){
            return true;
        }else{
           return false;
        }
        
    }
    
    /** 
     * This function saves the team devs and chief in the database 
     * **/
    public function saveDevs(){
        /** Save the new activity devs in the database **/
        $res = true;
        $existId = Activite::find()->orderBy('id_activite DESC')->scalar(); // exist when a new activity is crea ted
        $pId = empty($this->activityId)?$existId:$this->activityId;
        $devsArray = $this->selectedDevs;
        if( !empty($devsArray) && is_array($devsArray) ){
            (new Query())->createCommand()->delete('faire_activite' ,['id_activite'=>$this->activityId])->execute();
            foreach ($devsArray as $devId){
                $pDevs = FaireActivite::findOne(['id_activite'=>$this->activityId, 'id_user'=>$devId]);
                if( empty($pDevs) ){
                    $pDevs = new FaireActivite();
                }
                $pDevs->id_activite =  $pId;
                $pDevs->id_user = $devId;
                if( !$pDevs->save() ){ $res = false; }
            }
        }else{
            return false;
        }
        return $res;
    }
    
    
}