<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HomeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap-theme.css',
        'css/font-awesome.css',
        'css/mycss.css',
        'css/myreponsive.css',
        'css/tm-font.css',
        'css/settingslide.css'
        
    ];
    public $js = [
        'js/jquery-1.9.1.js',
        'js/jquery.themepunch.plugins.min.js',
        'js/jquery.themepunch.revolution.min.js',
        'js/bootstrap.js',
        'js/slide-show-about.js',
        'js/home.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
