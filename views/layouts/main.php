<?php

use yii\helpers\Html;
use app\assets\ClipOneAsset;

/* @var $this \yii\web\View */
/* @var $content string */

$bundle = ClipOneAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="" name="description" />
        <meta content="" name="Target Media BV" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <?php $this->registerCssFile('@web/clipone/assets/css/print.css', ['media' => 'print']); ?>        
        <?php $this->registerCssFile('clipone/assets/plugins/font-awesome/css/font-awesome-ie7.min.css', ['condition' => 'lte IE7']); ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <!-- start: HEADER -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <!-- start: TOP NAVIGATION CONTAINER -->
            <div class="container">
                <div class="navbar-header">
                    <!-- start: RESPONSIVE MENU TOGGLER -->
                    <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="clip-list-2"></span>
                    </button>
                    <!-- end: RESPONSIVE MENU TOGGLER -->
                    <!-- start: LOGO -->
                    <a class="navbar-brand" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/site/logout'); ?>">
                        <?= Yii::t('app', 'Target<i class="fa fa-music"></i>Music') ?>
                    </a>
                    <!-- end: LOGO -->
                </div>
                <div class="navbar-tools">
                    <!-- start: TOP NAVIGATION MENU -->
                    <ul class="nav navbar-right">
                        <?php if(!empty(Yii::$app->controller->__languages)) { ?>
                        <li>
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                                <i class="clip-earth-2"></i> <?= Yii::t('app', 'Language') ?>
                                <!-- <span class="badge"> 12</span> -->
                            </a>
                            <ul class="dropdown-menu todo">
                                <li>
                                    <span class="dropdown-menu-title"> <?= Yii::t('app', 'Choose language') ?></span>
                                </li>
                                
                                <li>
                                    <div class="drop-down-wrapper">
                                        <ul>
                                            <?php foreach(Yii::$app->controller->__languages as $lang){ ?>
                                            <li>
                                                <a class="todo-actions" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/backend/change-lang/') . '?lang=' .$lang['code']; ?>">
                                                    <span class="desc" style="opacity: 1; text-decoration: none;"><strong><?php echo $lang['name'] ?></strong></span>
                                                    <span class="label flag_label" style="opacity: 1;">
                                                        <img src="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/clipone/assets/images/flag/<?php echo $lang['code'] ?>.png" alt="">
                                                    </span>
                                                </a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <?php } ?>
                        <!-- end: Language DROPDOWN-->
                        <!-- start: USER DROPDOWN -->
                        <?php
                        if (!Yii::$app->user->isGuest) {
                            ?>
                            <li class="dropdown current-user">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="javascript:void(0)">
                                    <img src="<?php
                                    if (Yii::$app->user->identity->avatar == '') {
                                        echo Yii::$app->urlManager->getBaseUrl() . '/clipone/assets/images/avatar-null-small.jpg';
                                    } else {
                                        echo Yii::$app->urlManager->getBaseUrl() . '/upload' . Yii::$app->user->identity->avatar;
                                    }
                                    ?>" class="circle-img" alt="">
                                    <span class="username"><?php echo Yii::$app->user->identity->username; ?></span>
                                    <i class="clip-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#">
                                            <i class="clip-user-2"></i>
                                            &nbsp;<?= Yii::t('app', 'My Profile') ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="clip-calendar"></i>
                                            &nbsp;<?= Yii::t('app', 'My Calendar') ?>
                                        </a>
                                    <li>
                                        <a href="#">
                                            <i class="clip-bubble-4"></i>
                                            &nbsp;<?= Yii::t('app', 'My Messages') ?> (3)
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#"><i class="clip-locked"></i>
                                            &nbsp;<?= Yii::t('app', 'Lock Screen') ?> </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/site/logout'); ?>" data-method="post">
                                            <i class="clip-exit"></i>
                                            &nbsp;<?= Yii::t('app', 'Log Out') ?>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- end: USER DROPDOWN -->
                        <?php } ?>
                    </ul>
                    <!-- end: TOP NAVIGATION MENU -->
                </div>
                <!-- end: TOP NAVIGATION MENU -->
            </div>
            <!-- end: TOP NAVIGATION CONTAINER -->
        </div>
        <!-- end: HEADER -->
        <!-- start: MAIN CONTAINER -->
        <div class="main-container">
            <!-- start: SIDEBAR -->
            <div class="main-navigation navbar-collapse collapse">
                <!-- start: MAIN MENU TOGGLER BUTTON -->
                <div class="navigation-toggler">
                    <i class="clip-chevron-left"></i>
                    <i class="clip-chevron-right"></i>
                </div>
                <!-- end: MAIN MENU TOGGLER BUTTON -->
                <!-- start: MAIN NAVIGATION MENU -->
                <ul class="main-navigation-menu">
                    <li <?php echo Yii::$app->controller->id == 'site' ? 'class="active open"' : '' ?>>
                        <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('') ?>"><i class="clip-home-3"></i>
                            <span class="title"> <?= Yii::t('app', 'Home') ?> </span><span class="selected"></span>
                        </a>
                    </li>
                    <li <?php echo Yii::$app->controller->id == 'pages' ? 'class="active open"' : '' ?>>
                        <a href="javascript:void(0)"><i class="clip-screen"></i>
                            <span class="title"> <?= Yii::t('app', 'Pages') ?> </span><i class="icon-arrow"></i>
                            <span class="selected"></span>
                        </a>
                        <ul class="sub-menu">
                            <li <?php echo (Yii::$app->controller->action->id == 'index' && Yii::$app->controller->id == 'pages') ? 'class="active"' : '' ?> >
                                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('pages') ?>">
                                    <span class="title"> <?= Yii::t('app', 'All pages') ?> </span>
                                </a>
                            </li>                            
                            <li <?php echo (in_array(Yii::$app->controller->action->id, array('add', 'edit')) && Yii::$app->controller->id == 'pages') ? 'class="active"' : '' ?>>
                                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('pages/add') ?>">
                                    <span class="title"> <?= Yii::t('app', 'Add new page') ?> </span>
                                    <span class="badge badge-new"><?= Yii::t('app', 'new') ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo Yii::$app->controller->id == 'media' ? 'class="active open"' : '' ?>>
                        <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('media') ?>"><i class="clip-grid-6"></i>
                            <span class="title"> <?= Yii::t('app', 'Media') ?> </span>
                            <span class="selected"></span>
                        </a>                        
                    </li>
                    <li <?php echo (Yii::$app->controller->id == 'particles' || in_array(Yii::$app->controller->id, ['partner', 'portfolio', 'content-list'])) ? 'class="active open"' : '' ?>>
                        <a href="javascript:void(0)"><i class="clip-pencil"></i>
                            <span class="title">   <?= Yii::t('app', 'Particles') ?> </span><i class="icon-arrow"></i>
                            <span class="selected"></span>
                        </a>
                        <ul class="sub-menu">
                            <li <?php echo (Yii::$app->controller->action->id == 'index' && Yii::$app->controller->id == 'particles') ? 'class="active"' : '' ?>>
                                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('particles') ?>">
                                    <span class="title"> <?= Yii::t('app', 'Library') ?></span>
                                </a>
                            </li>
                            <li <?php echo in_array(Yii::$app->controller->id, ['partner', 'portfolio', 'content-list']) ? 'class="active open"' : '' ?>>
                                <a href="javascript:void(0)">
                                    <span class="title">   <?= Yii::t('app', 'Widgets') ?> </span><i class="icon-arrow"></i>
                                    <span class="selected"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li <?php echo Yii::$app->controller->id == 'partner' ? 'class="active"' : '' ?>>
                                        <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('cmsparticles/partner') ?>">
                                            <span class="title"> <?= Yii::t('app', 'Partner') ?></span>
                                        </a>
                                    </li>
                                    <li <?php echo Yii::$app->controller->id == 'portfolio' ? 'class="active"' : '' ?>>
                                        <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('cmsparticles/portfolio') ?>">
                                            <span class="title"> <?= Yii::t('app', 'Portfolio') ?></span>
                                        </a>
                                    </li>
                                    <li <?php echo Yii::$app->controller->id == 'content-list' ? 'class="active"' : '' ?>>
                                        <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('cmsparticles/content-list') ?>">
                                            <span class="title"> <?= Yii::t('app', 'Content list') ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li <?php echo (in_array(Yii::$app->controller->action->id, array('create', 'upldate')) && Yii::$app->controller->id == 'particles') ? 'class="active"' : '' ?>>
                                <a href="<?php echo Yii::$app->urlManager->createUrl('particles/create'); ?>">
                                    <span class="title"> <?= Yii::t('app', 'Create particles') ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo Yii::$app->controller->id == 'languages' ? 'class="active open"' : '' ?>>
                        <a href="javascript:void(0)"><i class="clip-file"></i>
                            <span class="title">  <?= Yii::t('app', 'Languages') ?></span><i class="icon-arrow"></i>
                            <span class="selected"></span>
                        </a>
                        <ul class="sub-menu">
                            <li <?php echo (Yii::$app->controller->action->id == 'index' && Yii::$app->controller->id == 'languages') ? 'class="active"' : '' ?>>
                                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('languages') ?>">
                                    <span class="title"> <?= Yii::t('app', 'Library') ?></span>
                                </a>
                            </li>
                            <li <?php echo (in_array(Yii::$app->controller->action->id, array('create', 'update')) && Yii::$app->controller->id == 'languages') ? 'class="active"' : '' ?>>
                                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('languages/create') ?>">
                                    <span class="title"> <?= Yii::t('app', 'Create languages') ?></span>
                                </a>
                            </li>
                            
                                <li <?php echo (Yii::$app->controller->action->id == 'languagesetting' && Yii::$app->controller->id == 'languages') ? 'class="active"' : '' ?>>
                                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('languages/languagesetting') ?>">
                                    <span class="title"> <?= Yii::t('app', 'Translate languages') ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo in_array(Yii::$app->controller->id, array('users', 'roles', 'permission', 'assignment')) ? 'class="active open"' : '' ?>>
                        <a href="javascript:void(0)"><i class="clip-user-2 "></i>
                            <span class="title">   <?= Yii::t('app', 'Accounts') ?></span><i class="icon-arrow"></i>
                            <span class="selected"></span>
                        </a>
                        <ul class="sub-menu">
                            <li <?php echo ( Yii::$app->controller->id == 'users') ? 'class="active"' : '' ?>>
                                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('users'); ?>">
                                    <span class="title"><?= Yii::t('app', 'Users') ?></span>
                                </a>
                            </li>
                            <li <?php echo (Yii::$app->controller->id == 'roles') ? 'class="active"' : '' ?>>
                                <a href="<?php echo Yii::$app->urlManager->createUrl('roles') ?>">
                                    <span class="title"> <?= Yii::t('app', 'Roles') ?></span>
                                </a>
                            </li>
                            <li <?php echo (Yii::$app->controller->id == 'assignment') ? 'class="active"' : '' ?>>
                                <a href="<?php echo Yii::$app->urlManager->createUrl('assignment') ?>">
                                    <span class="title"> <?= Yii::t('app', 'Assignment') ?></span>
                                </a>
                            </li>
                            <li <?php echo (Yii::$app->controller->id == 'permission') ? 'class="active"' : '' ?>>
                                <a href="<?php echo Yii::$app->urlManager->createUrl('permission') ?>">
                                    <span class="title"> <?= Yii::t('app', 'Permission') ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo (Yii::$app->controller->id == 'setting') ? 'class="active"' : '' ?>>
                        <a href="<?php echo Yii::$app->urlManager->createUrl('setting') ?>">
                            <i class="clip-cogs "></i>
                            <span class="title"> <?= Yii::t('app', 'Setting') ?></span>
                        </a>
                    </li>
                </ul>
                <!-- end: MAIN NAVIGATION MENU -->
            </div>
            <!-- end: SIDEBAR -->
            <!-- start: PAGE -->
            <div class="main-content">
                <div class="container">
                    <!-- start: PAGE HEADER -->
                    <div class="row">
                        <div class="col-sm-12">                            
                            <!-- start: PAGE TITLE & BREADCRUMB -->
                            <?=
                            yii\widgets\Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ]);
                            ?>
                            <div class="page-header">
                                <h1><?= $this->title ?> <small><?= $this->title ?></small></h1>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <!-- end: PAGE HEADER -->
                    <!-- ============================================ -->
<?php echo $content ?>
                </div>
            </div>
            <!-- end: PAGE -->
        </div>
        <!-- end: MAIN CONTAINER -->
        <!-- start: FOOTER -->
        <div class="footer clearfix">
            <!-- start: COPYRIGHT -->
            <div class="copyright">
                2015 &copy; copyright by <a  target="_blank" href="http://www.targetmedia.nl/"><?= Yii::t('app', 'Target Media') ?></a>.
            </div>
            <!-- end: COPYRIGHT -->
            <div class="footer-items">
                <span class="go-top"><i class="clip-chevron-up"></i></span>
            </div>
        </div>
        <!-- end: FOOTER -->
        <!-- start: MAIN JAVASCRIPTS -->
        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.min.js"></script>
        <script src="assets/plugins/excanvas.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <![endif]-->
        <!--[if gte IE 9]><!-->
        <script type="text/javascript">
            var root_url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/'); ?>";
        </script>
<?php $this->endBody() ?>
<?php $this->registerJs('Main.init();') ?>
    </body>
</html>
<?php $this->endPage() ?>
