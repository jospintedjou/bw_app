<?php

namespace frontend\modules\customerMarket\controllers;

use common\models\Client;
use common\models\User;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use frontend\modules\customerMarket\models\CustomerForm;
use frontend\modules\customerMarket\models\AppointmentForm;
use common\models\MarchePrive;
use common\models\MarchePublic;
use Yii;

class CustomerController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'view-customers', 'create', 'update', 'view-details', 'add-appointment'],
                'rules' => [
                    [
                        'actions' => ['logout', 'create', 'update', 'view-details', 'view-customers', 'add-appointment'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'view-details' => ['post'],
                    'add-appointment' => ['post'],
                    'update' => ['post'],
                    'create' => ['post'],
                ],
            ],
        ];
    }

    /**
     * This function allow to see all customers in the database
     * @return mixed 
     */
    public function actionViewCustomers() {
     
            $model = new CustomerForm();

            $model_empty = new CustomerForm();
            $model_appointment = new AppointmentForm();
            $customer = Client::find()->orderBy(['denomination'=>SORT_DESC])->all();
            $commercial = User::find()->where(['and', 'id_supp is NULL', ['<>', 'role', 'ADMIN']])->all();
            return $this->render('view-customers', [
                        'model' => $model,
                        'model_empty' => $model_empty,
                        'model_appointment' => $model_appointment,
                        'commercials' => $commercial,
                        'customer' => $customer]);
        
    }

    /**
     * This function create a customer,store it to the database and render contain view of all customers 
     * with a flash message which advise user for success or fail register customer
     * @return mixed 
     */
    public function actionCreate() {

       
            $model = new CustomerForm();
            if ($model->load(Yii::$app->request->post())) {
                $nbre = Client::find()
                        ->where(['type' => $model->type,
                            'denomination' => $model->denomination,
                            'raison_sociale' => $model->raison_sociale,
                        ])
                        ->count();
                if ($nbre == 0) {
                    if ($model->registercustomer()) {
                        Yii::$app->getSession()->setFlash('success', "Votre client a été bien enregistré");
                        return $this->redirect(['view-customers']);
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', " Echec d'enregistrement!!! ce client existe deja dans le systeme"
                    );
                }
            }
            return $this->redirect(['view-customers']);
       
    }

    /**
     * This function allow to update attributes of one customer display flash message for 
     * successing update an redirect to action ViewCustomer
     * @return mixed
     */
    public function actionUpdate() {
        if (Yii::$app->user->identity->role != 'DEV') {
            $model_empty = new CustomerForm();

            if ($model_empty->load(Yii::$app->request->post())) {
                
                // this request find customer id and affect it to $nbre  
                $nbre = Client::find()
                        ->where(['type' => $model_empty->type,
                            'denomination' => $model_empty->denomination,
                            'raison_sociale' => $model_empty->raison_sociale,
                        ])
                        ->scalar();
                if ($nbre == $model_empty->id_user || $nbre==null) {
                    if ($model_empty->registercustomer()) {
                        Yii::$app->getSession()->setFlash('info', "Mise à Jour Effectue avec succès");
                        return $this->redirect(['view-customers']);
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', " Echec de la mis à jour!!! ce client existe dejà "
                    );
                }
            }

            return $this->redirect(['view-customers']);
        }
        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * This function allow to add details of an appointment with one specific customer in the database
     * That customer have id $customerId in the database
     * @return mixed
     */
    public function actionAddAppointment() {
        if (Yii::$app->user->identity->role != 'DEV') {
            $model_appointment = new AppointmentForm();

            if ($model_appointment->load(Yii::$app->request->post())) {

                $commercial = User::findOne($model_appointment->commercial_id);

                if (!empty($commercial)) {
                    if ($commercial['role'] != 'ADMIN') {
                        if ($model_appointment->registerappointment()) {

                            Yii::$app->getSession()->setFlash('info', "Contact Client enregistré avec succes");

                            return $this->redirect(['view-customers']);
                        } else
                        if (empty($model_appointment->date)) {
                            Yii::$app->getSession()->setFlash('error', "Echec !!!! Date De La prise de Contact  Non Renseignée");
                        }
                    } else {
                        Yii::$app->getSession()->setFlash('error', "Cet Utilisateur N'est Pas Un Commercial !!!!");
                    }
                } else {

                    Yii::$app->getSession()->setFlash('error', "Informations Erronnées !!!!");
                }
                return $this->redirect(['view-customers']);
            }
        }
    }

    /**
     * This function allow to see in details attributes of one specific customer in the database
     * and render a viewdetails with appointments table and depnding markets table (private or public) 
     * @params int $id is the customer id
     * @params string $type is the customer type:'public' or 'prive'
     * @return mixed
     */
    public function actionViewDetails($id, $type) {
        
            if (isset($id) && !empty($id) && isset($type) && !empty($type)) {

                $infos_customer = Client::findOne($id);

                if (!empty($infos_customer)) {
                    //$contacts = Contact::find()->where(['id_client' => $id])->all()->innerJoin('user',"id_client=id_user");
                    $query = new \yii\db\Query;
                    $contacts = $query->select('date,prenom,nom,motif,debouche,moyen')
                            ->from('contact')
                            ->innerJoin('user', 'id_user=id')
                            ->all();
                    $customer = $this->findnamecustomer($id);

                    if ($type == 'prive' || $type == 'public') {
                        if ($type == 'prive') {
                            $markets = MarchePrive::find()->where(['id_client' => $id])->all();
                        } else if ($type == 'public') {
                            $markets = MarchePublic::find()->where(['id_client' => $id])->all();
                        }
                        return $this->render('view-details', [
                                    'contacts' => $contacts,
                                    'markets' => $markets,
                                    'customer' => $customer,
                                    'model' => $infos_customer
                        ]);
                    }
                }
            }
            throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
       
    }

    /**
     * This function render name of customer on use id $Id
     * @return string
     */
    public function findnamecustomer($id) {

        $customer = (new \yii\db\Query())
                ->select(['denomination', 'raison_sociale'])
                ->from('client')
                ->where(['id_user' => $id])
                ->one();
				if($customer['raison_sociale']=='Aucune'){
                      return $customer['denomination'];
		}
		else {
			return $customer['denomination'] . ' ' . $customer['raison_sociale'];
		}
    }

}
