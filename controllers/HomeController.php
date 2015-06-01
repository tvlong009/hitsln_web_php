<?php
namespace app\controllers;

use Yii;
use app\controllers\FrontendController;
use app\models\Page;
use app\models\PageContent;
use app\models\Languages;

class HomeController extends FrontendController
{

    public function beforeAction($action)
    {
        if ($action->id == 'page-ajax') {
            return true;
        }
        return parent::beforeAction($action);
    }

    public function actionIndex($page = 'index')
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            return $this->__actionPageAjax();
        } else {
            $model = null;
            if ($page != '') {
                $format = '"%Y-%m-%d"';
                $model = Page::find(['key' => $page, 'status' => 'published', '(publish_date = NULL or publish_date < STR_TO_DATE("'.date('Y-m-d').'", '.$format.'))'])
                                ->orderBy(['created' => SORT_DESC])->one();

                if ($model) {
                    $model->content = Page::getPageContentData($model->id);
                    return $this->render('index', array('model' => $model));
                } else {
                    return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('site/error?from=page'), 404);
                }
            }
        }
    }

    public function actionPreviewPage($page = 'index', $lang = 0)
    {
        $model = null;
        if ($page != '') {
            $model = Page::findOne(['id' => $page]);
            if ($model) {
                $model->content = Page::getPageContentData($model->id, $lang);
            }
        }
        return $this->render('index', array('model' => $model));
    }

    protected function __actionPageAjax()
    {
        $data = array();
        $request = Yii::$app->request;
        $pageKey = $request->get('page');
        $language = Languages::findOne(['code' => Yii::$app->language]);
        if (!$language) {
            $language = Languages::findOne(['is_default' => 1]);

            if (!$language) {
                $language = Languages::findOne(['is_active' => 1]);
            }
            if (!$language) {
                $languages = Languages::find()->all();
                if (!empty($languages)) {
                    $language = $languages[0];
                }
            }
        }
        if ($pageKey != '') {
            $maxVersion = Page::find()->where(['key' => $pageKey])->max('version');
            $model = Page::findOne(['key' => $pageKey, 'status' => 'published', 'version' => $maxVersion]);
            if ($model && $language) {
                $pageContent = PageContent::findOne(['page_id' => $model->id, 'language' => $language->id]);
                $model->content = Page::getPageContentData($model->id, $language->id);

                if (is_file($model->content)) {
                    $this->layout = 'blank';
                    $model->content = $this->render('index', array('model' => $model));
                }

                $data['page_key'] = $model->key;
                $data['page_content'] = $model->content;
                $data['header_img'] = $pageContent->header_img;
                $data['page_title'] = $pageContent->title;
            }
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;

        if (empty($data)) {
            $data['error'] = 1;
            $data['redirect_url'] = Yii::$app->urlManager->createAbsoluteUrl('site/error?from=page');
        }
        return $data;
    }

    public function actionFiles($path = '', $file = '')
    {
        $file_path = Yii::getAlias('@webroot') . '/files/' . $path . '/' . $file;
        if (is_file($file_path)) {
            header('Cache-control: max-age=' . (60 * 60 * 24 * 365));
            header('Expires: ' . gmdate(DATE_RFC1123, time() + 60 * 60 * 24 * 365));
            header('Content-type: image/png');
            header('Last-Modified: ' . gmdate(DATE_RFC1123, filemtime($file_path)));
            readfile($file_path);
        }
    }
    /**
     * @author Jimmy
     * @todo login
     */
    public function actionLogin()
    {
        $this->layout = 'login_frontend';
        return $this->render('login');
    }
    /**
     * @author Jimmy
     * @todo register
     */
    public function actionRegister()
    {
        $this->layout = 'login_frontend';
        return $this->render('register');
    }

}
