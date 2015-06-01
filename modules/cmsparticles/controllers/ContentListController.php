<?php

namespace app\modules\cmsparticles\controllers;

use app\controllers\BackendController;
use app\modules\cmsparticles\models\ContentList;
use yii\data\ActiveDataProvider;
use Yii;

class ContentListController extends BackendController {

    public function actionIndex() {
        //get all pages
        $sortBy = Yii::$app->getRequest()->get('sort') != '' ? Yii::$app->getRequest()->get('sort') : 'displayorder';

        $posType = strpos($sortBy, '-');

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

        $model = ContentList::find()->orderBy([$sortBy => $sortType]);

        $dataProvider = new ActiveDataProvider(
                array(
            'query' => $model,
            'pagination' => array(
                'pageSize' => $this->recordPerPage
            )
                )
        );

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionAdd() {
        $model = new ContentList();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Create content list successfully');
            return $this->redirect(\Yii::$app->urlManager->createAbsoluteUrl('/cmsparticles/content-list/edit?id=' . $model->primaryKey));
        }

        return $this->render('add', ['model' => $model]);
    }

    public function actionEdit($id) {
        $model = ContentList::findOne($id);
        if ($model) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Update content list successfully'));
            }
            return $this->render('edit', ['model' => $model]);
        } else {
            return $this->redirect(\Yii::$app->urlManager->createAbsoluteUrl('/cmsparticles/content-list/'));
        }
    }

    public function actionDelete() {
        $data = [];
        if (Yii::$app->getRequest()->isAjax) {
            $contentlistIdList = Yii::$app->getRequest()->post('id');
            if (!empty($contentlistIdList)) {
                foreach ($contentlistIdList as $contentlistId) {
                    $contentlist = ContentList::findOne($contentlistId);
                    if ($contentlist) {
                        $contentlist->delete();
                    }
                }
                Yii::$app->session->setFlash('success', Yii::t('app', 'Delete content list success'));
                $data['success'] = '1';
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Delete content list error'));
                $data['error'] = 1;
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $data['error'] = 1;
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
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

}
