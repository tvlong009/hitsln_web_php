<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class MediaWebController extends FrontendController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionNew()
    {
        return $this->render('new-release');
    }
}


