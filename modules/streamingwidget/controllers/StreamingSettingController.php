<?php

namespace app\modules\streamingwidget\controllers;

use app\controllers\BackendController;
use app\models\Setting;
use Yii;

class StreamingSettingController extends BackendController
{
    public function actionIndex()
    {
        $formData = array();

        if (Yii::$app->request->post()) {
            $formData = array_merge($formData, Yii::$app->request->post());

            if ($this->validData($formData)) {
                if (!empty($formData['setting'])) {
                    foreach ($formData['setting'] as $keyName => $value) {
                        $model = Setting::findOne(['key' => 'streaming_' . $keyName]);
                        if($model){
                            if ($keyName == 'password') {
                                if ($value != '') {
                                    $model->value = (string)$value;

                                    $model->save();
                                }
                            } else {
                                $model->value = (string)$value;

                                $model->save();
                            }
                        } else {
                            $model = new Setting();
                            $model->key = 'streaming_' . $keyName;
                            $model->value = (string)$value;

                            $model->save();
                        }
                    }

                    Yii::$app->session->setFlash('success', Yii::t('app', 'Save setting streaming success'));
                }
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Please enter fill full information'));
            }
        }

        $info = array('username' => 'streaming_username', 'password' => 'streaming_password', 'portalID' => 'streaming_portalID');
        foreach ($info as $key => $item) {
            $setting = Setting::findOne(['key' => $item]);
            $formData[$key] = $setting != null ? $setting->value : '';
        }

        return $this->render('index', ['formData' => $formData]);
    }

    private function validData($formData) {
        $valid = true;

        if (!empty($formData['setting'])) {
            foreach ($formData['setting'] as $key => $value) {
                if (!isset($formData['is_update']) && $key == 'password' && $value == '') {
                    $valid = false;
                    break;
                } elseif ($key != 'password' && $value == '') {
                    $valid = false;
                    break;
                }
            }
        }

        return $valid;
    }
}