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

if (Yii::$app->session->hasFlash('warning')) {
    ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'code')->textInput(['maxlength' => 2]) ?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

    <?php echo $form->field($model, 'is_active')->dropDownList(['0' => 'Not active', '1' => 'Is active']); ?>

<?php echo $form->field($model, 'is_default')->dropDownList(['0' => 'Not default', '1' => 'Is default']); ?>
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
<script type="text/javascript">
    var url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/languages') ?>";
    var root_url = "<?php echo Yii::$app->urlManager->baseUrl; ?>";
</script>