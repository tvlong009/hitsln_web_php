<?php app\assets\ServiceAsset::register($this) ?>
<?php $this->title = 'Our Service' ?>
<!DOCTYPE html>
<html>
    <body>
        <!-- ===========================    CONTENT    =========================== -->
        <div class="site_content">

            <!-- Breadcrumb -->
            <div class="breadcrumb_site breadcrumb_service">
                <div class="container">
                    <div class="row">
                        <h2><?=$this->title?></h2>
                    </div>
                </div>
            </div>
            <!-- End Breadcrumb -->

            <!-- Box content page -->
            <div class="main_box_content">
                <div class="container">
                    <div class="row">	

                        <div class="col-md-12">
                            <h3 class="title_main_box_content">
                                <?php
                                if ($model) {
                                    echo $model->title;
                                }
                                ?>
                            </h3>
                        </div>

                        <div class="col-sm-12 col-md-7 justify ">

                            <?php
                            if ($model) {
                                echo $model->content;
                            }
                            ?>

                        </div>


                        <div class="col-sm-12 col-md-5 text_center ">
                            <img src="<?php echo Yii::$app->urlManager->baseUrl ?>/img/music_streaming.png" alt="">
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