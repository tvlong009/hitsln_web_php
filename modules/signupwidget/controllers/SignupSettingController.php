<?php

namespace app\modules\signupwidget\controllers;

use app\controllers\BackendController;
use app\models\Roles;
use app\modules\signupwidget\models\SignupSetting;
use yii\web\UploadedFile;
use Yii;

class SignupSettingController extends BackendController
{
    public function actionUpdate()
    {
        $signupSettings = SignupSetting::find();

        if (Yii::$app->request->isPost) {
            $formData = Yii::$app->request->post();

            if (!empty($formData['setting'])) {
                foreach ($formData['setting'] as $settingName => $value) {
                    $signupSetting = SignupSetting::findOne(['key_name' => $settingName]);
                    $signupSetting  = $signupSetting == null ? new SignupSetting() : $signupSetting;
                    $signupSetting->key_name = (string) $settingName;
                    $signupSetting->value = $value;

                    $signupSetting->save();
                }
            }

            if (!empty($formData['custom_field'])) {
                $customerField = array();
                foreach ($formData['custom_field'] as $key => $fieldName) {
                    if (isset($formData['custom_field_type'][$key]) && $fieldName != '') {
                        $customerField[$fieldName] = $formData['custom_field_type'][$key];
                    }
                }

                $signupSetting = SignupSetting::findOne(['key_name' => 'custom_field']);
                $signupSetting  = $signupSetting == null ? new SignupSetting() : $signupSetting;
                $signupSetting->key_name = 'custom_field';
                $signupSetting->value = json_encode($customerField);

                $signupSetting->save();
            }

            //upload logo
            $signupSetting = SignupSetting::findOne(['key_name' => 'logo']);

            $signupSetting = $signupSetting == null ? new SignupSetting() : $signupSetting;

            $signupSetting->key_name = 'logo';

            $signupSetting->logo = UploadedFile::getInstance($signupSetting, 'logo');

            if ($signupSetting->logo && $signupSetting->validate()) {
                $logoName =  $signupSetting->logo->baseName . '.' . $signupSetting->logo->extension;
                $signupSetting->value = $logoName;
                $signupSetting->save();
                $signupSetting->logo->saveAs('uploads/' . $logoName);
            }

            $isDeleteLogo = Yii::$app->request->post('delete_logo');
            if (isset($isDeleteLogo)) {
                $signupSetting = SignupSetting::findOne(['key_name' => 'logo']);
                if ($signupSetting) {
                    unlink(Yii::getAlias('@webroot') . '/uploads/' . $signupSetting->value);
                    $signupSetting->value = '';
                    $signupSetting->save();
                }
            }

            Yii::$app->session->setFlash('success', Yii::t('app', 'Update sign up setting setting successfully'));

        }

        $settings = array();
        if ($signupSettings->count() > 0) {
            foreach ($signupSettings->all() as $setting) {
                $settings[$setting->key_name] = $setting->value;
            }
        }

        $roles = Roles::find()->all();

        return $this->render('update', array('signupSettings' => $settings, 'roles' => $roles));
    }
}