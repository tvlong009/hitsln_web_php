<?php app\assets\UserPropertyGroupAsset::register($this) ?>
<div class="row">
    <div class="col-sm-12">

        <!-- start: FORM WIZARD PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?= Yii::t('app', 'User group property') ?>

                <div class="panel-tools">
                    <a class=" btn btn-xs btn-link " href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['user-property-group/create']); ?>">
                        <i class="fa fa-plus icon_18 color_green"></i>
                    </a>
                    <!-- btn add -->

                    <a class="btn btn-xs btn-link panel-config" href="javascript:void(0)" id="edit-user-property-group">
                        <i class="fa fa-wrench icon_18 color_blue"></i>
                    </a>
                    <!-- btn edit -->

                    <a class=" btn btn-xs btn-link " href="javascript:void(0)" id="delete-user-property-group">
                        <i class="fa fa-trash-o icon_18 color_red"></i>
                    </a>
                    <!-- btn delete -->


                    <a class="btn btn-xs btn-link panel-refresh" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('user-property-group') ?>">
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

                use yii\grid\GridView;
                use yii\helpers\Html;
                use app\models\site\User;

                $this->title = Yii::t('app', 'User Property Group');
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
                }

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
                echo Html::beginForm('', 'post', ['id' => 'my_form']);
                echo GridView::widget(array(
                    'dataProvider' => $dataProvider,
                    'columns' => array(
                        array(
                            'attribute' => 'group_id',
                            'label' => 'ID'
                        ),
                        array(
                            'attribute' => 'group_name',
                        ),                        
                        array(
                            'attribute' => 'displayorder',                            
                        ),                        
                        array(
                            'class' => 'yii\grid\CheckboxColumn',
                            'header' => 'Select',
                            'name' => 'id[]',
                            'checkboxOptions' => function($model, $key, $index, $column) {
                                return ['class' => 'group_id', 'value' => $model->group_id];
                            },
                                ),
                            ),
                        ));

                        echo Html::endForm();
                        ?>                
                    </div>
                    <!-- end: FORM WIZARD PANEL -->
                </div>
            </div>
        </div>
        <!-- end: PAGE CONTENT-->
        <!-- ============================================ -->    
        <script type="text/javascript">
            var url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/user-property-group') ?>";
            var root_url = "<?php echo Yii::$app->urlManager->baseUrl; ?>";
</script>
