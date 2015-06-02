<?php
\app\modules\signupwidget\assets\SignUpAsset::register($this);
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="other_page">
    <div class="container">
        <div class="row">
            <div class="col-md-12 logo">
                <?php if (isset($signupSettings['logo']) && $signupSettings['logo'] != '') { ?>
                    <?php
                    ?>
                    <?php echo Html::img($imageUrl . 'uploads/' . $signupSettings['logo']) ?>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3 box_otherpage">
                <?php
                if (isset($signupSettings['enablesocial']) && $signupSettings['enablesocial'] == 1) {
                    ?>
                    <div class="col-md-6 margin_bottom_20 margin_top_40">
                        <button type="submit" class="btn btn btn-facebook btn_other_page col-md-6 btn_full_div">
                            <i class="icon-facebook"></i>
                            <?php echo Yii::t('app', 'Login with facebook'); ?>
                        </button>
                    </div>

                    <div class="col-md-6 margin_bottom_20 margin_top_40">

                        <button type="submit" class="btn btn btn-danger btn_other_page col-md-6 btn_full_div">
                            <i class="icon-gplus"></i>
                            <?php echo Yii::t('app', 'Login with google plus'); ?>
                        </button>
                    </div>

                    <div class="col-md-12">
                        <div class="login-or">
                            <span class="span-or"><?php echo Yii::t('app', 'or'); ?></span>
                        </div>
                    </div>

                    <!-- END:Regiter Link box -->
                <?php } ?>
                <div class="col-md-12">
                    <?php if (Yii::$app->session->hasFlash('success')) {
                        ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo Yii::$app->session->getFlash('success'); ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if (Yii::$app->session->hasFlash('error')) {
                        ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo Yii::$app->session->getFlash('error'); ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    $form = ActiveForm::begin([
                                'id' => 'form-signup',
                            ])
                    ?>
                    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => 32, 'value' => uniqid(), 'type' => 'hidden'])->label(false) ?>
                    <?php
                    echo $form->field($model, 'username', ['template' => '
                        <div class="input-group input-group-lg">
						  <span class="input-group-addon" id="basic-addon1">
						 	 <i class="icon-users"></i>
						  </span>
						  {input}
						  </div>
						  {error}
                        '])->textInput([
                        'class' => 'form-control',
                        'placeholder' => Yii::t('app', 'Username'),
                        'aria-describedby' => 'basic-addon1'
                    ])
                    ?>
                    <?php
                    if (!$require_change_password) {
                        ?>
                        <?php
                        echo $form->field($model, 'password', ['template' => '
                        <div class="input-group input-group-lg">
						  <span class="input-group-addon" id="basic-addon1">
						 	 <i class="icon-lock"></i>
						  </span>
						  {input}
						  </div>
						  {error}
                        '])->passwordInput([
                            'class' => 'form-control',
                            'placeholder' => Yii::t('app', 'Password'),
                            'aria-describedby' => 'basic-addon1'
                        ])
                        ?>

                        <?php
                        echo $form->field($model, 'password_repeat', ['template' => '
                        <div class="input-group input-group-lg">
						  <span class="input-group-addon" id="basic-addon1">
						 	 <i class="icon-lock"></i>
						  </span>
						  {input}
						  </div>
						  {error}
                        '])->passwordInput([
                            'class' => 'form-control',
                            'placeholder' => Yii::t('app', 'Password confirmation'),
                            'aria-describedby' => 'basic-addon1'
                        ])
                        ?>
                    <?php } ?>
                    <?php
                        echo $form->field($model, 'name', ['template' => '
                        <div class="input-group input-group-lg">
						  <span class="input-group-addon" id="basic-addon1">
						 	 <i class="icon-user"></i>
						  </span>
						  {input}
						  </div>
						  {error}
                        '])->textInput([
                            'class' => 'form-control',
                            'placeholder' => Yii::t('app', 'Name'),
                            'aria-describedby' => 'basic-addon1'
                        ])
                        ?>
                    <?php
                    echo $form->field($model, 'email', ['template' => '
                        <div class="input-group input-group-lg">
						  <span class="input-group-addon" id="basic-addon1">
						 	 <i class="fa fa-envelope"></i>
						  </span>
						  {input}
						  </div>
						  {error}
                        '])->textInput([
                        'class' => 'form-control',
                        'placeholder' => Yii::t('app', 'Email'),
                        'aria-describedby' => 'basic-addon1'
                    ])
                    ?>
                    <div class="form-group connected-group text_align_left">
                        <label class="control-label">
                            <span class=""><?php echo Yii::t('app', 'Date of Birth') ?> </span>
                        </label>
                        <div class="row">
                            <div class="col-md-4">
                                <select name="dd" id="dd" class="form-control ">
<?php
for ($i = 1; $i < 32; $i++) {
    ?>
                                        <option value="<?php echo $i ?>"><?php echo sprintf("%02d", $i); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="mm" id="mm" class="form-control">
<?php
for ($i = 1; $i < 13; $i++) {
    ?>
                                        <option value="<?php echo $i ?>"><?php echo sprintf("%02d", $i); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="yy" id="yy" class="form-control">
                                    <?php
                                    $now = date('Y');
                                    $minYear = $now - 60;
                                    for ($i = $now; $i >= $minYear; $i--) {
                                        ?>
                                        <option value="<?php echo $i ?>"><?php echo $i; ?></option>
    <?php
}
?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text_align_left">
                        <div>
                            <label class="radio-inline">
                                <input type="radio" class="grey" value="0" name="gender" id="gender_female">
                        <?php echo Yii::t('app', 'Female'); ?>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" class="grey" value="1" checked name="gender" checked  id="gender_male">
                        <?php echo Yii::t('app', 'Male'); ?>
                            </label>
                        </div>
                        <br>
<?php
if (isset($signupSettings['term_condition']) && $signupSettings['term_condition'] != '') {
    echo $signupSettings['term_condition'];
} else {
    echo Yii::t('app', '<p>By clicking on Sign up, you agree to HitsNL  <a class="under_line " href="">terms & conditions</a> and privacy policy</p>');
}
?>
                    </div>
                </div>
                <div class="col-md-12 text_align_left">
                    <button type="submit" class="btn btn btn-danger btn_other_page btn_full_div">
                    <?php echo Yii::t('app', 'SIGUP'); ?>
                    </button>
                    <br><br>
<?php
if (isset($signupSettings['sign_in']) && $signupSettings['sign_in'] != '') {
    echo $signupSettings['sign_in'];
} else {
    echo Yii::t('app', '<p>Already have an account?  <a class="under_line " href="' . $loginUrl . '">Log in </a> </p>');
}
?>
                </div>
                <!-- End a box -->
<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>