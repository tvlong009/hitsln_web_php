<?php

namespace app\modules\loginwidget\controllers;

use app\controllers\BackendController;
use app\models\AppLoginForm;
use app\modules\loginwidget\models\LoginSetting;
use app\modules\loginwidget\widgets\LoginWidget;
use Yii;
use yii\web\UploadedFile;

class LoginSettingController extends BackendController
{
    public function actionUpdate()
    {
        if (Yii::$app->request->isPost) {
            $formData = Yii::$app->request->post('setting');

            if (!empty($formData)) {
                foreach ($formData as $settingName => $value) {
                    $loginSetting = LoginSetting::findOne(['key_name' => $settingName]);
                    $loginSetting  = $loginSetting == null ? new LoginSetting() : $loginSetting;
                    $loginSetting->key_name = (string) $settingName;
                    $loginSetting->value = $value;

                    $loginSetting->save();
                }
            }

            //upload logo
            $loginSetting = LoginSetting::findOne(['key_name' => 'logo']);

            $loginSetting = $loginSetting == null ? new LoginSetting() : $loginSetting;

            $loginSetting->key_name = 'logo';

            $loginSetting->logo = UploadedFile::getInstance($loginSetting, 'logo');

            if ($loginSetting->logo && $loginSetting->validate()) {
                $logoName =  $loginSetting->logo->baseName . '.' . $loginSetting->logo->extension;
                $loginSetting->value = $logoName;
                $loginSetting->save();
                $loginSetting->logo->saveAs('uploads/' . $logoName);
            }

            $isDeleteLogo = Yii::$app->request->post('delete_logo');
            if (isset($isDeleteLogo)) {
                $loginSetting = LoginSetting::findOne(['key_name' => 'logo']);
                if ($loginSetting) {
                    unlink(Yii::getAlias('@webroot') . '/uploads/' . $loginSetting->value);
                    $loginSetting->value = '';
                    $loginSetting->save();
                }
            }

            Yii::$app->session->setFlash('success', Yii::t('app', 'Update login setting successfully'));
        }

        $loginSettings = LoginSetting::find();
        $settings = array();
        if ($loginSettings->count() > 0) {
            foreach ($loginSettings->all() as $setting) {
                $settings[$setting->key_name] = $setting->value;
            }
        }

        return $this->render('update', array('loginSettings' => $settings));
    }
}
