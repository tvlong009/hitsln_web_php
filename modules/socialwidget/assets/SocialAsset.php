<?php
namespace app\modules\socialwidget\assets;

use yii\web\AssetBundle;

class SocialAsset extends AssetBundle
{
    public $sourcePath = __DIR__;
    public $css = [
        'css/social.css',
    ];
    public $js = [
        'js/social.js',
    ];
    public $depends = [
        'app\assets\ClipOneAsset'
    ];
}