<?php

use yii\helpers\Html;
use yii\grid\GridView;
\app\modules\slidewidget\assets\SlideShowAsset::register($this);
?>
<div class="row">
    <div class="col-sm-12">

        <!-- start: FORM WIZARD PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?= Yii::t('app', 'Slide Widget Items') ?>

                <div class="panel-tools">
                    <a class=" btn btn-xs btn-link " href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['slidewidget/item/create']); ?>">
                        <i class="fa fa-plus icon_18 color_green"></i>
                    </a>
                    <!-- btn add -->

                    <a class="btn btn-xs btn-link panel-config" href="javascript:void(0)" id="edit-item">
                        <i class="fa fa-wrench icon_18 color_blue"></i>
                    </a>
                    <!-- btn edit -->

                    <a class=" btn btn-xs btn-link " href="javascript:void(0)" id="delete-item">
                        <i class="fa fa-trash-o icon_18 color_red"></i>
                    </a>
                    <!-- btn delete -->


                    <a class="btn btn-xs btn-link panel-refresh" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('item') ?>">
                        <i class="fa fa-refresh icon_18"></i>
                    </a>
                    <!-- btn refresh -->


                    <a class="btn btn-xs btn-link panel-expand" href="javascript:void(0)">
                        <i class="fa fa-resize-full icon_18"></i>
                    </a>

                </div>
            </div>
            <div class="panel-body">
                <?php
                $this->title = 'Slide Widget Items';
                $this->params['breadcrumbs'][] = $this->title;
                ?>
                <div id="error"></div>
                <?php
                if (Yii::$app->session->hasFlash('error')) {
                    ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo Yii::$app->session->getFlash('error'); ?>
                    </div>
                    <?php
                }?>
               <?php 
                if (Yii::$app->session->hasFlash('success')) {
                    ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo Yii::$app->session->getFlash('success'); ?>
                    </div>
                    <?php
                }
                ?> 
                    <?php 
                if (Yii::$app->session->hasFlash('warning')) {
                    ?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo Yii::$app->session->getFlash('warning'); ?>
                    </div>
                    <?php
                }
                ?>
                <div class="items-of-slide-index">
                    <?php
                        echo Html::beginForm('', 'post', ['id' => 'my_form']);
                        echo GridView::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => [
                                ['attribute' => 'id', 'label' => 'ID'],
                                ['attribute' => 'title', 'label' => 'Title'],
                                ['attribute' => 'description', 'label' => 'Description'],
                                ['attribute' => 'link', 'label' => 'URL'],
                                [
                                    'attribute' => 'open_new_window',
                                    'label' => 'Open new window',
                                    'format' => 'html',
                                    'value' => function($model, $key, $index, $columns){
                                        if ($model['open_new_window'] == 1) {
                                            return '<i class="glyphicon glyphicon-ok"></i>';
                                        } else {
                                            return '';
                                        }
                                    }
                                ],
                                [
                                    'attribute' => 'is_active',
                                    'label' => 'Active',
                                    'format' => 'html',
                                    'value' => function($model, $key, $index, $columns) {
                                        if ($model['is_active'] == 1) {
                                            return '<span class="label label-success">Active</span>';
                                        } else {
                                            return '<span class="label label-danger">Deactive</span>';
                                        }
                                    }
                                ],
                                [
                                    'class' => 'yii\grid\CheckboxColumn',
                                    'header' => 'Select',
                                    'name' => 'id[]',
                                    'checkboxOptions' => function($model, $key, $index, $columns) {
                                        return ['class' => 'item_id', 'value' => $model->id];
                                    }

                                ]
                            ],
                        ]);
                        echo Html::endForm();
                    ?>
                </div>
                    <!-- end: FORM WIZARD PANEL -->
            </div>
        </div>
    </div>
</div>
        <!-- end: PAGE CONTENT-->
        <!-- ============================================ -->    
<script type="text/javascript">
    var url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('slidewidget/item') ?>";
    var root_url = "<?php echo Yii::$app->urlManager->baseUrl; ?>";
</script>