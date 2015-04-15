<!-- ============================================ -->
<div class="row">
    <div class="col-sm-12">

        <!-- start: FORM WIZARD PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                Setting                

            </div>
            <div class="panel-body">
                <?php

                use yii\helpers\Html;
                use yii\widgets\DetailView;

/* @var $this yii\web\View */
                /* @var $model app\models\Setting */

                $this->title = $model->key;
                $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['index']];
                $this->params['breadcrumbs'][] = $this->title;
                ?>
                <div class="setting-view">
                    <?=
                    DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'key',
                            'value:ntext',
                        ],
                    ])
                    ?>
                    <div class=" col-xs-12 text-right">
                        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->key], ['class' => 'btn btn-primary']) ?>
                        <?=
                        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->key], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>