<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Languages */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="languages-view">



    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'level',
            'is_master',
            'is_default',
        ],
    ])
    ?>

    <div class="col-md-12">
        <div class="pull-right">
            <?= Html::a(Yii::t('app','Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            
        </div>
    </div>
</div>
