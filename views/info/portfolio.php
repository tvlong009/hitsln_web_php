<?php app\assets\InfoAsset::register($this); ?>
<!-- ===========================    CONTENT    =========================== -->

<div class="site_content">

		<!-- Breadcrumb -->
		<div class="breadcrumb_site breadcrumb_portfolio">
			<div class="container">
				<div class="row">
					<h2><?php echo Yii::t('app', 'Portfolio'); ?></h2>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb -->


		<!-- Box content page -->
		<div class="main_box_content">
			<div class="container">
				<div class="row">	

					<div class="col-md-12">
						<h3 class="title_main_box_content"><?php echo Yii::t('app', 'Portfolio'); ?></h3>
					</div>

                    <?php
                    $wrapper = '<div class="col-sm-12 col-md-12 no_padding portfolio_box">{item}</div>';
                    $itemTemplate = '
                        <div class="col-sx-12 col-sm-6 col-md-6 col-lg-4 portfolio_item">
                            <span data-toggle="modal" data-target="#{id}">
                            <i class="fa fa fa-eye"></i></span>
                            <img src="{imageUrl}">
                            <p>{name}</p>
                            <div class="portfolio_line"></div>
                        </div>
                        <div class="modal fade" id="{id}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content model_porfolio">
                                <div class="col-md-12"> <a data-dismiss="modal">Close <i class="fa fa-close"></i></a></div>
                                <div class="col-md-7">
                                    <img src="{imageUrl}" alt="">
                                </div>
                                <div class="col-md-5">
                                    <h4>{name}</h4>
                                    <i>{name}</i>
                                    <div class="portfolio_popup_line">&nbsp;</div>
                                    <p>{description}.</p>
                                    <a class="btn btn-yellow" href="{url}">'.Yii::t('app', 'Website').'</a>
                                </div>
                            </div>
                          </div>
                        </div>
                    ';
                    echo \app\modules\cmsparticles\widgets\PortfolioWidget::widget(array(
                        'wrapper' => $wrapper,
                        'itemTemplate' => $itemTemplate,
                    ));
                    ?>

				</div>
			</div>			
		</div>
		<!-- END:Box content page -->

</div>
<!-- ===========================  END CONTENT =========================== -->