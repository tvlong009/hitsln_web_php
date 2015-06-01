<?php


namespace app\assets;

use yii\web\AssetBundle;

class PartnerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/partner.js',  
    ];
    public $depends = [
        'app\assets\ClipOneAsset'
    ];
}
