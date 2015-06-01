<?php
namespace app\modules\loginwidget\assets;

use yii\web\AssetBundle;

class LoginSettingAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
    ];
    public $depends = [
        'app\assets\ClipOneAsset'
    ];
}