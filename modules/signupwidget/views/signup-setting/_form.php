<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

if (Yii::$app->session->hasFlash('success')) {
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success'); ?>
    </div>
<?php }
?>
<?php
$form = ActiveForm::begin([
    'id' => 'my-form-partner',
    'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
]);
?>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label"><?php echo Yii::t('app', 'Logo'); ?></label><br/>
            <?php if (isset($signupSettings['logo']) && $signupSettings['logo'] != '') { ?>
                <?php echo Html::img('@web/uploads/' . $signupSettings['logo'], ['width' => '100', 'height' => '100']) ?>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="1"
                               name="delete_logo"/> <?php echo Yii::t('app', 'Delete this logo ?'); ?>
                    </label>
                </div>
            <?php } ?>
            <input type="file" name="SignupSetting[logo]" class=""/>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo Yii::t('app', 'Message'); ?></label>

            <div class='row'>
                <div class="col-md-3" style="margin-top:10px;"><?php echo Yii::t('app', 'Term condition') ?></div>
                <div class='col-md-5'><textarea rows="3" class="form-control"
                                                name="setting[term_condition]"><?php echo isset($signupSettings['term_condition']) ? $signupSettings['term_condition'] : ''; ?></textarea>
                </div>
            </div>
            <div class='row' style="margin-top:10px;">
                <div class="col-md-3"><?php echo Yii::t('app', 'Already have an account?') ?></div>
                <div class='col-md-5'><textarea rows="2" class="form-control"
                                                name="setting[sign_in]"><?php echo isset($signupSettings['sign_in']) ? $signupSettings['sign_in'] : ''; ?></textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo Yii::t('app', 'Enable social ?'); ?></label>
            <select name="setting[enablesocial]" class="form-control" style="width: 150px;">
                <option <?php echo (isset($signupSettings['enablesocial']) && $signupSettings['enablesocial'] == 1) ? 'selected' : ''; ?>
                    value="1"><?php echo Yii::t('app', 'Yes'); ?></option>
                <option <?php echo (isset($signupSettings['enablesocial']) && $signupSettings['enablesocial'] == 0) ? 'selected' : ''; ?>
                    value="0"><?php echo Yii::t('app', 'No'); ?></option>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo Yii::t('app', 'Custom sign up field'); ?></label>
            <?php
            use \app\modules\signupwidget\models\SignupSetting;
            ?>
            <div class='row custom_field_template hidden' style="margin-top:10px;">
                <div class="col-md-3"><input type="text" class="form-control" name="custom_field[]"
                                             placeholder="<?php echo Yii::t('app', 'Field name') ?>"/></div>
                <div class="col-md-5">
                    <?php echo Html::dropDownList('custom_field_type[]', SignupSetting::TYPE_STRING, SignupSetting::getTypeList(), array('class' => 'form-control')) ?>
                </div>
                <div>
                    <a class="btn btn-danger del_field" href="javascript:void(0)"><i class="glyphicon glyphicon-trash"></i></a>
                </div>
            </div>
            <?php
            if (!empty($signupSetting['custom_field'])) {
                $customField = json_decode($signupSetting['custom_field']);
                foreach ($customField as $name => $type) {
                    ?>
                    <div class='row custom_field' style="margin-top:10px;">
                        <div class="col-md-3"><input type="text" class="form-control" name="custom_field[]"
                                                     placeholder="<?php echo Yii::t('app', 'Field name') ?>" value="<?php echo $name ?>"/></div>
                        <div class="col-md-5">
                            <?php echo Html::dropDownList('custom_field_type[]', $type, SignupSetting::getTypeList(), array('class' => 'form-control')) ?>
                        </div>
                        <div>
                            <a class="btn btn-danger del_field" href="javascript:void(0)"><i class="glyphicon glyphicon-trash"></i></a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class='row custom_field' style="margin-top:10px;">
                    <div class="col-md-3"><input type="text" class="form-control" name="custom_field[]"
                                                 placeholder="<?php echo Yii::t('app', 'Field name') ?>"/></div>
                    <div class="col-md-5">
                        <?php echo Html::dropDownList('custom_field_type[]', SignupSetting::TYPE_STRING, SignupSetting::getTypeList(), array('class' => 'form-control')) ?>
                    </div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-12"><a id="add_custom_field" class="btn btn-info pull-right"><?php echo Yii::t('app', 'Add customer field'); ?></a></div>
                </div>
            <?php
            }
            ?>
        </div>
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

                <?php echo Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary pull-right', 'id' => 'add_partner']); ?>

            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>