<?php
namespace app\assets;

use yii\web\AssetBundle;

class UserPropertyAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
	];
	public $js = [
			'js/userpropertys.js',
	];
	public $depends = [
			'app\assets\ClipOneAsset'
	];
}