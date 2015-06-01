<?php

namespace app\modules\cmsparticles\controllers;

use app\controllers\BackendController;
use app\modules\cmsparticles\models\Portfolio;
use yii\data\ActiveDataProvider;
use Yii;

class PortfolioController extends BackendController
{

    public function actionIndex()
    {
        //get all pages
        $sortBy = Yii::$app->getRequest()->get('sort') != '' ? Yii::$app->getRequest()->get('sort') : 'name';

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

        $model = Portfolio::find()->orderBy([$sortBy => $sortType]);

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
        $model = new Portfolio();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $images = Yii::$app->request->post('images');
            $this->uploadFile($images, $model);
            Yii::$app->session->setFlash('success', Yii::t('app','Create portfolio successfully'));
            return $this->redirect(\Yii::$app->urlManager->createAbsoluteUrl('/cmsparticles/portfolio/edit?id=' . $model->primaryKey));
        }

        return $this->render('add', ['model' => $model]);
    }

    public function actionEdit($id)
    {
        $model = Portfolio::findOne($id);

        if ($model) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $images = Yii::$app->request->post('images');
                $this->uploadFile($images, $model);
                Yii::$app->session->setFlash('success', Yii::t('app','Update portfolio successfully'));
            }

            return $this->render('edit', ['model' => $model]);
        } else {
            $this->redirect(\Yii::$app->urlManager->createAbsoluteUrl('/cmsparticles/portfolio/'));
        }
    }

    public function actionDelete()
    {
        $data = [];
        if (Yii::$app->getRequest()->isAjax) {
            $portfolioIdList = Yii::$app->getRequest()->post('id');
            if (!empty($portfolioIdList)) {
                foreach ($portfolioIdList as $portfolioId) {
                    $portfolio = Portfolio::findOne($portfolioId);
                    if ($portfolio) {
                        $portfolio->delete();
                    }
                }
                Yii::$app->session->setFlash('success', Yii::t('app','Delete portfolio success'));
                $data['success'] = '1';
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app','Delete portfolio error'));
                $data['error'] = 1;
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app','Request not valid'));
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
        $baseDir = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/files/portfolio/';
        $uploadDir = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/files/portfolio/' . $model->primaryKey . '/';
        $thumbnailDir = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/files/portfolio/' . $model->primaryKey . '/thumbnail/';
        $baseThumbNailDir = dirname($this->get_server_var('SCRIPT_FILENAME')) . '/files/portfolio/thumbnail/';
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
