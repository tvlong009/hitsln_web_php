<?php
namespace app\modules\quicklinkwidget\assets;

use yii\web\AssetBundle;
use Yii;

class QuickLinkAsset extends AssetBundle
{

    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
    public $sourcePath = __DIR__;
    public $css = [

    ];
    public $js = [
        'js/quicklinkgroup.js',
        'js/quicklink.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}