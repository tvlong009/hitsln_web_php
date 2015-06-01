<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;
use app\models\Roles;
use app\models\UsersRoles;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

if (Yii::$app->session->hasFlash('success')) {
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

<div class="col-md-6">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php if ($model->isNewRecord === true) { ?>

        <?= $form->field($model, 'avatar')->fileInput(); ?>

    <?php } ?>


    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => 32, 'value' => uniqid()]) ?>


    <?php if ($model->isNewRecord === true) { ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]); ?>

    <?php } ?>


    <?= $form->field($model, 'require_change_password')->checkbox(); ?>

    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?php
    $rolemodle = new Roles();
    $roleslist = Roles::find()->all();
    if(empty($roleslist)){Yii::$app->session->setFlash('error', Yii::t('app', 'Please define roles'));}

    $arrayname = array();
    $arrayid = array();
   
    for ($i = 0; $i < count($roleslist); $i++) {

        $arrayid[$i] = $roleslist[$i]->id;
        $arrayname[$arrayid[$i]] = $roleslist[$i]->name;
    }
    if ($model->isNewRecord === true) {
        
           if(Yii::$app->session->hasFlash('error')){
           echo "<div><bold>". Yii::t('app',"Role Names")."</bold></div>";
           echo "<div style='color: red'>".Yii::$app->getSession()->getFlash('error')."</div>";
           }else{
           echo $form->field($rolemodle, 'name')->checkboxList($arrayname);}
    } else {
        $list = array();
        $listcheck = UsersRoles::findAll(['user_id' => $model->id]);
        for ($i = 0; $i < count($listcheck); $i++) {
            $list[$i] = $listcheck[$i]->role_id;
        }
        echo "<div><bold>". Yii::t('app',"Role Names")."</bold></div>";
        if(Yii::$app->session->hasFlash('error')){
            echo "<div style='color: red'>".Yii::$app->getSession()->getFlash('error')."</div>";
        }else{
        echo Html::checkboxList('Roles', $list, $arrayname, ['class' => '']);
        }
    }
    ?>
	
	<?php
	if (!empty($userpropertyList)) {
		foreach ($userpropertyList as $userproperty) {			
			echo app\modules\userpropertywidget\widgets\UserPropertyWidget::widget(['model' => $userproperty, 'user' => $model]);
		}
	}
	?>
	
    <?php echo $form->field($model, 'status')->dropDownList(['0' => Yii::t('app','New'), '1' => Yii::t('app','Active'), '2' => Yii::t('app','Inactive')]); ?>
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
            <?php echo Yii::t('app','Please check information before clicking the submit button');?>
        </p>
    </div>


    <div class="col-md-6">
        <div class="pull-right">

            <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>

        </div>												
    </div>                    
</div>

<?php ActiveForm::end(); ?>

