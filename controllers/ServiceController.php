<?php

namespace app\controllers;

use Yii;
use app\controllers\FrontendController;
use app\models\Page;

class ServiceController extends FrontendController {

    public function actionIndex() {
        return $this->render('service');
    }

    public function actionServiceDownload() {
        $model = Page::findOne(['key' => 'Digital Music Downloads']);
        if ($model) {
            $model->content = Page::getPageContentData($model->id);
        }
        return $this->render('service_download', ['model' => $model]);
    }

    public function actionServiceMusicStreaming() {
        $model = Page::findOne(['key' => 'Music Streaming']);
        if ($model) {
            $model->content = Page::getPageContentData($model->id);
        }
        return $this->render('service_music_streaming', ['model' =>
                    $model]);
    }

    public function actionTechnology() {
        return $this->render('technology');
    }

}
