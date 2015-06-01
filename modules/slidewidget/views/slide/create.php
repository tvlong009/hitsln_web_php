<?php
/* @var $this yii\web\View */
/* @var $model app\modules\slidewidget\models\SlideWidget */

use yii\helpers\Html;
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?= Yii::t('app', 'Add new slide') ?>
            </div>
            <div class="panel-body">
                <?php
                $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Slide Widgets'), 'url' => ['index']];
                ?>
                <div class="slide-widget-create">

                    <h1><?= Html::encode($this->title) ?></h1>

                    <?=
                    $this->render('_form', [
                        'model' => $model,
                        'items' => $items
                    ])
                    ?>

                </div>
            </div>
        </div>           
        <!-- end: FORM WIZARD PANEL -->        
    </div>
</div>
<!-- end: PAGE CONTENT-->
<!-- ============================================ -->