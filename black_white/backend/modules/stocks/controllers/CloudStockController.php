<?php

namespace backend\modules\stocks\controllers;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class CloudStockController extends \yii\web\Controller
{
    
     public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['logout', 'index','stock-configuration'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','stock-configuration'],
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
    
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionStockConfiguration()
    {
        return $this->render('stock-configuration');
    }

}
