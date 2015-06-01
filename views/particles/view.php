<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Particles */

$this->title = 'Particel\'s number '.$model->particle_id;
$this->params['breadcrumbs'][] = ['label' => 'Particles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="particles-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'particle_id',
            'particle_type',
            'particle_key',
            'attributes:ntext',
            'created',
            'modified',
        ],
    ]) ?>

    <p>
        <?= Html::a('Edit', ['update', 'id' => $model->particle_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->particle_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
