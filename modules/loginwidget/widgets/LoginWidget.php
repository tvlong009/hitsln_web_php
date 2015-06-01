<?php
/**
 * Created by PhpStorm.
 * User: longvo
 * Date: 16/04/2015
 * Time: 11:19
 */

namespace app\modules\loginwidget\widgets;

use yii\base\Widget;
use app\modules\loginwidget\models\LoginSetting;
use app\models\AppLoginForm;
use Yii;

class LoginWidget extends Widget
{
    public $successUrl = '';

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if ($this->successUrl != '') {

            if (!\Yii::$app->user->isGuest) {
                if($this->curPageURL() == $this->successUrl){
                    return '';
                } else {
                    return Yii::$app->controller->redirect($this->successUrl);
                }
            }

            $loginSettings = LoginSetting::find();

            $settings = array();
            if ($loginSettings->count() > 0) {
                foreach ($loginSettings->all() as $loginSetting) {
                    $settings[$loginSetting->key_name] = $loginSetting->value;
                }
            }

            $loginForm = new LoginForm();

            $imageUrl = str_replace(['frontend', '/index.php'], ['app', ''], Yii::$app->urlManager->createAbsoluteUrl(''));

            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post())) {

                if ($model->login()) {
                    if (Yii::$app->request->referrer) {
                        return Yii::$app->controller->redirect(Yii::$app->request->referrer);
                    } else {
                        return  Yii::$app->request->post('successUrl') != '' ? Yii::$app->controller->redirect(Yii::$app->request->post('successUrl'))
                            : Yii::$app->controller->redirect(Yii::$app->controller->goHome());
                    }
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('app', 'Wrong username or password.'));
                }
            }

            return $this->render('loginwidget', ['loginSettings' => $settings, 'model' => $loginForm, 'successUrl' => $this->successUrl,
                'errorUrl' => $this->curPageURL(),
                'imageUrl' => $imageUrl
            ]);
        } else {
            return Yii::t('app', 'Please set success url .');
        }

    }

    function curPageURL() {
        $pageURL = 'http';
        if (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

}