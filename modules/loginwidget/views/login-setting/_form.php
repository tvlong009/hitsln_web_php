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
            <label class="control-label"><?php echo Yii::t('app', 'Logo'); ?></label>
            <input type="file" name="setting['logo']" class='' />
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo Yii::t('app', 'Alert message'); ?></label>
            <textarea rows="5" class="form-control" name="setting['alert_message']"></textarea>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo Yii::t('app', 'Message'); ?></label>
            <div class='row'>
                <div class="col-md-3" style="margin-top:10px;"><?php echo Yii::t('app', 'Already a member ?') ?></div>
                <div class='col-md-5'><input type='text' name="setting['message1']" class="form-control" /></div>
            </div>
            <div class='row' style="margin-top:10px">
                <div class="col-md-3" style="margin-top:10px;"><?php echo Yii::t('app', 'Sign in with HitsNL account') ?></div>
                <div class='col-md-5'><input type='text' name="setting['message2']" class="form-control" /></div>
            </div>
            <div class='row' style="margin-top:10px">
                <div class="col-md-3" style="margin-top:10px;"><?php echo Yii::t('app', 'Connect with HitsNL') ?></div>
                <div class='col-md-5'><input type='text' name="setting['message3']" class="form-control" /></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo Yii::t('app', 'Is active ?'); ?></label>
            <input type="checkbox" name="setting['isactive']" value="1" checked style="margin-left: 10px;"/>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo Yii::t('app', 'Enable social ?'); ?></label>
            <input type="checkbox" name="setting['enablesocial']" value="1" checked style="margin-left: 10px;"/>
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

