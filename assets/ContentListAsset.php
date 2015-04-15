<?php

namespace app\assets;

use yii\web\AssetBundle;

class ContentListAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/contentlist.js',  
    ];
    public $depends = [
        'app\assets\ClipOneAsset'
    ];
}
