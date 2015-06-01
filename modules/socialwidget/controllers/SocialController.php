<?php

namespace app\modules\socialwidget\controllers;

use app\modules\socialwidget\models\Social;
use yii\data\ActiveDataProvider;
use app\controllers\BackendController;
use yii\web\UploadedFile;
use Yii;

class SocialController extends BackendController {

    public $recordPerPage = 30;
    /**
     * get list social links
     * @author Jimmy
     * @return 
     */
    public function actionIndex()
    {
        //get all pages
        $sortBy = Yii::$app->getRequest()->get('sort') != '' ? Yii::$app->getRequest()->get('sort') : 'order';

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

        $model = Social::find()->orderBy([$sortBy => $sortType]);

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
    /**
     * create social link
     * @author Jimmy
     * @return 
     */
    public function actionAdd() {
        $model = new Social();
        if ($model->load(Yii::$app->request->post())) {
            $icon = UploadedFile::getInstance($model, 'icon');
            if (empty($icon) == false) {
                $model->icon = $this->uploadFile($icon);
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Create Social link successfully'));
                return $this->redirect(\Yii::$app->urlManager->createAbsoluteUrl('/socialwidget/social/edit?id=' . $model->primaryKey));
            } 
        }
        return $this->render('add', ['model' => $model]);
    }
    /**
     * update social link
     * @author Jimmy
     * @param int $id
     * @return type
     */
    public function actionEdit($id) {
        $model = Social::findOne($id);

        if ($model) {            
            if ($model->load(Yii::$app->request->post()) && $model->validate() == true) {
                $icon = UploadedFile::getInstance($model, 'icon');
                $icon_exist = Yii::$app->request->post('icon_exist');
                // check action delete icon
                if(empty(Yii::$app->request->post('delete_icon')) == false) {
                    unlink(Yii::getAlias('@app')."/web/uploads/social/". $icon_exist);
                    $icon_exist = '';
                }
                // check icon upload
                if (empty($icon) == false) {
                    // upload icon
                    $model->icon = $this->uploadFile($icon);
                } else {
                    $model->icon = $icon_exist;
                } 
                // save social link
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Update Social link successfully'));
                }
            } elseif (empty($model->errors) == false) {
                $model->icon = Yii::$app->request->post('icon_exist');
            }
            return $this->render('edit', ['model' => $model]);
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $this->redirect('index');
        }
    }
    /**
     * delete social link
     * @author Jimmy
     * @return int
     */
    public function actionDelete()
    {
        $data = [];
        if (Yii::$app->getRequest()->isAjax) {
            $socialIdList = Yii::$app->getRequest()->post('id');
            if (!empty($socialIdList)) {
                foreach ($socialIdList as $socialId) {
                    $social = Social::findOne($socialId);
                    if ($social) {
                        $social->delete();
                    }
                }
                Yii::$app->session->setFlash('success', Yii::t('app', 'Delete social link success'));
                $data['success'] = '1';
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Delete social link error'));
                $data['error'] = 1;
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $data['error'] = 1;
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    private function uploadFile($icon)
    {
        $basename = uniqid('social_');
        $model_icon = $name = $basename . '.' . $icon->extension;
        $uploadDirBack = Yii::getAlias('@app') . '/web/uploads/social/';
        if (!file_exists($uploadDirBack)) {
            mkdir($uploadDirBack, 0777, TRUE);
        }
        $icon->saveAs($uploadDirBack . $name);
        // copy filr upload fromapp to front end
        //copy($uploadDirBack . $name, $uploadDirFront . $name);
        return $model_icon;
    }

}
