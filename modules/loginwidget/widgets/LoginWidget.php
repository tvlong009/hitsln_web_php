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
use app\models\site\forms\LoginForm;
use Yii;

class LoginWidget extends Widget
{
    public $successUrl = '';
    public $errorUrl = '';
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if ($this->successUrl != '' && $this->errorUrl != '') {

            if (!\Yii::$app->user->isGuest) {
                return Yii::$app->response->redirect($this->successUrl);
            }

            $loginSettings = LoginSetting::find();

            $settings = array();
            if ($loginSettings->count() > 0) {
                foreach ($loginSettings->all() as $loginSetting) {
                    $settings[$loginSetting->key_name] = $loginSetting->value;
                }
            }

            $loginForm = new LoginForm();

            return $this->render('loginwidget', ['loginSettings' => $settings, 'model' => $loginForm, 'successUrl' => $this->successUrl,
                'errorUrl' => $this->errorUrl,
            ]);
        } else {
            return Yii::t('app', 'Please set success and error url .');
        }

    }

}