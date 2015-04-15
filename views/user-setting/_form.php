
<?php app\assets\UserSettingAsset::register($this) ?>
<!-- ============================================ -->
<div class="row">
    <div class="col-sm-12">

        <!-- start: FORM WIZARD PANEL -->
        <div class="panel panel-default">

            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?php
                if ($model->isNewRecord === true) {
                    echo Yii::t('app',"Create User Setting");
                } else {
                    echo Yii::t('app',"Update User Setting");
                }
                ?>

            </div>

            <div class="panel-body">


                <?php

                use yii\helpers\Html;
                use yii\widgets\ActiveForm;
                use app\models\site\User;

if (Yii::$app->session->hasFlash('success')) {
                    ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo Yii::$app->session->getFlash('success'); ?>
                    </div>
                    <?php
                }
                ?>

                <div class="user-setting-form ">

                    <?php $form = ActiveForm::begin(); ?>
                    <?php echo Html::beginForm('', 'post', ['id' => 'my_form']); ?>
                    <div class="form-group">
                        <label class="control-label" for="usersetting-key">User</label>
                        <?php if ($model->isNewRecord === true) { ?>

                            <select name="userId" class="form-control">
                                <?php
                                $model_users = new User();
                                $model_users = User::find()->all();
                                foreach ($model_users as $model_user) {
                                    echo "<option value='" . $model_user->id . "'>" . $model_user->username . "</option>";
                                }
                                ?>
                            </select>
                        <?php } else { ?>
                            <select name="userId" class="form-control" readonly>
                                <?php
                                $model_users = new User();
                                $model_users = User::findAll(["id" => $model->user_id]);
                                foreach ($model_users as $model_user) {
                                    echo "<option value='" . $model_user->id . "'>" . $model_user->username . "</option>";
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>

                    <?= $form->field($model, 'key')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>



                </div>
            </div>
        </div>
        <!-- end: FORM WIZARD PANEL -->
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div>
                <span class="symbol required"></span>      Required Fields
                <hr>
            </div>
        </div>                    
    </div>


    <div class="row">
        <div class="col-md-6 pull-right">
            <div class="pull-right">

                <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-primary pull-right' : 'btn btn-primary pull-right']) ?>

            </div>												
        </div>                    
    </div> 
         
</div>


<script type="text/javascript">
    var url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/user-setting') ?>";
    var root_url = "<?php echo Yii::$app->urlManager->baseUrl; ?>";
</script>

<?php ActiveForm::end(); ?>