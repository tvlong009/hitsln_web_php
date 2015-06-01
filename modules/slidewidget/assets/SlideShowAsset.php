<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace  app\modules\slidewidget\assets;

use yii\web\AssetBundle;

class SlideShowAsset extends AssetBundle
{
    public $sourcePath = __DIR__;
    public $css = [
        'css/slideshow.css'
    ];
    public $js = [
        'js/slideshow.js',  
    ];
    public $depends = [
        'app\assets\ClipOneAsset'
    ];
}