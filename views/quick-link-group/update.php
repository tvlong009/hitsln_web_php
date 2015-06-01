<?php app\assets\QuickLinkGroupAsset::register($this) ?>

<!-- ============================================ -->
<!-- start: PAGE CONTENT -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?=Yii::t('app','Update quick link group')?>
            </div>
            <div class="panel-body">
                <?php
                /* @var $this yii\web\View */
                /* @var $model app\models\Languages */

                $this->title = Yii::t('app','Update quick link group');
                $this->params['breadcrumbs'][] = ['label' => Yii::t('app','Update quick link group'), 'url' => ['index']];
                $this->params['breadcrumbs'][] = $this->title;

                ?>
                <?= $this->render('_form', [
                    'model' => $model,
                    'languages' => $languages,
                    'formData' => $formData,
                ]) ?>
            </div>
        </div>
        <!-- end: FORM WIZARD PANEL -->
    </div>
</div>
<!-- end: PAGE CONTENT-->
<!-- ============================================ -->