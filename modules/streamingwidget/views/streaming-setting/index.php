<?php \app\modules\streamingwidget\assets\StreamingAsset::register($this); ?>
<!-- ============================================ -->
<!-- start: PAGE CONTENT -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?=Yii::t('app','Streaming setting')?>
            </div>
            <div class="panel-body">
                <?php
                /* @var $this yii\web\View */
                /* @var $model app\models\Languages */

                $this->title = Yii::t('app','Streaming setting');
                $this->params['breadcrumbs'][] = ['label' => Yii::t('app','Streaming setting'), 'url' => ['index']];
                $this->params['breadcrumbs'][] = $this->title;


                if (Yii::$app->session->hasFlash('success')) {
                ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo Yii::$app->session->getFlash('success'); ?>
                </div>
                <?php }

                if (Yii::$app->session->hasFlash('error')) {
                ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo Yii::$app->session->getFlash('error'); ?>
                </div>
                <?php }
                ?>

                <?php
                use yii\helpers\Html;
                use yii\bootstrap\ActiveForm;
                $form = ActiveForm::begin([
                    'id' => 'my-form-partner',
                    'options' => ['class' => 'form-horizontal'],
                ]);
                ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label"><?php echo Yii::t('app', 'UserName'); ?></label>
                        <input type="text" class="form-control" name="setting[username]" value="<?php echo isset($formData['username']) ? $formData['username'] : '' ?>" />
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?php echo Yii::t('app', 'Password'); ?></label>
                        <?php
                        if (isset($formData['password'])) {
                            ?>
                            <input type="hidden" name="is_update" value="1"/>
                        <?php
                        }
                        ?>
                        <input type="password" class="form-control" name="setting[password]" />
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?php echo Yii::t('app', 'PortalID'); ?></label>
                        <input type="text" class="form-control" name="setting[portalID]" value="<?php echo isset($formData['username']) ? $formData['portalID'] : '' ?>" />
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

                            <?php echo Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-primary pull-right']); ?>

                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <!-- end: FORM WIZARD PANEL -->
    </div>
</div>
<!-- end: PAGE CONTENT-->
<!-- ============================================ -->