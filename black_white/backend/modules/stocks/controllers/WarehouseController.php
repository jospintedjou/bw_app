<?php

namespace backend\modules\stocks\controllers;

use Yii;
use common\providers\ProduitSearch;
use backend\modules\stocks\models\StockProductForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\Photo;

class WarehouseController extends \yii\web\Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['logout', 'index', 'notify-warehouse', 'print-delivry-order', 'tack-in', 'tack-out', 'view', 'create-product'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'notify-warehouse', 'print-delivry-order', 'tack-in', 'tack-out', 'view', 'create-product'],
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

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionCreateProduct() {
        $model = new StockProductForm();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', "Votre produit a été bien enregistré");
                return $this->redirect(['view']);
            }
        }
        Yii::$app->getSession()->setFlash('danger', "echec d'enregistrement,vérifier si ce produit existe déjà pour cette categorie");
        return $this->redirect(['view']);
    }

    public function actionNotifyWarehouse($id_warehouse) {
        return $this->render('notify-warehouse');
    }

    public function actionPrintDelivryOrder($id_order) {
        return $this->render('print-delivry-order');
    }

    public function actionTackIn() {
        return $this->render('tack-in');
    }

    public function actionTackOut() {
        return $this->render('tack-out');
    }

    public function actionView() {
        // your default model and dataProvider generated by gii
        $searchModel = new ProduitSearch();
        $dataDrinkProvider = $searchModel->search_drink(Yii::$app->request->getQueryParams());
        $dataTabacProvider = $searchModel->search_tabac(Yii::$app->request->getQueryParams());
        $model = new StockProductForm();
        return $this->render('view', [
                    'data_drinkProvider' => $dataDrinkProvider,
                    'data_tabacProvider' => $dataTabacProvider,
                    'searchModel' => $searchModel,
                    'model' => $model,
        ]);
    }
    
    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
