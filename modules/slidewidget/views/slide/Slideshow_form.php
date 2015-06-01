<?php app\assets\SlideshowAsset::register($this) ?>
<?php

use yii\helpers\Html; ?>
<!-- ============================================ -->

<div class="row">
    <div class="col-sm-12">

        <!-- start: FORM WIZARD PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?php echo Yii::t('app', 'Slide and Item Setting'); ?>             
            </div>
            <div class="panel-body">

                <?php
                /* @var $this yii\web\View */

                $this->title = Yii::t('app', 'Slide and item setting');
                $this->params['breadcrumbs'][] = $this->title;
                ?>
                <!--content       -->
<div id="divdeps" style="display:none" title=""></div>
                <br />
                <div class="row">

                    <div class="dual-list list-left col-md-6">
                        <div class="well text-right">

                            <div class="row">
                                <div class="col-md-12  pull-right">
                                    <div class="btn-group">
                                        <button title="create a slide" type="button" 
                                                class="create_slide btn btn-success glyphicon glyphicon-plus fa" style="
                                                font-size: 19px;
                                                width: 40px;
                                                height: 34px; margin-top: -1px"
                                                value="btn-success"></button>
                                        <button style="
                                                font-size: 18px;
                                                width: 40px;
                                                height: 34px; margin-top: -2 px" class="btn btn-sm btn-warning fa" 
                                                type="button" data-original-title="Edit slide">
                                            <i class="glyphicon glyphicon-edit"></i></button>
                                        <button style="
                                                font-size: 19px;
                                                width: 40px;
                                                height: 34px; margin-top: -2 px" class="btn btn-danger fa" type="button"
                                                data-toggle="tooltip"
                                                data-original-title="Remove slides"><i class="icon-remove icon-white"></i></button>
                                        <a class="btn btn-default selector" title="select all"><i class="glyphicon glyphicon-unchecked"></i></a>
                                    </div>
                                </div>

                            </div>
                            <div class="User_list" style="overflow: auto; height: 400px;">
                                <ul class="list-group slide_list">
                                    <!--                                            Slide List-->
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="dual-list list-right col-md-6">
                        <div class="well">
                            <div class="row">
                                <div class="col-md-12 ">
                                      <div class="btn-group pull-right">
                                        <button title="create a slide" type="button" 
                                                class="create_slide btn btn-success glyphicon glyphicon-plus fa" style="
                                                font-size: 19px;
                                                width: 40px;
                                                height: 34px; margin-top: -1px"
                                                value="btn-success"></button>
                                        <button style="
                                                font-size: 18px;
                                                width: 40px;
                                                height: 34px; margin-top: -2 px" class="btn btn-sm btn-warning fa" 
                                                type="button" data-original-title="Edit slide">
                                            <i class="glyphicon glyphicon-edit"></i></button>
                                        <button style="
                                                font-size: 19px;
                                                width: 40px;
                                                height: 34px; margin-top: -2 px" class="btn btn-danger fa" type="button"
                                                data-toggle="tooltip"
                                                data-original-title="Remove slides"><i class="icon-remove icon-white"></i></button>
                                        <a class="btn btn-default selector" title="select all"><i class="glyphicon glyphicon-unchecked"></i></a>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="User_list" style="overflow: auto; height: 400px;">
                                <ul class="list-group item_list">
                                    <!--                                    Items list-->
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>



                <!--end content-->
            </div>
            <!-- end: FORM WIZARD PANEL -->
        </div>
    </div>
    <div class="col-sm-12">
       <button title="create a slide" type="button" 
               class="save_item_slide btn btn-success pull-right" value="btn-success">Save items in slide</button>
    </div>
</div>
<!-- end: PAGE CONTENT-->
<!-- ============================================ -->    
<script type="text/javascript">
    var url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/slidewidget/slide') ?>";
    var root_url = "<?php echo Yii::$app->urlManager->baseUrl; ?>";
</script>