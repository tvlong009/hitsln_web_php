<?php

namespace app\controllers;

use Yii;
use app\models\Particles;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\BackendController;

/**
 * ParticlesController implements the CRUD actions for Particles model.
 */
class ParticlesController extends BackendController {

    /**
     * Lists all Particles models.
     * @return mixed
     */
    public function actionIndex() {

        //get all pages
        $sortBy = Yii::$app->getRequest()->get('sort') != '' ? Yii::$app->getRequest()->get('sort') : 'id';

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
            'query' => Particles::find()->orderBy([$sortBy => $sortType]),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Particles model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Particles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Particles();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Create particles successfully'));
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Particles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Update particles successfully'));
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Particles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete() {
        $data = [];
        if (Yii::$app->getRequest()->isAjax) {
            $particleList = Yii::$app->getRequest()->post('id');
            if (!empty($particleList)) {
                foreach ($particleList as $particleId) {
                    $particle = Particles::findOne($particleId);
                    if ($particle) {
                        $particle->delete();
                    }
                }
                Yii::$app->session->setFlash('success', Yii::t('app', 'Delete particle success'));
                $data['success'] = '1';
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Delete particle error'));
                $data['error'] = 1;
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $data['error'] = 1;
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    public function actionDeletecheckbox() {
        if (Yii::$app->request->isAjax) {
            $checkboxes = Yii::$app->request->post('selection');
            if (!empty($checkboxes)) {
                if (is_array($checkboxes)) {
                    foreach ($checkboxes as $id) {
                        $this->findModel($id)->delete();
                    }
                } else {
                    $this->findModel($checkboxes)->delete();
                }
            }
            echo json_encode(array('message' => Yii::t('app', 'Delete success'), 'status' => 0));
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Particles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Particles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Particles::findOne($id)) !== null) {
            return $model;
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $this->redirect('index');
        }
    }

}
