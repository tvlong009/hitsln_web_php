<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use app\models\site\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\BackendController;
use app\models\UsersRoles;
use app\models\Roles;
use app\models\Permission;
use yii\web\UploadedFile;

class AssignmentController extends BackendController {

    public function actionIndex() {
        $roles = Roles::find()->all();
        if (empty($roles)) {
            Yii::$app->getSession()->setFlash('warning_role', Yii::t('app', 'Please define roles'));
            return $this->redirect('roles/create');
        } else {
            return $this->render('index');
        }
    }

    public function actionUpdaterole() {
        $data = [];
        if (Yii::$app->request->isAjax) {
            $checkboxes = array();
            $checkboxes = Yii::$app->request->post('selection');
            $user_id = Yii::$app->request->post('userId');

            if (!empty($checkboxes)) {
                UsersRoles::deleteAll(['user_id' => $user_id]);
                for ($i = 0; $i < count($checkboxes); $i++) {
                    $user_role = new UsersRoles();
                    $user_role->role_id = $checkboxes[$i];
                    $user_role->user_id = $user_id;
                    $user_role->save();
                }
                Yii::$app->session->setFlash('success', Yii::t('app', 'Update  success'));
                $data['success'] = '1';
            }
        }

        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    public function actionDeleteuserrole() {
        $data = [];
        if (Yii::$app->request->isAjax) {
            $checkboxes = array();
            if ($checkboxes = Yii::$app->request->post('selection') &&
                    $user_id = Yii::$app->request->post('userId')) {
                Permission::deleteAll(['user_id' => $user_id]);
                UsersRoles::deleteAll(["user_id" => $user_id]);
                User::deleteAll(["id" => $user_id]);

                Yii::$app->session->setFlash('success', Yii::t('app', 'Delete User Role false'));
                $data['success'] = '1';
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Delete User Role false'));
                $data['error'] = '0';
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Delete User Role false'));
            $data['error'] = '0';
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    public function actionPagination() {

        $array_user = array();
        $array_user = User::find()->all();
        //set role user
        for ($i = 0; $i < count($array_user); $i++) {
            //Load roles of users
            //----- create array with value = role id
            $roleslist = Roles::find()->all();
            $arrayname = array();
            $arrayid = array();

            for ($x = 0; $x < count($roleslist); $x++) {

                $arrayid[$x] = $roleslist[$x]->id;
                $arrayname[$arrayid[$x]] = $roleslist[$x]->name;
            }
            // check the checkbox 
            $list = array();
            $listcheck = UsersRoles::findAll(['user_id' => $array_user[$i]->id]);
            for ($y = 0; $y < count($listcheck); $y++) {
                $list[$y] = $listcheck[$y]->role_id;
            }
        }

        //pagination       
        $data = [];
        if (Yii::$app->request->isAjax && Yii::$app->request->post('pagenumber')) {


            $recordperpage = Yii::$app->request->post('recordperpage');
            $pagenumber = Yii::$app->request->post('pagenumber');
            $totalrecord = ($pagenumber * $recordperpage);
            $firstrecordshow = ($pagenumber * $recordperpage) - $recordperpage;
            return $this->renderPartial('_list', array(
                        'arrayname' => $arrayname,
                        'list' => $list,
                        'array_user' => $array_user,
                        'totalrecord' => $totalrecord,
                        'firstrecordshow' => $firstrecordshow));
        }
        $data["totalrecord"] = $totalrecord;
        $data['firstrecordshow'] = $firstrecordshow;

        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

}
