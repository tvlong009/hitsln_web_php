<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Page;
use app\models\PageContent;
use app\controllers\BackendController;
use app\models\Languages;
use app\models\Particles;

class PagesController extends BackendController
{
    public function __construct($id, $module)
    {
        parent::__construct($id, $module);
        $countLanguage = Languages::find()->count();
        
        if ($countLanguage == 0) {
            Yii::$app->session->setFlash('warning', 'Please create language before create page');
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('languages/create'));
        }
    }

    public function actionIndex()
    {
        //get all pages
        $sortBy = Yii::$app->getRequest()->get('sort') != '' ? Yii::$app->getRequest()->get('sort') : 'page_key';

        if (Yii::$app->getRequest()->get('sort') != '') {
            $posType = strpos($sortBy, '-');

            $sortType = SORT_DESC;

            if (is_numeric($posType)) {
                $sortBy = substr($sortBy, $posType + 1);
                $sortType = SORT_DESC;
            } else {
                $sortType = SORT_ASC;
            }
        } else {
            $sortType = SORT_DESC;
        }
        $model = Page::find()->orderBy([$sortBy => $sortType]);


        $dataProvider = new ActiveDataProvider(
                array(
            'query' => $model,
            'pagination' => array(
                'pageSize' => $this->recordPerPage
            )
                )
        );


        return $this->render('index', array('dataProvider' => $dataProvider));
    }

    public function actionAdd()
    {
        $model = new Page();       

        $languages = Languages::find();

        if ($languages->count() == 0) {
            //create language default
            $language = new Languages();
            $language->name = Yii::t('app','Default');
            $language->description = Yii::t('app','Default');

            $language->save();
        }

        $particles = Particles::find();

        $request = Yii::$app->request->post();
        if ($request) {
            if (isset($request['savedraft'])) {
                $model->status = 'draft';
            } elseif (isset($request['publish'])) {
                $model->status = 'published';
            }

            if ($model->load($request) && $model->save()) {
                foreach (Yii::$app->getRequest()->post('page_content') as $languageId => $content) {
                    $pageContent = new PageContent();
                     
                    $pageContent->page_id = $model->page_id;
                    $pageContent->page_title = $model->page_key;
                    if ($languageId != 'default') {
                        $language = Languages::findOne($languageId);
                        $pageContent->page_language = (int) $language->primaryKey;
                    }

                    $pageContent->page_content = (string) $content;
                    $pageContent->save();
                }

                Yii::$app->getSession()->setFlash('success', Yii::t('app','Create page successfully'));
                return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('pages'));
            }
        }
        $pageContent = array();
        foreach ($languages->all() as $language) {
            $pageContent[$language['language_id']] = new PageContent();
        }

        return $this->render('add', [
                    'model' => $model,
                    'pageContent' => $pageContent,
                    'languages' => $languages->all(),
                    'particles' => $particles
        ]);
    }

    public function actionAddAjax()
    {
        $model = Page::findOne(Yii::$app->getRequest()->post('id'));

        if (!$model) {
            $model = new Page();
        }

        $model->load(Yii::$app->request->post());
        $model->user_id = Yii::$app->getUser()->getId();

        $model->save();
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return ['id' => (int) $model->page_id];
    }

    public function actionEdit($id)
    {
        $model = Page::findOne($id);

        if ($model) {

            $pageContents = PageContent::findAll(['page_id' => $model->page_id]);

            $languages = Languages::find();

            $particles = Particles::find();

            $request = Yii::$app->request->post();
            if ($request) {
                if (isset($request['savedraft'])) {
                    $model->status = 'draft';
                } elseif (isset($request['publish'])) {
                    $model->status = 'published';
                }

                if ($model->load($request) && $model->save()) {
                    if (Yii::$app->getRequest()->post('page_content') != null) {
                        foreach (Yii::$app->getRequest()->post('page_content') as $languageId => $content) {
                            $check = false;
                            foreach ($pageContents as $item) {
                                if ($item->page_language == $languageId) {
                                    $check = true;
                                    break;
                                }
                            }

                            if ($check) {
                                $item->page_content = (string) $content;
                                $item->save();
                            } else {
                                $pagecontent = new PageContent();
                                $pagecontent->page_id = $model->page_id;
                                $pagecontent->page_title = $model->page_key;
                                $language = Languages::findOne($languageId);
                                $pagecontent->page_language = (int) $language->primaryKey;
                                $pagecontent->page_content = (string) $content;
                                $pagecontent->save();
                            }
                        }
                    }

                    Yii::$app->getSession()->setFlash('success', Yii::t('app','Update page successfully'));
                }
            }

            $pageContents = PageContent::findAll(['page_id' => $model->page_id]);
            foreach ($languages->all() as $language) {
                $check = false;

                foreach ($pageContents as $content) {
                    if ($content['page_language'] == $language['language_id']) {
                        $check = true;
                        break;
                    }
                }
                if ($check) {
                    $pageContent[$language['language_id']] = $content;
                } else {
                    $pageContent[$language['language_id']] = new PageContent();
                }
            }

            return $this->render('edit', [
                        'model' => $model,
                        'pageContent' => $pageContent,
                        'languages' => $languages->all(),
                        'particles' => $particles,
            ]);
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app','Page not exist'));
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('pages'));
        }
    }

    public function actionDelete()
    {
        $data = [];
        if (Yii::$app->getRequest()->isAjax) {
            $pageIdList = Yii::$app->getRequest()->post('id');
            if (!empty($pageIdList)) {
                foreach ($pageIdList as $pageId) {
                    $page = Page::findOne($pageId);
                    if ($page) {
                        $page->delete();
                    }
                }
                Yii::$app->session->setFlash('success', Yii::t('app','Delete page success'));
                $data['success'] = '1';
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app','Delete page error'));
                $data['error'] = 1;
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app','Request not valid'));
            $data['error'] = 1;
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    public function actionSchedulePublish()
    {
        $data = array();
        $request = Yii::$app->request->post();

        if (Yii::$app->request->isAjax && $request) {
            $id = (int) $request['pageid'];
            $model = Page::findOne($id);

            if ($model) {                
                
                $dateString = explode('/', Yii::$app->request->post('publishdate'));
                $dateString = $dateString[2] . '-' . $dateString[0] . '-' . $dateString[1];

                $model->publish_date = $dateString . ' ' . $dateParts[1] . ':00';

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app','Set publish date for page success'));
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('app','Set publish date for page error'));
                }
            }
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

}
