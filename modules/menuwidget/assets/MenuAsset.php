<?php

namespace app\modules\menuwidget\assets;

use yii\web\AssetBundle;
use Yii;

class MenuAsset extends AssetBundle
{
    public $sourcePath = __DIR__;
    public $css = [
        'css' => 'css/superfish.css',
    ];
    public $js = [
        'js/menu.js',
        'js/menu_item.js',
        'js/hoverIntent.js',
        'js/superfish.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public $publishOptions = [
        'forceCopy' => true,
    ];
}