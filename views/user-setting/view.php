<?php app\assets\UserSettingAsset::register($this) ?>

<!-- ============================================ -->
<div class="row">
    <div class="col-sm-12">

        <!-- start: FORM WIZARD PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                User Setting

                

            </div>
            <div class="panel-body">
                <?php if (Yii::$app->session->hasFlash('success')) {
                    ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo Yii::$app->session->getFlash('success'); ?>
                    </div>
                    <?php
                }?>
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserSetting */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','User Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-setting-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'key',
            'value:ntext',
        ],
    ]) ?>
    <p>
        <?= Html::a(Yii::t('app','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app','Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>

                   </div>
            <!-- end: FORM WIZARD PANEL -->
        </div>
    </div>
</div>
<script type="text/javascript">
    var url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/user-setting') ?>";
    var root_url = "<?php echo Yii::$app->urlManager->baseUrl; ?>";
</script>