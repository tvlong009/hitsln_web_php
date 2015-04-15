<?php
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin([
            'class' => 'form-horizontal',
            'id' => 'newsletter_form',
            'fieldConfig' => [
                'template' => '<div class="input-group">{input}<span class="input-group-btn"><button class="btn btn-primary" type="submit">Send</button></span></div>{error}',
            ]
        ]);
?>
<div class="form-group">
    <?php 
        echo $form->field($model, 'newsletter_email')->textInput(['class' => 'form-control']);
        ?>
</div>
<?php
    ActiveForm::end();
?>