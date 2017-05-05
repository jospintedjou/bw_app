<?php

namespace frontend\modules\purchaseOrder\controllers;

use Yii;
use yii\web\Controller;
use common\models\BonCmde;
use common\models\Client;
use \frontend\modules\purchaseOrder\models\PurchaseOderForm;

/**
 * Default controller for the `purchase-order` module
 */
class PurchaseOrderController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionViewOrders() {
        if (Yii::$app->user->identity->role != 'DEV') {
            $purchaseorder = new PurchaseOderForm();
            $purchaseorder_create = new PurchaseOderForm();
            $purchaseorders = BonCmde::find()->all();
            return $this->render('purchase-orders', [
                        'purchaseorder' => $purchaseorder,
                        'purchaseorder_create' => $purchaseorder_create,
                        'purchaseorders' => $purchaseorders
            ]);
        }
        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * This function create a purchase order and store it to the database
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->identity->role != 'DEV') {
            $purchaseorder = new PurchaseOderForm();

            if ($purchaseorder->load(Yii::$app->request->post())) {
                $infos_customer = Client::findOne($purchaseorder->id_client);

                if (!empty($infos_customer)) {
                    if ($purchaseorder->registerpurchaseorder()) {
                        Yii::$app->getSession()->setFlash('success', "Votre Bon de commande a ete bien ajoute");
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', "Informations Erronnées");
                }
            }
            return $this->redirect(['view-orders']);
        }
        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * This function allow to update details of an existing purchase order
     * That purchase order have id $orderId in the database
     * @params int $orderId 
     * @return mixed
     */
    public function actionUpdate() {

        if (Yii::$app->user->identity->role != 'DEV') {
            $purchaseorder = new PurchaseOderForm();

            if ($purchaseorder->load(Yii::$app->request->post())) {
                $infos_customer = Client::findOne($purchaseorder->id_client);

                if (!empty($infos_customer)) {
                    if ($purchaseorder->registerpurchaseorder()) {
                        Yii::$app->getSession()->setFlash('info', "Votre Bon de commande a ete bien mis a jour");
                    } else {
                        Yii::$app->getSession()->setFlash('error', "Echec De Mise à Jour !!!! Date(s) Manquante(s)");
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', "Echec De mise A Jour ,Informations Erronnées");
                }
            }
            return $this->redirect(['view-orders']);
        }
        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }

}
