<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use backend\models\CreateForm;
use backend\models\UpdateForm;
use backend\models\ChangePassForm;
use yii\bootstrap\ActiveForm;
use backend\models\PasswordResetRequestForm;
use backend\models\ResetPasswordForm;
use yii\web\BadRequestHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $defaultAcition = 'login';
    

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'send'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'view-accounts', 'validate', 'find-account',
                                      'create', 'delete', 'change-password', 'reset-password',
                                      'update-account', 'request-password-reset', 'send', 'sort'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'sort' => ['post'],
                    'validate' => ['post'],
                    'find-account' => ['post'],
                    'delete' => ['post'],
                    'update-account' => ['post'],
                    'request-password-reset' => ['post'],
                    'change-password' => ['post']
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
        ];
    }

    
    /**
     * Allow the connection of one administrator in the system.
     *
     * @return a view.
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['site/view-accounts']);
        }

        $model = new LoginForm();
        $model->sidetoken = true;
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['site/view-accounts']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    
    /**
     * Allow the disconnection of one administrator in the system.
     *
     * @return a view.
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    
    /**
     * Allow to one administrator to create an user account.
     *
     * @return a view.
     */
    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new CreateForm();
        $usr = User::findOne(Yii::$app->user->id);
        $model->_user = $usr;
        
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            $model->photo = UploadedFile::getInstance($model, 'photo');
            if (!$model->validate()){
                return false;
            }
            $bool = $model->create();
            return [
                    'success'  => $bool,
                    'growl' => [
                        'title' => '<strong>Account creation</strong><br/><hr/>',
                        'icon' => $bool? 'glyphicon glyphicon-ok-sign' : 'glyphicon glyphicon-danger-sign',
                        'message' => $bool? 'Account was created successfully' : 'Creation failed'
                    ],
                    'options' => [  'type' => $bool? 'success' : 'danger',
                                    'delay' => 3000,
                                    'allow_dismiss' => true
                                 ]
            ];
        }
    }
    
    
    /**
     * Allow to one administrator to delete an user account.
     *
     * @param Integer $idAccount represent the id of the account that you'll delete.
     * @return a view.
     */
    public function actionDelete($idAccount)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $account = User::findOne(['id' => $idAccount, 'id_supp' => null]);
        $bool = false;
        $usr = User::findOne(Yii::$app->user->id);
        if ($account->role != 'DG' && $account && $usr && ($usr->role == 'ADMIN' || $usr->role == 'DG')){
            $account->id_supp = $usr->id;
            $bool = $account->save();
        }
        return [
                'success'  => $bool,
                'growl' => [
                    'title' => '<strong>Account deletion</strong><br/><hr/>',
                    'icon' => $bool? 'glyphicon glyphicon-ok-sign' : 'glyphicon glyphicon-warning-sign',
                    'message' => $bool? 'Account was deleted successfully' : 'Deletion failed'
                ],
                'options' => [  'type' => $bool? 'success' : 'warning',
                                'delay' => 3000,
                                'allow_dismiss' => true
                             ]
        ];
        
    }
    
    
    /**
     * Allow to one administrator to change the password of an existing user account.
     *
     * @return a view.
     */
    public function actionChangePassword()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $modelChangePass = new ChangePassForm();
        $modelChangePass->idChanger = Yii::$app->user->id;
        
        if (Yii::$app->request->isAjax && $modelChangePass->load(Yii::$app->request->post())) {
            if (!$modelChangePass->validate()){
                return false;
            }
            $bool = $modelChangePass->changePass();
            if ($bool['result'] && $bool['disconnect']){
                return $this->actionLogout();
            }  else {
                return [
                    'success'  => $bool,
                    'growl' => [
                        'title' => '<strong>Change password</strong><br/><hr/>',
                        'icon' => $bool? 'glyphicon glyphicon-ok-sign' : 'glyphicon glyphicon-warning-sign',
                        'message' => $bool? 'Password was change successfully' : 'Password change failed'
                    ],
                    'options' => [  'type' => $bool? 'success' : 'warning',
                                    'delay' => 3000,
                                    'allow_dismiss' => true
                                 ]
                ];
            }
        }
    }
    
    
    /**
     * Serves to an administrator to send a request for password Change.
     *
     * @param Integer $idAccount represent the id of the account that you'll reset the password.
     * @return a mixed.
     */
    public function actionRequestPasswordReset($idAccount)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $model = new PasswordResetRequestForm();
        $model->idUser = $idAccount;
        $model->email = User::findOne(['id' => Yii::$app->user->id, 'role' => ['DG', 'ADMIN']])->email;
        
        if (empty($model->email) || !isset($model->email)){
            return 'error: Sorry, we are unable to reset password for email provided.';
        }
        
        if (Yii::$app->request->isAjax && $model->validate()) {
            $bool = $model->sendEmail();
            return [
                'success'  => $bool,
                'growl' => [
                    'title' => '<strong>Password reset request</strong><br/><hr/>',
                    'icon' => $bool? 'glyphicon glyphicon-ok-sign' : 'glyphicon glyphicon-warning-sign',
                    'message' => $bool? 'success: Check your email for further instructions.': 'error: Sorry, we are unable to reset password for email provided.',
                ],
                'options' => [  'type' => $bool? 'success' : 'warning',
                                'delay' => 3000,
                                'allow_dismiss' => true
                             ]
            ];
        }
    }

    
    /**
     * Resets password.
     *
     * @param string $token
     * @param integer $idAccount
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        $user = User::findByPasswordResetToken($token);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $bool = $model->resetPassword();
            Yii::$app->getSession()->setFlash($bool? 'success' : 'warning', $bool? 'Password resets successfully' : 'Reset password failed');
            return $this->redirect(['view-accounts']);
        }

        return $this->render('reset-password', ['model' => $model, 'user' => $user]);
    }
    
    
    /**
     * Allow to one administrator to edit informations about an existing user account.
     *
     * @return mixed.
     */
    public function actionUpdateAccount()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $modelUpdate = new UpdateForm();
        $modelUpdate->_user = User::findOne(Yii::$app->user->id);
        
        if ($modelUpdate->load(Yii::$app->request->post()) && Yii::$app->request->isAjax){
            $modelUpdate->photo = UploadedFile::getInstance($modelUpdate, 'photo');
            if ($modelUpdate->validate()){
                $bool = $modelUpdate->update();
                return [
                        'success'  => $bool,
                        'growl' => [
                            'title' => '<strong>Account edition</strong><br/><hr/>',
                            'icon' => $bool? 'glyphicon glyphicon-ok-sign' : 'glyphicon glyphicon-warning-sign',
                            'message' => $bool? 'Account was updated successfully' : 'Edition of account failed'
                        ],
                        'options' => [  'type' => $bool? 'success' : 'warning',
                                        'delay' => 3000,
                                        'allow_dismiss' => true
                                     ]
                ];
            }
        }
    }
    
    
    /**
     * Allow to one administrator to see the list of all user accounts. 
     *
     * @return a view.
     */
    public function actionViewAccounts()
    {
        $modelCreate = new CreateForm(); $modelChangePass = new ChangePassForm();
        $modelUpdate = new UpdateForm(); $modelRequest = new PasswordResetRequestForm();
        
        $user = User::findOne(Yii::$app->user->id);
        $postesCreate = $this->postes($user, 'create'); $postesUpdate = $this->postes($user, 'update');
        if ($user->role == 'DG'){
            $utilisateurs = User::find()->asArray()->where(['id_supp' => null])->all();
        }  else {
            $utilisateurs = User::find()->asArray()->where(['not in', 'role', ['DG', 'ADMIN']])->andWhere(['id_supp' => null])->orWhere(['id' => $user->id])->all();
        }
        foreach ($utilisateurs as $utilisateur){
            $tab[$utilisateur['id']] = $utilisateur;
            $tab[$utilisateur['id']]['poste'] = $this->poste($utilisateur['role']);
            $tab[$utilisateur['id']]['fichier'] = User::findOne($utilisateur['id'])->getFichiers()->asArray()->where(['type' => 'photo'])->one();
        }
        $accounts = $tab;
        
        return $this->render('accounts', ['accounts' => $accounts, 'postesCreate' => $postesCreate, 'user' => $user,
                                          'modelUpdate' => $modelUpdate, 'modelChangePass' => $modelChangePass,
                                          'modelRequest' => $modelRequest, 'modelCreate' => $modelCreate, 'postesUpdate' => $postesUpdate
                                         ]);
    }
    
    /**
     * this action serves to find the model that represent the user to update.
     * 
     * @param integer $id is the id of the selected user.
     */
    public function actionFindAccount($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new UpdateForm();
        
        $user = User::findOne(['id' => $id]);
        
        $model->name = $user->nom;
        $model->surname = $user->prenom;
        $model->username = $user->username;
        $model->email = $user->email;
        $model->role = $user->role;
        $model->idUser = $user->id;
        
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
    
    

    /**
     * this function return the a String that represent the role of an employee
     */
    protected function poste($rol)
    {
        switch($rol){
            case 'DG' :
                return 'Directeur Général';

            case 'DT' :
                return 'Directeur  Technique';

            case 'AD' :
                return 'Assistante de Direction';
        
            case 'ADMIN' :
                return 'Administrateur';
        
            case 'SDT' :
                return 'Secrétaire du DT';
        
            case 'DEV' :
                return 'Développeur';
            
            case 'DC' :
                return 'Directeur Commercial';
            
            case 'COMP' :
                return 'Comptable';
            
            case 'CAISSE' :
                return 'Caissier';
        
            default :
                return '    ';
        }
    }
    
    /**
     * this function return a list of roles that one user can manage depending of action.
     */
    protected function postes($user, $action)
    {
        if ($user->role == 'DG'){
            $postes = [
                        'ADMIN' => 'Administrateur',
                        'DT' => 'Directeur technique',
                        'AD' => 'Assistante de direction',
                        'DC' => 'Directeur commercial',
                        'COMP' => 'Comptable',
                        'DEV' => 'Developpeur',
                        'SDT' => 'Secretaire DT',
                        'CAISSE' => 'Caissier'
                      ];
            if ($action == 'update'){
                $postes['DG'] = 'Directeur general';
            }
        }  else {
            $postes = [
                        'DT' => 'Directeur technique',
                        'AD' => 'Assistante de direction',
                        'DC' => 'Directeur commercial',
                        'COMP' => 'Comptable',
                        'DEV' => 'Developpeur',
                        'SDT' => 'Secretaire DT',
                        'CAISSE' => 'Caissier'
                      ];
            if ($action == 'update'){
                $postes['ADMIN'] = 'Administrateur';
            }
        }
        return $postes;
    }
}
