<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use frontend\models\LoginForm;
use frontend\models\ContactForm;

class HomeController extends FrontendController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
