<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
if (Yii::$app->session->hasFlash('success')) {
    ?>                
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
            <?php if (isset($loginSettings['logo']) && $loginSettings['logo'] != '') { ?>
            <?php echo Html::img('@web/uploads/' . $loginSettings['logo'], ['width' => '100', 'height' => '100']) ?>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="1" name="delete_logo"/> <?php echo Yii::t('app', 'Delete this logo ?'); ?>
                </label>
            </div>
            <?php } ?>
            <input type="file" name="LoginSetting[logo]" class="" />
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo Yii::t('app', 'Alert message'); ?></label>
            <textarea rows="5" class="form-control" name="setting[alert_message]"><?php echo isset($loginSettings['alert_message']) ? $loginSettings['alert_message'] : ''; ?></textarea>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo Yii::t('app', 'Message'); ?></label>
            <div class='row'>
                <div class="col-md-3" style="margin-top:10px;"><?php echo Yii::t('app', 'Already a member ?') ?></div>
                <div class='col-md-5'><input type='text' name="setting[message1]" class="form-control" value="<?php echo isset($loginSettings['message1']) ? $loginSettings['message1'] : ''; ?>" /></div>
            </div>
            <div class='row' style="margin-top:10px">
                <div class="col-md-3" style="margin-top:10px;"><?php echo Yii::t('app', 'Sign in with HitsNL account') ?></div>
                <div class='col-md-5'><input type='text' name="setting[message2]" class="form-control" value="<?php echo isset($loginSettings['message2']) ? $loginSettings['message2'] : ''; ?>" /></div>
            </div>
            <div class='row' style="margin-top:10px">
                <div class="col-md-3" style="margin-top:10px;"><?php echo Yii::t('app', 'Connect with HitsNL') ?></div>
                <div class='col-md-5'><input type='text' name="setting[message3]" class="form-control" value="<?php echo isset($loginSettings['message3']) ? $loginSettings['message3'] : ''; ?>" /></div>
            </div>
            <div class='row' style="margin-top:10px">
                <div class="col-md-3" style="margin-top:10px;"><?php echo Yii::t('app', 'Sign sup with HitsNL account') ?></div>
                <div class='col-md-5'><input type='text' name="setting[message4]" class="form-control" value="<?php echo isset($loginSettings['message4']) ? $loginSettings['message4'] : ''; ?>" /></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo Yii::t('app', 'Is active ?'); ?></label>
            <select name="setting[isactive]" class="form-control">
                <option <?php echo (isset($loginSettings['isactive']) && $loginSettings['isactive'] == 1) ? 'selected' : ''; ?> value="1"><?php echo Yii::t('app', 'Yes'); ?></option>
                <option <?php echo (isset($loginSettings['isactive']) && $loginSettings['isactive'] == 0) ? 'selected' : ''; ?> value="0"><?php echo Yii::t('app', 'No'); ?></option>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo Yii::t('app', 'Enable social ?'); ?></label>
            <select name="setting[enablesocial]" class="form-control">
                <option <?php echo (isset($loginSettings['enablesocial']) && $loginSettings['enablesocial'] == 1) ? 'selected' : ''; ?> value="1"><?php echo Yii::t('app', 'Yes'); ?></option>
                <option <?php echo (isset($loginSettings['enablesocial']) && $loginSettings['enablesocial'] == 0) ? 'selected' : ''; ?> value="0"><?php echo Yii::t('app', 'No'); ?></option>
            </select>
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
            <?= Yii::t('app', 'Please check information before clicking the submit button')?>
        </p>
    </div>


    <div class="col-md-6">
        <div class="pull-right">

<?php echo Html::submitButton(Yii::t('app','Update'), ['class' => 'btn btn-primary pull-right', 'id' => 'add_partner']); ?>

        </div>												
    </div>                    
</div>
<?php ActiveForm::end(); ?>

