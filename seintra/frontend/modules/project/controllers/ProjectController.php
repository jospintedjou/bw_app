<?php

namespace frontend\modules\project\controllers;

use Yii;
use mPDF;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\db\Query;
use common\models\Projet;
use \common\models\Activite;
use common\models\Tache;
use frontend\modules\project\models\ProjectForm;
use frontend\modules\project\models\ActivityForm;
use frontend\modules\project\models\TaskForm;

/**
 * Default controller for the `project` module
 */
class ProjectController extends Controller {
    public $enableCsrfValidation = false;
    
    public function init() {
        parent::init();
        \Yii::$app->language = 'fr'; 
    }
    public function beforeAction($action) {
       $result = parent::beforeAction($action);
       
       return $result;
    }
    
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['view-projects', 'view-details', 'add-project', 'add-activity', 'add-task', 'update-project', 'update-activity', 'update-task'],
                'rules' => [
                    [
                        'actions' =>['view-projects', 'view-details', 'add-project', 'add-activity', 
                                    'add-task', 'update-project', 'update-activity', 'update-task'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }
    /** This function create a pdf with the evolution of an ended project from begining to end. **/
     public function actionCreateMpdf($projectId){
        if(isset($projectId) && !empty($projectId) && is_numeric($projectId) ) {
            $project = projet::find()->where(['id_projet'=>$projectId])->one();
            $type2 = $project['type'];
            $type = ($type2 == 'adm_struct') ? 'Administratif et structurel' : 'Technique';
            $finals = $this->getProjectInfo($projectId);
            $projectForm = new ActivityForm();
            
                $devs = ($type2 != 'adm_struct') ? $this->getProjectDevs($projectId) : [];
          
            
            $mpdf=new mPDF();
            $bootstrapCss = file_get_contents('css/libs/bootstrap.css');
            $mpdf->SetTitle('suivi de projet');
            $mpdf->SetHeader('<img style="width:20px; height:20px" src="uploads/seinova.png"/>SEINOVA SARL');
            $mpdf->WriteHTML($bootstrapCss, 1);
            
            $mpdf->WriteHTML(
               $this->renderPartial("project-export-pdf", [
                        'finals' => $finals,
                        'project' => $project,
                        'devs' => $devs,
                        'type' => $type2,
                        'type2' => $type,
                        'model'=>$projectForm
                    ])
                
            );
            $mpdf->setFooter('{PAGENO}/{nbpg}');
            $mpdf->Output('suivi_projet'.$project['id_projet'].'_'.str_replace(" ","-",$project['nom']).'.pdf', 'I');
            exit;
        } 
    }
    /** This function sends mails to concerbed persons
     * @param String $message The message to send 
     * @param Array $receivers Receiver(s) **/
    public function sendMail( $message, $subject, $receivers){
        /** 
        $from='intraweb@seinova.com';
        foreach($receivers as $rec){
            $tos[] = $rec['email'];
        }

        $mail = Yii::$app->mail->compose(['html'=>'index'], ['body'=>$message] ) 
         ->setFrom($from)
         ->setTo($tos)
         ->setSubject($subject);
      
             if( $mail->send() ){
                 return true;
             }else{
                 return false;
             }
        **/
        return true;
   }

    
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        echo date('Y-m-d');
        //  return $this->render('index');
    }

    /**
     * This function lists  all projects of a particular type either technical or administrative
     * @param String $type is the type of project: 'technique' or 'adm_struct'
     * @return mixed
     */
    public function actionViewProjects($type) {
        $type = Yii::$app->request->getQueryParam('type');
        if(isset($type) && !empty($type) && ($type=='technique' || $type=='adm_struct')) {
            $type2 = $type;
            $type = ($type2 == 'adm_struct') ? 'Administratifs et structurels' : 'Techniques';
            //Updates the status of all activities that satrt date has been already reached
            (new Query())->createCommand()->update('projet', ['statut'=>'en_cours'],
                              ['and', ['<=', 'date_debut', date('Y-m-d')], ['statut'=>'en_attente']])->execute();
            $finals = $this->getProjectsInfo($type2);
            /** Intialisation of the new project model  **/
            $projectForm = new ProjectForm();
            $projectForm->devs = $this->getAllDevs();
            return $this->render("project-list", ['finals' => $finals,
                        'type' => $type,
                        'type2' => $type2,
                        'model'=>$projectForm
            ]);
         }else{
            throw new \yii\web\NotFoundHttpException();
        }
    }
     /**
     * This function displays project details, all activities and task of a project
     * @return mixed
     */
    public function actionViewDetails($projectId, $type) {
        if(isset($projectId) && !empty($projectId) && isset($type) && !empty($type) && ($type=='technique' || $type=='adm_struct')){
            
        $type2 = $type;
        $type = ($type2 == 'adm_struct') ? 'Administratifs et structurels' : 'Techniques';
           //Updates the status of all activities that satrt date has been already reached
            (new Query())->createCommand()->update('activite', ['statut'=>'en_cours'],
                              ['and', ['<=', 'date_debut', date('Y-m-d')], ['statut'=>'en_attente']])->execute();
            //Updates the status of all tasks that satrt date has been already reached
            (new Query())->createCommand()->update('tache', ['statut'=>'en_cours'],
                              ['and', ['<=', 'date_debut', date('Y-m-d')], ['statut'=>'en_attente']])->execute();

            $finals = $this->getProjectInfo($projectId);
            $project = projet::find()->where(['id_projet'=>$projectId])->one();
            $projectChief = $this->getProjectDevs($projectId, true);
       
            $devs = ($type2 != 'adm_struct') ?  $this->getProjectDevs($projectId) : [];
            
           /** 
            * Intialisation of the new project model 
            * **/
            $projectForm = new ActivityForm();
            $projectForm->devs = $this->getProjectDevs($projectId);
            return $this->render("project-details", [    
                            'finals' => $finals,
                            'type' => $type,
                            'type2' => $type2,
                            'projectId'=>$projectId,
                            'devs'=>$devs,
                            'projectChief'=>$projectChief,
                            'project'=>$project,
                            'model'=>$projectForm
                ]);
        }else{
            throw new \yii\web\NotFoundHttpException();
        }
    }
    
     /**
     * This function create a new project and add it to the database
     * @return mixed
     */
    public function actionAddProject() {
       $projectForm = new ProjectForm();
       
       if( $projectForm->load(Yii::$app->request->post()) ){
           if(empty($projectForm->dateStart) && empty($projectForm->dateStart2)){
               Yii::$app->session->setFlash('dateStartError', "la date de début n'est pas remplie");
           }else{
                $projectForm->newProject();  
              
           }
           return $this->redirect(['view-projects', 'type'=>$projectForm->type ]);
       }else{
            throw new \yii\web\NotFoundHttpException();
       }       
    }
    
      /**
     * This function allow to add an activity to one specific project
     * @params int $projectId 
     * @return mixed
     */
    public function actionAddActivity() {
        $activityForm = new ActivityForm();
       if( $activityForm->load(Yii::$app->request->post()) ){
           if(empty($activityForm->dateStart) && empty($activityForm->dateStart2)){
               Yii::$app->session->setFlash('dateStartError', "la date de début n'est pas remplie");
           }else{
                $activityForm->newActivity();
           }
           return $this->redirect(['view-details',
                        'projectId'=> $activityForm->projectId,
                        'type' => $activityForm->type
                    ]);
       }else{
            throw new \yii\web\NotFoundHttpException();
       }
    }
     /**
     * This function allow to add an activity to one specific project
     * @params int $projectId 
     * @return mixed
     */
    public function actionAddTask() {
       $activityForm = new ActivityForm();
       $taskForm = new TaskForm();
      // return  $this->render('index');
 
       if( $activityForm->load(Yii::$app->request->post()) ){
           /** Set all the attribute of $taskForm from $activityForm **/
           $taskForm->setTaskForm($activityForm);
           if(empty($taskForm->dateStart) && empty($taskForm->dateStart2)){
               Yii::$app->session->setFlash('dateStartError', "la date de début n'est pas remplie");
           }else{
               $taskForm->newtask();
           }
               return $this->redirect(['view-details',
                            'projectId'=> $taskForm->projectId,
                            'type' => $taskForm->type
                        ]);    
       }else{
            throw new \yii\web\NotFoundHttpException();
       }
    }
    
    /**
     * This function updates a project
     * @return mixed
     */
    public function actionUpdateProject(){
        
        $projectForm = new ProjectForm();
        if($projectForm->load(Yii::$app->request->post())){
            $projectForm->selectedDevs = isset($_POST['to']) ? $_POST['to'] : [] ;
            if(empty($projectForm->dateStart) && empty($projectForm->dateStart2) ){
               Yii::$app->session->setFlash('dateStartError', "la date de début n'est pas remplie");
            }else{
                $projectForm->newProject();
           }
            return $this->redirect(['view-projects', 'type'=>$projectForm->type]);  
        }else{
             throw new \yii\web\NotFoundHttpException();
        }
        
    }
    
    /**
     * This function updates an activity
     * @return mixed
     */
    public function actionUpdateActivity(){
        
       $activityForm = new ActivityForm();
       if( $activityForm->load(Yii::$app->request->post()) ){
            $activityForm->selectedDevs = isset($_POST['to']) ? $_POST['to'] : [] ;
            if(empty($activityForm->dateStart) && empty($activityForm->dateStart2) ){
               Yii::$app->session->setFlash('dateStartError', "la date de début n'est pas remplie");
            }else{
                $activityForm->newActivity();
            }
            return $this->redirect(['view-details',
                        'projectId'=> $activityForm->projectId,
                        'type' => $activityForm->type
                    ]);                    
       }else{
            throw new \yii\web\NotFoundHttpException();
       }
    }
    
    /**
     * This function updates an activity
     * @return mixed
     */
    public function actionUpdateTask(){
       $activityForm = new ActivityForm();
       $taskForm = new TaskForm();
      // return  $this->render('index');
     
       if( $activityForm->load(Yii::$app->request->post()) ){
            $activityForm->selectedDevs = isset($_POST['to']) ? $_POST['to'] : [] ;
            /** Set all the attribute of $taskForm from $activityForm **/
            $taskForm->setTaskForm($activityForm);
             if(empty($taskForm->dateStart) && empty($taskForm->dateStart2) ){
               Yii::$app->session->setFlash('dateStartError', "la date de début n'est pas remplie");
            }else{
                $taskForm->newtask();
            }
               return $this->redirect(['view-details',
                            'projectId'=> $taskForm->projectId,
                            'type' => $taskForm->type
                        ]);     
       }else{
            throw new \yii\web\NotFoundHttpException();
       }
    }
    
    /**
     * This functio notifies the end of a project, activity or task
     * @params int $projectId 
     * @return mixed
     */
    public function actionNotifyEndProject($projectId) {
        if(isset($projectId)&& !empty($projectId)){
            $project = Projet::findOne(['id_projet'=>$projectId]);
            if(!empty($project)){
               $res = $this->endProject($projectId, 'termine_attente');
               if($res['status'] == 'true' ){
                   $this->sendMail("Le projet d'intitulé '".$project['nom']."' est terminé mais pas encore validé.", "Notification fin de projet non validée", $this->getReceivers($projectId, 'project', $project['type']) );
               }
               return json_encode($res);
            }
            return json_encode(['status'=>'false']);
        }else{
             throw new \yii\web\NotFoundHttpException();
       }
    }
    
    /**
     * This function notifies the end of an activity
     * @params int $activityId 
     * @return mixed
     */
    public function actionNotifyEndActivity($activityId) {
        if(isset($activityId)&& !empty($activityId)){
            $activity = Activite::findOne(['id_activite'=>$activityId]);
            if(!empty($activity)){
                $project = Projet::findOne(['id_projet'=>$activity['id_projet']]);
                $res = $this->endActivity($activityId, 'termine_attente');
                if($res['status'] == 'true' ){
                   $this->sendMail("L'activité d'intitulé '".$activity['nom']."' est terminée mais pas encore validée.\nElle concerne le projet '".$project['nom']."'.", "Notification fin d'activité non validée", $this->getReceivers($activityId, 'activity', $project['type']));
               }
               return json_encode($res);
            }
            return json_encode(['status'=>'false']);
        }else{
             throw new \yii\web\NotFoundHttpException();
        }
    }
    
    /**
     * This function notifies the end of a task
     * @params int $activityId 
     * @return mixed
     */
    public function actionNotifyEndTask($taskId) {
        if(isset($taskId)&& !empty($taskId)){
            $task = Tache::findOne(['id_tache'=>$taskId]);
            if(!empty($task)){
                $activity = Activite::findOne(['id_activite'=>$task->id_activite]);
                $project = Projet::findOne(['id_projet'=>$activity->id_projet]);
                $task->statut = 'termine_attente';
                if($task->save()){
                    $this->sendMail("La tâche d'intitulé '".$task['nom']."' est terminée mais pas encore validée.\nElle concerne l'activité '".$activity['nom']."' du projet '".$project['nom']."'.",  "Notification fin de tâche non validée", $this->getReceivers($taskId, 'task', $project['type']));
                    return json_encode(['status'=>'true']);
                }
            }
        }
        return json_encode(['status'=>'false']);
    }
    
     /**
     * This function confirms the end of a project by changing status 
     * @params int $projectId 
     * @params string $validated 'true' when end validated, 'false' otherwhise
     * @return mixed
     */
    public function actionValidateEndProject($projectId, $validated) {
        if(isset($projectId)&& !empty($projectId)){
            $project = Projet::findOne(['id_projet'=>$projectId]);
            if(!empty($project)){
                if($validated == 'true'){
                    $res = $this->endProject($projectId, 'termine');
                    if($res['status'] == 'true'){
                        $this->sendMail("Le projet d'intitulé '".$project['nom']."' est terminé et validé.",  "Notification fin de projet validée", $this->getReceivers($projectId, 'project', $project['type']));  
                    }
                }else{
                    $res = $this->endProject($projectId, 'en_cours');
                    if($res['status'] == 'true'){
                       $this->sendMail("La fin du projet d'intitulé '".$project['nom']."' a été refusée.\nIl reste donc en cours d'exécution. ",  "Notification fin de projet refusée", $this->getReceivers($projectId, 'project', $project['type']));  
                    }
                }
                return json_encode($res);
            }
       }
       return json_encode(['status'=>'false']);
        
    }
     /**
     * This function confirms the end of an activity by changing status 
     * @params int $projectId 
     * @return mixed
     */
    public function actionValidateEndActivity($activityId, $validated) {
        if(isset($activityId)&& !empty($activityId)){
            $activity = Activite::findOne(['id_activite'=>$activityId]);
            if(!empty($activity)){
                $project = Projet::findOne(['id_projet'=>$activity->id_projet]);
                if($validated == 'true'){
                   $res = $this->endActivity($activityId, 'termine');
                   if($res['status'] == 'true'){
                        $this->sendMail("L'activité d'intitulé '".$activity['nom']."' est terminée et validée.\nElle concerne le projet '".$project['nom']."'.",  "Notification fin d'activité validée", $this->getReceivers($activityId, 'activity', $project['type']));
                    }
                }else{
                    $res = $this->endActivity($activityId, 'en_cours');
                    if($res['status'] == 'true'){
                        $this->sendMail("La fin de l'activté d'intitulé '".$activity['nom']."' a été refusée.\nElle reste donc en cours d'exécution. Elle concerne le projet '".$project['nom']."'.",  "Notification fin d'activité refusée", $this->getReceivers($activityId, 'activity', $project['type']));   
                    }
                }  
                return json_encode($res);
            }
        }     
        return json_encode(['status'=>'false']);
        
    }
    
     /**
     * This function confirms the end of a task by changing status 
     * @params int $taskId 
     * @return mixed
     */
    public function actionValidateEndTask($taskId, $validated) {
        if(isset($taskId)&& !empty($taskId)){
            $task = Tache::findOne(['id_tache'=>$taskId]);
            if(!empty($task)){
                $activity = Activite::findOne(['id_activite'=>$task->id_activite]);
                $project = Projet::findOne(['id_projet'=>$activity->id_projet]);
                if($validated == 'true'){
                    $task->statut = 'termine';
                    $this->sendMail("La tâche d'intitulé '".$task['nom']."' est terminée et validée.\nElle concerne l'activité '".$activity['nom']."' du projet '".$project['nom']."'.",  "Notification fin de tâche non validée", $this->getReceivers($taskId, 'task', $project['type']));
                }else{
                    $task->statut = 'en_cours';
                    $this->sendMail("La fin de la tâche d'intitulé '".$task['nom']."' a été refusée.\nElle reste donc en cours d'exécution. Elle concerne l'activité '".$activity['nom']."' du projet '".$project['nom']."'.",  "Notification fin de tâche refusée", $this->getReceivers($taskId, 'task', $project['type']));   
                }
                if($task->save()){
                    return json_encode(['status'=>'true']);
                }
            }
        }
        return  json_encode(['status'=>'false']);
        
    }
    
    /** This function retrieve persons to notify when a project is ended
     * @param Int id is the project(or task or activity id)
     * @param int nature is the nature (project, activity or task)
     * @param int type is the nature (technique, adm_struct)
     *  **/ 
    public function getReceivers($id, $nature, $type){
        if($type === 'technique'){
            switch($nature){
                case 'project': $devs = $this->getProjectDevs($id);
                                break;
                case 'activity': $devs = $this->getActivityDevs($id);
                                break;
                case 'task': $devs = $this->getTaskDevs($id);
                                break;
                default: break;
            }
            
        }else{
             $devs = $this->getAllDevs();
        }
        $managers = $this->getManagers();
        $res = array_merge_recursive($managers, $devs);
        return $res;
    }
    /** This function update an ended activity status and all its tasks**/
    public function endActivity($activityId, $status){
        $res = ['status'=>'true'];
        $activity = Activite::findOne(['id_activite'=>$activityId]);
        $activity->statut = $status;
        if(!$activity->save()){
              $res = ['status'=>'false'];
        }
        $tasks = Tache::find()->where(['id_activite'=>$activity->id_activite])->all();
        foreach ($tasks as $task){
            if($task['statut'] != 'termine'){
                $task['statut'] = $status;
                if(!$task->save()){
                    $res = ['status'=>'false'];
                }
            }
        }
         return $res;
    }
    
    /** This function updates an ended project status and all its tasks**/
    public function endProject($projectId, $status){
        $res = ['status'=>'true'];
        $project = Projet::findOne(['id_projet'=>$projectId]);
        $project->statut = $status;
        if(!$project->save()){
              $res = ['status'=>'false'];
        }
        $activities = Activite::find()->where(['id_projet'=>$project->id_projet])->all();
        foreach ($activities as $activity){
            if($activity['statut'] != 'termine'){
                $this->endActivity($activity['id_activite'], $status);
            }
        }
         return $res;
    }
    
    
    public function getProjects($type){
        // recupère tous les projets 'technique' OU bien tous les projets 'adm/struc(t'  
        $query = new \yii\db\Query();
        $query->select('p.id_projet,p.type, statut, p.nom nom_projet, description desc, '
                                    . 'date_debut, date_fin, prestataire')
                         ->from('projet p');
        if(Yii::$app->user->identity->role == 'DEV' && $type=='technique' ){
            $query->innerJoin('dev_projet dp', 'dp.id_projet = p.id_projet and dp.id_user ='
                                    .Yii::$app->user->identity->id);
        }
        $projects = $query->where(['p.type' => $type])
                          ->orderBy('p.id_projet DESC')
                          ->all();
        return $projects;
    }
    
    /**  This function retrieve all activities of a project **/
    public function getActivities($projectId){
         // recupère toutes les activités du projet 'technique' OU bien tous les projets 'adm/struc(t'  
            $query = new \yii\db\Query();
            $activities = $query->select('a.id_activite,a.id_projet, a.type, statut, a.nom nom_activite, description desc, '
                                        . 'date_debut, date_fin, prestataire')
                             ->from('activite a')
                             ->where(['a.id_projet' => $projectId])
                              ->orderBy('a.id_activite DESC')
                             ->all();
            return $activities;
    }
    /** Get properties and developpers of each project
     * @param $type is the project type weither 'technique' or 'adm_strcut' **/
    public function getProjectsInfo($type){
        $projects = $this->getProjects($type);
        // Initialise l'indice du projet précédent à -1
        $prevProjectId = -1;
        $finals = [];
        /** 
          * La boucle foreach suivante recherche pour chaque projet la liste de ses développeurs
          * Elle crée alors un tableau associatif contenant les projets et leurs developpeurs dans un même sous tableau. 
          * $finals[0]['info']['nom_projet'] désigne le nom du premier projet
          * $finals[0]['devs'][0]['nom'] désigne le nom du premier developpeur du prem projet
          */
        foreach($projects as $project) {
            if($prevProjectId != $project['id_projet']){
                $project['btn_class'] = $this->btnClass($project['statut']);
                $project['statut'] = $this->renameStatus($project['statut']);

                $devs = $this->getProjectDevs($project['id_projet']);
                $finals[] = ['info' => $project, 'devs' => $devs];
            }
            $prevProjectId = $project['id_projet'];
        }
        return $finals;
    }
    /** Get properties and developpers of a project and its activities and their tasks
     * @param $projectId is the project id  **/
    public function getProjectInfo($projectId){
        $activities = $this->getActivities($projectId);
        $finals = [];
        if(!empty($activities)){
            //return $this->render('index');
            $query2 = new \yii\db\Query();
            /** 
             * La boucle foreach suivante recherche pour chaque projet la liste de ses développeurs
             * Elle crée alors un tableau associatif contenant les projets et leurs developpeurs dans un même sous tableau. 
             * $finals[0]['info']['nom_projet'] désigne le nom du premier projet
             * $finals[0]['devs'][0]['nom'] désigne le nom du premier developpeur du prem projet
             */
            $prevActivityId = -1;
                
            foreach($activities as $activity){
                    
                if($prevActivityId != $activity['id_activite']){

                    $activity['btn_class'] = $this->btnClass($activity['statut']);
                    $activity['statut'] = $this->renameStatus($activity['statut']);

                    $devs = $this->getActivityDevs($activity['id_activite']);
                    $actTasks = $this->getActivityTasks($activity['id_activite']);
                    $prevTaskId = -1;
                    $tasks = [];
                    foreach($actTasks as $task){
                        if($prevTaskId != $task['id_tache']){
                           $task['btn_class'] = $this->btnClass($task['statut']);
                           $task['statut'] = $this->renameStatus($task['statut']);
                           $taskDevs = $this->getTaskDevs($task['id_tache']);
                           $tasks[] = ['info'=>$task, 'devs' => $taskDevs];
                        }
                        $prevTaskId = $task['id_tache'];
                    }

                    $finals[] = ['info' => $activity, 'devs' => $devs, 'tasks'=>$tasks];
                }
                $prevActivityId = $activity['id_activite'];
            }
            return $finals;
        }
    }
    
    /** 
     * This function renames the project stautus.
     * It removes the '_' in the status name and returns a correct printable text. 
     * @param String $status is the project status
     * @return String 
     * **/
    private function renameStatus($status){
        switch ($status){
            case 'en_attente': $res = 'en attente';
                               break;
            case 'en_cours': $res = 'en cours';
                               break;
            case 'termine': $res = 'terminé';
                               break;
            case 'termine_attente': $res = 'terminé non validé';
                               break;
            default : $res='';                
                      break;
        }
        return $res;
    }
    /** 
     * This function gives the boostrap proper class depending on the projet status
     * @param String $status is the project status
     * @return String A boostrap class
     * **/
    private function btnClass($status){
        switch ($status){
            case 'en_attente': $res = 'btn-dark';
                               break;
            case 'en_cours': $res = 'btn-info';
                               break;
            case 'termine': $res = 'btn-success';
                               break;
            case 'termine_attente': $res = 'btn-warning';
                               break;
            default : $res='';                
                      break;
        }
        return $res;
    }
    
    /**
     * This function returns All managers staff from database
     * @params bool ad. True when AD should be selected False otherwise
     * @return mixed
     */
    public function getManagers() {
        $roles =  ['DG', 'DT', 'AD'];
        $query= new \yii\db\Query;
         $devs = $query->select('u.id, prenom, u.nom, f.nom nom_fich, u.role, u.email')
                       ->from('user u')
                      ->leftJoin('fichier f', 'f.id_user = u.id')
                      ->where(['u.role'=>$roles ])
                      ->andWhere(['u.id_supp' => null])
                      ->all();
         return $devs;
    }    
    
    /**
     * This function returns project devs from database
     * @params int $projectId
     * @return mixed
     */
    public static function getProjectDevs($projectId, $onlyChief=false) {
        $array = $onlyChief ? ['dp.role' =>'chef'] : [];
        $query= new \yii\db\Query;
         $devs = $query->select('u.id, prenom,u.nom, f.nom nom_fich, dp.role, u.email')
                       ->from('user u')
                      ->innerJoin('dev_projet dp', 'dp.id_user = u.id')
                      ->leftJoin('fichier f', 'f.id_user = u.id')
                      ->where(['u.role'=>'DEV'])
                      ->andWhere(['dp.id_projet' => $projectId ])
                      ->andWhere($array)
                      ->andWhere(['u.id_supp' => null ])
                      ->orderBy('dp.role')
                      ->all();
         return $devs;
         
    }

  
     /**
     * This function returns all devs from database
     * @params int $projectId
     * @return mixed
     */
    public static function getAllDevs() {
        $query= new \yii\db\Query;
         $devs = $query->select('u.id, prenom, u.nom,  f.nom nom_fich, u.role, u.email')
                       ->from('user u')
                      ->leftJoin('fichier f', 'f.id_user = u.id')
                      ->where(['u.role'=>'DEV'])
                      ->andWhere(['u.id_supp'=>null])
                      ->all(); 
      /**  foreach ($devs as $dev){
            $res[] = [$dev['id'] => $dev['nom']]; 
        } **/
         return $devs;
    }
    
    /**
     * This function returns activity devs from database
     * @params int $activityId
     * @return mixed
     */
    public function getActivityDevs($activityId) {
        $query= new \yii\db\Query;
        $devs = $query->select('u.id, prenom,u.nom, f.nom nom_fich, u.role, u.email')
                      ->from('user u')
                     ->innerJoin('faire_activite fa', 'fa.id_user = u.id')
                     ->leftJoin('fichier f', 'f.id_user = u.id')
                     ->where(['fa.id_activite' => $activityId ])
                     ->andWhere(['u.role'=>'DEV'])
                     ->andWhere(['u.id_supp'=>null])
                     ->all();
         return $devs;
    }
    
    /**
     * This function returns task devs from database
     * @params int $activityId
     * @return mixed
     */
    public function getTaskDevs($taskId) {
        $query= new \yii\db\Query;
        $devs = $query->select('u.id, prenom,u.nom, f.nom nom_fich, u.role, u.email')
                      ->from('user u')
                     ->innerJoin('faire_tache ft', 'ft.id_user = u.id')
                     ->leftJoin('fichier f', 'f.id_user = u.id')
                     ->where(['ft.id_tache' => $taskId ])
                     ->andWhere(['u.role'=>'DEV'])
                    ->andWhere(['u.id_supp'=>null])
                     ->all();
         return $devs;
    }

    /**      
     * * @params int $activityId 
     * @return mixed
     */
    public function getActivityTasks($activityId) {
        $query = new \yii\db\Query;
        $tasks = $query->select('t.id_tache, t.type, statut, t.nom nom_tache, description desc, '
                                        . 'date_debut, date_fin, prestataire')
                                        ->from('tache t')
                                        ->where(['t.id_activite' => $activityId])
                                        ->orderBy('t.id_tache DESC')
                                        ->all();
        return $tasks;
    }
    
    public function actionTest()
    {
        $res = $this->getReceivers(5, 'project', 'technique');
        print_r($res);
    }
}
