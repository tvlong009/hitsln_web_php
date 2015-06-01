<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\controllers\BackendController;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ManagePageForm;

class SiteBackendController extends BackendController {

        public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        if (!\Yii::$app->user->isGuest) {
            $viewData = [];

            $form = new ManagePageForm();

            $viewData['formModel'] = $form;

            return $this->render('index', $viewData);
        } else {
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('site-backend/login'));
        }
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('site-backend'));
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->request->referrer) {
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('site-backend'));
            }
        } else {
            $this->layout = 'login';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('site-backend'));
    }
}
