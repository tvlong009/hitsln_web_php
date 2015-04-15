<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\site\User;
use app\models\Roles;
use app\models\UsersRoles;

class BackendController extends Controller
{

    public $recordPerPage = 30;
    public $__languages;

    public function __construct($id, $module)
    {
        //just for test
        parent::__construct($id, $module);

        $user = User::find();

        if ($user->count() == 0) {

            //create account to test
            $user = new User();
            $user->username = 'admin';
            $user->name = 'Administrator';
            $user->password = sha1('123456');
            $user->email = 'admin@targetmediamusic.com';
            $user->auth_key = \Yii::$app->security->generateRandomKey();
            $user->created_at = time();
            $user->updated_at = time();

            $user->save();
        } else {
            $user = Yii::$app->user;            
        }
        
        $roleMaster = Roles::findOne(['is_master' => 1]);
        if (!$roleMaster) {
            $roleMaster = new Roles();
            $roleMaster->name = 'master';
            $roleMaster->level = 20;
            $roleMaster->is_master = 1;
            $roleMaster->is_default = 0;
        
            $roleMaster->save();
        }
        
        $roleUser = UsersRoles::findOne(['user_id' => $user->id, 'role_id' => $roleMaster->id]);
        if (!$roleUser) {
            $roleUser = new UsersRoles();
            $roleUser->user_id = $user->id;
            $roleUser->role_id = $roleMaster->id;
        
            $roleUser->save();
        }
        $this->__languages = \app\models\Languages::find()->all();
    }

    public function beforeAction($action)
    {
        parent::beforeAction($action);
        //get roles of user
        $currentController = $this->uniqueId;
        $currentAction = $action->actionMethod;
        if ($currentController == 'site'){
            return true;
        }
        if (!Yii::$app->user->isGuest) {
            $userRoles = \app\models\UsersRoles::findAll(['user_id' => Yii::$app->user->identity->id]);
            if (!empty($userRoles)) {
                $currentController = strtoupper($currentController[0]) . substr($currentController, 1) . 'Controller';
                $permission = \app\models\Permission::findOne(array('action' => $currentController . '\\' . $currentAction, 'object_id' => Yii::$app->user->identity->id, 'object_class' => 'user'));
                if (empty($permission))
                    $permission = \app\models\Permission::findOne(array('action' => $currentController . '\\*', 'object_id' => Yii::$app->user->identity->id, 'object_class' => 'user'));
                if (empty($permission))
                    $permission = \app\models\Permission::findOne(array('action' => '*\\' . $currentAction, 'object_id' => Yii::$app->user->identity->id, 'object_class' => 'user'));
                if (empty($permission))
                    $permission = \app\models\Permission::findOne(array('action' => '*\\*', 'object_id' => Yii::$app->user->identity->id, 'object_class' => 'user'));
                if (empty($permission))
                    $permission = \app\models\Permission::findOne(array('action' => '*', 'object_id' => Yii::$app->user->identity->id, 'object_class' => 'user'));
                if (!empty($permission))
                    return true;
                $roles = array(0);
                foreach ($userRoles as $userRole)
                    $roles[] = $userRole->role_id;
                $roles = \app\models\Roles::find()->where(['in', 'id', $roles])->all();
                if (!empty($roles)) {
                    foreach ($roles as $role) {
                        if ($role->is_master)
                            return true;
                        $permission = \app\models\Permission::findOne(array('action' => $currentController . '\\' . $currentAction, 'object_id' => $role->id, 'object_class' => 'role'));
                        if (empty($permission))
                            $permission = \app\models\Permission::findOne(array('action' => $currentController . '\\*', 'object_id' => $role->id, 'object_class' => 'role'));
                        if (empty($permission))
                            $permission = \app\models\Permission::findOne(array('action' => '*\\' . $currentAction, 'object_id' => $role->id, 'object_class' => 'role'));
                        if (empty($permission))
                            $permission = \app\models\Permission::findOne(array('action' => '*\\*', 'object_id' => $role->id, 'object_class' => 'role'));
                        if (empty($permission))
                            $permission = \app\models\Permission::findOne(array('action' => '*', 'object_id' => $role->id, 'object_class' => 'role'));
                        if (!empty($permission))
                            return true;
                    }
                }
            }
        }
        Yii::$app->session->setFlash('error', Yii::t('app', 'Permission denied'));
        if (Yii::$app->user->isGuest) {
            $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('site/login'));
        } else {
            $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(''));
        }

    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
        ];
    }

//    public function actions() {
//        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ]
//        ];
//    }

    public function actionError()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            return '';
        }

        if ($exception instanceof HttpException) {
            $code = $exception->statusCode;
        } else {
            $code = $exception->getCode();
        }
        if ($exception instanceof Exception) {
            $name = $exception->getName();
        } else {
            $name = Yii::t('yii', 'Error');
        }
        if ($code) {
            $name .= " (#$code)";
        }

        if ($exception instanceof UserException) {
            $message = $exception->getMessage();
        } else {
            $message = Yii::t('yii', 'An internal server error occurred.');
        }
        if (Yii::$app->getRequest()->getIsAjax()) {
            return "$name: $message";
        } else {
            $this->layout = 'error';
            return $this->render('error' ? : $this->id, [
                        'name' => $name,
                        'message' => $message,
                        'exception' => $exception,
            ]);
        }
    }

    public function actionChangeLang($lang = '')
    {
        Yii::$app->language = $lang;
        if (Yii::$app->request->referrer) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->goHome();
        }
    }

}
