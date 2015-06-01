<?php

namespace app\modules\slidewidget\controllers;

use Yii;
use app\modules\slidewidget\models\SlideSlideshow;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\slidewidget\models\SlideSlideItem;

/**
 * SlideController implements the CRUD actions for SlideSlideshow model.
 */
class SlideController extends \app\controllers\BackendController {

    /**
     * Lists all SlideSlideshow models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => SlideSlideshow::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SlideSlideshow model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SlideSlideshow model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new SlideSlideshow();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $items_id = Yii::$app->request->post('items');
            if (!empty($items_id)) {
                foreach ($items_id as $id) {
                    $model_slide_item = new SlideSlideItem();
                    $id = str_replace('item_', '', $id);
                    $model_slide_item->slide_id = $model->id;
                    $model_slide_item->item_id = $id;
                    $model_slide_item->save();
                }

                Yii::$app->session->setFlash('success', 'Save slide and items successful');
                return $this->redirect('index');
            } else {
                Yii::$app->session->setFlash('warning', 'The slide has no item');
                return $this->redirect('index');
            }
        } else {
            $items = \app\modules\slidewidget\models\SlideItem::findAll(['is_active'=>'1']);
            return $this->render('create', [
                        'model' => $model,
                        'items' => $items
            ]);
        }
    }

    /**
     * Updates an existing SlideSlideshow model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $items = \app\modules\slidewidget\models\SlideItem::findAll(['is_active'=>'1']);
        $items_seleted = \app\modules\slidewidget\models\SlideSlideItem::findAll(['slide_id' => $id]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
               $items_id = Yii::$app->request->post('items');
            if (!empty($items_id)) {
                SlideSlideItem::deleteAll(['slide_id' => $id]);
                
                foreach ($items_id as $item_id) {
                    $model_slide_item = new SlideSlideItem();
                    $item_id = str_replace('item_', '', $item_id);
                    $model_slide_item->slide_id = $id;
                    $model_slide_item->item_id = $item_id;
                    $model_slide_item->save();
                }
                Yii::$app->session->setFlash('success', 'Update slide and items successful');
                $items_seleted = \app\modules\slidewidget\models\SlideSlideItem::findAll(['slide_id' => $id]);
                  return $this->render('update', [
                        'model' => $model,
                        'items_seleted' => $items_seleted,
                        'items' => $items,
            ]);
            } else {
                SlideSlideItem::deleteAll(['slide_id' => $id]);
                Yii::$app->session->setFlash('warning', 'The slide has no item');
                $items_seleted = \app\modules\slidewidget\models\SlideSlideItem::findAll(['slide_id' => $id]);
                  return $this->render('update', [
                        'model' => $model,
                        'items_seleted' => $items_seleted,
                        'items' => $items,
            ]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'items_seleted' => $items_seleted,
                        'items' => $items,
            ]);
        }
    }

    /**
     * Deletes an existing SlideSlideshow model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete() {
        $data = [];
        if (Yii::$app->getRequest()->isAjax) {
            $SlideList = Yii::$app->getRequest()->post('id');
            if (!empty($SlideList)) {
                foreach ($SlideList as $slideId) {
                    $slide = SlideSlideshow::findOne($slideId);
                    if ($slide) {
                        \app\modules\slidewidget\models\SlideSlideItem::deleteAll(['slide_id' => $slideId]);
                        $slide->delete();
                    }
                }
                Yii::$app->session->setFlash('success', Yii::t('app', 'Delete slide success'));
                $data['success'] = '1';
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Delete slide error'));
                $data['error'] = 1;
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $data['error'] = 1;
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    /**
     * Finds the SlideSlideshow model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SlideSlideshow the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = SlideSlideshow::findOne($id)) !== null) {
            return $model;
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $this->redirect('index');
        }
    }

}
