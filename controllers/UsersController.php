<?php
namespace app\controllers;

use Yii;
use app\models\site\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\BackendController;
use app\models\UsersRoles;
use app\models\Roles;
use yii\web\UploadedFile;
use app\models\Permission;
use app\models\UserSetting;
use app\models\UserProperty;
use app\models\UserPropertyValue;
use app\models\app\models;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends BackendController
{

    /**
     * Lists all User models.
     * 
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()
        ]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single User model.
     * 
     * @param integer $id            
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * 
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        
        $userpropertyList = UserProperty::findAll([
            'status' => 1
        ]);
        
        if ($model->load(Yii::$app->request->post())) {
            
            // -----------------------------------
            // Save user
            
            $model->password = sha1($model->password); // password changes
                                                       // time set
            $model->created_at = time();
            $model->updated_at = time();
            
            // upload avatar image
            $model->avatar = UploadedFile::getInstance($model, 'avatar');
            
            if ($model->isNewRecord === true) {
                if ($model->avatar) {
                    if (! file_exists('uploads/' . $model->avatar->baseName . '.' . $model->avatar->extension)) {
                        $model->avatar->saveAs('uploads/' . $model->avatar->baseName . '.' . $model->avatar->extension);
                    }
                    $model->avatar = $model->avatar->baseName . '.' . $model->avatar->extension;
                }
            }
            // save into db
            if ($model->save()) {
                
                // -----------------------------------------
                // Save role into user_role table
                $role_model = new Roles();
                if (! empty(Roles::find()->all())) {
                    if ($role_model->load(Yii::$app->request->post())) {
                        // var_dump($role_model);
                        // var_dump(count($role_model->name));die();
                        
                        for ($i = 0; $i < count($role_model->name); $i ++) {
                            
                            $user_role = new UsersRoles();
                            $user_role->role_id = $role_model->name[$i];
                            $user_role->user_id = $model->id;
                            $user_role->save();
                        }
                    }
                }
                // add user property
                $this->insertUserPropertyValue($model);
                
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'userpropertyList' => $userpropertyList
                ]);
            }
            
            return $this->redirect([
                'view',
                'id' => $model->id
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'userpropertyList' => $userpropertyList
            ]);
        }
    }
    
    // public function actions
    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * 
     * @param integer $id            
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $userpropertyList = UserProperty::findAll([
            'status' => 1
        ]);
        
        if ($model->load(Yii::$app->request->post())) {
            
            // time set
            $model->updated_at = time();
            
            // upload avatar image
            if ($model->isNewRecord === true) {
                if ($model->avatar) {
                    if (! file_exists('uploads/' . $model->avatar->baseName . '.' . $model->avatar->extension)) {
                        $model->avatar->saveAs('uploads/' . $model->avatar->baseName . '.' . $model->avatar->extension);
                    }
                    $model->avatar = $model->avatar->baseName . '.' . $model->avatar->extension;
                }
            }
            
            if ($model->save()) {
                
                // -----------------------------------------
                // Save role into user_role table
                $mode_role = array();
                $mode_role = Yii::$app->request->post('Roles');
                // var_dump(count($mode_role));die();
                if (! empty($mode_role)) {
                    UsersRoles::deleteAll([
                        'user_id' => $id
                    ]);
                    for ($i = 0; $i < count($mode_role); $i ++) {
                        $user_role = new UsersRoles();
                        $user_role->role_id = $mode_role[$i];
                        $user_role->user_id = $id;
                        $user_role->save();
                    }
                }
                // save user property
                UserPropertyValue::deleteAll([
                    'user_id' => $model->id
                ]);
                $this->insertUserPropertyValue($model);
                
                Yii::$app->session->setFlash('success', 'Update User Successfully');
                return $this->render('view', [
                    'model' => $model,
                    'userpropertyList' => $userpropertyList
                ]);
            } else {
                Yii::$app->session->setFlash('error', 'Update User False');
                return $this->render('update', [
                    'model' => $model,
                    'userpropertyList' => $userpropertyList
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'userpropertyList' => $userpropertyList
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * 
     * @param integer $id            
     * @return mixed
     */
    public function actionDelete()
    {
        $data = [];
        if (Yii::$app->getRequest()->isAjax) {
            $UserList = Yii::$app->getRequest()->post('id');
            if (! empty($UserList)) {
                foreach ($UserList as $UserId) {
                    $user = new User();
                    UsersRoles::deleteAll([
                        'user_id' => $UserId
                    ]);
                    UserSetting::deleteAll([
                        'user_id' => $UserId
                    ]);
                    $user = User::findOne([
                        'id' => $UserId
                    ]);
                    
                    if ($user) {
                        $user->delete();
                        UserPropertyValue::deleteAll([
                            'user_id' => $user->id
                        ]);
                    }
                }
                
                $data['success'] = '1';
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Delete user error'));
                $data['error'] = 1;
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $data['error'] = 1;
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
        // return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * 
     * @param integer $id            
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    public function actionDeletecheckbox()
    {
        if (Yii::$app->request->isAjax) {
            $checkboxes = Yii::$app->request->post('selection');
            if (! empty($checkboxes)) {
                if (is_array($checkboxes)) {
                    foreach ($checkboxes as $id) {
                        UsersRoles::deleteAll([
                            'user_id' => $id
                        ]);
                        $this->findModel($id)->delete();
                    }
                } else {
                    $this->findModel($checkboxes)->delete();
                }
            }
            echo json_encode(array(
                'message' => Yii::t('app', 'Delete success'),
                'status' => 0
            ));
        } else {
            return $this->redirect([
                'index'
            ]);
        }
    }

    private function insertUserPropertyValue($model)
    {
        // save user property
        $userproperties = Yii::$app->request->post('property');
        if (! empty($userproperties)) {
            foreach ($userproperties as $propertyId => $item) {
                $property = UserProperty::findOne($propertyId);
                if ($property) {
                    if (is_array($item)) {
                        foreach ($item as $value) {
                            $propertyValue = new UserPropertyValue();
                            $propertyValue->user_id = $model->id;
                            $propertyValue->property_id = $property->property_id;
                            $propertyValue->value = (string) $value;
                            
                            $propertyValue->save();
                        }
                    } else {
                        $propertyValue = new UserPropertyValue();
                        $propertyValue->user_id = $model->id;
                        $propertyValue->property_id = $property->property_id;
                        $propertyValue->value = (string) $item;
                        
                        $propertyValue->save();
                    }
                }
            }
        }
    }
}
