<?php
namespace app\modules\cmsparticles\widgets;

use yii\base\Widget;

class PartnerWidget extends Widget
{
    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        $model = \app\modules\cmsparticles\models\Partner::findAll(['status' => 1]);
        
        return $this->render('partner', ['model' => $model]);
    }
}
