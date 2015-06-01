<?php

namespace app\modules\cmsparticles\controllers;

use app\controllers\BackendController;

class ContactFormController extends BackendController
{
    public function actions()
    {
        return [
            'captcha' => [
                'class' => '\yii\captcha\CaptchaAction',
            ],
        ];
    }

    public function actionIndex()
    {

    }
}