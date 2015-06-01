<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin([
            'id' => 'my-form-social',
            'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],            
        ]);
if (Yii::$app->session->hasFlash('success')) {
    ?>                
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success'); ?>
    </div>
<?php }
?>
<div class="col-md-6">
    <?php
    echo Html::hiddenInput('icon_exist', $model->icon);
    echo $form->field($model, 'name')->textInput(['placeholder' => Yii::t('app','Name')]);
    echo $form->field($model, 'link')->textInput(['placeholder' => Yii::t('app','Link'), 'type' => 'url']);
    echo $form->field($model, 'css_class')->textInput(['placeholder' => Yii::t('app','Css Class')]);
    echo $form->field($model, 'order')->textInput(['placeholder' => Yii::t('app','Order')]);
    echo $form->field($model,'js_action')->textarea(['rows' => 5]); 
    echo $form->field($model, 'is_active')->dropDownList(['1' => Yii::t('app','Is active'), '0' => Yii::t('app','Not active')]);
    echo $form->field($model, 'icon')->fileInput();
    if($model->icon != '') {
        echo '<img src="'.Yii::$app->urlManager->getBaseUrl().'/uploads/social/'.$model->icon.'" class="social_icon">';
    ?>
        <div class="form-group">
            <label for="delet_icon">Delete Icon</label>
            <?php echo Html::checkbox('delete_icon', false, ['value' => 1])?>
        </div>
    <?php }?>
</div>
<!-- end of modal -->
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

<?php echo Html::submitButton($model->isNewRecord ? Yii::t('app','Add') : Yii::t('app','Edit'), ['class' => 'btn btn-primary pull-right', 'id' => 'add_social']); ?>

        </div>												
    </div>                    
</div>
<?php ActiveForm::end(); ?>
