<?php
namespace app\modules\socialwidget\widgets;

use yii\base\Widget;

class SocialWidget extends Widget
{
    public $template = '';
    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        $model = \app\modules\socialwidget\models\Social::findAll(['is_active' => 1]);
        return $this->render('social', ['model' => $model, 'template' => $this->template]);
    }
}
