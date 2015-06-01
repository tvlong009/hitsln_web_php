<?php

namespace app\modules\userpropertywidget\assets;

use yii\web\AssetBundle;
use Yii;

class UserPropertyAsset extends AssetBundle
{
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
    public $sourcePath = __DIR__;
    public $css = [

    ];
    public $js = [
        'js/userpropertygroup.js',
        'js/userproperty.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}