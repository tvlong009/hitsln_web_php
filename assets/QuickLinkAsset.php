<?php
namespace app\assets;

use yii\web\AssetBundle;

class QuickLinkAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/quicklink.js',
    ];
    public $depends = [
        'app\assets\ClipOneAsset'
    ];
}