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

    <?=
    $form->field($model, 'type')->dropDownList(array(
        '' => 'Choose particle type',
        Yii::t('app', 'Portfolio') => Yii::t('app', 'Portfolio'),
        Yii::t('app', 'Partners') => Yii::t('app', 'Partners'),
        Yii::t('app', 'Contact Form') => Yii::t('app', 'Contact Form'),
        Yii::t('app', 'Content List') => Yii::t('app', 'Content List'),
        Yii::t('app', 'Newsletter') => Yii::t('app', 'Newsletter'),
    ))
    ?>

<?= $form->field($model, 'key')->textInput(['maxlength' => 20]) ?>

    <div class="form-group">
        <label for="" class="control-label"><?= Yii::t('app', 'Attribute') ?></label>
        <div id="attribute" class="json-editor" style="padding: 0;margin-left: 0px;"></div>
        <br/>
        <small><code><?= Yii::t('app', 'The string of value should be into quotation mark') ?></code></small>
    </div>
<?= $form->field($model, 'attributes')->hiddenInput(['id' => 'attribute_value']); ?>
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

<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>

        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<script type="text/javascript">
<?php
if (is_array(json_decode($model->attributes, true))) {
    echo 'var json = ' . $model->attributes;
} else {
    echo 'var json = {"new key": "new value"};';
}
?>
</script>