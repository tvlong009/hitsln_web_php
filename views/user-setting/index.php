<?php app\assets\UserSettingAsset::register($this) ?>
<div class="row">
    <div class="col-sm-12">

        <!-- start: FORM WIZARD PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?php  echo Yii::t('app','User Setting');?>

                <div class="panel-tools">
                    <a class=" btn btn-xs btn-link " href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['user-setting/create']); ?>">
                        <i class="fa fa-plus icon_18 color_green"></i>
                    </a>
                    <!-- btn add -->

                    <a class="btn btn-xs btn-link panel-config" href="javascript:void(0)" id="edit-user-setting">
                        <i class="fa fa-wrench icon_18 color_blue"></i>
                    </a>
                    <!-- btn edit -->

                    <a class=" btn btn-xs btn-link " href="javascript:void(0)" id="delete-user-setting">
                        <i class="fa fa-trash-o icon_18 color_red"></i>
                    </a>
                    <!-- btn delete -->


                    <a class="btn btn-xs btn-link panel-refresh" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('user-setting') ?>">
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

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','User Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-setting-index">
    
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
      <div id="error"></div>  
 

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
         'columns' => array(
        array(
            'attribute' => 'user_id',
            'label' => Yii::t('app','Name'),
            'value'=>function($model, $key, $index, $columns) {
                                $user = User::findAll(['id'=>$model['user_id']]);
                                if ($user[0]) {
                                    return $user[0]->name;
                                } else {
                                    return '';
                                }}
        ),
        array(
            'attribute' => 'key',
            'label' => Yii::t('app','Key'),
        ),
        array(
            'attribute' => 'value',
            'format'=>'ntext'
        ),   
        array(
            'class' => 'yii\grid\CheckboxColumn',
            'header' => Yii::t('app','Select'),
            'name' => 'id[]',
            'checkboxOptions' =>function($model, $key, $index, $column){
                return ['class' => 'user-setting-id', 'value' => $model->id];
            },
        ),
    ),
    ]); 
     
            ?>

</div>

                       </div>
            <!-- end: FORM WIZARD PANEL -->
        </div>
    </div>
</div>
    <!-- end: PAGE CONTENT-->
    <!-- ============================================ -->    

    
<script type="text/javascript">
    var url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/user-setting') ?>";
    var root_url = "<?php echo Yii::$app->urlManager->baseUrl; ?>";
</script>
