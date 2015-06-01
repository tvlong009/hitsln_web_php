<?php

namespace app\controllers;

use app\models\Languages;
use app\models\Page;
use yii\web\Controller;
use Yii;

class ApiController extends Controller
{
    public function actionGetPage()
    {
        $dataJson = array();

        $langCode = Yii::$app->request->get('langCode');
        $pageKey = Yii::$app->request->get('pageKey');

        $language = Languages::findOne(['code' => $langCode]);
        $page = Page::findOne(['key' => $pageKey]);

        if (!$language) {
            $language = Languages::findOne(['is_default' => 1]);
            if ($language) {
                Yii::$app->session->set('app_language', $language->code);
            } else {
                $language = Languages::findOne(['is_active' => 1]);
                if ($language) {
                    Yii::$app->session->set('app_language', $language->code);
                }
            }
        }

        if ($language && $page) {
            $pageContent = Page::getPageContentData($page->id, $language->id);
            $dataJson = array(
                'id' => $page->id,
                'key' => $page->key,
                'status' => $page->status,
                'publish_date' => $page->publish_date,
                'sort_order' => $page->sort_order,
                'parent_id' => $page->parent_id,
                'user_id' => $page->user_id,
                'page_content' => $pageContent,
            );
        }

        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $dataJson;
    }
}