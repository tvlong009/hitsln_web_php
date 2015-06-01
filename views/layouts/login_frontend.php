<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\LoginLayoutAsset;

/* @var $this \yii\web\View */
/* @var $content string */

LoginLayoutAsset::register($this);
?>

<?php
$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
     <?php $this->head() ?>     
    </head>

    <body>
        <?php $this->beginBody() ?>
        <?= $content; ?> 
        <?php $this->endBody() ?>

    </body>
</html>
<?php $this->endPage() ?>
