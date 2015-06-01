<?php
namespace app\modules\useractivity\widgets;

use yii\base\Widget;

class UserActivityWidget extends Widget
{
    public $limit = 3;
    public $template = '';
    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        $model = \app\modules\useractivity\models\Activity::find()->limit($this->limit)->offset(0)->all();
        return $this->render('activity', ['model' => $model, 'template' => $this->template, 'limit' => $this->limit]);
    }
}
