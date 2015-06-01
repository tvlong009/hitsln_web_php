<?php

namespace app\modules\slidewidget\assets;

use yii\web\AssetBundle;

class IndexSlideShowAsset extends AssetBundle {

    public $sourcePath = __DIR__;
    public $css = [
        'css/index_slideshow.css'
    ];
    public $js = [
        'js/index_slideshow.js',
        'js/jquery.themepunch.plugins.min.js',
        'js/jquery.themepunch.revolution.min.js'
    ];
    public $publishOptions = [
        'forceCopy' => true,
    ];
}