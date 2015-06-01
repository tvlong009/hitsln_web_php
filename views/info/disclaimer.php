<?php app\assets\InfoAsset::register($this) ?>
<?php $this->title = "Disclaimer" ?>
<!-- ===========================    CONTENT    =========================== -->

<div class="site_content">

		<!-- Breadcrumb -->
		<div class="breadcrumb_site breadcrumb_terms">
			<div class="container">
				<div class="row">
					<h2>
                        <?php
                        if ($model) {
                            echo $model->title;
                        }
                        ?>
                    </h2>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb -->


		<!-- Box content page -->
		<div class="main_box_content">
			<div class="container">
				<div class="row">	

					<div class="col-md-12 terms_content">
                        <?php
                        if ($model) {
                            echo $model->content;
                        }
                        ?>
					</div>


					

					
					</div>					
				</div>

				
			</div>			
		</div>
		<!-- END:Box content page -->
	
</div>


<!-- ===========================  END CONTENT =========================== -->