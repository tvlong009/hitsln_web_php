<?php

namespace app\modules\cmsparticles\widgets;

use yii\base\Widget;
use app\modules\cmsparticles\models\Newsletter;

class Newsletter extends Widget
{
    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        $model = new Newsletter();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', 'Thank you for registering newsletter');
        }
        
        return $this->render('newsleter', ['model' => $model]);
    }
}
