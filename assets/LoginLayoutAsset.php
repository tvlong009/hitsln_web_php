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
class LoginLayoutAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap-theme.css',
        'css/font-awesome.css',
        'css/tm-font.css',
        'css/entypo.css',
        'css/general.css',
        'css/style.css',
        'css/otherpage.css'
    ];
    public $js = [
        'js/less.min.js',
        'js/jquery-1.9.1.js',
        'js/bootstrap.js',
        'js/myjs.js'      
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
