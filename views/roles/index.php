<?php app\assets\RoleAsset::register($this) ?>
<div class="row">
    <div class="col-sm-12">

        <!-- start: FORM WIZARD PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?php echo Yii::t('app','Roles');?>

                <div class="panel-tools">
                    <a class=" btn btn-xs btn-link " href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['roles/create']); ?>">
                        <i class="fa fa-plus icon_18 color_green"></i>
                    </a>
                    <!-- btn add -->

                    <a class="btn btn-xs btn-link panel-config" href="javascript:void(0)" id="edit-roles">
                        <i class="fa fa-wrench icon_18 color_blue"></i>
                    </a>
                    <!-- btn edit -->

                    <a class=" btn btn-xs btn-link " href="javascript:void(0)" id="delete-roles">
                        <i class="fa fa-trash-o icon_18 color_red"></i>
                    </a>
                    <!-- btn delete -->


                    <a class="btn btn-xs btn-link panel-refresh" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('roles') ?>">
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

                $this->title = Yii::t('app','Roles');
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
                            'attribute' => 'id',
                            'label' => Yii::t('app','ID'),
                        ),
                        array(
                            'attribute' => 'name',
                        ),
                        array(
                            'attribute' => 'level',
                        ),
                        array(
                            'attribute' => 'is_master',
                            'label' => Yii::t('app','Is Master'),
                            'format' => 'html',
                            'value' => function($model, $key, $index, $columns) {
                                if ($model['is_default'] == 1) {
                                    return '<i class="glyphicon glyphicon-ok"></i>';
                                } else {
                                    return '';
                                }
                            }
                        ),
                        array(
                            'attribute' => 'is_default',
                            'label' => Yii::t('app','Is Default'),
                            'format' => 'html',
                            'value' => function($model, $key, $index, $columns) {
                                if ($model['is_default'] == 1) {
                                    return '<i class="glyphicon glyphicon-ok"></i>';
                                } else {
                                    return '';
                                }
                            }
                        ),
                        array(
                            'class' => 'yii\grid\CheckboxColumn',
                            'header' => Yii::t('app','Select'),
                            'name' => 'id[]',
                            'checkboxOptions' => function($model, $key, $index, $column) {
                                return ['class' => 'role_id', 'value' => $model->id];
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
            var url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/roles') ?>";
            var root_url = "<?php echo Yii::$app->urlManager->baseUrl; ?>";
</script>


