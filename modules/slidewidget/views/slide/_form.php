<?php \app\modules\slidewidget\assets\SlideShowAsset::register($this); ?>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
if (Yii::$app->session->hasFlash('error')) {
    ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
    <?php
}
?>

<div class="slide-widget-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?php echo $form->field($model, 'effect')->dropDownList(['fade' => 'fade', 'zoomout' => 'zoomout']); ?>

    <?php echo $form->field($model, 'is_active')->dropDownList(['0' => 'Not active', '1' => 'Is active']); ?>



    <!--Item list-->

    <div class="well">

        <div class="col-ms-12" >
            <label><?php echo Yii::t('app', 'Items List') ?></label>
            <select name = "items[]" style="width:100%" multiple>
                <!--                                    Items list-->
                <?php
                if (!empty($items)) {
                    foreach ($items as $i => $item) {
                        if ($model->isNewRecord) {
                            ?>
                            <option value="<?php echo "item_" . $item->id ?>" ><?php echo $item->title ?></option>
                            <?php
                        } else {
                            ?>
                            <?php
                            $select = false;
                            if (!empty($items_seleted)) {
                                foreach ($items_seleted as $item_selected) {
                                    if ($item_selected->item_id == $item->id) {
                                        $select = true;
                                        break;
                                    }
                                }
                            }
                            ?>
                            <?php if ($select == true) { ?>
                                <option value="<?php echo "item_" . $item->id ?>" selected><?php echo $item->title ?></option>
                            <?php } else {
                                ?><option value="<?php echo "item_" . $item->id ?>"><?php echo $item->title ?></option><?php
                            }
                        }
                    }
                } else {
                    ?>
                    <option disabled><?php echo Yii::t('app', 'No item is created or actived') ?></option>
                <?php }
                ?>
            </select>
        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success create_slide' : 'btn btn-primary update_slide'])
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    var url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('slidewidget/slide') ?>";
    var root_url = "<?php echo Yii::$app->urlManager->baseUrl; ?>";
</script>