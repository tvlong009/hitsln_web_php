<?php app\assets\RoleAsset::register($this) ?>

<!-- ============================================ -->
<!-- start: PAGE CONTENT -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?php echo  Yii::t('app','Update role');?>                
            </div>
            <div class="panel-body">
                <?php
/* @var $this yii\web\View */
/* @var $model app\models\Roles */

$this->title = Yii::t('app','Update Roles');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Roles'), 'url' => ['index']];
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