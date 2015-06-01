<?php

namespace app\modules\cmsparticles\widgets;

use yii\base\Widget;
use Yii;
use app\modules\cmsparticles\models\ContactForm;

class ContactFormWidgets extends Widget
{
    private $particleType = 'contatct form';

    public function init()
    {
        parent::init();
    }
    
    public function run()
    {         
        $model = new ContactForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contactform', ['model' => $model, array('captcha' => array('class' => 'yii\captcha\CaptchaAction'))]);
        }
        
        
    }
}
