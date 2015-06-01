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
        </button>roo
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
            <label class="control-label" for=""><?php echo Yii::t('app', 'Group'); ?></label>
            <select class="form-control" name="group">
                <option value="0"><?php echo Yii::t('app', 'Choose group quick link');?></option>
                <?php
                foreach ($groups as $groupId => $groupName) {
                    ?>
                    <option <?php echo (isset($model->group_id) && $model->group_id == $groupId) ? 'selected' : '' ?> value="<?php echo $groupId; ?>"><?php echo $groupName ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="" class="control-label"><?php echo Yii::t('app', 'Label link'); ?></label>
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
        <div class="form-group">
            <label for="" class="control-label"><?php echo Yii::t('app', 'Type'); ?></label>
            <select class="form-control" name="type" id="type">
                <?php
                foreach ($model->getTypeList() as $type => $name) {
                    ?>
                    <option <?php echo (isset($model->type) && $model->type == $type) ? 'selected' : '' ?> value="<?php echo $type ?>"><?php echo $name; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group" id="action">
            <label for="" class="control-label"><?php echo Yii::t('app', 'Controller/Action') ?></label>
            <select name="action" class="form-control">
                <?php
                if (!empty($routers)) {
                    foreach ($routers as $controllerName => $actions) {
                        foreach ($actions as $action) {
                            ?>
                            <option <?php echo (isset($model->action) && $model->prefix . '/' .$model->action == $controllerName . '/' . $action) ? 'selected' : '' ?> value="<?php echo $controllerName . '/' . $action; ?>"><?php echo $controllerName . '/' . $action; ?></option>
                            <?php
                        }
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group" id="url" style="display: none;">
            <label for="" class="control-label"><?php echo Yii::t('app', 'Url') ?></label>
            <input type="text" name="url" class="form-control" value="<?php echo $model->url; ?>" />
        </div>
        <?php
        if (!$model->isNewRecord) {
            echo $form->field($model, 'displayorder')->textInput(['name' => 'displayorder']);
        }
        ?>
        <?php echo $form->field($model, 'is_blank')->dropDownList(array('1' => Yii::t('app', 'Yes'), '0' => Yii::t('app', 'No')), ['name' => 'is_blank']); ?>
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