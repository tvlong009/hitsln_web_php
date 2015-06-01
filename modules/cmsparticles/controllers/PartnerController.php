<?php

namespace app\modules\cmsparticles\controllers;

use app\controllers\BackendController;
use app\modules\cmsparticles\models\Partner;
use yii\data\ActiveDataProvider;
use Yii;

class PartnerController extends BackendController
{

    public function actionIndex()
    {
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

        $model = Partner::find()->orderBy([$sortBy => $sortType]);

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

    public function actionAdd()
    {
        $model = new Partner();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $images = Yii::$app->request->post('images');
            $this->uploadFile($images, $model);
            Yii::$app->session->setFlash('success', Yii::t('app', 'Create partner successfully'));
            return $this->redirect(\Yii::$app->urlManager->createAbsoluteUrl('/cmsparticles/partner/edit?id=' . $model->primaryKey));
        }

        return $this->render('add', ['model' => $model]);
    }

    public function actionEdit($id)
    {
        $model = Partner::findOne($id);

        if ($model) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                $images = Yii::$app->request->post('images');
                $this->uploadFile($images, $model);
                Yii::$app->session->setFlash('success', Yii::t('app', 'Update partner successfully'));
            }
            return $this->render('edit', ['model' => $model]);
        } else {
            return $this->redirect(\Yii::$app->urlManager->createAbsoluteUrl('/cmsparticles/partner/'));
        }
    }

    public function actionDelete()
    {
        $data = [];
        if (Yii::$app->getRequest()->isAjax) {
            $partnerIdList = Yii::$app->getRequest()->post('id');
            if (!empty($partnerIdList)) {
                foreach ($partnerIdList as $partnerId) {
                    $partner = Partner::findOne($partnerId);
                    if ($partner) {
                        $partner->delete();
                    }
                }
                Yii::$app->session->setFlash('success', Yii::t('app', 'Delete partner success'));
                $data['success'] = '1';
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Delete partner error'));
                $data['error'] = 1;
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $data['error'] = 1;
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    private function get_server_var($id)
    {
        return @$_SERVER[$id];
    }

    private function uploadFile($images = array(), $model = null)
    {
        $baseDir = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/files/partner/';
        $uploadDir = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/files/partner/' . $model->primaryKey . '/';
        $thumbnailDir = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/files/partner/' . $model->primaryKey . '/thumbnail/';
        $baseThumbNailDir = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/files/partner/thumbnail/';
        if ($images !== null) {
            if (!file_exists($uploadDir)) {
                $oldumask = umask(0);
                mkdir($uploadDir, 0777, TRUE);
                umask($oldumask);
            }

            if (!file_exists($thumbnailDir)) {
                $oldumask = umask(0);
                mkdir($thumbnailDir, 0777, TRUE);
                umask($oldumask);
            }
            if (is_writable($uploadDir)) {
                foreach ($images as $image) {
                    if (file_exists($baseDir . $image)) {
                        if (file_exists($uploadDir . $image)) {
                            if (is_writable($uploadDir . $image)) {
                                copy($baseDir . $image, $uploadDir . $image);
                                copy($baseThumbNailDir . $image, $thumbnailDir . $image);
                                unlink($baseDir . $image);
                                unlink($baseThumbNailDir . $image);
                            }
                        } else {
                            copy($baseDir . $image, $uploadDir . $image);
                            copy($baseThumbNailDir . $image, $thumbnailDir . $image);
                            unlink($baseDir . $image);
                            unlink($baseThumbNailDir . $image);
                        }
                    }
                }
            }
        }
    }

}
