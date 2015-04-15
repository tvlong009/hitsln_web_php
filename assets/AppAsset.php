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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/fileupload/style.css',
        'css/fileupload/jquery.fileupload.css',
        'css/fileupload/jquery.fileupload-ui.css',
//        'css/datetimepicker/bootstrap-datetimepicker.min.css',
    ];
    public $js = [
        'js/fileupload/cors/jquery.postmessage-transport.js',
        'js/fileupload/cors/jquery.xdr-transport.js',
        'js/fileupload/vendor/jquery.ui.widget.js',
        'js/fileupload/tmpl.min.js',
        'js/fileupload/load-image.all.min.js',
        'js/fileupload/jquery.iframe-transport.js',
        'js/fileupload/jquery.fileupload.js',
        'js/fileupload/jquery.fileupload-process.js',
        'js/fileupload/jquery.fileupload-image.js',
        'js/fileupload/jquery.fileupload-audio.js',
        'js/fileupload/jquery.fileupload-video.js',
        'js/fileupload/jquery.fileupload-validate.js',
        'js/fileupload/jquery.fileupload-ui.js',
//        'js/datetimepicker/moment.js',
//        'js/datetimepicker/bootstrap-datetimepicker.min.js',
//        'js/page.js',
//        'js/particles.js',
//        'js/portfolio.js',
//        'js/media.js',
//        'js/languages.js',
//        'js/users.js',
//        'js/roles.js',
//        'js/partner.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
