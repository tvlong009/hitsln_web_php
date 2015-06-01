<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Languages */
/* @var $form yii\widgets\ActiveForm */

if (Yii::$app->session->hasFlash('error')) {
    ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"
                aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo Yii::$app->session->getFlash('error'); ?>
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

function getPageList($pages, $parentId = 0, $selected = 0, $text = '')
{
    if (!empty($pages[$parentId])) {
        foreach ($pages[$parentId] as $page) {
            echo '<option value="'.$page->key.'">'.$text . $page->key.'</option>';
            if (!empty($pages[$page->id])) {
                getPageList($pages, $page->id, $selected, '&nbsp;&nbsp;');
            }
        }
    }
}

?>

<?php
$form = ActiveForm::begin([
    'id' => 'my-form',
    'options' => ['class' => 'form-horizontal'],
]);
?>
    <div class="col-md-6">
        <div class="form-group">
            <label class="label-control" for=""><?php echo Yii::t('app', 'Label'); ?></label>
            <?php
            if (!empty($languages)) {
                ?>
            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                <?php
                foreach ($languages as $i => $language) {
                    ?>
                    <li role="presentation" <?php echo $i == 0 ? 'class="active"' : '' ?>>
                        <a href="#item_<?php echo $language->name ?>" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><?php echo $language->name; ?></a>
                    </li>
                    <?php
                }
                ?>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <?php
                    foreach ($languages as $i => $language) {
                        ?>
                    <div role="tabpanel" class="tab-pane fade <?php echo $i == 0 ? 'active in' : '' ?>" id="item_<?php echo $language->name ?>" aria-labelledby="home-tab">
                        <input type="text" class="form-control" name="labelitem[<?php echo $language->id ?>]" value="<?php echo isset($itemLanguages[$language->id]) ? $itemLanguages[$language->id] : ''; ?>"/>
                    </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
                <?php
            }
            ?>
        </div>
        <div class="row">
            <div class="col-md-7"><?php echo $form->field($model, 'link')->textInput(['id' => 'link_txt']); ?></div>
            <div class="col-md-5">
                <select id="pageKey" class="form-control" style="margin-top:25px;">
                    <option value=""><?php echo Yii::t('app', 'Please choose page') ?></option>
                    <?php echo getPageList($pages);?>
                </select>
            </div>
        </div>
        <?php echo $form->field($model, 'parent_id')->dropDownList($items, ['prompt' => 'Choose parent item']); ?>
        <?php echo $form->field($model, 'is_blank')->dropDownList(array('1' => 'Yes', '0' => 'No'));?>
        <?php echo $form->field($model, 'is_active')->dropDownList(array('1' => 'Yes', '0' => 'No'));?>
        <?php echo $form->field($model, 'is_ajax')->dropDownList(array('1' => 'Yes', '0' => 'No'));?>
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
    var page_url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('home/index'); ?>";
</script>