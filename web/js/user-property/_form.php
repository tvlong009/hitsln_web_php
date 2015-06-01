<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Languages */
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
?>

<?php
$form = ActiveForm::begin([
            'id' => 'my-form',
            'options' => ['class' => 'form-horizontal'],           
        ]);
?>
<div class="col-md-6">
	<?php
	echo $form->field($model, 'group_id')->dropDownList(ArrayHelper::map($userpropertygroupList, 'group_id', 'group_name')); 
	?>
    <?= $form->field($model, 'property_name')->textInput(['maxlength' => 255])?>
    <?php echo $form->field($model, 'type')->dropDownList($model->getTypeList());?>
    <?php echo $form->field($model, 'value')->textarea(array('class' => 'form-control')) ?>
    <?php echo $form->field($model, 'status')->dropDownList(array('1' => 'Enable', '2' => 'Disable'));?>
    <?php
   	if (!$model->isNewRecord) {
   		echo $form->field($model, 'displayorder')->textInput();
   	} 
    ?>
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