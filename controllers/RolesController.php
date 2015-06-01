<?php

namespace app\controllers;

use Yii;
use app\models\Roles;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\BackendController;
use app\models\UsersRoles;

/**
 * RolesController implements the CRUD actions for Roles model.
 */
class RolesController extends BackendController {

    /**
     * Lists all Roles models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Roles::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Roles model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Roles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Roles();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success-save-role', 'Save role successfully');
            } else {
                Yii::$app->getSession()->setFlash('error-save-role', 'Save role successfully');
            }
            return $this->render('create', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Roles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Roles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete() {
        $data = [];

        if (Yii::$app->getRequest()->isAjax) {
            $RoleList = Yii::$app->getRequest()->post('id');
            if (!empty($RoleList)) {
                foreach ($RoleList as $RoleId) {
                    $role = new Roles;
                    $role = Roles::findOne($RoleId);
                    if ($role) {
                        $usersRoles = UsersRoles::findAll(['role_id' => $RoleId]);
                        foreach ($usersRoles as $userRole) {
                            $userRole->delete();
                        }
                        $role->delete();
                    }
                }
                Yii::$app->session->setFlash('success', Yii::t('app', 'Delete role success'));
                $data['success'] = '1';
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Delete role error'));
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
     * Finds the Roles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Roles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Roles::findOne($id)) !== null) {
            return $model;
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $this->redirect('index');
        }
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

}
