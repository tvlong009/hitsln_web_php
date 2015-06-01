<?php

namespace app\modules\slidewidget\controllers;

use Yii;
use app\modules\slidewidget\models\SlideItem;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ItemController implements the CRUD actions for ItemOfSlide model.
 */
class ItemController extends \app\controllers\BackendController
{
    /**
     * Lists all ItemOfSlide models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => SlideItem::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new ItemOfSlide model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SlideItem();
        if(!$model->checkUploadDir()){
            $model->createUploadDir();
        }
        if (Yii::$app->request->isPost) {
            if($model->load(Yii::$app->request->post()) && $model->validate()
                    && $model->file = UploadedFile::getInstance($model, 'file')){
                $model->image = md5($model->file->name).  uniqid();
                if($model->save() && $model->file->saveAs($model->upload_dir . '/' . $model->image)){
                    Yii::$app->session->setFlash('success', 'Create item successfully');
                    return $this->redirect('index');
                } else {
                    Yii::$app->session->setFlash('warning','Cannot create item');
                }
            } else {
                Yii::$app->session->setFlash('warning','Cannot create item');
            }
        }
        return $this->render('create', [
                'model' => $model,
        ]);
    }

    /**
     * Updates an existing ItemOfSlide model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(!$model->checkUploadDir()){
            $model->createUploadDir();
        }
        $original_image = $model->image;
        $file_name = (string) 'http://' . $_SERVER['SERVER_NAME'] . Yii::getAlias('@web') . '/uploads/slidewidget/' . $model->image;
        if (Yii::$app->request->isPost) {
            if($model->load(Yii::$app->request->post()) && $model->validate()){
                $model->file = UploadedFile::getInstance($model, 'file');
                if($model->file){
                    $model->image = md5($model->file->name).  uniqid();
                    $model->file->saveAs($model->upload_dir . '/' . $model->image);
                    $model->file = null;
                } 
                if($model->save()){
                    Yii::$app->session->setFlash('success', 'Update item successfully');                        
                } else {
                    Yii::$app->session->setFlash('warning','Cannot update item');
                }
            } else {
                Yii::$app->session->setFlash('warning','Cannot update item');

            }
            return $this->render('update', ['model' => $model, 'image_src' => $file_name]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'image_src' => $file_name,
            ]);
        }
    }

    /**
     * Deletes an existing ItemOfSlide model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        if(Yii::$app->getRequest()->isAjax){
            $ids = Yii::$app->request->post('id');
            if(is_array($ids)){
                foreach($ids as $id){
                    $model = $this->findModel($id);
                    unlink($model->upload_dir . '/' . $model->image);
                    \app\modules\slidewidget\models\SlideSlideItem::deleteAll(['item_id'=>$id]);
                    $model->delete();
                }
                Yii::$app->session->setFlash('success', Yii::t('app', 'Delete item success'));
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Can not delete item'));
                return $this->redirect(['index']);
            }
        }
    }

    /**
     * Finds the ItemOfSlide model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItemOfSlide the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SlideItem::findOne($id)) !== null) {
            return $model;
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $this->redirect('index');
        }
    }
}
