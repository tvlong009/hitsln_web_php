<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\slidewidget\models\SlideWidget */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?=Yii::t('app','Update slide')?>
            </div>
            <div class="panel-body">
<?php

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Slide Widgets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['index', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="slide-widget-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'items_seleted' => $items_seleted,
        'items' => $items
    ]) ?>
    

</div>
</div>
        </div>           
        <!-- end: FORM WIZARD PANEL -->        
    </div>
</div>
<!-- end: PAGE CONTENT-->
<!-- ============================================ -->