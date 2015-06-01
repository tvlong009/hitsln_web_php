<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\assets;

use yii\web\AssetBundle;

class AssignmentAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = ['css/assignment.css'
    ];
    public $js = [
        'js/assignment.js',  
    ];
    public $depends = [
        'app\assets\ClipOneAsset'
    ];
}