<?php
namespace app\assets;

use yii\web\AssetBundle;

class UserPropertyGroupAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
	];
	public $js = [
			'js/userpropertygroups.js',
	];
	public $depends = [
			'app\assets\ClipOneAsset'
	];
}