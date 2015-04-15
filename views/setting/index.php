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
                use yii\grid\GridView;

/* @var $this yii\web\View */
                /* @var $dataProvider yii\data\ActiveDataProvider */

                $this->title = Yii::t('app', 'Settings');
                $this->params['breadcrumbs'][] = $this->title;
                ?>
                <div class="setting-index">
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'key',
                            'value:ntext',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]);
                    ?>
                    <div class=" col-xs-12 text-right">
                        <?= Html::a(Yii::t('app', 'Create Setting'), ['create'], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>