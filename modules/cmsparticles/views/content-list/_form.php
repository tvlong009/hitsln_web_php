<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Languages */
/* @var $form yii\widgets\ActiveForm */

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
$form = ActiveForm::begin([
            'id' => 'my-form',
            'options' => ['class' => 'form-horizontal'],            
        ]);
?>

<div class="col-md-6">
<?= $form->field($model, 'title'); ?>

    <div class="form-group">
    <label class="control-label" for="short_description">Short description</label>
    <?=
    yii\redactor\widgets\Redactor::widget([
        'model' => $model,
        'attribute' => 'short_description',
        'options' => [
            'class' => 'form-control',
            'id' => 'short_description'
        ],
        'clientOptions' => [
            'plugins' => ['imagemanager'],
            'imageManagerJson' => '/media/image-json',
            'imageUpload' => '/redactor/upload/image',
            'fileUpload' => '/redactor/upload/file'
        ],
    ]);
    ?>
    </div>
<?= !$model->isNewRecord ? $form->field($model, 'displayorder') : '' ?>
<?= $form->field($model, 'status')->dropDownList(['1' => 'Enable', '0' => 'Disable']); ?>
</div>
<div class="row">
    <div class="col-md-12">
        <div>
            
            <hr>
        </div>
    </div>                    
</div>
<div class="row">
    <div class="col-md-6">
        <p>
            <?= Yii::t('app', 'Please check information before clicking the submit button')?>
        </p>
    </div>


    <div class="col-md-6">
        <div class="pull-right">

<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>

        </div>												
    </div>                    
</div>
<?php ActiveForm::end(); ?>