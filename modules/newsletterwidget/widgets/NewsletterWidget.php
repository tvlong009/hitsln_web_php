<?php

namespace app\modules\newsletterwidget\widgets;

use app\modules\newsletterwidget\models\Newsletter;
use yii\base\Widget;

class NewsletterWidget extends Widget
{
    public $template = '';
    public function init()
    {
        if ($this->template == '') {
            $this->template = '<div class="input-group">{input}<span class="input-group-btn"><button class="btn btn-primary" type="submit">Send</button></span></div>{error}';
        }
        parent::init();
    }
    
    public function run()
    {
        $model = new Newsletter();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', 'Thank you for registering newsletter');

            $model = new Newsletter();
        }
        
        return $this->render('newsleter', ['model' => $model, 'template' => $this->template]);
    }
}
