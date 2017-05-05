<?php

namespace backend\modules\statistics\controllers;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
class StatisticsController extends \yii\web\Controller
{
    
     public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['logout','index','view-state-sales'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout','index','view-state-sales'],
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

    public function actionViewStateSales()
    {
        return $this->render('view-state-sales');
    }

}
