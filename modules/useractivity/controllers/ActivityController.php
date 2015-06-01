<?php

namespace app\modules\useractivity\controllers;

use app\modules\useractivity\models\Activity;
use Yii;
use app\controllers\BackendController;

class ActivityController extends BackendController
{

    public function push($oldData = NULL, $newData = NULL, $description = NULL, $userId = NULL, $module = NULL, $controller = NULL, $action = NULL)
    {
        if ($oldData != $newData) {
            $model = new Activity();
            $model->user_id = $userId == NULL ? Yii::$app->user->identity->id : $userId;
            $model->module = $module == NULL ? Yii::$app->controller->module->id : $module;
            $model->controller = $controller == NULL ? Yii::$app->controller->id : $controller;
            $model->action = $action == NULL ? Yii::$app->controller->action->id : $action;

            // check is object old data
            if (is_object($oldData)) {
                $oldData = $oldData->toArray();
                $oldData = json_encode($oldData);
            }
            $model->old_data = $oldData;

            // check is object new data
            if (is_object($newData)) {
                $newData = $newData->toArray();
                $newData = json_encode($newData);
            }
            $model->new_data = $newData;
            $model->description = $description;

            $model->save();
        }
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSee()
    {
        if (Yii::$app->getRequest()->isAjax) {
            $offset = Yii::$app->getRequest()->post('offset');
            $limit = Yii::$app->getRequest()->post('limit');
            //var_dump($offset);
            $model = \app\modules\useractivity\models\Activity::find()->limit($limit)->offset($offset)->all();
            if (is_array($model)) {
                foreach ($model as $key => $value) {
                    $model[$key] = is_object($value) ? $value->toArray() : array();
                }
            }
            Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
            return $model;
        }
    }

}
