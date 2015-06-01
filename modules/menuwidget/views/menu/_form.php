<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Languages */
/* @var $form yii\widgets\ActiveForm */

if (Yii::$app->session->hasFlash('success')) {
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"
                aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo Yii::$app->session->getFlash('success'); ?>
    </div>
<?php
}

if (Yii::$app->session->hasFlash('warning')) {
    ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"
                aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo Yii::$app->session->getFlash('warning'); ?>
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
    <?php echo $form->field($model, 'key'); ?>
    <?php echo $form->field($model, 'effect')->dropDownList($js)?>
    <?php echo $form->field($model, 'is_active')->dropDownList(array('1' => 'Yes', '0' => 'No'));?>
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
                <?= Yii::t('app', 'Please check information before clicking the submit button') ?>
            </p>
        </div>


        <div class="col-md-6">
            <div class="pull-right">

                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>

            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>