<?php

namespace app\modules\signupwidget\widgets;

use app\models\Roles;
use app\models\User;
use app\models\UsersRoles;
use app\modules\signupwidget\models\SignupSetting;
use yii\base\Widget;
use Yii;

class SignupWidget extends Widget
{
    public $requireChangePassword = false;
    public $defaultRole;
    public $mailMethod;
    public $loginUrl;
    private $role;
    private $randomString;

    public function init()
    {
        if ($this->defaultRole == '') {
            $this->defaultRole = 'user';

            $this->role = Roles::findOne(['name' => $this->defaultRole]);

            if ($this->role == null) {
                $this->role = new Roles();
                $this->role->name = 'user';
                $this->role->level = 21;
                $this->role->is_master = 0;
                $this->role->is_default = 0;

                $this->role->save();
            }
        }

        if ($this->mailMethod == '') {
            $this->mailMethod = 'smtp';
        }

        if ($this->loginUrl == '') {
            $this->loginUrl = Yii::$app->urlManager->createAbsoluteUrl('home/login');
        }
    }

    public function run()
    {
        $model = new User();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->require_change_password = $this->requireChangePassword ? 1 : 0;

            if ($this->requireChangePassword) {
                $this->randomString = Yii::$app->security->generateRandomString(6);
                $model->password = $this->randomString;
            } 

            $model->gender = (int)Yii::$app->request->post('gender');
            $model->birth_date = date('Y-m-d', mktime(
                0,
                0,
                0,
                Yii::$app->request->post('mm'),
                Yii::$app->request->post('dd'),
                Yii::$app->request->post('yy')
            ));
            $model->name = $model->username;
            if ($model->save()) {
                $userRole = new UsersRoles();
                $userRole->user_id = $model->id;
                $userRole->role_id = $this->role->id;
                $userRole->save();

                if ($model->require_change_password) {
                    $model->active_code = Yii::$app->security->generateRandomString();
                    $model->save();

                    $this->sendMail($model);
                }
                // if login unsuccess show message signup success
                Yii::$app->session->setFlash('success', Yii::t('app', 'Sign up successfully'));
                return Yii::$app->controller->redirect(Yii::$app->urlManager->createAbsoluteUrl('/home/login'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Sign up unsuccess, please try again.'));
            }
        }


        $signupSettings = SignupSetting::find();
        $setting = array();

        if ($signupSettings->count() > 0) {
            foreach ($signupSettings->all() as $signupSetting) {
                $setting[$signupSetting->key_name] = $signupSetting->value;
            }
        }

        $imageUrl = str_replace(['frontend', '/index.php'], ['backend', ''], Yii::$app->urlManager->createAbsoluteUrl(''));


        return $this->render('signupwidget', [
            'signupSettings' => $setting,
            'imageUrl' => $imageUrl,
            'model' => $model,
            'loginUrl' => $this->loginUrl,
            'require_change_password' => $this->requireChangePassword
        ]);
    }

    public function sendMail($model)
    {
        $to = $model->email;
        $subject = Yii::t('app', 'No-reply Require change password');
        if ($this->mailMethod == 'smtp') {
            $email = Yii::$app->mailer->compose('changePasswordEmail-html', ['model' => $model, 'password' => $this->randomString])
                ->setTo($to)
                ->setSubject($subject)
            ->send();
        } elseif ($this->mailMethod == 'mailer') {
            Yii::$app->controller->layout = '@common/mail/layouts/html';
            $content = Yii::$app->controller->render('@common/mail/changePasswordEmail-html', ['model' => $model, 'password' => $this->randomString]);
            //$header = 'From : ' . Yii::$app->params['adminEmail'] . "\r\n";
            $header = 'From: longtestsmtp@gmail.com'. "\r\n";
            $email = mail($to,$subject, $content, $header);
        }

        return $email;
    }
}