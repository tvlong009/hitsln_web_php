<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="box-login">
    <h3><?php echo Yii::t('app', 'Sign in to your account') ?></h3>
    <p>
        <?php echo Yii::t('app', 'Please enter your name and password to log in.') ?>
    </p>
    <?php
    $form = ActiveForm::begin(['id' => 'form-login',
                'fieldConfig' => [
                    'template' => "{input}\n{error}",
                ]
            ])
    ?>
    <?php if (Yii::$app->session->hasFlash('error')) { ?>
        <div class="errorHandler alert alert-danger">
            <i class="fa fa-remove-sign"></i> <?php echo Yii::$app->session->getFlash('error') ?>
        </div>
    <?php } ?>
    <fieldset>
        <div class="form-group">
            <span class="input-icon">
<!--                    <input type="text" class="form-control" name="username" placeholder="Username">-->
                <?= $form->field($model, 'username')->textInput(['placeholder' => 'Username', 'style' => 'padding-left:25px;']) ?>
                <i class="fa fa-user"></i> </span>
            <!-- To mark the incorrectly filled input, you must add the class "error" to the input -->
            <!-- example: <input type="text" class="login error" name="login" value="Username" /> -->
        </div>
        <div class="form-group form-actions">
            <span class="input-icon">
<!--                    <input type="password" class="form-control password" name="password" placeholder="Password">-->
                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password', 'style' => 'padding-left:25px;']) ?>
                <i class="fa fa-lock"></i>
                <a class="forgot" href="#\<?php Yii::$app->urlManager->createAbsoluteUrl('site/request-password-reset') ?>">
                   I forgot my password
                   </a> </span>
                   </div>
                   <div class="form-actions">
                   <label for="remember" class="checkbox-inline">
   <!--                    <input type="checkbox" class="grey remember" id="remember" name="remember">
                       Keep me signed in-->
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                    </label>

                    <button type="submit" class="btn btn-bricky pull-right">
                        <?php echo Yii::t('app', 'Login') ?> <i class="fa fa-arrow-circle-right"></i>
                    </button>
                    </div>
                    <div class="new-account">
                        <?php echo Yii::t('app', 'Don\'t have an account yet?') ?>
                        <a href="#" class="register">
                            <?php echo Yii::t('app', 'Create an account') ?>
                        </a>
                    </div>
                    </fieldset>
                    <?php ActiveForm::end(); ?>
                    </div>
                    <div class="box-forgot">
                        <h3><?php echo Yii::t('app', 'Forget Password?') ?></h3>
                        <p>
                            <?php echo Yii::t('app', 'Enter your e-mail address below to reset your password.') ?>
                        </p>
                        <form class="form-forgot">
                            <div class="errorHandler alert alert-danger no-display">
                                <i class="fa fa-remove-sign"></i> 
                                <?php echo Yii::t('app', 'You have some form errors. Please check below.') ?>
                            </div>
                            <fieldset>
                                <div class="form-group">
                                    <span class="input-icon">
                                        <input type="email" class="form-control" name="email" placeholder="Email">
                                        <i class="fa fa-envelope"></i> </span>
                                </div>
                                <div class="form-actions">
                                    <a class="btn btn-light-grey go-back">
                                        <i class="fa fa-circle-arrow-left"></i> 
                                        <?php echo Yii::t('app', 'Back') ?>
                                    </a>
                                    <button type="submit" class="btn btn-bricky pull-right">
                                        <?php echo Yii::t('app', 'Submit') ?> <i class="fa fa-arrow-circle-right"></i>
                                    </button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <!-- end: FORGOT BOX -->
                    <!-- start: REGISTER BOX -->
                    <div class="box-register">
                        <h3><?php echo Yii::t('app', 'Sign Up') ?></h3>
                        <p>
                            <?php echo Yii::t('app', 'Enter your personal details below:') ?>
                        </p>
                        <form class="form-register">
                            <div class="errorHandler alert alert-danger no-display">
                                <i class="fa fa-remove-sign"></i> 
                                <?php echo Yii::t('app', 'You have some form errors. Please check below.') ?>
                            </div>
                            <fieldset>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="full_name" placeholder="<?php echo Yii::t('app', 'Full Name') ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="address" placeholder="<?php echo Yii::t('app', 'Address') ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="city" placeholder="<?php echo Yii::t('app', 'City') ?>">
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label class="radio-inline">
                                            <input type="radio" class="grey" value="F" name="gender">
                                            <?php echo Yii::t('app', 'Female') ?>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" class="grey" value="M" name="gender">
                                            <?php echo Yii::t('app', 'Male') ?>
                                        </label>
                                    </div>
                                </div>
                                <p>
                                    <?php echo Yii::t('app', 'Enter your account details below:') ?>
                                </p>
                                <div class="form-group">
                                    <span class="input-icon">
                                        <input type="email" class="form-control" name="email" placeholder="<?php echo Yii::t('app', 'Email') ?>">
                                        <i class="fa fa-envelope"></i> </span>
                                </div>
                                <div class="form-group">
                                    <span class="input-icon">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="<?php echo Yii::t('app', 'Password') ?>">
                                        <i class="fa fa-lock"></i> </span>
                                </div>
                                <div class="form-group">
                                    <span class="input-icon">
                                        <input type="password" class="form-control" name="password_again" placeholder="<?php echo Yii::t('app', 'Password Again') ?>">
                                        <i class="fa fa-lock"></i> </span>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label for="agree" class="checkbox-inline">
                                            <input type="checkbox" class="grey agree" id="agree" name="agree">
                                            <?php echo Yii::t('app', 'I agree to the Terms of Service and Privacy Policy') ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <a class="btn btn-light-grey go-back">
                                        <i class="fa fa-circle-arrow-left"></i> 
                                        <?php echo Yii::t('app', 'Back') ?>
                                    </a>
                                    <button type="submit" class="btn btn-bricky pull-right">
                                        <?php echo Yii::t('app', 'Submit') ?> <i class="fa fa-arrow-circle-right"></i>
                                    </button>
                                </div>
                            </fieldset>
                        </form>
                    </div>