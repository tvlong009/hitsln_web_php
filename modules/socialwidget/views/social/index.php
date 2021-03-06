<?php app\modules\socialwidget\assets\SocialAsset::register($this) ?>
<!-- ============================================ -->
<div class="row">
    <div class="col-sm-12">
        <!-- start: FORM WIZARD PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?=Yii::t('app','Social links')?>

                <div class="panel-tools">
                    <a class=" btn btn-xs btn-link " href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['socialwidget/social/add']); ?>">
                        <i class="fa fa-plus icon_18 color_green"></i>
                    </a>
                    <!-- btn add -->

                    <a class="btn btn-xs btn-link panel-config" href="javascript:void(0)" id="edit-social">
                        <i class="fa fa-wrench icon_18 color_blue"></i>
                    </a>
                    <!-- btn edit -->

                    <a class=" btn btn-xs btn-link " href="javascript:void(0)" id="delete-social">
                        <i class="fa fa-trash-o icon_18 color_red"></i>
                    </a>
                    <!-- btn delete -->


                    <a class="btn btn-xs btn-link panel-refresh" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('socialwidget/social/') ?>">
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

                $this->title = Yii::t('app','Social');
                $this->params['breadcrumbs'][] = $this->title;            

                echo '<div id="error"></div>';

                if (Yii::$app->session->hasFlash('error')) {
                ?>
                <div class="alert alert-error alert-dismissible" role="alert">
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
                echo Html::beginForm('','post', ['id' => 'my_form']);
                echo GridView::widget(array(
                    'dataProvider' => $dataProvider,
                    'columns' => array(
                        array(
                            'attribute' => 'order',
                            'label' => Yii::t('app','Display order')
                        ),
                        array(
                            'attribute' => 'name',
                            'label' => Yii::t('app','Name')
                        ),
                        array(
                            'attribute' => 'link',
                            'label' => Yii::t('app','Link')
                        ),
                        array(
                            'attribute' => 'css_class',
                            'label' => Yii::t('app','Css Class')
                        ),
                        array(
                            'attribute' => 'is_active',
                            'label' => Yii::t('app','Status'),
                            'format' => 'html',
                            'value' => function($model, $key, $index, $columns) {
                                if ($model['is_active'] == 1) {
                                    return '<span class="label label-success">Active</span>';
                                } else {
                                    return '<span class="label label-danger">Deactive</span>';
                                }
                            }
                        ),
                        array(
                            'attribute' => 'created',
                            'label' => Yii::t('app','Date'),
                            'format' =>  array('date', 'php:d/m/Y')
                        ),
                        array(
                            'class' => 'yii\grid\CheckboxColumn',
                            'header' => 'Select',
                            'name' => 'id[]',
                            'checkboxOptions' =>function($model, $key, $index, $column){
                                return ['class' => 'social_id', 'value' => $model->id];
                            },
                        ),
                    ),
                ));

                echo Html::endForm();
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/socialwidget/social/') ?>";
    var root_url = "<?php echo Yii::$app->urlManager->baseUrl; ?>";
</script>