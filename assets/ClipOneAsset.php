<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ClipOneAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'clipone/assets/plugins/font-awesome/css/font-awesome.min.css',
        'clipone/assets/fonts/style.css',
        'clipone/assets/css/main.css',
        'clipone/assets/css/main-responsive.css',
        'clipone/assets/plugins/iCheck/skins/all.css',
        'clipone/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css',
        'clipone/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css',
        'clipone/assets/css/theme_light.css',
        'clipone/assets/plugins/bootstrap-datepicker/css/datepicker.css',
        'clipone/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
        'clipone/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css',
    ];
    public $js = [
        'clipone/assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js',
        'clipone/assets/plugins/bootstrap/js/bootstrap.js',
        'clipone/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
        'clipone/assets/plugins/blockUI/jquery.blockUI.js',
        'clipone/assets/plugins/iCheck/jquery.icheck.min.js',
        'clipone/assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js',
        'clipone/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js',
        'clipone/assets/plugins/less/less-1.5.0.min.js',
        'clipone/assets/plugins/jquery-cookie/jquery.cookie.js',
        'clipone/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js',
        'clipone/assets/js/main.js',
        'clipone/assets/plugins/jquery-validation/dist/jquery.validate.min.js',
        'clipone/assets/js/login.js',  
        'clipone/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
        'clipone/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js',        
    ];
    public $depends = [
        'app\assets\BackendAsset'
    ];

}
