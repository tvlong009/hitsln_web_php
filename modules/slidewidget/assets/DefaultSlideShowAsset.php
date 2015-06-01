<?php

namespace app\modules\slidewidget\assets;

use yii\web\AssetBundle;

class DefaultSlideShowAsset extends AssetBundle {

    public $sourcePath = __DIR__;
    public $css = [
        'css/default_slideshow.css'
    ];
    public $js = [
        'js/default_slideshow.js',
    ];
}
