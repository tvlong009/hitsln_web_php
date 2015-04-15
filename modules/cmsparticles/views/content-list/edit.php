<?php app\assets\ContentListAsset::register($this) ?>
<!-- start: PAGE HEADER -->
<!-- ============================================ -->
<div class="row">
    <div class="col-sm-12">
        <!-- start: FORM WIZARD PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?= Yii::t('app','Edit content lists')?>
            </div>
            <div class="panel-body">
                <?php
                /* @var $this yii\web\View */
                /* @var $model app\models\Languages */


                $this->title = Yii::t('app', 'Edit content list');
                $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Particles'), 'url' => Yii::$app->urlManager->createAbsoluteUrl('particles')];
                $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Content lists'), 'url' => Yii::$app->urlManager->createAbsoluteUrl('cmsparticles/content-list')];
                $this->params['breadcrumbs'][] = $this->title;
                ?>
                <?=
                $this->render('_form', [
                    'model' => $model,
                ])
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/cmsparticles/content-list/') ?>";
    var root_url = "<?php echo Yii::$app->urlManager->baseUrl; ?>";
</script>
