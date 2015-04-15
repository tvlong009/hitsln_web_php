<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserSetting */

$this->title = 'Update User Setting: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-setting-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
