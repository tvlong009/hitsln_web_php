<?php
namespace app\assets;

use yii\web\AssetBundle;

class LoginWidgetSettingAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
	];
	public $js = [
			'js/loginwidgetsetting.js',
	];
	public $depends = [
			'app\assets\ClipOneAsset'
	];
}