<?php

namespace app\modules\languagewidget\assets;

use yii\web\AssetBundle;
use Yii;

class LanguageAsset extends AssetBundle
{
    public $sourcePath = __DIR__;
    public $css = [
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public $publishOptions = [
        'forceCopy' => true,
    ];
}