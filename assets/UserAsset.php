<?php

namespace app\assets;

use yii\web\AssetBundle;

class UserAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/users.js',  
    ];
    public $depends = [
        'app\assets\ClipOneAsset'
    ];
}
