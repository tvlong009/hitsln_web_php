<?php app\assets\PortfolioAsset::register($this) ?>
<!-- ============================================ -->
<!-- start: PAGE CONTENT -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?=Yii::t('app','Add new portfolio')?>
            </div>
            <div class="panel-body">
                <?php
                $this->title = Yii::t('app','Portfolio add');
                $this->params['breadcrumbs'][] = ['label' => Yii::t('app','Particles'), 'url' => Yii::$app->urlManager->createAbsoluteUrl('particles')];
                $this->params['breadcrumbs'][] = ['label' => Yii::t('app','Portfolio'), 'url' => Yii::$app->urlManager->createAbsoluteUrl('cmsparticles/portfolio')];
                $this->params['breadcrumbs'][] = $this->title;
                echo $this->render('_form', array('model' => $model));
                ?>
            </div>
        </div>
    </div>
</div>
