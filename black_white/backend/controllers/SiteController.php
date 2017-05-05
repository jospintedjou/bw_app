<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\providers\OurConnection;
use common\providers\OurType;

/**
 * Site controller
 */
class SiteController extends Controller
{
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
                        'actions' => ['login', 'error', 'test'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'home', 'choose-db'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
     * Displays index page.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    /**
     * Displays homepage.
     *
     * @param Array $succs The list of succursales
     * @return string
     */
    public function actionHome()
    {
        if(Yii::$app->appType->type == 'cloud'){
        $succs = (new OurConnection)->getAllDatabases();
        unset($succs['cloud']);
         return  $this->render('home', ['succursales' => $succs]);
        }else{
            return $this->render('index');
        }
    }
    
    /**
     * Displays index page.
     *
     * @param Array $name The name of selected database
     * @return string
     */
    public function actionChooseDb($name)
    {
        $con = new OurConnection();
        if ($con->setDbName($name)){
            return $this->render('index');
        }
        return $this->redirect(['site/home']);
    }
    
    
    public function actionTest(){
        return $this->renderPartial('listeComptes');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'mainLogin.php';
        if (!Yii::$app->user->isGuest) {
            Yii::$app->session->set('bw_database', Yii::$app->db->name);
            return $this->goHome();
        }

        $model = new LoginForm();
        $model->side = 'backend';
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->set('bw_database', Yii::$app->db->name);
            if (OurType::getType() == 'cloud'){
               return $this->redirect(['/site/home']); 
            }else{
                return $this->goHome();
            }
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
