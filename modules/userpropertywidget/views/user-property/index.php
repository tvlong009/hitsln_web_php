<?php app\modules\userpropertywidget\assets\UserPropertyAsset::register($this) ?>
<!-- ============================================ -->
<div class="row">
    <div class="col-sm-12">

        <!-- start: FORM WIZARD PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?= Yii::t('app', 'User property') ?>

                <div class="panel-tools">
                    <a class=" btn btn-xs btn-link " href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['userpropertywidget/user-property/create']); ?>">
                        <i class="fa fa-plus icon_18 color_green"></i>
                    </a>
                    <!-- btn add -->

                    <a class="btn btn-xs btn-link panel-config" href="javascript:void(0)" id="edit-user-property">
                        <i class="fa fa-wrench icon_18 color_blue"></i>
                    </a>
                    <!-- btn edit -->

                    <a class=" btn btn-xs btn-link " href="javascript:void(0)" id="delete-user-property">
                        <i class="fa fa-trash-o icon_18 color_red"></i>
                    </a>
                    <!-- btn delete -->


                    <a class="btn btn-xs btn-link panel-refresh" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('userpropertywidget/user-property') ?>">
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
                use app\modules\userpropertywidget\models\UserPropertyGroup;

                $this->title = Yii::t('app', 'User property');
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
                    		'label' => 'Group',
                    		'format' => 'text',
                    		'value' => function($model, $key, $index, $columns) {                    			
                    			$userpropertygroup = UserPropertyGroup::findOne($model['group_id']);
                    			if ($userpropertygroup) {
                    				return $userpropertygroup->group_name;
                    			} else {
                    				return '';
                    			}
                    		}
                    	),
                        array(
                            'attribute' => 'property_name',
                            'label' => 'Name'
                        ),
                        array(
                        	'attribute' => 'type',
                        	'label' => 'Type',
                        	'format' => 'text',
                        	'value' => function($model, $key, $index, $columns){
                        		return $model->getTypeName();
                    		}
                        ),
                        array(
                        		'attribute' => 'displayorder',
                        		'label' => 'Display order'
                        ),
                        array(
				            'attribute' => 'status',
				            'label' => 'Status',
				            'format' => 'html',
				            'value' => function($model, $key, $index, $columns) {
				                if ($model['status'] == 1) {
				                    return '<span class="label label-success">Enable</span>';
				                } else {
				                    return '<span class="label label-danger">Disable</span>';
				                }
				            }
				        ),                                            
                        array(
                            'class' => 'yii\grid\CheckboxColumn',
                            'header' => 'Select',
                            'name' => 'id[]',
                            'checkboxOptions' => function($model, $key, $index, $column) {
                                return ['class' => 'property_id', 'value' => $model->property_id];
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
        <?php // $this->registerJsFile('/js/page.js', array('position' => yii\web\View::POS_END) )  ?>
        <script type="text/javascript">
            var url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('userpropertywidget/user-property') ?>";
            //var root_url = "<?php echo Yii::$app->urlManager->baseUrl; ?>";
</script>