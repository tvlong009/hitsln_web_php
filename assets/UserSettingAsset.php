<?php

namespace app\assets;

use yii\web\AssetBundle;

class UserSettingAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/userSetting.js',  
    ];
    public $depends = [
        'app\assets\ClipOneAsset'
    ];
}
