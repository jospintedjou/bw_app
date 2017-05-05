<?php

namespace frontend\modules\meeting\controllers;
use yii\web\Controller;
use yii\web\Request;
use frontend\modules\meeting\models\createCalendarForm;
use common\models\Reunion;
use yii;
use yii\web\Session;
use kartik\widgets\Growl;
use yii\helpers\Url;
use yii\web\JsonResponseFormatter;
use common\models\User;
use common\models\ParticiperReunion;
use common\models\Fichier;
use yii\web\UploadedFile;
use \frontend\modules\meeting\models\uploadFileForm;
use \frontend\modules\meeting\models\partForm;

/**
 * Default controller for the `meeting` module
 */
class MeetingController extends Controller {

// version mise a jours 21/09/2016
    public $enableCsrfValidation = false;
    
    /**
     * This function send a message to all participant of some meeting and store it to the database
     * @return mixed
     */
    public function actionMessage(){
       if (Yii::$app->request->isAjax) {
            $toto = Yii::$app->request->post();                   
            $mess = $toto['message'];                   
            $emails = $toto['email'];
            $entete = $toto['entete'];
            $status = 0;
//           $mail = Yii::$app->mail->compose('index', ['body' => $mess])
//                    ->setFrom('intraweb@seinova.com')
//                    ->setTo($emails)
//                    ->setSubject($entete);
//            $status = $mail->send();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
         return [
                    'grow' => [
                        'title' => '<strong>Envoi de Mail</strong><br/><hr/>',
                        'icon' => $status? 'glyphicon glyphicon-ok-sign' : 'glyphicon glyphicon-danger-sign',
                        'message' => $status? 'Mails Envoyes avec success' : 'Envoi des Mails non disponible pour le moment'
                    ],
                    'options' => [ 
                        'type' => $status? 'success' : 'danger',
                        'delay' => 5000,
                        'allow_dismiss' => true
                    ],
                    'mess'=>$mess
           ];
       }
   }

   /**
    * 
    * Suppression de message et Envoie des mails aux participants
    */
    
  /**
     * This function create a meeting and display it to the callendar view-Meeting
     * @return mixed
     */ 
   
   public function addMeeting($meete, $now){
       
       $meeting = new \yii2fullcalendar\models\Event();
        $meeting->title = $meete->title;
        $meeting->id = $meete->id_reunion;
        $meeting->start = date('Y-m-d\TH:i:s\Z', strtotime($meete->date . ' ' . $meete->heure_debut));
        $meeting->end = date('Y-m-d\TH:i:s\Z', strtotime($meete->date . ' ' . $meete->heure_fin));
        $next = strtotime($meete->date . ' ' . $meete->heure_fin);
        if ($now > $next) {

            if($meete->id_fichier ===-1){

                $meeting->backgroundColor = '#5cb85c';
            }
            else{

                $meeting->backgroundColor = '#5bc0de';
            }

        }
       return $meeting;
   }
    
    /**
     * This function load rigth to an connected user and return it
     * @return mixed
     */
    
    
    public function actionDroit(){
        
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $id = Yii::$app->user->id;
        $droits = User::findOne($id)->role;
        
        return $droits;
    }
    /**
     * This function create a meeting and store it to the database
     * @return mixed
     */
      
    public function actionCreate() {
        
        $index = 0;  
        $message = '?';
        $email = [];
        $entete = '?';
        $model = new createCalendarForm();
        if ($model->load(\yii::$app->request->post())) {
            $model->selectedParts = isset($_POST['to'])?$_POST['to']:[];
            $id = Yii::$app->user->id;
            if ($model->entry()) {  
//              $Reunion_DG = new ParticiperReunion();  
              $count = Reunion::find()->max('id_reunion'); 
//              $Reunion_DG->id_user = User::find()->where(['role'=>'DG'])->all()->id;
//              $Reunion_DG->id_reunion = $count;
//              $Reunion_DG->ajoute_apres = 'non';
//              $Reunion_DT = new ParticiperReunion();
//              $Reunion_DT->id_user = User::find()->where(['role'=>'DT'])->all()->id;
//              $Reunion_DG->id_reunion = $count;
//              $Reunion_DG->ajoute_apres = 'non';
//              $Reunion_DG->save();
//              $Reunion_DG->save();
                       
               if(! empty($model->selectedParts)){
                   
                    foreach($model->selectedParts as $participant){
                        
                        $user = User::findOne($participant);
                        $email[] =  $user->email;
                        $reunion = new ParticiperReunion();
                        $reunion ->id_user = $participant;
                        $reunion ->id_reunion = $count;
                        $reunion ->ajoute_apres = 'non';
                        $reunion ->save();
                    }
                    $message = '<br/>Réunion a Seinova le '.$model->date.' a '.$model->heuredebut.' dans la '.$model->lieu;
                    $entete = 'Reunion Seinova important'; 
               }
             \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
             $response = true;
              
            }
            else{
                
               $response = false; 
            }
            
            return [
                 
                    'grow' => [
                        
                        'title' => '<strong>Creation Reunion</strong><br/><hr/>',
                        'icon' => $response? 'glyphicon glyphicon-ok-sign' : 'glyphicon glyphicon-danger-sign',
                        'message' => $response? 'Reunion Creee avec success' : 'Echec Creation Reunion'
                    ],
                    'options' => [ 
                        'type' => $response? 'success' : 'danger',
                        'delay' => 3000,
                        'allow_dismiss' => true
                    ],
                    'message'=>$message,
                    'email'=>$email,
                    'entete'=>$entete,
            ];
        }
        
    }

    /**
     * This function allow to add a member to one existing meeting
     * That member have id $memberId in the database
     * @params int $memberId 
     * @return mixed
     */
    
    public function actionAddMember() {
        
         \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
         $partmodele = new partForm();
        
        if ($partmodele->load(\yii::$app->request->post())){
            
            if($partmodele->entrypart()){
                $result = 1;
            }
            else{
                $result = 0;
            }
            
             return [
                 
                    'grow' => [
                        'title' => '<strong>Ajout Participants</strong><br/><hr/>',
                        'icon' => $result? 'glyphicon glyphicon-ok-sign' : 'glyphicon glyphicon-danger-sign',
                        'message' => $result? 'Participants ajoute avec success' : 'Echec Ajout Participants'
                    ],
                    'options' => [ 
                        'type' => $result? 'success' : 'danger',
                        'delay' => 3000,
                        'allow_dismiss' => true
                    ]

             ];
        }
    }

    /**
     * This function allow to add an archive which concern one existing meeting
     * @return mixed
     */
    
    public function actionAddArchive() {
        
        $modele = new uploadFileForm();
        $file = new Fichier();   
       \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(yii::$app->request->isPost){    
            $modele->load(\yii::$app->request->post());
            $modele->protocole = UploadedFile::getInstance($modele, 'protocole');
            if($modele->validate()){
                  $reunion = Reunion::findOne($modele->Id_meeting);
                  $max = Fichier::find()->orderBy('id_fichier DESC')->scalar()+1;
                  $file->nom = $reunion->date . '_' . 'Protocole_Reunion_' . $max ;
                  $file->type = $modele->protocole->extension;
                  if($file->save()){
                    $modele->protocole->saveAs('MeetingsSeinova/' . $file->nom . '.' . $modele->protocole->extension);
                    $request = Reunion::updateAll(['id_fichier'=>$max],['id_reunion'=>$modele->Id_meeting]) ;
                   
                    return 'success';
                  
                  }  
            }
        }
           throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * This function allow to see in details attributes of one specific meeting in the database
     * That meeting have id $meetingId in the database
     * @params int $meetingId
     * @return mixed
     * @Author Ngauss Erick
     */
    
    public function actionView($meeting) {
        date_default_timezone_set('Africa/Douala');     
        $id = Yii::$app->user->id;
        $droit = User::findOne($id)->role;
        $reunion = new createCalendarForm();
        $reun = Reunion::findOne($meeting);
        $participants = ParticiperReunion::find()->where(['id_reunion'=>$meeting])->All();
        $p = ParticiperReunion::find()->where(['id_reunion'=>$meeting])->andWhere(['id_user'=>$id])->One();
        $alluser = User::find()->
                where(['id_supp'=>NULL])->
                andWhere(['!=','role','ADMIN'])
                ->andWhere(['!=','role','DG'])
                ->andWhere(['!=','role','DT'])->All();
        $reunion->titre = $reun->title;
        $reunion->description = $reun->description;
        $reunion->lieu = $reun->lieu;
        $reunion->date = $reun->date;
        $reunion->heuredebut = $reun->heure_debut;
        $reunion->heurefin = $reun->heure_fin;
        $reunion->Id_reunion = $reun->id_reunion;
        $now = time();
        $end = strtotime($reun->date . ' ' . $reun->heure_fin);
        $end_plus = strtotime("+1 week", strtotime($reun->date . ' ' . $reun->heure_fin));
        $active_archive = -1;
        $path = '';
        $doitparticiper = 0;
        $countparticipant = 0;
        $resultParticipant = [];
        $resultParticipantapres =[];
        $abs = $now - $end;
        foreach ($participants as $participant){
            
            $user = User::findOne($participant->id_user);
            $resultParticipant[] =  array($user->nom,$user->prenom,$user->email,$user->id,$participant->ajoute_apres);
            $countparticipant ++;
            
            if($id === $participant->id_user){
                $doitparticiper = 1;
            }
        }
               
        if(!empty($p)){
            $p->lus = "oui";
            $p->save();
        }
       
        if($now>$end){
            
             $id_fichier = Reunion::findOne($meeting)->id_fichier;
             $status = ($now > $end_plus)? 0:1;
             
             if( !($id_fichier ===-1)){
                 $active_archive = 1;
                 $file_reunion = Fichier::findOne($id_fichier);
                 $path = "MeetingsSeinova/".$file_reunion->nom . '.' .  $file_reunion->type; 
                }
             else{
                 $active_archive = -1;
                }
        }
        else{
            
            $active_archive = 0; 
            $status = -1; 
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; 
        return [$reunion,$active_archive,$resultParticipant,$countparticipant,$path,$droit,$alluser,$doitparticiper,$resultParticipantapres,$status,
            ];
       
    }

    /**
     * This function allow to export reports of one existing meeting
     * @return mixed
     */
     
    public function actionExportReport() {
          
        $path = Yii::getPathOfAlias('webroot')."/MeetingsSeinova/".$file_reunion->nom . '_' . $file_reunion->id_fichier . '_' .  $file_reunion->type;
        $this->downloadFile($path);
        return $file_reunion;  
    }
    
   /**
     * This function allow to delete one existing meeting
     * @return mixed
     */
      
    public function actionDelete($id_meeting) {
        $email = [];
        $message = 'Mails?';
        $tete = 'Remouve?';
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
          
       $id_user = yii::$app->user->id;
       $transaction = \yii::$app->db->beginTransaction();
       try{
         // \Yii::$app->setFlash('success', 'la reunion a ete supprimee avec success');
            Yii::$app->db->createCommand()
                     ->update('reunion', 
                     [
                         'id_supp' => $id_user,

                     ], 
                     [
                         'id_reunion' => $id_meeting
                     ]
                     )
                     ->execute();
        $transaction->commit();
       }
       catch(Exception $e){
           
           $transaction->rollback();
       }   
        $user = ParticiperReunion::find()->where(['id_reunion'=>$id_meeting])->All();
        if(!empty($user)){
            foreach($user as $participents){
                $participents->lus = "oui";
                $participents->save();
                $senders = User::findOne($participents->id_user);
                $email[] = $senders->email;
            }
            $reunion = Reunion::findOne($id_meeting);
            $message = 'La Reunion du '.$reunion->date.' a '.$reunion->heure_debut.' a  ete reportee pour une date Ulterieure';
            $tete = 'Reunion reporté!';
            ParticiperReunion::deleteAll(['id_reunion'=>$id_meeting]);
        }
        return [
                'message'=>$message,
                'email'=>$email,
                'entete'=>$tete,
                ];
    }

   
    /**
     * This function allow to update attributes of one meeting in the database
     * That meeting have id $meetingId in the database
     * @params int $meetingId 
     * @return mixed
     */
    
    public function actionUpdate() {
        $tableau=[];
        $count = 0;
        $update = false;
        $modelEdit = new createCalendarForm();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($modelEdit->load(\yii::$app->request->post())&& ($modelEdit->validate())) {
            
            $transaction = \yii::$app->db->beginTransaction();
            try{
                 Yii::$app->db->createCommand()
                     ->update('reunion', 
                     [
                         'title' => $modelEdit->titre,
                         'description' => $modelEdit->description,
                         'heure_debut' => $modelEdit->heuredebut,
                         'heure_fin' => $modelEdit->heurefin,
                         'date' => $modelEdit->date,
                         'lieu' => $modelEdit->lieu,
                     ], 
                     [
                         'id_reunion' => $modelEdit->Id_reunion
                     ]
                     )
                     ->execute();
                 $transaction->commit();
                 $update = true;
            }catch(Exception $e){

                $update = false;
                $transaction->rollback();
            }   
            if(!empty($modelEdit->participants)){
                ParticiperReunion::deleteAll(['id_reunion'=>$modelEdit->Id_reunion]);
                $tableau[]=$modelEdit->participants;
                foreach($modelEdit->participants as $participent){
                    $count++;
                    $participerreunion = new ParticiperReunion();
                    $participerreunion->id_user = $participent;
                    $participerreunion->id_reunion = $modelEdit->Id_reunion;
                    $participerreunion->ajoute_apres = 'non';
                    $participerreunion->save();
                }
                $part = true;
            } 
            else{
                $part = false;
            }
        }
           return [
                 
                    'grow' => [
                        'title' => '<strong>Modifier Reunion</strong><br/><hr/>',
                        'icon' => $update? 'glyphicon glyphicon-ok-sign' : 'glyphicon glyphicon-danger-sign',
                        'message' => $update? 'Reunion modifiee avec success et '.(($count==0)?'Aucun Participants Ajoutes':$count.' Participants Ajoutes') : 'Echec Modiffication, certains champs sont certainement vides  ou les heures de reunion incorrectes'
                    ],
                    'options' => [ 
                        'type' => $update? 'success' : 'danger',
                        'delay' => 5000,
                        'allow_dismiss' => true
                    ]

             ]; 
         
   }
   
   /**
    * action to count number of unread Meeting of an specific user
    */
    public function actionNbmeeting(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
         $id_use = yii::$app->user->id;
         $lus = ParticiperReunion::find()->where(['id_user' => $id_use])->andWhere(['lus' => "non"])->count(); 
         return [
             'nbMeeting'=>$lus
                 ];
    }
   
   
    /**
     * This function allow to see all meetings in the database
     * @return mixed
     */
    public function actionViewMeetings() {
        date_default_timezone_set('Africa/Douala');
        $id_use = yii::$app->user->id;
        $droits = User::findOne($id_use)->role;
        $modele = new uploadFileForm();
        $model_reunion = new createCalendarForm();
        $modelEdit = new createCalendarForm();
        $model = new createCalendarForm();
        $partmodele = new partForm();
        $model->participants = User::find()
                ->where(['id_supp' => NULL])
                ->andWhere(['!=','role','ADMIN'])
                ->andWhere(['!=','role','DG'])
                ->andWhere(['!=','role','DT'])
                ->All();
        $reunion = Reunion::find()->All();
        $tablereunion = [];
        $event = null;
        $now = time();
        
        foreach ($reunion as $meet) {
            $countreun = 0; $lus = 0;
            if($meet->id_supp ===null){
                $user = ParticiperReunion::find()->where(['id_reunion' => $meet->id_reunion])->All();
                if(($droits === "DG") || ($droits === "DT")){
                    $tablereunion[] = $this->addMeeting($meet, $now = time());
                }
                else{
                    
                    if(!empty($user)){
                    
                        foreach($user as $usere){

                            if(($usere->id_user === $id_use)){
                                $tablereunion[] = $this->addMeeting($meet, $now = time());
                            } 
                        }
                    }
                }                    
           }
                    
        }
            return $this->render('view-meetings', 
                    [
                        'model' => $model, 
                        'Events' => $tablereunion,
                        'modelEdit' => $modelEdit,
                        'modele'=>$modele,
                        'model_reunion'=>$model_reunion,
                        'partmodele'=>$partmodele,
                    ]);
    }

}
