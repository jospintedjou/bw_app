<?php

namespace frontend\controllers;
use  \yii\web\Controller;
class CustomerController extends Controller
{
    /**
     * 
     * @param type $id_customer
     * @return type
     */
    public function actionAddAppointment($id_customer)
    {
        return $this->render('add-appointment');
    }
    /**
     * 
     * @param type $id_customer
     * @return type
     */
    public function actionAddMarket($id_customer)
    {
        return $this->render('add-market');
    }
    /**
     * 
     * @return type
     */
    public function actionCreate()
    {
        return $this->render('create');
    }
    /**
     * 
     * @param type $id_customer
     * @return type
     */
    public function actionUpdate($id_customer)
    {
        return $this->render('update');
    }
    /**
     * 
     * @param type $id_customer
     * @return type
     */
    public function actionView($id_customer)
    {
        return $this->render('view');
    }
    /**
     * 
     * @return type
     */
    public function actionViewCustomers()
    {
        return $this->render('view-customers');
    }

}
