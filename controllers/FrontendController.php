<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Languages;

class FrontendController extends Controller
{
    public $__languages;
    /**
     * @author Jimmy
     */
    public function init()
    {
        parent::init();

        $this->layout = 'main_frontend';

        if (!Yii::$app->session->has('frontend_language')) {
            $language = Languages::findOne(['is_default' => 1]);
            if ($language) {
                Yii::$app->session->set('frontend_language', $language->code);
            } else {
                $language = Languages::findOne(['is_active' => 1]);
                if ($language) {
                    Yii::$app->session->set('frontend_language', $language->code);
                }
            }
        }
        Yii::$app->language = Yii::$app->session->get('frontend_language');
        $this->__languages = Languages::find()->where(['is_active' => 1])->all();
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    /**
     * @author Jimmy
     * @param string $lang
     * @return void
     */
    public function actionChangeLang($lang = '') {
        Yii::$app->session->set('frontend_language', $lang);
        if (Yii::$app->request->referrer) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->goHome();
        }
    }

}
