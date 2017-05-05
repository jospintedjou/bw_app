<?php

namespace frontend\controllers;

class MeetingController extends \yii\base\Controller
{
    public function actionAddArchive()
    {
        return $this->render('add-archive');
    }

    public function actionAddMember()
    {
        return $this->render('add-member');
    }

    public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionExportReport()
    {
        return $this->render('export-report');
    }

    public function actionGrantAccess()
    {
        return $this->render('grant-access');
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

    public function actionView()
    {
        return $this->render('view');
    }

    public function actionViewMeetings()
    {
        return $this->render('view-meetings');
    }

}
