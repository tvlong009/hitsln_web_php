<?php \app\modules\slidewidget\assets\SlideShowAsset::register($this);?>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\slidewidget\models\ItemsOfSlide */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
if (Yii::$app->session->hasFlash('success')) {
?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php
}

if (Yii::$app->session->hasFlash('warning')) {
?>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?= Yii::$app->session->getFlash('warning') ?>
    </div>
<?php
}
?>
<div class="items-of-slide-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'file')->fileInput() ?>
    
    <?php 
        if(isset($image_src)){
            echo Html::img($image_src, array('style' => 'max-width:300px;max-height:300px;'));          
        }
    ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_active')->dropDownList([1 => 'is Active', 0 => 'is not Active']) ?>
    
    <?= $form->field($model, 'open_new_window')->dropDownList([0 => 'open in the current window', 1 => 'open new window when clicked']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
