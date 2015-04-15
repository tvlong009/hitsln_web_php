<?php app\assets\PortfolioAsset::register($this) ?>

<!-- ============================================ -->
<div class="row">
    <div class="col-sm-12">
        <!-- start: FORM WIZARD PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?=Yii::t('app','Portfolios')?>

                <div class="panel-tools">
                    <a class=" btn btn-xs btn-link " href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['cmsparticles/portfolio/add']); ?>">
                        <i class="fa fa-plus icon_18 color_green"></i>
                    </a>
                    <!-- btn add -->

                    <a class="btn btn-xs btn-link panel-config" href="javascript:void(0)" id="edit-portfolio">
                        <i class="fa fa-wrench icon_18 color_blue"></i>
                    </a>
                    <!-- btn edit -->

                    <a class=" btn btn-xs btn-link " href="javascript:void(0)" id="delete-portfolio">
                        <i class="fa fa-trash-o icon_18 color_red"></i>
                    </a>
                    <!-- btn delete -->


                    <a class="btn btn-xs btn-link panel-refresh" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('cmsparticles/portfolio/') ?>">
                        <i class="fa fa-refresh icon_18"></i>
                    </a>
                    <!-- btn refresh -->


                    <a class="btn btn-xs btn-link panel-expand" href="javascript:void(0)">
                        <i class="fa fa-resize-full icon_18"></i>
                    </a>

                </div>

            </div>
            <div class="panel-body">
                <?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('app','Portfolio');
 $this->params['breadcrumbs'][] = ['label' => Yii::t('app','Particles'), 'url' => Yii::$app->urlManager->createAbsoluteUrl('particles')];  
$this->params['breadcrumbs'][] = $this->title;

echo '<div id="error"></div>';

if (Yii::$app->session->hasFlash('error')) {
?>
<div class="alert alert-error alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?php echo Yii::$app->session->getFlash('error'); ?>
</div>
<?php
}

if (Yii::$app->session->hasFlash('success')) {
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?php echo Yii::$app->session->getFlash('success'); ?>
</div>
<?php
}

echo Html::beginForm('','post', ['id' => 'my_form']);
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'columns' => array(
        array(
            'attribute' => 'portfolio_name',
            'label' => 'Name'
        ),
        array(
            'attribute' => 'link',
            'label' => 'Link'
        ),
        array(
            'attribute' => 'status',
            'label' => 'Status',
            'format' => 'html',
            'value' => function($model, $key, $index, $columns) {
                if ($model['status'] == 1) {
                    return '<span class="label label-success">Enable</span>';
                } else {
                    return '<span class="label label-danger">Disable</span>';
                }
            }
        ),
        array(
            'attribute' => 'created',
            'label' => 'Date',
            'format' =>  array('date', 'php:d/m/Y')
        ),
        array(
            'class' => 'yii\grid\CheckboxColumn',
            'header' => 'Select',
            'name' => 'id[]',
            'checkboxOptions' =>function($model, $key, $index, $column){
                return ['class' => 'portfolio_id', 'value' => $model->portfolio_id];
            },
        ),
    ),
));

echo Html::endForm();
?>
            </div>
        </div>
    </div>
</div>
 <script type="text/javascript">
    var url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/cmsparticles/portfolio/') ?>";
    var root_url = "<?php echo Yii::$app->urlManager->baseUrl; ?>";
</script>   