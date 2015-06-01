<?php app\assets\InfoAsset::register($this); ?>
<!-- ===========================    CONTENT    =========================== -->

<div class="site_content">

    <!-- Breadcrumb -->
    <div class="breadcrumb_site breadcrumb_partner">
        <div class="container">
            <div class="row">
                <h2><?php echo Yii::t('app', 'Our Partners'); ?></h2>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->


    <!-- Box content page -->
    <div class="main_box_content">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <h3 class="title_main_box_content"><?php echo Yii::t('app', 'To provide the best reliability and quality we have teamed up
                        with technology
                        leaders in Hardware, Software and Systems support.') ?></h3>
                </div>


                <?php
                $wrapper = '<div class="col-md-12 margin_top_50">{item}</div>';
                $itemTemplate = '
                    <div class="col-md-4 parter_item"
                         data-toggle="popover"
                         title="Popover title"
                         data-placement="top"
                         data-content="{description}<br><br> <a href=\'{url}\' class=\'btn-yellow\'>Website</a>">
                        <img src="{imageUrl}" alt="">
                        <img src="' . Yii::$app->urlManager->baseUrl . '/img/bg_box_partner.png" alt="">
                    </div>
                ';
                echo \app\modules\cmsparticles\widgets\PartnerWidget::widget(array(
                    'wrapper' => $wrapper,
                    'itemTemplate' => $itemTemplate,
                ));
                ?>

                <!-- End Column Right -->


            </div>


        </div>
    </div>
    <!-- END:Box content page -->

</div>


<!-- ===========================  END CONTENT =========================== -->