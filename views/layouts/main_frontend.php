<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\FrontendAsset;

/* @var $this \yii\web\View */
/* @var $content string */

FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<?php
    $controller = Yii::$app->controller->id;
    $action = Yii::$app->controller->action->id;
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>

<?php $this->beginBody() ?>
            <!-- Menu for PC -->
        <nav class="navbar navbar-default menu">

            <div class="container">

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header logo">
                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/home') ?>">
                        <img class="logo" src="<?php echo Yii::$app->urlManager->baseUrl ?>/img/logo.png" alt="Logo"></a>
                </div>
                <!-- End logo -->


                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse">


                    <?php
                    echo \app\modules\menuwidget\widgets\MenuWidget::widget(array(
                        'menuKey' => 'Main',
                        'classRootMenu' => 'nav navbar-nav',
                        'idRootMenu' => 'menu_pc',
                        'activeClass' => 'active_page'
                    ));
                    ?>
                    <!--END  Menu right -->


                    <ul class="nav navbar-nav navbar-right flag_menu">
                        <?php foreach(Yii::$app->controller->__languages as $lang){ ?>
                        <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/frontend/change-lang?lang='.$lang['code']); ?>">
                            <img src="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/flag/<?php echo $lang['code'] ?>.png" alt="Flag">
                        </a>
                        <?php }?>
                    </ul>  <!-- Flag -->


                </div><!-- /.navbar-collapse -->


            </div><!-- /.container- -->

        </nav>
        <!-- End Menu BLock PC -->



        <!-- Menu mobile -->

        <nav class="navbar navbar-default menu_mobile">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <img class="menu_item" src="<?php echo Yii::$app->urlManager->baseUrl ?>/img/nav.png" alt="" data-toggle="collapse" data-target="#menu_monile_text" >
            </div>

            <div class="logo_mobile">
                <img  src="<?php echo Yii::$app->urlManager->baseUrl ?>/img/logo.png" alt="Logo">
                <!-- End logo -->
            </div>

            <div class="nav navbar-nav navbar-right flag_menu">
                <?php foreach(Yii::$app->controller->__languages as $lang){ ?>
                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/frontend/change-lang/') . '&lang='.$lang['code']; ?>">
                    <img src="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/flag/<?php echo $lang['code'] ?>.png" alt="Flag">
                </a>
                <?php }?>
            </div>
            <!-- Flag -->

            <div class="collapse navbar-collapse" id="menu_monile_text">

                <ul class="nav navbar-nav ">
                    <li ><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('info/about') ?>">About us</a></li>
                    <li ><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('media/') ?>">Music labels</a></li>
                    <li ><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('service/') ?>">Our services</a></li>
                    <li class="active_page"  ><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('service/technology') ?>">Our technology</a></li>
                    <li  ><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('info/portfolio') ?>">Our portfolio</a></li>
                </ul>
                <!--END  Menu right -->

            </div><!-- /.navbar-collapse -->

        </nav>

        <!-- End menu mobile -->

            <!-- Content to be rendered -->
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <div class="content">
                    <?= $content ?>
                </div>
            <!-- end Content -->

        <footer>
            <div class="footer_line">
                <div class="container">
                    <div class="col-xs-12 col-sm-4 col-md-4  big_text">
                        <div class="display-table">
                            <p class="display-cell"><?php echo Yii::t('app', 'SIGN UP FOR OUR NEWSLETTER'); ?></p>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-5 col-md-4 display-table">

                        <div class="input-append" style="padding-top:15px">
                            <?php echo app\modules\newsletterwidget\widgets\NewsletterWidget::widget(array('template' => '{input}<button type="submit" class="btn btn-danger">'.Yii::t('app', 'SIGN UP').'</button>'));
                            ?>
                        </div>


                    </div>

                    <div class="col-xs-12 col-sm-3 col-md-4  icon_footer ">
                        <div class="display-table">
                            <div class="display-cell">
                                <?php echo app\modules\socialwidget\widgets\SocialWidget::widget()?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- END FOOTER LINE -->


            <div class="footer_menu">
                <div class="container">
                    <div class="col-xs-12" style="padding-left: 0; padding-right: 0">
                    <div class="col-xs-12 col-sm-12 col-md-3">
                        <p class="big_text"><strong>What is TargetMusic?</strong></p>
                        <p>
                            TargetMusic is based in Huizen. It began its operations in 2004 and was a supplier of the Planet Music platform, one of the firs tfaaudio streaming platforms in the Netherlands.
                        </p>
                    </div>

<!--                    <div class="col-xs-12 col-sm-4 col-md-3">-->
<!--                        <p class="big_text"><strong> <span class="under_footer"> Our </span> Company</strong></p>-->
<!--                        <ul>-->
<!--                            <li><a href="">Contact Us</a></li>-->
<!--                            <li><a href="">Our Services</a></li>-->
<!--                            <li><a href="">Our Technology</a></li>-->
<!--                            <li><a href="">Our Partners</a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!---->
<!--                    <div class="col-xs-12 col-sm-4 col-md-3">-->
<!--                        <p class="big_text"><strong><span class="under_footer"> Pro</span>jects</strong></p>-->
<!--                        <ul>-->
<!--                            <li><a href="">Download</a></li>-->
<!--                            <li><a href="">Streaming</a></li>-->
<!--                            <li><a href="">New Releases</a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!---->
<!--                    <div class="col-xs-12 col-sm-4 col-md-3">-->
<!--                        <p class="big_text"><strong><span class="under_footer">Terms</span> and Conditions</strong></p>-->
<!--                        <ul>-->
<!--                            <li><a href="">Terms & Conditions</a></li>-->
<!--                            <li><a href="">Disclaimer</a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
                    <?php echo \app\modules\quicklinkwidget\widgets\QuickLinkWidget::widget(); ?>
                    </div>
                </div>
            </div>


            <div class="footer_end">
                <div class="container">
                    <div class="col-xs-12">
                        © 2014 Target Music
                    </div>
                </div>
            </div>

        </footer>
<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

