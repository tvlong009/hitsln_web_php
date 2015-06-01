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
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">
                <?php echo Html::img('@web/img/logo_xs.png'); ?>
            </a>

        </div>
        <!-- /.navbar-header -->
        <div class="search_top_bar">
            <form class="navbar-form navbar-left" method="GET" role="search">
                <i class="icon-search"></i>
                <div class="form-group">
                    <input type="text" name="q" class="form-control" placeholder="Search">
                </div>
            </form>
        </div>

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown hit_noti">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i>
                    <!-- <i class="fa fa-caret-down"></i> -->
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="pull-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> Message Sent
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-tasks fa-fw"></i> New Task
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-alerts -->
            </li>
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse position_relative">
                <!-- Side bar menu-->
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="home.html"><i class="fa fa-home icon_parent"></i> Home </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-music icon_parent"></i> HitsNL Top 30
                            <span class="fa arrow"></span></a>

                        <ul class="nav nav-second-level">
                            <li class="active">
                                <a href="#">
                                    <i class="fa fa-life-buoy icon_child"></i> Something....
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-life-buoy icon_child"></i> Something....
                                </a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-bar-chart-o icon_parent"></i> Aanbevolen
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="album.html">
                                    <i class="icon-cd icon_child"></i>
                                    Album
                                </a>
                            </li>
                            <li>
                                <a href="buttons.html">
                                    <i class="icon-users icon_child"></i>
                                    Artiesten</a>
                            </li>
                            <li>
                                <a href="notifications.html">
                                    <i class="icon-list icon_child"></i>
                                    Playlisten
                                </a>
                            </li>
                            <li>
                                <a href="typography.html">
                                    <i class="fa fa-database icon_child"></i>
                                    Tracks</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                    <li  class="active">

                        <a  href="#">
                            <i class="fa fa-heart-o icon_parent"></i>
                            Mijn Favorieten
                            <span class="fa arrow"></span></a>

                        <ul class="nav nav-second-level">
                            <li>
                                <a href="album.html">
                                    <i class="icon-cd icon_child"></i>
                                    Album
                                </a>
                            </li>
                            <li class="active">
                                <a href="buttons.html">
                                    <i class="icon-users icon_child"></i>
                                    Artiesten</a>
                            </li>
                            <li>
                                <a href="notifications.html">
                                    <i class="icon-list icon_child"></i>
                                    Playlisten
                                </a>
                            </li>
                            <li>
                                <a href="typography.html">
                                    <i class="fa fa-database icon_child"></i>
                                    Tracks</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                </ul>
                <!--END: Side bar menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
    <!-- ===================== END:TOPBAR AND SIDE BAR =====================-->
    <!-- /.Setting player -->
    <div class="player_side_bar">
        <div class="title_player">
            MUSIC PLAYER
        </div>
        <div class="cover_player">
            <?php echo Html::img('@web/img/cover_player.jpg') ?>
        </div>
        <div class="info_song">
            Garth Brooks <br>
            Comeback album
        </div>
        <div class="player_bar_song">
            <?php echo Html::img('@web/img/player.png') ?>
        </div>
    </div>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row top_bar_content" >

                <!-- ==========    Top Banner COntent ==========    -->
                <div class="col-lg-10">
                    <div class="banner_content">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">


                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
<!--                                    <img src="img/banner/1.jpg" alt="">-->
                                    <?php echo Html::img('@web/img/banner/1.jpg') ?>
                                </div>
                                <div class="item">
<!--                                    <img src="img/banner/1.jpg" alt="">-->
                                    <?php echo Html::img('@web/img/banner/1.jpg') ?>
                                </div>
                            </div>

                        </div>
                        <!-- End slide -->
                    </div>
                </div>
                <!-- End left column -->

                <div class="col-lg-2 position_relative">
                    <div class="menu_right_bar_absolute">
                        <ul class="nav" id="right-menu">
                            <li>
                                <a href="myaccount.html">
                                    <i class="fa fa-home icon_parent"></i> My Account </a>
                            </li>

                            <li>
                                <a href="myaccount.html">
                                    <i class="fa fa-paper-plane icon_parent"></i> Promotion </a>
                            </li>

                            <li>
                                <a href="myaccount.html">
                                    <i class="fa fa-gear icon_parent"></i> Settings </a>
                            </li>

                            <li>
                                <a href="myaccount.html">
                                    <i class="fa fa-bullhorn icon_parent"></i> Radio </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-ellipsis-h  icon_parent"></i> More
                                    <span class="fa arrow"></span>
                                </a>

                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="album.html">
                                            <i class="fa fa-ellipsis-h icon_child"></i>
                                            Album
                                        </a>
                                    </li>
                                    <li>
                                        <a href="buttons.html">
                                            <i class="icon-users icon_child"></i>
                                            Artiesten</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>

                        </ul>
                    </div>
                </div>
                <!-- End right column -->

                <div class="col-lg-12 main_content_page"> <!--start content -->
                    <?php echo $content ?>
                </div><!--end content -->
            </div>
        </div>
    </div>
    <!-- /.Setting player -->
    <!-- ===================== Page Content =====================-->
</div>
<!-- Menu of item -->
<div class="menu_right_click">
    <div class="line_3_color">&nbsp;</div>
    <ul class="list-group">
        <li class="list-group-item"><a href="#">Play</a></li>
        <li class="list-group-item menu_right_click_child">
            <a href="#">Add to Playlisten</a>
            <i class="fa fa-angle-right pull-right"></i>
            <ul class="list-group">
                <li class="list-group-item"><a href="#">Play</a></li>
                <li class="list-group-item"><a href="#">Add to Playlisten</a></li>
                <li class="list-group-item"><a href="#">Add to Favorieten</a></li>
                <li class="list-group-item"><a href="#">Share</a></li>
            </ul>
        </li>
        <li class="list-group-item menu_right_click_child">
            <i class="fa fa-angle-right pull-right"></i>
            <a href="#">Add to Favorieten</a>
            <ul class="list-group">
                <li class="list-group-item"><a href="#">Play</a></li>
                <li class="list-group-item"><a href="#">Add to Playlisten</a></li>
                <li class="list-group-item"><a href="#">Add to Favorieten</a></li>
                <li class="list-group-item"><a href="#">Share</a></li>
            </ul>
        </li>
        <li class="list-group-item"><a href="#">Share</a></li>
    </ul>
</div>

<!-- END:Menu of item -->
<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

