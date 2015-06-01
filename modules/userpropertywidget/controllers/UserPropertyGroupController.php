<?php

namespace app\modules\userpropertywidget\controllers;

use app\controllers\BackendController;
use app\modules\userpropertywidget\models\UserProperty;
use app\modules\userpropertywidget\models\UserPropertyGroup;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use Yii;

class UserPropertyGroupController extends BackendController {

    public function actionIndex() {
        //get all pages
        $sortBy = Yii::$app->getRequest()->get('sort') != '' ? Yii::$app->getRequest()->get('sort') : 'displayorder';

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



        $dataProvider = new ActiveDataProvider([
            'query' => UserPropertyGroup::find()->orderBy([$sortBy => $sortType]),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate() {
        $model = new UserPropertyGroup();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Create user property group successfully'));
            return $this->redirect('index');
        }

        return $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Update user property group successfully'));
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    public function actionDelete() {
        $data = [];
        if (Yii::$app->getRequest()->isAjax) {
            $userpropertygroupList = Yii::$app->getRequest()->post('id');
            if (!empty($userpropertygroupList)) {
                foreach ($userpropertygroupList as $userpropertygroupId) {
                    $userpropertygroup = UserPropertyGroup::findOne($userpropertygroupId);
                    if ($userpropertygroup) {
                        $userproperties = UserProperty::findAll(['group_id' => $userpropertygroupId]);
                        foreach ($userproperties as $userproperty) {
                            $userproperty->group_id = null;
                            $userproperty->save();
                        }
                        $userpropertygroup->delete();
                    }
                }
                Yii::$app->session->setFlash('success', Yii::t('app', 'Delete user property group success'));
                $data['success'] = '1';
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Delete user property group error'));
                $data['error'] = 1;
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $data['error'] = 1;
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    protected function findModel($id) {
        if (($model = UserPropertyGroup::findOne($id)) !== null) {
            return $model;
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $this->redirect('index');
        }
    }

}
