<?php

use yii\helpers\Html;

//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
//use yii\widgets\Breadcrumbs;
//use kartik\sidenav\SideNav;

/* @var $this \yii\web\View */
/* @var $content string */

app\assets\ClipOneAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="login example1">
        <?php $this->beginBody() ?>
        <div class="main-login col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <div class="logo">Target<i class="fa fa-music"></i>Music
            </div>
            <!-- start: LOGIN BOX -->
            <?= $content ?>
            <!-- start: COPYRIGHT -->
            <div class="copyright">
                <?php echo Yii::t('app', '2015 &copy; copyright by <a  target="_blank" href="http://www.targetmedia.nl/">Target Media</a>.') ?>
            </div>
            <!-- end: COPYRIGHT -->
        </div>
        <?php $this->endBody() ?>
        <?php $this->registerJs('Main.init();Login.init();') ?>
    </body>
</html>
<?php $this->endPage() ?>
