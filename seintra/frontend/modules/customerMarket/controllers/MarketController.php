<?php

namespace frontend\modules\customerMarket\controllers;

use yii;
use \common\models\MarchePrive;
use \common\models\Client;
use common\models\MarchePublic;
use yii\web\Controller;
use frontend\modules\customerMarket\models\PrivateMarketForm;
use frontend\modules\customerMarket\models\PublicMarketForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

class MarketController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'view-markets', 'create-private-market', 'create-public-market', 'update'],
                'rules' => [
                    [
                        'actions' => ['logout', 'create-private-market', 'create-public-market', 'update', 'view-markets'],
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
     * Renders the index view for the module
     * @return string
     */
    public function actionViewMarkets($type) {
        if (Yii::$app->user->identity->role != 'DEV') {

            $type = Yii::$app->request->getQueryParam('type');
            

           
            if (isset($type) && !empty($type) && ($type == 'prive')) {
                $privatemarket = new PrivateMarketForm();
                $privatemarkets = MarchePrive::find()->orderBy(['intitule' => SORT_DESC])->all();
                $clientsPrive = ArrayHelper::map(Client::find()->where(['type' => 'prive'])->orderBy(['denomination' => SORT_DESC])->all(), 'id_user', function($model, $defaultvalue) {
                        if( $model['raison_sociale']=='Aucune'){
																						return $model['denomination'] ;
																					}
																					else
																					{
																						return $model['denomination'] . ' ' . $model['raison_sociale'];
                                                                        }
                    });
                return $this->render('view_markets_private', ['privatemarket' => $privatemarket,                     
                            'privatemarkets' => $privatemarkets,
                            'clientsPrive' => $clientsPrive,                           
                ]);
            } else 
                if (isset($type) && !empty($type) && ($type == 'public')) {
                $publicmarket = new PublicMarketForm();
                $publicmarkets = MarchePublic::find()->orderBy(['intitule' => SORT_DESC])->all();
                $clientsPublic = ArrayHelper::map(Client::find()->where(['type' => 'public'])->orderBy(['denomination' => SORT_DESC])->all(), 'id_user', function($model, $defaultvalue) {
                        if( $model['raison_sociale']=='Aucune'){
																						return $model['denomination'] ;
																					}
																					else
																					{
																						return $model['denomination'] . ' ' . $model['raison_sociale'];
                                                                        }
                    });

                return $this->render('view_markets_public', [
                            'publicmarket' => $publicmarket,
                            'publicmarkets' => $publicmarkets,
                            'clientsPublic' => $clientsPublic,                            
                ]);
            }
        }
        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * This function create a private market and store it to the database
     * @return mixed
     */
    public function actionCreatePrivateMarket() {
        if (Yii::$app->user->identity->role != 'DEV') {
            $privatemarket = new PrivateMarketForm();
            if ($privatemarket->load(Yii::$app->request->post())) {

                $infos_customer = Client::findOne($privatemarket->client);

                if ($infos_customer['type'] == 'prive') {
                    if (($privatemarket->etat == 'en_attente') && !empty($privatemarket->date_reponse)) {
                        $privatemarket->date_reponse = null;
                    }
                    if ($privatemarket->registerprivatemarket()) {
                        Yii::$app->getSession()->setFlash('success', "Marche enregistré avec succes");
                    } else {
                        Yii::$app->getSession()->setFlash('error', "Information(s) Manquante(s)ou Erronée(s) ");
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', "Ce client n'est pas un Privé");
                }
            }
            return $this->redirect(['view-markets', 'type'=>$infos_customer['type'] ]);
        }
        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * This function create a public market and store it to the database
     * @return mixed
     */
    public function actionCreatePublicMarket() {

        if (Yii::$app->user->identity->role != 'DEV') {
            $publicmarket = new PublicMarketForm();

            if ($publicmarket->load(Yii::$app->request->post())) {
                $infos_customer = Client::findOne($publicmarket->client);

                if ($infos_customer['type'] == 'public') {
                    if (($publicmarket->etat == 'en_attente') && !empty($publicmarket->date_reponse)) {
                        $publicmarket->date_reponse = null;
                    }
                    if ($publicmarket->registerpublicmarket()) {
                        Yii::$app->getSession()->setFlash('success', "Marche enregistré avec succes");
                    } else {
                        Yii::$app->getSession()->setFlash('error', "Information(s) Manquante(s) ou Erronée(s) ");
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', "Ce client n'est pas un Public");
                }
            }
          return $this->redirect(['view-markets', 'type'=>$infos_customer['type'] ]);
        }
        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * This function allow to update attributes of one market in the database
     * That market have id $marketId in the database
     * @params int $marketId 
     * @return mixed
     */
    public function actionUpdatePrivateMarket() {
        if (Yii::$app->user->identity->role != 'DEV') {
            $privatmarket = new PrivateMarketForm();

            if ($privatmarket->load(Yii::$app->request->post())) {
                $infos_customer = Client::findOne($privatmarket->client);

                if ($infos_customer['type'] == 'prive') {
                    if (($privatmarket->etat == 'en_attente') && !empty($privatmarket->date_reponse)) {
                        $privatmarket->date_reponse = null;
                    }
                    if ($privatmarket->registerprivatemarket()) {

                        Yii::$app->getSession()->setFlash('info', "les infos mis à jour de ce marche ont ete bien enregistrées");
                    } else {
                        Yii::$app->getSession()->setFlash('error', "Information(s) Manquante(s) ou Erronée(s) ");
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', "Ce client n'est pas un Privé ");
                }
                return $this->redirect(['view-markets', 'type'=>$infos_customer['type'] ]);
            }
        }
        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUpdatePublicMarket() {
        if (Yii::$app->user->identity->role != 'DEV') {
            $publicmarket = new PublicMarketForm();
            if ($publicmarket->load(Yii::$app->request->post())) {

                $infos_customer = Client::findOne($publicmarket->client);

                if ($infos_customer['type'] == 'public') {

                    if (($publicmarket->etat == 'en_attente') && !empty($publicmarket->date_reponse)) {
                        $publicmarket->date_reponse = null;
                    }
                    if ($publicmarket->registerpublicmarket()) {

                        Yii::$app->getSession()->setFlash('info', "la mis à jour de ce marche a ete bien effectue");
                    } else {
                        Yii::$app->getSession()->setFlash('error', "Informations(s) Manquante(s) ou Erronée(s)");
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', "Ce client n'est pas un Public ");
                }
                return $this->redirect(['view-markets', 'type'=>$infos_customer['type'] ]);
            }
        }
        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }

}
