<?php

namespace app\assets;
use yii\web\AssetBundle;


/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ErrorAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'clipone/assets/css/theme_light.css',
    ];
    public $js = [
        'clipone/assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js',
        'clipone/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js',
        'clipone/assets/plugins/less/less-1.5.0.min.js',
        'clipone/assets/plugins/jquery-cookie/jquery.cookie.js',
        'clipone/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js',
        'clipone/assets/js/main.js',
        'clipone/assets/plugins/rainyday/rainyday.js',
        'clipone/assets/js/utility-error404.js'
    ];
    public $depends = [
        'app\assets\ClipOneAsset'
    ];
}
