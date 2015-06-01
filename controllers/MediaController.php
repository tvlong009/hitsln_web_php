<?php

namespace app\controllers;

use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use app\controllers\BackendController;

class MediaController extends BackendController {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionAddAjax() {
        $this->layout = 'blank';
        return $this->render('addajax');
    }

    public function actionUpload() {
        $upload_handler = new UploadHandler([
            'script_url' => \Yii::$app->urlManager->createAbsoluteUrl('media/upload')
        ]);
    }

    public function actionUploadPortfolio() {
        $portfolioId = (int) Yii::$app->request->get('portfolio_id');
        $uploadDir = '';

        $fullUrl = str_replace('/index.php', '', MediaController::get_full_url());

        if ($portfolioId > 0) {
            $uploadDir = dirname(MediaController::get_server_var('SCRIPT_FILENAME')) . '/files/portfolio/' . $portfolioId . '/';
            $uploadUrl = $fullUrl . '/files/portfolio/' . $portfolioId . '/';
        } else {
            $uploadDir = dirname(MediaController::get_server_var('SCRIPT_FILENAME')) . '/files/portfolio/';
            $uploadUrl = $fullUrl . '/files/portfolio/';
        }

        $upload_handler = new UploadHandler([
            'script_url' => \Yii::$app->urlManager->createAbsoluteUrl('media/upload-portfolio'),
            'upload_dir' => $uploadDir,
            'upload_url' => $uploadUrl
        ]);
    }

    public function actionUploadPartner() {
        $partnerId = (int) Yii::$app->request->get('partner_id');
        $fullUrl = str_replace('/index.php', '', MediaController::get_full_url());
        $uploadDir = '';
        if ($partnerId > 0) {
            $uploadDir = dirname(MediaController::get_server_var('SCRIPT_FILENAME')) . '/files/partner/' . $partnerId . '/';
            $uploadUrl =  $fullUrl . '/files/partner/' . $partnerId . '/';
        } else {
            $uploadDir = dirname(MediaController::get_server_var('SCRIPT_FILENAME')) . '/files/partner/';
            $uploadUrl = $fullUrl . '/files/partner/';
        }



        $upload_handler = new UploadHandler([
            'script_url' => \Yii::$app->urlManager->createAbsoluteUrl('media/upload-partner'),
            'upload_dir' => $uploadDir,
            'upload_url' => $uploadUrl
        ]);
    }

    public function actionImageJson() {
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(403, 'This action allow only ajaxRequest');
        } else {
            $base_path = dirname(MediaController::get_server_var('SCRIPT_FILENAME'));
            $filesPath = FileHelper::findFiles($base_path . '/files/', ['recursive' => TRUE,
                        'only' => ['*.jpg', '*.jpeg', '*.jpe', '*.png', '*.gif']]);
            if (is_array($filesPath) && count($filesPath)) {
                $result = [];
                $full_url = MediaController::get_full_url();
                foreach ($filesPath as $filePath) {
                    if (strpos($filePath, '/thumbnail/') === FALSE) {
                        $url = str_replace($base_path, $full_url, $filePath);
                        $url = str_replace('/index.php', '', $url);
                        $result[] = ['image' => $url, 'thumb' => $url];
                    }
                }
                Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
                return $result;
            }
        }
    }

    public static function get_server_var($id) {
        return @$_SERVER[$id];
    }

    public static function get_full_url() {
        $https = !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') === 0 ||
                !empty($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
                strcasecmp($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') === 0;
        return
                ($https ? 'https://' : 'http://') .
                (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'] . '@' : '') .
                (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'] .
                        ($https && $_SERVER['SERVER_PORT'] === 443 ||
                        $_SERVER['SERVER_PORT'] === 80 ? '' : ':' . $_SERVER['SERVER_PORT']))) .
                (Yii::$app->urlManager->showScriptName) ? $_SERVER['SCRIPT_NAME']
                    : substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/'));

    }

}
