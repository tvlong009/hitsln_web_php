<?php

namespace app\controllers;

use app\controllers\BackendController;
use app\models\UserProperty;
use app\models\UserPropertyValue;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use Yii;
use app\models\UserPropertyGroup;

class UserPropertyController extends BackendController {

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
            'query' => UserProperty::find()->orderBy([$sortBy => $sortType]),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate() {
        $model = new UserProperty();

        $userpropertygroups = UserPropertyGroup::find()->all();
        $userpropertygroupList = array(array(
                'group_id' => 0,
                'group_name' => 'Group Default'
        ));
        $userpropertygroupList = array_merge($userpropertygroupList, $userpropertygroups);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Create user property successfully'));
            return $this->redirect('index');
        }

        return $this->render('create', array('model' => $model, 'userpropertygroupList' => $userpropertygroupList));
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        $userpropertygroups = UserPropertyGroup::find()->all();
        $userpropertygroupList = array(array(
                'group_id' => 0,
                'group_name' => 'Group Default'
        ));
        $userpropertygroupList = array_merge($userpropertygroupList, $userpropertygroups);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Update user property successfully'));
        }

        return $this->render('update', [
                    'model' => $model,
                    'userpropertygroupList' => $userpropertygroupList,
        ]);
    }

    public function actionDelete() {
        $data = [];
        if (Yii::$app->getRequest()->isAjax) {
            $userpropertyList = Yii::$app->getRequest()->post('id');
            if (!empty($userpropertyList)) {
                foreach ($userpropertyList as $userpropertyId) {
                    $userproperty = UserProperty::findOne($userpropertyId);
                    if ($userproperty) {

                        $userpropertyvalues = UserPropertyValue::findAll(['property_id' => $userpropertyId]);

                        foreach ($userpropertyvalues as $userpropertyvalue) {
                            $userpropertyvalue->delete();
                        }

                        $userproperty->delete();
                    }
                }
                Yii::$app->session->setFlash('success', Yii::t('app', 'Delete user property success'));
                $data['success'] = '1';
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Delete user property error'));
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
        if (($model = UserProperty::findOne($id)) !== null) {
            return $model;
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $this->redirect('index');
        }
    }

}
