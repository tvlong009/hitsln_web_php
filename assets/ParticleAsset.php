<?php

namespace app\assets;

use yii\web\AssetBundle;

class ParticleAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    'css/jsoneditor/jsoneditor.css'
    ];
    public $js = [
        'js/particles.js',
        'js/jsoneditor/jquery.jsoneditor.js',
    ];
    public $depends = [
        'app\assets\ClipOneAsset'
    ];
}
