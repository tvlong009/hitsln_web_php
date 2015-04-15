<?php

namespace app\controllers;

use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use app\controllers\BackendController;

class MediaController extends BackendController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAddAjax()
    {
        $this->layout = 'blank';
        return $this->render('addajax');
    }

    public function actionUpload()
    {
        $upload_handler = new UploadHandler([
            'script_url' => \Yii::$app->urlManager->createAbsoluteUrl('media/upload'),
        ]);
    }

    public function actionUploadPortfolio()
    {
        $portfolioId = (int)Yii::$app->request->get('portfolio_id');
        $uploadDir = '';
        if ($portfolioId > 0) {
            $uploadDir = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/files/portfolio/' . $portfolioId . '/';
            $uploadUrl = $this->get_full_url(). '/files/portfolio/' . $portfolioId . '/';
        } else {
            $uploadDir = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/files/portfolio/';
            $uploadUrl = $this->get_full_url(). '/files/portfolio/';
        }
        
        
        
        $upload_handler = new UploadHandler([
            'script_url' => \Yii::$app->urlManager->createAbsoluteUrl('media/upload-portfolio'),
            'upload_dir' => $uploadDir,
            'upload_url' => $uploadUrl
        ]);
    }
    
    public function actionUploadPartner()
    {
        $partnerId = (int)Yii::$app->request->get('partner_id');       
        $uploadDir = '';
        if ($partnerId > 0) {
            $uploadDir = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/files/partner/' . $partnerId . '/';
            $uploadUrl = $this->get_full_url(). '/files/partner/' . $partnerId . '/';
        } else {
            $uploadDir = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/files/partner/';
            $uploadUrl = $this->get_full_url(). '/files/partner/';
        }
        
        
        
        $upload_handler = new UploadHandler([
            'script_url' => \Yii::$app->urlManager->createAbsoluteUrl('media/upload-partner'),
            'upload_dir' => $uploadDir,
            'upload_url' => $uploadUrl
        ]);
    }

    public function actionImageJson()
    {
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(403, 'This action allow only ajaxRequest');
        } else {
            $filesPath = FileHelper::findFiles(dirname($this->get_server_var('SCRIPT_FILENAME')) . '/files/', [
                        'recursive' => false,
                        'only' => ['*.jpg', '*.jpeg', '*.jpe', '*.png', '*.gif']
            ]);

            if (is_array($filesPath) && count($filesPath)) {
                $result = [];
                foreach ($filesPath as $filePath) {
                    $url = $this->get_full_url(). '/files/' . basename($filePath);
                    $result[] = ['image' => $url, 'thumb' => $url];
                }

                Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
                return $result;
            }
        }
    }

    protected function get_server_var($id)
    {
        return @$_SERVER[$id];
    }
    
    protected function get_full_url() {
        $https = !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') === 0 ||
            !empty($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
                strcasecmp($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') === 0;
        return
            ($https ? 'https://' : 'http://').
            (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
            (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
            ($https && $_SERVER['SERVER_PORT'] === 443 ||
            $_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT']))).
            substr($_SERVER['SCRIPT_NAME'],0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
    }

}
