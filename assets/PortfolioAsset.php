<?php


namespace app\assets;

use yii\web\AssetBundle;

class PortfolioAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/portfolio.js',  
    ];
    public $depends = [
        'app\assets\ClipOneAsset'
    ];
}
