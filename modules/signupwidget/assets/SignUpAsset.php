<?php

namespace app\modules\signupwidget\assets;

use yii\web\AssetBundle;
use Yii;

class SignUpAsset extends AssetBundle
{
    public $sourcePath = __DIR__;
    public $css = [

    ];
    public $js = [
        'js/signup.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public $publishOptions = [
        'forceCopy' => true,
    ];
}