<?php
namespace app\modules\cmsparticles\widgets;

use yii\base\Widget;

class PortfolioWidget extends Widget
{
    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        $model = \app\modules\cmsparticles\models\Portfolio::findAll(['status' => 1]);
        return $this->render('portfolio', ['model' => $model]);        
    }
}
