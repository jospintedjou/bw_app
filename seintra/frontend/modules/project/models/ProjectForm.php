<?php
namespace frontend\modules\project\models;

use Yii;
use yii\base\Model;
use common\models\Projet;
use common\models\DevProjet;
use yii\db\Query;
use frontend\modules\project\controllers\ProjectController;

/**
 * ContactForm is the model behind the contact form.
 */
class ProjectForm extends Model
{
    public $title;
    public $provider;
    public $description;
    public $devs;
    public $selectedDevs;
    public $chief;
    public $dateStart; //For create.
    public $dateStart2; //Because Kartik-datePicker get conflicts when using only $dateStart. For update.
    public $dateEnd; //For create
    public $dateEnd2; //To avoid Kartik-datePicker conflits when using this model. For update.
    public $type;
    public $projectId;
    
    
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
                       'whenClient'=>'function(attribute, value){ return $("#projectform-datestart2") !== null; }' 
            ],
            ['dateStart2', 'required', 
                'when'=>function($model){ return empty($model->dateStart); } ,
                       'whenClient'=>'function(attribute, value){ return $("#projectform-datestart") !== null; }' 
            ],
            ['dateEnd', 'required', 
                'when'=>function($model){ return empty($model->dateEnd2); } ,
                       'whenClient'=>'function(attribute, value){ return $("#projectform-dateend2") !== null; }' 
            ],
            ['dateEnd2', 'required', 
                'when'=>function($model){ return empty($model->dateEnd); } ,
                       'whenClient'=>'function(attribute, value){ return $("#projectform-dateend") !== null; }' 
            ],
                   
            [['projectId', 'title', 'provider', 'description', 'type'], 'string'],
            [['chief'], 'integer'],
            ['chief', 'required', 
                'when'=>function($model){ return !empty($model->selectedDevs); } ,
                       'whenClient'=>'function(attribute, value){ return $("#chiefID") !== null; }' 
                    ],
            ['selectedDevs', 'required', 
                'when'=>function($model){ return !empty($model->selectedDevs); } ,
               //        'whenClient'=>'function(attribute, value){ return $("#chiefID") !== null; }' 
                    ],
            [['dateStart', 'dateStart2', 'dateEnd', 'dateEnd2'], 'safe' ],
            ['dateEnd', 'compare','compareAttribute'=>'dateStart','operator'=>'>=',
             'message'=>'La date de fin doit être supérieure à la date de début '
            ],
            ['dateEnd2', 'compare','compareAttribute'=>'dateStart2','operator'=>'>=',
             'message'=>'La date de fin doit être supérieure à la date de début '
            ],
            ['selectedDevs', 'each', 'rule'=>['integer']],
            ['selectedDevs', 'each', 'rule'=>['in','allowArray'=>true, 'range'=>$devs]],
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
     * This function insert a new project in the data base after validating datas
     * But for commodity reasons, the same function is used to create and to update projects
     * **/
    public function newProject(){
       // $this->saveProject();
        if (!$this->validate()) {
            return null;
        }
        
        if( $project = $this->saveProject() ){
            if($this->type == 'technique'){
                if(!$this->saveDevs()){ 
                    return null;
                }
            } 
            return $project;   
        }
        return null; 
    }
     
     /** 
     * This function updates a project in the data base after validating datas
     * Is not used yet
     * **/
    public function updateProject(){
        if (!$this->validate()){
            return null;
        }
        if(  $this->saveProject()){
            return true;          
        }
        return null; 
    }
    
    /** 
     * This function saves a project in the data base 
     * **/
    public function saveProject(){
         
        if( !empty($this->projectId) ){
           $project = Projet::findOne(['id_projet'=>$this->projectId]);
        }else{
          $project = new Projet();
        }
        $project->nom = $this->title;
        $project->description = $this->description;
        $project->date_debut = (!empty($this->dateStart)) 
                                ? Yii::$app->formatter->asDate($this->dateStart, 'yyyy-MM-dd') 
                                : Yii::$app->formatter->asDate($this->dateStart2, 'yyyy-MM-dd');
        $project->date_fin = (!empty($this->dateEnd)) 
                              ? Yii::$app->formatter->asDate($this->dateEnd, 'yyyy-MM-dd')
                              : Yii::$app->formatter->asDate($this->dateEnd2, 'yyyy-MM-dd');
        $project->prestataire = $this->provider;
        $project->type = $this->type;

        $today = strtotime(Yii::$app->formatter->asDate('now', 'yyyy-MM-dd'));
        $start = strtotime(Yii::$app->formatter->asDate( $project->date_debut , 'yyyy-MM-dd'));
        if($today < $start ){
             $project->statut = 'en_attente';
        }else{
             $project->statut = 'en_cours';
        }
       // if(isset($this->projectId)){$project->id_projet = $this->projectId ;}
        if($project->save()){
            return true;
        }else{
           return false;
        }
        
    }
    
    /** 
     * This function saves the team devs and chief in the database 
     * **/
    public function saveDevs(){
        /** Save the new project devs in the database **/
        $res = true;
        $existId = Projet::find()->orderBy('id_projet DESC')->scalar(); // exist when a new projetc is crea ted
        $pId = empty($this->projectId)?$existId:$this->projectId;
        $devsArray = $this->selectedDevs;
        if( !empty($devsArray) && is_array($devsArray) ){
            (new Query())->createCommand()->delete('dev_projet' ,['id_projet'=>$this->projectId])->execute();
            foreach ($devsArray as $devId){
                $pDevs = DevProjet::findOne(['id_projet'=>$this->projectId, 'id_user'=>$devId]);
                if( empty($pDevs) ){
                    $pDevs = new DevProjet();
                }
                $pDevs->id_projet =  $pId;
                $pDevs->id_user = $devId;
                $pDevs->role = 'dev';
                if( !$pDevs->save() ){ $res = false; }
            }
            /** Save the project chief in the database**/
            
            $db =  Yii::$app->db;
            $db->createCommand()->update('dev_projet', ['role'=>'chef'], 
                    ['id_user'=>$this->chief, 'id_projet'=>$pId])->execute();
        }else{
            return false;
        }
        return $res;
    }
    
    
}