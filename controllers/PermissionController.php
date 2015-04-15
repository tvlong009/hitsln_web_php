<?php

namespace app\controllers;

use app\controllers\BackendController;
use Yii;
use yii\helpers\Html;
use app\models\Permission;

class PermissionController extends BackendController
{
    private $controllers = array();
    public function actionIndex()
    {
        $user_array = \app\models\site\User::find()->all();
        $roles = \app\models\Roles::find()->all();
        return $this->render('index', array('user_array' => $user_array, 'roles' => $roles));
    }

    private function getController($path, $ignoreFolder = array('nbproject', 'vendor'), $ignoreController = array('BackendController', 'SiteController'))
    {
        $controllers = glob($path . '/*' , GLOB_ONLYDIR);
        $controllerList = array();
        if (!empty($controllers)) {
            foreach ($controllers as $controller) {
                if (!in_array(basename($controller), $ignoreFolder)) {
                    if (basename($controller) == 'controllers') {
                        $controllerList = glob($controller. '/*Controller.php');
                        if (!empty($controllerList)) {
                            foreach ($controllerList as $controllerName) {
                                if(!in_array(substr(basename($controllerName), 0, -4), $ignoreController)){
                                    $controllerContent = file_get_contents($controllerName);
                                    $namespace = substr($controllerContent, strpos($controllerContent, 'namespace'),
                                        strpos($controllerContent, ';') - strpos($controllerContent, 'namespace'));
                                    $namespace = explode(' ', $namespace);
                                    $this->controllers[substr(basename($controllerName), 0, -4)] = $namespace[1];
                                }
                            }
                        }
                    } else {
                        $this->getController($controller);
                    }
                }
            }
        }
        return $this->controllers;
    }

    public function actionPermissions($userId = '', $object_class = '')
    {
        $routers = array();
        if (empty($userId))
            $userId = Yii::$app->request->post('userId');
        if (empty($object_class))
            $object_class = Yii::$app->request->post('object_class');
        if (!empty($userId)) {
            $object_class = $object_class == 'user' ? 'user' : 'role';
            $controllers = $this->getController(dirname(\Yii::getAlias('@webroot')));
            if (!empty($controllers)) {
                $permission_array = Permission::findAll(['object_class' => $object_class, "object_id" => $userId]);
                foreach ($controllers as $controller => $namespace) {
                    if ($controller[0] !== '.') {
                        $controller = str_replace('.php', '', $controller);
                        $routers[$controller] = array();
                        $class = $namespace . '\\' .$controller;
                        $reflectorController = new \ReflectionClass($class);
                        $methods = $reflectorController->getMethods(\ReflectionMethod::IS_PUBLIC);

                        if (!empty($methods)) {
                            foreach ($methods as $method) {
                                if (preg_match('/^action[A-Z]+/', $method->name) && $method->class == $class) {
                                    if (!empty($permission_array)) {
                                        for ($i = 0; $i < count($permission_array); $i++) {
                                            $permission = explode("\\", $permission_array[$i]->action);
                                            if ($permission[0] === $controller && $method->name === $permission[1]) {
                                                $method->selected = TRUE;
                                                break;
                                            }
                                        }
                                    }
                                    $routers[$controller][] = $method;
                                }
                            }
                        }
                    }
                }
            }
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return array('html' => $this->renderPartial('_permissions', array('routers' => $routers)));
    }

    public function actionSavepermission()
    {
        $data = [];
        if (Yii::$app->request->isAjax) {
            $userid = Yii::$app->request->post('userId');
            $roleId = Yii::$app->request->post('RoleId');
            $object_class = Yii::$app->request->post('object_class');
            $Permissions = Yii::$app->request->post('Permission');
            // Save permission
            Permission::deleteAll(['object_class' => $object_class, "object_id" => $userid]);
            foreach ($Permissions as $Permission) {
                $model = new Permission();
                $model->action = $Permission;    
                $model->object_id = $object_class == 'user' ? $userid : $roleId;
                $model->object_class = $object_class;
                if ($model->save()) {
                    $data['success'] = '1';
                } else {
                    $data['success'] = '0';
                }
            }
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

}
