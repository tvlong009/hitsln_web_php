<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserSetting */
$this->title = Yii::t('app',"Create User Setting");
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','User Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-setting-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
