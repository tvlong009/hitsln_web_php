<?php backend\assets\UserPropertyGroupAsset::register($this) ?>

<!-- ============================================ -->
<!-- start: PAGE CONTENT -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?=Yii::t('app','Update user group property')?>
            </div>
            <div class="panel-body">
                <?php
/* @var $this yii\web\View */
/* @var $model backend\models\Languages */

$this->title = Yii::t('app','Update user group property');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','User property group'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<?= $this->render('_form', [
        'model' => $model,
]) ?>
            </div>
        </div>           
        <!-- end: FORM WIZARD PANEL -->        
    </div>
</div>
<!-- end: PAGE CONTENT-->
<!-- ============================================ -->