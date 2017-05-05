<?php

namespace backend\modules\accounts\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\providers\Account;
use common\models\User;
use yii\bootstrap\ActiveForm;
use Yii;
use yii\web\UploadedFile;
use yii\web\Response;
use backend\modules\accounts\models\ChangePassForm;
use backend\modules\accounts\models\ChangePhotoForm;
use backend\modules\accounts\models\DeleteForm;
use backend\modules\accounts\models\CreateForm;
use backend\modules\accounts\models\UpdateForm;

class AccountController extends \yii\web\Controller
{
     public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['logout','change-password', 'confirm-presence','create','delete','index','update',
                        'view-account','view-history-presences'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','change-password','confirm-presence','create','delete','update',
                        'view-account','view-history-presences', 'view-accounts', 'find-account', 'validate', 'upload', 'save-photo'],
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
    
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'upload' => [
                'class' => 'budyaga\cropper\actions\UploadAction',
                'url' => 'uploads/miniatures',
                'path' => '@backend/web/uploads/miniatures',
            ]
        ];
    }
    
    /*
     * This function allow to change the user password
     * 
     * @return Mixed.
     */
    public function actionChangePassword()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $modelChangePass = new ChangePassForm();
        if (Yii::$app->request->isAjax && $modelChangePass->load(Yii::$app->request->post())) {
            $modelChangePass->_user = User::findOne(Yii::$app->user->id);
            if (!$modelChangePass->validate()){
                return false;
            }
            $bool = $modelChangePass->changePass();
            if ($bool['result'] && $bool['disconnect']){
                return Yii::$app->runAction('site/logout');
            }  else {
                return [
                    'success'  => $bool,
                    'growl' => [
                        'title' => '<strong>Changement de mot de passe</strong><br/><hr/>',
                        'icon' => $bool? 'glyphicon glyphicon-ok-sign' : 'glyphicon glyphicon-warning-sign',
                        'message' => $bool? 'Mot de passe change avec succes' : 'Le changement a echoue'
                    ],
                    'options' => [  'type' => $bool? 'success' : 'warning',
                                    'delay' => 3000,
                                    'allow_dismiss' => true
                                 ]
                ];
            }
        }
    }

    /*
     * 
     */
    public function actionConfirmPresence()
    {
        return $this->render('confirm-presence');
    }

    /*
     * This function allow to
     */
    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new CreateForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            $model->photo = UploadedFile::getInstance($model, 'photo');
            $model->_user = User::findOne(Yii::$app->user->id);
            if (!$model->validate()){
                return false;
            }
            $bool = $model->create();
            return [
                    'success'  => $bool,
                    'growl' => [
                        'title' => '<strong>Creation de comptes</strong><br/><hr/>',
                        'icon' => $bool? 'glyphicon glyphicon-ok-sign' : 'glyphicon glyphicon-danger-sign',
                        'message' => $bool? 'Le compte a ete cree avec succes' : 'Creation echouee'
                    ],
                    'options' => [  'type' => $bool? 'success' : 'danger',
                                    'delay' => 3000,
                                    'allow_dismiss' => true ]
            ];
        }
    }

    /*
     * This function allow to
     */
    public function actionDelete()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new DeleteForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            $model->_user = User::findOne(Yii::$app->user->id);
            if (!$model->validate()){
                return false;
            }
            $bool = $model->delete();
            return [
                    'success'  => $bool,
                    'growl' => [
                        'title' => '<strong>Suppression de comptes</strong><br/><hr/>',
                        'icon' => $bool? 'glyphicon glyphicon-ok-sign' : 'glyphicon glyphicon-warning-sign',
                        'message' => $bool? 'Compte supprime avec succes' : 'Suppression echoue'
                    ],
                    'options' => [  'type' => $bool? 'success' : 'warning',
                                    'delay' => 3000,
                                    'allow_dismiss' => true
                                 ]
            ];
        }
    }


    /*
     * This function allow to
     */
    public function actionUpdate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $modelUpdate = new UpdateForm();
        
        if ($modelUpdate->load(Yii::$app->request->post()) && Yii::$app->request->isAjax){
            $modelUpdate->_user = User::findOne(Yii::$app->user->id);
            if ($modelUpdate->validate()){
                $bool = $modelUpdate->update();
                return [
                        'success'  => $bool,
                        'growl' => [
                            'title' => '<strong>Mise a jour de comptes</strong><br/><hr/>',
                            'icon' => $bool? 'glyphicon glyphicon-ok-sign' : 'glyphicon glyphicon-warning-sign',
                            'message' => $bool? 'Le compte a ete edite avec succes' : 'La modification a ehouee'
                        ],
                        'options' => [  'type' => $bool? 'success' : 'warning',
                                        'delay' => 3000,
                                        'allow_dismiss' => true
                                     ]
                ];
            }
        }
    }
    
    /*
     * This function allow to
     */
    public function actionViewAccounts()
    {
        $modelCreate = new CreateForm();
        $modelUpdate = new UpdateForm();
        $modelChangePass = new ChangePassForm();
        $modelDelete = new DeleteForm();
        
        $user = User::findOne(Yii::$app->user->id);
        $postesCreate = $this->postes($user, 'create');
        $postesUpdate = $this->postes($user, 'update');
        
        $accountManager = new Account($user);
        $accounts = [];
        $i = 1;
        
        foreach ($accountManager->getUsersWithPicture() as $account){
            $accounts[$i] = $account;
            $accounts[$i]['poste'] = $this->poste($account['role']);
            $i = $i + 1;
        }
        $arr = ['accounts' => $accounts, 'user' => $user, 'modelCreate' => $modelCreate,
                'modelUpdate' => $modelUpdate, 'modelChangePass' => $modelChangePass,
                'postesCreate' => $postesCreate, 'postesUpdate' => $postesUpdate, 'modelDelete' => $modelDelete,
               ];
        return $this->render('view-accounts', $arr);
    }

    /*
     * This function allow to
     */
    public function actionViewAccount($id_user)
    {
        $user = User::findOne(Yii::$app->user->id);
        $accountManager = new Account($user);
        $usr = $accountManager->getUser($id_user);
        $usr['poste'] = $this->poste($usr['role']);
        $model = new ChangePhotoForm();
        
        return $this->render('view-account', ['usr' => $usr, 'model' => $model]);
    }

    /*
     * 
     */
    public function actionViewHistoryPresences($id_user)
    {
        return $this->render('view-history-presences');
    }

    /*
     * 
     */
    public function actionViewPresenceRecap($id_user)
    {
        return $this->render('view-presence-recap');
    }
    
    /**
     * this action serves to find the model that represent the user to update.
     * 
     * @param integer $id is the id of the selected user.
     */
    public function actionSavePhoto()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new ChangePhotoForm();
        $model->_user = User::findOne(Yii::$app->user->id);
        $params = json_decode(Yii::$app->request->post('param'));
        $model->idUser = $params->idUser;
        if ($model->validate()){
            $bool = $model->change($params->name);
            return [
                    'success'  => $bool,
                    'growl' => [
                        'title' => '<strong>Mise a jour du profil</strong><br/><hr/>',
                        'icon' => $bool? 'glyphicon glyphicon-ok-sign' : 'glyphicon glyphicon-warning-sign',
                        'message' => $bool? 'La photo a ete modifiee avec succes' : 'La modification a ehouee'
                    ],
                    'options' => [  'type' => $bool? 'success' : 'warning',
                                    'delay' => 3000,
                                    'allow_dismiss' => true
                                 ]
            ];
        }
    }
    
    
    /**
     * this action serves to find the model that represent the user to update.
     * 
     * @param integer $id is the id of the selected user.
     */
    public function actionFindAccount($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $usr = User::findOne(Yii::$app->user->id);
        $accountManager = new Account($usr);
        
        $model = new UpdateForm();
        
        $user = $accountManager->getUser($id);
        
        $model->name = $user['nom'];
        $model->surname = $user['prenom'];
        $model->username = $user['username'];
        $model->email = $user['email'];
        $model->role = $user['role'];
        $model->sex = $user['sexe'];
        $model->phoneNumber = $user['telephone'];
        $model->idUser = $id;
        
        return $model;
    }
    
    
    /*
     * validate action
     */
    public function actionValidate($natureModel)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        switch ($natureModel) {
            case 'create':
                $model = new CreateForm();
                if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
                    return ActiveForm::validate($model);
                }
            case 'update':
                $model = new UpdateForm();
                if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
                    return ActiveForm::validate($model);
                }
            case 'changePass':
                $model = new ChangePassForm();
                if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
                    return ActiveForm::validate($model);
                }
            default :
                exit();
        }
    }
    
    
    /*
     * This function serves to give the meaning of each roles
     * 
     * @params String $role the user role which we have to know the meaning
     * 
     * @return String that represent the meaning of role
     */
    protected function poste($rol){
        switch($rol){
            case 'DG' :
                return 'Directeur Général';
            case 'GS' :
                return 'Gestionnaire de Succursale';
            case 'MP' :
                return 'Magasinier Principal';
            case 'BM' :
                return 'Barman';
            case 'SE' :
                return 'Serveuse';
            case 'CU' :
                return 'Cuisinier';
            case 'VI' :
                return 'Videur';
            case 'GP' :
                return 'Gardien de Parking';
            case 'AU' :
                return 'Autre';
            case 'ADMIN' :
                return 'Administrateur';
            default :
                return 'Autre';
        }
    }
    
    
    /*
     * This function serves to give roles that the logged user can manage for an action
     * 
     * @params String $user the logged user
     * @params String $action the action that the logged user would perform
     * 
     * @return Array that represent the list of roles
     */
    protected function postes($user, $action){
        $postes = [];
        if ($user->role == 'DG'){
            if($action == 'update'){
                $postes['DG'] = 'Directeur Général';
            }
            $postes['GS'] = 'Gestionnaire de Succursale';
            $postes['MP'] = 'Magasinier Principal';
            $postes['ADMIN'] = 'Administrateur';
        }else if($user->role == 'GS'){
            if($action == 'update'){
                $postes['GS'] = 'Gestionnaire de Succursale';
            }
        }else if($user->role == 'ADMIN'){
            $postes['GS'] = 'Gestionnaire de Succursale';
            $postes['MP'] = 'Magasinier Principal';
            $postes['ADMIN'] = 'Administrateur';
        }else{
            return [];
        }
        $postes['BM'] = 'Barman';
        $postes['SE'] = 'Serveuse';
        $postes['CU'] = 'Cuisinier';
        $postes['VI'] = 'Videur';
        $postes['GP'] = 'Gardien de Parking';
        $postes['AU'] = 'Autre';
        return $postes;
    }
    
}
