<?php
namespace frontend\modules\project\models;

use Yii;
use yii\base\Model;
use common\models\Tache;
use common\models\FaireTache;
use yii\db\Query;
use frontend\modules\project\controllers\ProjectController;

/**
 * ContactForm is the model behind the contact form.
 */
class TaskForm extends Model
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
    public $projectId;
    public $activityId;
    public $taskId;
    
    
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
            [['activityId', 'taskId', 'title', 'provider', 'description', 'type'], 'string'],
            ['selectedDevs', 'required', 
                'when'=>function($model){ return !empty($model->selectedDevs); } ,
                 //      'whenClient'=>'function(attribute, value){ return $("#chiefID") !== null; }' 
                    ],
            [['dateStart', 'dateStart2', 'dateEnd', 'dateEnd2'], 'safe' ],
            ['dateEnd', 'compare','compareAttribute'=>'dateStart','operator'=>'>=',
             'message'=>'La date de fin doit être supérieure à la date de début '
            ],
            ['dateEnd2', 'compare','compareAttribute'=>'dateStart2','operator'=>'>=',
             'message'=>'La date de fin doit être supérieure à la date de début '
            ],
            ['selectedDevs', 'each', 'rule'=>['in', 'range'=>$devs]],
            ['selectedDevs', 'each', 'rule'=>['integer']]
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
     * This function insert a new activity in the data base after validating datas
     * 
     * **/
    public function newTask(){
        if (!$this->validate()) {
            return null;
        }
        
        if( $activity = $this->saveTask() ){
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
     * This function saves an activity in the data base 
     * **/
    public function saveTask(){
         
        if( !empty($this->taskId) ){
           $task = Tache::findOne(['id_tache'=>$this->taskId]);
        }else{
           $task = new Tache();
        }
        $task->nom = $this->title;
        $task->description = $this->description;
        $task->date_debut = (!empty($this->dateStart)) 
                                ? Yii::$app->formatter->asDate($this->dateStart, 'yyyy-MM-dd') 
                                : Yii::$app->formatter->asDate($this->dateStart2, 'yyyy-MM-dd');
        $task->date_fin = (!empty($this->dateEnd)) 
                              ? Yii::$app->formatter->asDate($this->dateEnd, 'yyyy-MM-dd')
                              : Yii::$app->formatter->asDate($this->dateEnd2, 'yyyy-MM-dd');
        $task->prestataire = $this->provider;
        $task->type = $this->type;
       if( !empty($this->activityId) ){
           $task->id_activite = $this->activityId;
       }
        $today = strtotime(Yii::$app->formatter->asDate('now', 'yyyy-MM-dd'));
        $start = strtotime(Yii::$app->formatter->asDate( $task->date_debut , 'yyyy-MM-dd'));
        if($today < $start ){
             $task->statut = 'en_attente';
        }else{
             $task->statut = 'en_cours';
        }
        if($task->save()){
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
        $existId = Tache::find()->orderBy('id_tache DESC')->scalar(); // exist when a new task is crea ted
        $pId = empty($this->taskId)?$existId:$this->taskId;
        $devsArray = $this->selectedDevs;
        if( !empty($devsArray) && is_array($devsArray) ){
            (new Query())->createCommand()->delete('faire_tache' ,['id_tache'=>$this->taskId])->execute();
            foreach ($devsArray as $devId){
                $pDevs = FaireTache::findOne(['id_tache'=>$this->taskId, 'id_user'=>$devId]);
                if( empty($pDevs) ){
                    $pDevs = new FaireTache();
                }
                $pDevs->id_tache =  $pId;
                $pDevs->id_user = $devId;
                if( !$pDevs->save() ){ $res = false; }
            }
        }else{
            return false;
        }
        return $res;
    }
    
    /** This function sets the model attrinute from a given activity model 
     * **/
    
    public function setTaskForm($activityForm) {
        if($activityForm instanceof ActivityForm){
            $this->title = $activityForm->title;
            $this->description = $activityForm->description;
            $this->provider = $activityForm->provider;
            $this->devs = $activityForm->devs;
            $this->selectedDevs = $activityForm->selectedDevs;
            $this->dateStart = (!empty($activityForm->dateStart)) ? $activityForm->dateStart : $activityForm->dateStart2 ;
            $this->dateEnd = (!empty($activityForm->dateEnd)) ? $activityForm->dateEnd : $activityForm->dateEnd2;
            $this->type = $activityForm->type;
            $this->projectId = $activityForm->projectId;
            $this->activityId = $activityForm->activityId;
            $this->taskId = $activityForm->taskId;
            
            return true;
        }
        return false;
    }
}