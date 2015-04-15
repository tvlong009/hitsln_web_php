<?php


namespace app\assets;

use yii\web\AssetBundle;

class MediaAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/media.js',  
    ];
    public $depends = [
        'app\assets\ClipOneAsset'
    ];
}
