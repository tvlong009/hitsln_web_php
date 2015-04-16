<?php
/**
 * Created by PhpStorm.
 * User: longvo
 * Date: 16/04/2015
 * Time: 13:53
 */

namespace app\modules\loginwidget\controllers;

use app\controllers\BackendController;
use app\models\site\forms\LoginForm;
use Yii;

class LoginController extends BackendController
{
    public function actionLogin()
    {

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->request->referrer) {
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                return  Yii::$app->request->post('successUrl') != '' ? $this->redirect(Yii::$app->request->post('successUrl')) : $this->goHome();
            }
        } else {
            $currUrl = Yii::$app->request->post('currUrl');
            Yii::$app->session->setFlash('error', Yii::t('app', 'Wrong username or password.'));

            return  Yii::$app->request->post('errorUrl') != '' ? $this->redirect(Yii::$app->request->post('errorUrl')) : $this->redirect(Yii::$app->request->referrer);
        }
    }
}