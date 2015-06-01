<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Page;
use app\models\PageContent;
use app\controllers\BackendController;
use app\models\Languages;
use app\models\Particles;
use yii\db\Query;
use yii\web\UploadedFile;
use app\libraries\Image_resize_lib;

class PagesController extends BackendController {

    public function __construct($id, $module) {
        parent::__construct($id, $module);
        $countLanguage = Languages::find()->count();

        if ($countLanguage == 0) {
            Yii::$app->session->setFlash('warning', 'Please create language before create page');
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('languages/create'));
        }
    }

    public function actionIndex() {
        //get all pages
        $sortBy = Yii::$app->getRequest()->get('sort') != '' ? Yii::$app->getRequest()->get('sort') : 'created';

        if (Yii::$app->getRequest()->get('sort') != '') {
            $posType = strpos($sortBy, '-');
            if (is_numeric($posType)) {
                $sortBy = substr($sortBy, $posType + 1);
                $sortType = SORT_DESC;
            } else {
                $sortType = SORT_ASC;
            }
        } else {
            $sortType = SORT_DESC;
        }

        $model = Page::find()->select(['max(id) as id', 'key', 'status', 'publish_date', 'sort_order', 'parent_id', 'created', 'modified', 'user_id'])
            ->groupBy('key')->orderBy([$sortBy => $sortType]);

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

    public function actionAdd() {
        $model = new Page();

        $languages = Languages::find();

        if ($languages->count() == 0) {
            //create language default
            $language = new Languages();
            $language->name = Yii::t('app', 'Default');
            $language->description = Yii::t('app', 'Default');

            $language->save();
        }

        $particles = Particles::find();

        $request = Yii::$app->request->post();
        if ($request) {
            $model->status = 'published';

            $model->user_id = Yii::$app->user->id;

            if ($model->load($request) && $model->save()) {

                foreach (Yii::$app->getRequest()->post('page_content') as $languageId => $content) {
                    $pageContent = new PageContent();

                    $pageContent->page_id = $model->id;
                    $pageContent->title = $model->key;
                    $language = Languages::findOne($languageId);
                    $pageContent->language = (int) $language->primaryKey;
                    $pageContent->header_image = UploadedFile::getInstance($pageContent, 'image_header_' . $language->primaryKey);
                    if ($pageContent->header_image && $pageContent->validate()) {
                        $uploadDirHeaderImage = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/uploads/pages/header_img/';
                        if (!file_exists($uploadDirHeaderImage)) {
                            $oldumask = umask(0);
                            @mkdir($uploadDirHeaderImage, 0777, TRUE);
                            umask($oldumask);
                        }
                        $fileName = md5($pageContent->header_image->baseName);

                        $pageContent->header_img = (string) ($fileName . '.' . $pageContent->header_image->extension);
                    }

                    if (Yii::$app->request->post('content_type') == 1) {
                        $this->resizeImage($content['content']);
                        $pageContent->content = (string) $content['content'];
                        $pageContent->save();
                    } else {
                        $pageContent->file = UploadedFile::getInstance($pageContent, 'php_' . $language->primaryKey);
                        if ($pageContent->file && $pageContent->validate() &&  $pageContent->file->extension == 'php') {
                            $uploadDir = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/uploads/pages/';
                            if (!file_exists($uploadDir)) {
                                $oldumask = umask(0);
                                @mkdir($uploadDir, 0777, TRUE);
                                umask($oldumask);
                            }

                            $fileName = md5($pageContent->file->baseName);
                            $pageContent->content = (string) ($fileName . '.' . $pageContent->file->extension);
                            $pageContent->save();

                            $pageContent->file->saveAs($uploadDir . $fileName . '.' . $pageContent->file->extension);
                            $pageContent->header_image->saveAs($uploadDirHeaderImage .  md5($pageContent->header_image->baseName) . '.' . $pageContent->header_image->extension);
                        } else {
                            Yii::$app->session->setFlash('warning', Yii::t('app','File upload not valid'));
                        }
                    }
                }

                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Create page successfully'));
                return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('pages'));
            }
        }
        $pageContent = array();
        foreach ($languages->all() as $language) {
            $pageContent[$language['id']] = new PageContent();
        }

        return $this->render('add', [
                    'model' => $model,
                    'pageContent' => $pageContent,
                    'languages' => $languages->all(),
                    'particles' => $particles,
        ]);
    }

    public function actionAddAjax()
    {
        $model = Page::findOne(Yii::$app->getRequest()->post('id'));
        $request = Yii::$app->request->post();
        if (!$model) {
            $model = new Page();
            $model->status = 'published';
        }

        foreach (Yii::$app->getRequest()->post('page_content') as $languageId => $content) {
            $pageContent = new PageContent();

            $pageContent->page_id = $model->id;
            $pageContent->title = $model->key;
            $language = Languages::findOne($languageId);
            $pageContent->language = (int) $language->primaryKey;
            $pageContent->header_image = UploadedFile::getInstance($pageContent, 'image_header_' . $language->primaryKey);
            if ($pageContent->header_image && $pageContent->validate()) {
                $uploadDirHeaderImage = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/uploads/pages/header_img/';
                if (!file_exists($uploadDirHeaderImage)) {
                    $oldumask = umask(0);
                    @mkdir($uploadDirHeaderImage, 0777, TRUE);
                    umask($oldumask);
                }
                $fileName = md5($pageContent->header_image->baseName);

                $pageContent->header_img = (string) ($fileName . '.' . $pageContent->header_image->extension);
            }

            if (Yii::$app->request->post('content_type') == 1) {
                $this->resizeImage($content['content']);
                $pageContent->content = (string) $content['content'];
                $pageContent->save();
            } else {
                $pageContent->file = UploadedFile::getInstance($pageContent, 'php_' . $language->primaryKey);
                if ($pageContent->file && $pageContent->validate() &&  $pageContent->file->extension == 'php') {
                    $uploadDir = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/uploads/pages/';
                    if (!file_exists($uploadDir)) {
                        $oldumask = umask(0);
                        @mkdir($uploadDir, 0777, TRUE);
                        umask($oldumask);
                    }

                    $fileName = md5($pageContent->file->baseName);
                    $pageContent->content = (string) ($fileName . '.' . $pageContent->file->extension);
                    $pageContent->save();

                    $pageContent->file->saveAs($uploadDir . $fileName . '.' . $pageContent->file->extension);
                    $pageContent->header_image->saveAs($uploadDirHeaderImage .  md5($pageContent->header_image->baseName) . '.' . $pageContent->header_image->extension);
                } else {
                    Yii::$app->session->setFlash('warning', Yii::t('app','File upload not valid'));
                }
            }
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return ['id' => (int) $model->id];
    }

    public function actionEdit($id) {
        $model = Page::findOne($id);
        if ($model) {
            $languages = Languages::find();
            $particles = Particles::find();

            $request = Yii::$app->request->post();
            if ($request) {
                $model = new Page();

                $model->status = 'published';

                $model->user_id = Yii::$app->user->id;

                if ($model->load($request) && $model->save()) {

                    foreach (Yii::$app->getRequest()->post('page_content') as $languageId => $content) {
                        $pageContent = new PageContent();

                        $pageContent->page_id = $model->id;
                        $pageContent->title = $content['title'];
                        $language = Languages::findOne($languageId);
                        $pageContent->language = (int) $language->primaryKey;
                        $pageContent->header_image = UploadedFile::getInstance($pageContent, 'image_header_' . $language->primaryKey);
                        if ($pageContent->header_image && $pageContent->validate()) {
                            $uploadDirHeaderImage = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/uploads/pages/header_img/';
                            if (!file_exists($uploadDirHeaderImage)) {
                                $oldumask = umask(0);
                                @mkdir($uploadDirHeaderImage, 0777, TRUE);
                                umask($oldumask);
                            }
                            $fileName = md5($pageContent->header_image->baseName);

                            $pageContent->header_img = (string) ($fileName . '.' . $pageContent->header_image->extension);
                        }

                        if (Yii::$app->request->post('content_type') == 1) {
                            $this->resizeImage($content['content']);
                            $pageContent->content = (string) $content['content'];
                            $pageContent->save();
                        } else {
                            $pageContent->file = UploadedFile::getInstance($pageContent, 'php_' . $language->primaryKey);
                            if ($pageContent->file && $pageContent->validate() &&  $pageContent->file->extension == 'php') {
                                $uploadDir = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/uploads/pages/';
                                if (!file_exists($uploadDir)) {
                                    $oldumask = umask(0);
                                    @mkdir($uploadDir, 0777, TRUE);
                                    umask($oldumask);
                                }

                                $fileName = md5($pageContent->file->baseName);
                                $pageContent->content = (string) ($fileName . '.' . $pageContent->file->extension);
                                $pageContent->save();

                                $pageContent->file->saveAs($uploadDir . $fileName . '.' . $pageContent->file->extension);
                                $pageContent->header_image->saveAs($uploadDirHeaderImage .  md5($pageContent->header_image->baseName) . '.' . $pageContent->header_image->extension);
                            } else {
                                Yii::$app->session->setFlash('warning', Yii::t('app','File upload not valid'));
                            }
                        }
                    }

                    Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Update page successfully'));
                    return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('pages'));
                }
            }

            $pageContents = PageContent::findAll(['page_id' => $model->id]);
            $checkTypePHP = false;
            $pageContent = array();
            foreach ($languages->all() as $i => $language) {
                $check = false;

                foreach ($pageContents as $content) {
                    if ($content['language'] == $language['id']) {
                        $check = true;
                        break;
                    }
                }
                if ($check) {
                    if ($content != '' && end(explode('.', $content->content)) == 'php' && $i == 0) {
                        $checkTypePHP = true;
                    }
                    $pageContent[$language['id']] = $content;
                } else {
                    $pageContent[$language['id']] = new PageContent();
                }
            }


            return $this->render('edit', [
                'model' => $model,
                'pageContent' => $pageContent,
                'languages' => $languages->all(),
                'particles' => $particles,
                'checkTypePHP' => $checkTypePHP,
            ]);
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Page not exist'));
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('pages'));
        }
    }

    public function actionEditAjax()
    {
        $id = Yii::$app->request->post('id');
        $model = Page::findOne($id);

        if ($model) {
            $request = Yii::$app->request->post();
            if ($request) {
                $model = new Page();

                $model->status = 'published';

                $model->user_id = Yii::$app->user->id;

                if ($model->load($request) && $model->save()) {

                    foreach (Yii::$app->getRequest()->post('page_content') as $languageId => $content) {
                        $pageContent = new PageContent();

                        $pageContent->page_id = $model->id;
                        $pageContent->title = $content['title'];
                        $language = Languages::findOne($languageId);
                        $pageContent->language = (int) $language->primaryKey;
                        $pageContent->header_image = UploadedFile::getInstance($pageContent, 'image_header_' . $language->primaryKey);
                        if ($pageContent->header_image && $pageContent->validate()) {
                            $uploadDirHeaderImage = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/uploads/pages/header_img/';
                            if (!file_exists($uploadDirHeaderImage)) {
                                $oldumask = umask(0);
                                @mkdir($uploadDirHeaderImage, 0777, TRUE);
                                umask($oldumask);
                            }
                            $fileName = md5($pageContent->header_image->baseName);

                            $pageContent->header_img = (string) ($fileName . '.' . $pageContent->header_image->extension);
                        }

                        if (Yii::$app->request->post('content_type') == 1) {
                            $pageContent->content = (string) $content['content'];
                            $pageContent->save();
                        } else {
                            $pageContent->file = UploadedFile::getInstance($pageContent, 'php_' . $language->primaryKey);
                            if ($pageContent->file && $pageContent->validate() &&  $pageContent->file->extension == 'php') {
                                $uploadDir = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/uploads/pages/';
                                if (!file_exists($uploadDir)) {
                                    $oldumask = umask(0);
                                    @mkdir($uploadDir, 0777, TRUE);
                                    umask($oldumask);
                                }

                                $fileName = md5($pageContent->file->baseName);
                                $pageContent->content = (string) ($fileName . '.' . $pageContent->file->extension);
                                $pageContent->save();

                                $pageContent->file->saveAs($uploadDir . $fileName . '.' . $pageContent->file->extension);
                                $pageContent->header_image->saveAs($uploadDirHeaderImage .  md5($pageContent->header_image->baseName) . '.' . $pageContent->header_image->extension);
                            } else {
                                Yii::$app->session->setFlash('warning', Yii::t('app','File upload not valid'));
                            }
                        }
                    }

                    Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Update page successfully'));
                    return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('pages'));
                }
            }
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return ['id' => (int) $model->id];
    }

    public function actionDelete() {
        $data = [];
        if (Yii::$app->getRequest()->isAjax) {
            $pageIdList = Yii::$app->getRequest()->post('id');
            if (!empty($pageIdList)) {
                foreach ($pageIdList as $pageId) {
                    $page = Page::findOne($pageId);
                    if ($page) {
                        $page_contents = PageContent::findAll(array('id' => $pageId));
                        foreach ($page_contents as $page_content) {
                            $page_content->delete();
                        }
                        $page->delete();
                    }
                }
                Yii::$app->session->setFlash('success', Yii::t('app', 'Delete page success'));
                $data['success'] = '1';
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Delete page error'));
                $data['error'] = 1;
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $data['error'] = 1;
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    public function actionSchedulePublish() {
        $data = array();
        $request = Yii::$app->request->post();

        if (Yii::$app->request->isAjax && $request) {
            $id = (int) $request['pageid'];
            $model = Page::findOne($id);
            if ($model) {
                $model->publish_date = Yii::$app->request->post('publishdate');
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Set publish date for page success'));
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('app', 'Set publish date for page error'));
                }
            }
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    private function get_server_var($id)
    {
        return @$_SERVER[$id];
    }

    public function actionFiles($path = '', $file = '') {
        $file_path = Yii::getAlias('@webroot') . '/files/' . $path . '/' . $file;
        if (is_file($file_path)) {
            header('Cache-control: max-age=' . (60 * 60 * 24 * 365));
            header('Expires: ' . gmdate(DATE_RFC1123, time() + 60 * 60 * 24 * 365));
            header('Content-type: image/png');
            header('Last-Modified: ' . gmdate(DATE_RFC1123, filemtime($file_path)));
            readfile($file_path);
        }
    }
    
    protected function resizeImage(&$content)
    {
        $matches = [];
        if(preg_match_all('#<img[^\<\>]*?src="([\w/_\.-]+)"[^\<\>]*?style="([\w\s\:\;\.]+)"[^\<\>]*?>#', $content, $matches)) {
            $imgs_old = $matches[0];
            $file_names = $matches[1];
            $styles = $matches[2];
            $imgs_new = [];

            //Store widths and heights of img with same index number
            $widths = [];
            $heights = [];

            foreach($styles as $key => $style)
            {
                preg_match('/width:\s?([0-9\.]+)px/', $style, $width);
                $widths[$key] = $width[1];

                preg_match('/height:\s?([0-9\.]+)px/', $style, $height);
                $heights[$key] = $height[1];
            }

            foreach($file_names as $key => $file_name)
            {
                $file_name_array = explode('.', $file_name);

                //Check extensions: jpg, png, gif, jpeg
                $extension = array_pop($file_name_array);
                if(!in_array(strtolower($extension), ['jpg', 'png', 'gif', 'jpeg'])                )
                {
                    return False;
                }

                //replace old filename with new filename
                $file_name_old = implode('.', $file_name_array);
                if(preg_match('/files\/.+$/', $file_name_old, $matches))
                {
                    $file_name_old = $matches[0];
                } else {
                    return False;
                }
                
                if(preg_match('/[0-9\.]+x[0-9\.]+$/', $file_name_old))
                {
                    $file_name_new = preg_replace('/[0-9\.]+x[0-9\.]+$/', "{$widths[$key]}x{$heights[$key]}", $file_name_old);                    
                } else {
                    $file_name_new = $file_name_old . "_{$widths[$key]}x{$heights[$key]}";
                }
                
                #SAVE IMAGE
                if($file_name_new != $file_name_old)
                {
                    $image_resize_lib = new Image_resize_lib();
                    $image_resize_lib->load($file_name_old . '.' . $extension);
                    $image_resize_lib->resize($widths[$key], $heights[$key]);
                    $image_resize_lib->save($file_name_new . '.' . $extension);                    
                }

                $imgs_new[$key] = str_replace($file_name_old, $file_name_new, $imgs_old[$key]);
            }
            foreach($imgs_old as $key => $value)
            {
                $content = str_replace($imgs_old[$key], $imgs_new[$key], $content);
            }
            return count($imgs_new);
        }
    }
}
