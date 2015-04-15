<?php

namespace app\controllers;

use Yii;
use app\models\UserSetting;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\BackendController;

/**
 * UserSettingController implements the CRUD actions for UserSetting model.
 */
class UserSettingController extends BackendController
{

    /**
     * Lists all UserSetting models.
     * @return mixed
     */
    public function actionIndex()
    {
     $sortBy = Yii::$app->getRequest()->get('sort') != '' ? Yii::$app->getRequest()->get('sort') : 'user_id';
        
        if (Yii::$app->getRequest()->get('sort') != '') {
            $posType = strpos($sortBy, '-');

        
            if (is_numeric($posType)) {
                $sortBy = substr($sortBy, $posType+1);
                $sortType = SORT_DESC;
            } else {
                $sortType = SORT_ASC;
            }
        } else {
            $sortType = SORT_DESC;
        }
  
        $dataProvider = new ActiveDataProvider([
            'query' => UserSetting::find()->orderBy([$sortBy => $sortType]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserSetting model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserSetting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserSetting();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->request->post('userId');
            if($model->save()){
                Yii::$app->getSession()->setFlash('success', Yii::t('app','Create User Setting Successfully'));
                return $this->redirect(['index', 'id' => $model->id]);
            }else{  
                Yii::$app->getSession()->setFlash('error', Yii::t('app','Create User Setting False'));
                return $this->render('index', [
                'model' => $model,
            ]);}

            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserSetting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())) {
            
            $model->user_id = Yii::$app->request->post('userId');
            
            if($model->save()){
            Yii::$app->getSession()->setFlash('success', Yii::t('app','Update User Setting Successfully'));
            return $this->redirect(['update', 'id' => $model->id]);
            }else{  Yii::$app->getSession()->setFlash('error', Yii::t('app','Update User Setting False'));
            return $this->render('update', [
                'model' => $model,
            ]);}
        } else {
            Yii::$app->getSession()->setFlash('error', Yii::t('app','Update User Setting False'));
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserSetting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
       $data = [];

        if (Yii::$app->getRequest()->isAjax) {
                $user_setting_arrays= Yii::$app->request->post('userSetting');
             
            if (!empty($user_setting_arrays)) {
                foreach ($user_setting_arrays as $user_setting_array) {
                    $user_setting = new UserSetting();
                    if($user_setting->deleteAll(['id'=>$user_setting_array])){
                    Yii::$app->session->setFlash('Success', Yii::t('app','Delete user setting successfully'));}
                    else{
                        Yii::$app->session->setFlash('error', Yii::t('app','Delete user setting error'));
                    $data['error'] = 1;}
                }
                Yii::$app->session->setFlash('success', Yii::t('app','Delete user setting success'));
                $data['success'] = '1';
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app','Delete user setting error'));
                $data['error'] = 1;
            }

        } else {
            Yii::$app->session->setFlash('error', Yii::t('app','Request not valid'));
            $data['error'] = 1;
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    /**
     * Finds the UserSetting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserSetting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserSetting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
        }
    }
}
