<?php

namespace app\components;

use yii\base\Widget;

class Newsletter extends Widget
{
    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        $model = new \app\models\Newsletter();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', 'Thank you for registering newsletter');
        }
        
        return $this->render('newsleter', ['model' => $model]);
    }
}
