<?php
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin([
            'class' => 'form-horizontal',
            'id' => 'newsletter_form',
            'fieldConfig' => [
                'template' => $template,
            ]
        ]);
?>
<?php
echo $form->field($model, 'email')->textInput(['class' => 'type_email', 'type' => 'email', 'placeholder' => Yii::t('app', 'Type your e-mail address')]);
?>
<?php
    ActiveForm::end();
?>