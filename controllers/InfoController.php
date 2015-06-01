<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Page;

class InfoController extends FrontendController {

    public $defaultAction = 'about';

    public function actionPartner() {
        return $this->render('partner');
    }

    public function actionPortfolio() {
        return $this->render('portfolio');
    }

    public function actionAbout() {
        $model = Page::findOne(['key' => 'About us']);
        if ($model) {
            $model->content = Page::getPageContentData($model->id);
        }
        return $this->render('about', ['model' => $model]);
    }

    public function actionContact() {
        return $this->render('contact');
    }

    public function actionDisclaimer() {
        $model = Page::findOne(['key' => 'Disclaimer']);
        if ($model) {
            $model->content = Page::getPageContentData($model->id);
        }
        return $this->render('disclaimer', ['model' => $model]);
    }

    public function actionTerms() {
        $model = Page::findOne(['key' => 'Terms & Conditions']);
        if ($model) {
            $model->content = Page::getPageContentData($model->id);
        }
        return $this->render('terms', ['model' => $model]);
    }
    
    public function actionStream(){
        return $this->render('streaming');
    }

}
