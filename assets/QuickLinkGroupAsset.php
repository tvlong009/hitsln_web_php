<?php
namespace app\assets;

use yii\web\AssetBundle;

class QuickLinkGroupAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/quicklinkgroup.js',
    ];
    public $depends = [
        'app\assets\ClipOneAsset'
    ];
}