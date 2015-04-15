<?php

namespace app\assets;

use yii\web\AssetBundle;

class RoleAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/roles.js',  
    ];
    public $depends = [
        'app\assets\ClipOneAsset'
    ];
}
