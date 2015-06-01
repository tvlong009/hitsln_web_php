<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Roles;

/* @var $this yii\web\View */
/* @var $model app\models\Languages */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
if (Yii::$app->session->hasFlash('warning_role')) {
    ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('warning_role'); ?>
    </div>
<?php } ?>

<?php if (Yii::$app->session->hasFlash('error-save-role')) {
    ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('error-save-role'); ?>
    </div>
<?php } ?>

<?php if (Yii::$app->session->hasFlash('success-save-role')) {
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success-save-role'); ?>
    </div>
<?php } ?>

<?php if (Yii::$app->session->hasFlash('success')) { ?>
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
    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'level')->textInput() ?>

    <?php echo $form->field($model, 'is_master')->dropDownList(['0' => Yii::t('app', 'Not Master'), '1' => Yii::t('app', 'Is Master')]); ?>
    <?php echo $form->field($model, 'is_default')->dropDownList(['0' => Yii::t('app', 'Not Default'), '1' => Yii::t('app', 'Set Default')]); ?>
</div>
<div class="row">
    <div class="col-md-12">
        <div>
            <span class="symbol required"></span><?php echo Yii::t('app', 'Required Fields'); ?>
            <hr>
        </div>
    </div>                    
</div>
<div class="row">
    <div class="col-md-6">
        <p>
            <?php echo Yii::t('app', 'Please check information before clicking the submit button'); ?>
        </p>
    </div>


    <div class="col-md-6">
        <div class="pull-right">

            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>

        </div>												
    </div>                    
</div>
<?php ActiveForm::end(); ?>
