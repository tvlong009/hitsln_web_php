<?php
namespace app\modules\useractivity\assets;

use yii\web\AssetBundle;

class ActivityAsset extends AssetBundle
{
    public $sourcePath = __DIR__;
    public $css = [
    ];
    public $js = [
        'js/activity.js'
    ];
    public $depends = [
        'app\assets\ClipOneAsset'
    ];
    public $publishOptions = [
        'forceCopy' => true,
    ];
}