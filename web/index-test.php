<?php

// NOTE: Make sure this file is not accessible when deployed to production
if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
    die('You are not allowed to access this file.');
}

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

$oldmask = umask(0);
if(!is_dir('../runtime/uploads'))
  mkdir('../runtime/uploads', 0766);
if(!is_dir('../runtime/files'))
  mkdir('../runtime/files', 0766);
if(!is_dir('../runtime/web'))
  mkdir('../runtime/web', 0766);
umask($oldmask);

require('../vendor/autoload.php');
require('../vendor/yiisoft/yii2/Yii.php');

$config = require('../tests/codeception/config/acceptance.php');

(new yii\web\Application($config))->run();
