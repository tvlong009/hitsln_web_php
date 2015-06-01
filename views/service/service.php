<?php app\assets\ServiceAsset::register($this) ?>
<!DOCTYPE html>
<html>
    <body>
        <!-- ===========================    CONTENT    =========================== -->
        <div class="site_content">
            <!-- Breadcrumb -->
            <div class="breadcrumb_site breadcrumb_service">
                <div class="container">
                    <div class="row">
                        <h2>OUR SERVICES</h2>
                    </div>
                </div>
            </div>
            <!-- End Breadcrumb -->
            <!-- Box content page -->
            <div class="main_box_content">
                <div class="container">
                    <div class="row">	

                        <div class="col-md-12">
                            <h3 class="title_main_box_content">Providing Music Platforms in the Netherlands, Belgiumv and Luxemburg</h3>
                            <p>TargetMusic is a leading provider of music platforms in the Netherlands, Belgium and Luxemburg. Our platforms provide a variety of delivery methods with built in capabilites for online payment processing. Our music catalog encompasses the major record labels, provided a wide variety of international artists and releases as well as renowned local artists. We provide you with the "Data Engine", you provide your customers with your own "Look and Feel".
                            </p>													
                        </div>

                        <div class="col-sm-6 col-md-6  ">
                            <div class="media box_service">

                                <div class="media-left">
                                    <img src="<?php echo Yii::$app->urlManager->baseUrl ?>/img/icon/service_1.png" alt="">
                                </div>

                                <div class="media-body">
                                    <h3><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('service/service-music-streaming') ?>" class="white-link">Music Streaming </a></h3>
                                    <p>Whether the objective is to provide a complete streaming platform as a dedicated service, or as an add-on to your existing web platform to increase customer retention...</p>
                                </div>

                            </div>

                        </div>


                        <div class="col-sm-6 col-md-6  ">
                            <div class="media box_service">

                                <div class="media-left">
                                    <img src="<?php echo Yii::$app->urlManager->baseUrl ?>/img/icon/service_2.png" alt="">
                                </div>

                                <div class="media-body">
                                    <h3><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('service/service-download') ?>" class="white-link"> Music Downloads </a></h3>
                                    <p>Digital Music offers your users flexibility and portability. Users can play their music on any device of their choice and whenever they wish.</p>
                                </div>

                            </div>

                        </div>					
                        <div class="hiden-sx height_300">&nbsp;</div>
                    </div>


                </div>			
            </div>
            <!-- END:Box content page -->

        </div>
        <!-- ===========================  END CONTENT =========================== -->
    </body>
</html>