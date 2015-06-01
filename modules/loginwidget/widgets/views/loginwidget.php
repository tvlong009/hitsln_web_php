<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="other_page">
    <div class="container">
        <div class="row">
            <div class="col-md-12 logo">
                <?php if (isset($loginSettings['logo']) && $loginSettings['logo'] != '') { ?>
                    <?php

                    ?>
                    <?php echo Html::img($imageUrl . 'uploads/' . $loginSettings['logo']) ?>
                <?php } ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3 box_otherpage">
                <?php
                if ((isset($loginSettings['isactive']) && $loginSettings['isactive'] == 1) || !isset($loginSettings['isactive'])) {
                    ?>
                    <h1>
                        <?php echo !empty($loginSettings['message1']) ? $loginSettings['message1'] : Yii::t('app', 'Already a member ?'); ?>
                        <br/>
                        <small><?php echo !empty($loginSettings['message2']) ? $loginSettings['message2'] : Yii::t('app', 'Sign in with HitsNL  Account'); ?></small>
                    </h1>

                    <!--  Form login -->
                    <div class="col-md-12">
                        <?php
                        if (isset($loginSettings['alert_message']) && $loginSettings['alert_message'] != '') {
                            ?>
                            <div class="alert alert-info" role="alert">
                                <?php echo $loginSettings['alert_message']; ?>
                            </div>
                        <?php
                        }
                        ?>

                        <?php if (Yii::$app->session->hasFlash('error')) { ?>
                            <div class="errorHandler alert alert-danger">
                                <i class="fa fa-remove-sign"></i> <?php echo Yii::$app->session->getFlash('error') ?>
                            </div>
                        <?php } ?>
                        <?php if (Yii::$app->session->hasFlash('success')) { ?>
                            <div class="errorHandler alert alert-success">
                                <i class="fa fa-remove-sign"></i> <?php echo Yii::$app->session->getFlash('success') ?>
                            </div>
                        <?php } ?>

                        <?php
                        $form = ActiveForm::begin([
                            'id' => 'form-login',
                            'fieldConfig' => [
                                //'template' => "{input}\n{error}",
                            ],
                            //'action' => ['loginwidget/login']
                        ])
                        ?>
                        <input type="hidden" name="successUrl" value="<?php if (isset($successUrl)) {
                            echo $successUrl;
                        } ?>"/>
                        <input type="hidden" name="errorUrl" value="<?php if (isset($errorUrl)) {
                            echo $errorUrl;
                        } ?>"/>

                        <?= $form->field($model, 'username', ['template' => '
                           <div class="input-group input-group-lg">
                            <span class="input-group-addon" id="basic-addon1">
                             <i class="icon-users"></i>
                          </span>
                          {input}
                            </div>
                            {error}
                        '])->textInput(['placeholder' => 'Username', 'style' => 'padding-left:25px;', 'placeholder' => Yii::t('app', 'Username'), 'aria-describedby' => 'basic-addon1']) ?>

                        <?= $form->field($model, 'password', ['template' => '
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon" id="basic-addon1">
                            <i class="icon-lock"></i>
						  </span>
						  {input}
                        </div>
                        {error}
                        '])->passwordInput(['placeholder' => 'Password', 'style' => 'padding-left:25px;', 'placeholder' => Yii::t('app', 'Password'), 'aria-describedby' => 'basic-addon1']) ?>

                        <div class="checkbox float_left">
                            <a href="#">
                                <?php echo Yii::t('app', 'Forgot Password?'); ?>
                            </a>

                        </div>

                        <button type="submit" class="btn btn btn-danger pull-right btn_other_page">
                            <?php echo Yii::t('app', 'LOGIN'); ?>
                        </button>
                        <?php ActiveForm::end(); ?>

                    </div>
                    <!-- End form login -->

                    <!-- Regiter Link box -->
                    <div class="col-md-12">
                        <div class="login-or">
                            <span class="span-or"><?php echo Yii::t('app', 'or'); ?></span>
                        </div>
                    </div>

                    <h1> <?php echo !empty($loginSettings['message3']) ? $loginSettings['message3'] : Yii::t('app', 'Connect with HitsNL'); ?>
                        <br>
                        <small><?php echo !empty($loginSettings['message4']) ? $loginSettings['message4'] : Yii::t('app', 'Sign up with HitsNL  Account'); ?></small>
                    </h1>

                    <div class="col-md-12">

                        <button type="submit" class="btn btn btn-danger btn_other_page btn_full_div">
                            <?php echo Yii::t('app', 'Register'); ?>
                        </button>

                        <?php
                        if (isset($loginSettings['enablesocial']) && $loginSettings['enablesocial'] == 1) {
                            ?>
                            <div class="login-or">
                                <span class="span-or"><?php echo Yii::t('app', 'or') ?></span>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                    if (isset($loginSettings['enablesocial']) && $loginSettings['enablesocial'] == 1) {
                        ?>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn btn-facebook btn_other_page col-md-6 btn_full_div">
                                <i class="icon-facebook"></i>
                                <?php echo Yii::t('app', 'Login with facebook'); ?>
                            </button>
                        </div>

                        <div class="col-md-6">

                            <button type="submit" class="btn btn btn-danger btn_other_page col-md-6 btn_full_div">
                                <i class="icon-gplus"></i>
                                <?php echo Yii::t('app', 'Login with google plus'); ?>
                            </button>
                        </div>
                    <?php
                    }
                    ?>
                <?php } else {
                    ?>
                    <div class="alert alert-warning"
                         role="alert"><?php echo Yii::t('app', 'Login temp not available. Please come back later.'); ?></div>
                <?php

                } ?>
            </div>
        </div>
    </div>
</div>