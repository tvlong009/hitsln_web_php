<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\MainLayoutAsset;

/* @var $this \yii\web\View */
/* @var $content string */

MainLayoutAsset::register($this);
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
                        <img src="img/logo_xs.png" alt="">
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

                            <li   class="active">

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
                    <img src="img/cover_player.jpg" alt="">
                </div>
                <div class="info_song">
                    Garth Brooks <br>
                    Comeback album
                </div>
                <div class="player_bar_song">
                    <img src="img/player.png" alt="">
                </div>
            </div>
            <!-- /.Setting player -->

                        <!-- ==========   End Top Banner COntent ==========    -->
                    <!-- ==========   Start COntent ==========    --> 
                    <?= $content; ?>  
                    <!-- ==========   END COntent ==========    --> 

        </div>
        <!-- /#wrapper -->
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

