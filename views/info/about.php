<?php app\assets\InfoAsset::register($this) ?>
<?php $this->title = "About us" ?>

<!-- ===========================    CONTENT    =========================== -->

<div class="site_content">

    <!-- Breadcrumb -->
    <div class="breadcrumb_site breadcrumb_about">
        <div class="container">
            <div class="row">
                <h2><?= $this->title ?></h2>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->


    <!-- Box content page -->
    <div class="main_box_content">
        <div class="container">
            <div class="row bg_about">
                <div class="col-sm-7 col-md-7 ">
                    <h3 class="title_main_box_content">About</h3>

                    <div class="justify">
                        <!--content -->
                        <?php
                        if ($model) {
                            echo $model->content;
                        }
                        ?>
                    </div>
                    <button class="btn btn-yellow"> Information Request</button>

                    <div class="height_200"></div>
                </div>


                <!-- Slide -->

                <?php echo app\modules\slidewidget\widgets\SlideWidget::widget(['name' => 'abc']) ?>

                <!-- End slide -->


            </div>
        </div>
    </div>
    <!-- END:Box content page -->

</div>


<!-- ===========================  END CONTENT =========================== -->