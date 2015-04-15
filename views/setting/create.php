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

/* @var $this yii\web\View */
                /* @var $model app\models\Setting */

                $this->title = Yii::t('app', 'Create Setting');
                $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['index']];
                $this->params['breadcrumbs'][] = $this->title;
                ?>
                <div class="setting-create">

                    <h1><?= Html::encode($this->title) ?></h1>

                    <?=
                    $this->render('_form', [
                        'model' => $model,
                    ])
                    ?>

                </div>

            </div>
        </div>
    </div>
</div>