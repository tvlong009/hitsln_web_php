<?php app\assets\ServiceAsset::register($this) ?>
<!DOCTYPE html>
<html>
    <body>
        <!-- ===========================    CONTENT    =========================== -->
        <div class="site_content">

            <!-- Breadcrumb -->
            <div class="breadcrumb_site breadcrumb_technology">
                <div class="container">
                    <div class="row">
                        <h2>Our technology</h2>
                    </div>
                </div>
            </div>
            <!-- End Breadcrumb -->
            <!-- Box content page -->
            <div class="main_box_content">
                <div class="container">
                    <div class="row">	

                        <div class="col-md-12">
                            <h3 class="title_main_box_content">Objective</h3>
                            <p>To provide a media delivery and streaming platform providing high quality and exceptional reliability and uptime. 
                                This is realized through the combination of state of the art technology and a redundant architecture provide a seamless solution to the objective. 
                            </p>													
                        </div>


                        <div class="col-sm-4 col-md-4 " >
                            <div class="technology_item">
                                <div class="circle_technology">
                                    <img src="<?php echo Yii::$app->urlManager->baseUrl ?>/img/icon/icon_network.png" alt="">
                                </div>
                                <h3>Network</h3>
                                <img src="<?php echo Yii::$app->urlManager->baseUrl ?>/img/icon/icon_technology.png" alt="">
                                <p>Starting with dual 10-Gigabit connections to the Dutch Internet Backbone,	with automatic failover in case one line should fail,	insure reliable customer connections to the network.</p>
                                <a href=""><img src="<?php echo Yii::$app->urlManager->baseUrl ?>/img/icon/readmore.png" alt=""></a>
                                <div class="tech_line"></div>
                            </div>						
                        </div>

                        <div class="col-sm-4 col-md-4">
                            <div class="technology_item">
                                <div class="circle_technology">
                                    <img src="<?php echo Yii::$app->urlManager->baseUrl ?>/img/icon/icon_note_and_mouse.png" alt="">
                                </div>
                                <h3>Hardware</h3>
                                <img src="<?php echo Yii::$app->urlManager->baseUrl ?>/img/icon/icon_technology.png" alt="">
                                <p>Whether the objective is to provide a complete streaming platform as a dedicated service, or as an add-on to your existing web platform to increase customer retention...</p>
                                <a href=""><img src="<?php echo Yii::$app->urlManager->baseUrl ?>/img/icon/readmore.png" alt=""></a>
                                <div class="tech_line"></div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4 ">
                            <div class="technology_item">
                                <div class="circle_technology">
                                    <img src="<?php echo Yii::$app->urlManager->baseUrl ?>/img/icon/icon_earth.png" alt="">
                                </div>
                                <h3>Software</h3>
                                <img src="<?php echo Yii::$app->urlManager->baseUrl ?>/img/icon/icon_technology.png" alt="">
                                <p>Whether the objective is to provide a complete streaming platform as a dedicated service, or as an add-on to your existing web platform to increase customer retention...</p>
                                <a href=""><img src="<?php echo Yii::$app->urlManager->baseUrl ?>/img/icon/readmore.png" alt=""></a>
                            </div>
                        </div>


                    </div>					
                </div>


            </div>			
        </div>
        <!-- END:Box content page -->
        <!-- ===========================  END CONTENT =========================== -->
    </body>
</html>