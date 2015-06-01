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

    if (Yii::$app->session->hasFlash('error_name')) {
    ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"
                aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo Yii::$app->session->getFlash('error_name'); ?>
    </div>
<?php
}
?>

<?php
$form = ActiveForm::begin([
    'id' => 'my-form',
    'options' => ['class' => 'form-horizontal'],
]);
$formData = isset($formData) ? $formData : array();

if (is_array(Yii::$app->request->post('name'))) {
    $formData = array_merge($formData, Yii::$app->request->post('name'));
}
?>
    <div class="col-md-6">
        <div class="form-group">
            <label for="" class="control-label"><?php echo Yii::t('app', 'Name'); ?></label>
            <?php
            foreach ($languages as $language) {
                ?>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-1" style="margin-top: 10px;"><?php echo $language->name ?></div>
                    <div class="col-md-5"><input type="text" class="form-control"
                                                 name="name[<?php echo $language->primaryKey ?>]" value="<?php echo isset($formData[$language->primaryKey]) ? $formData[$language->primaryKey] : ''; ?>"/></div>
                </div>
            <?php
            }
            ?>
        </div>

        <?php
        if (!$model->isNewRecord) {
            echo $form->field($model, 'displayorder')->textInput(['name' => 'displayorder']);
        }
        ?>
        <?php echo $form->field($model, 'status')->dropDownList(array('1' => Yii::t('app', 'Enable'), '2' => Yii::t('app', 'Disable')), ['name' => 'status']); ?>
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