<?php

namespace app\modules\loginwidget\controllers;

use app\controllers\BackendController;
use Yii;

class LoginSettingController extends BackendController
{
    public function actionUpdate()
    {
        $loginSettings = \app\modules\loginwidget\models\LoginSetting::find();
        if (Yii::$app->request->post()) {
            echo '<pre>';
            print_r(Yii::$app->request->post());
            die();
        }

        return $this->render('update', array('loginSetting' => $loginSettings));
    }
}
