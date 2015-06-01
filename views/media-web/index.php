<?php app\assets\MediaFrontendAsset::register($this) ?>
<!-- ===========================    CONTENT    =========================== -->

<div class="site_content">

		<!-- Breadcrumb -->
		<div class="breadcrumb_site breadcrumb_terms">
			<div class="container">
				<div class="row">
					<h2><?php echo Yii::t('app', 'MUSIC LABELS') ?></h2>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb -->


		<!-- Box content page -->
		<div class="main_box_content">
			<div class="container">
				<div class="row">	

					<div class="col-md-12">
						<h3 class="title_main_box_content"><?php echo Yii::t('app', 'Our Partnership with the Music Labels Insures Quality Content') ?></h3>
					</div>

					<!--content-->
                    <?php
                    $itemTemplate = '
                        <div class="col-sm-12  col-md-12 box_music_label">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="{imageUrl}">
                            </div>
                            <div class="col-md-7 bottom_yellow">
                                <div class="text_info_music_label scroll_bar">
                                {description}
                                </div>

                            </div>
                        </div>
                    </div>
                    ';
                    echo \app\modules\cmsparticles\widgets\PartnerWidget::widget(array(
                        'wrapper' => '<div id="content">{item}</div>',
                        'itemTemplate' => $itemTemplate
                    )); ?>

									
				</div>

				
			</div>			
		</div>
		<!-- END:Box content page -->
	
</div>