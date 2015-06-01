<?php
namespace app\modules\streamingwidget\assets;

use yii\web\AssetBundle;
use Yii;

class StreamingAsset extends AssetBundle
{

    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
    public $sourcePath = __DIR__;
    public $css = [
        'css/bar-ui.css'
    ];
    public $js = [
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public $publishOptions = [
        'forceCopy' => true,
    ];
    
    public function init() {
        parent::init();
        $this->js[] = YII_DEBUG ? 'js/soundmanager2.js' : 'js/soundmanager2-nodebug-jsmin.js';
        $this->js[] = 'js/bar-ui.js';
        $this->js[] = 'js/streaming.js';
    }
}