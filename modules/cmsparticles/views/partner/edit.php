<?php app\assets\PartnerAsset::register($this) ?>

<!-- ============================================ -->
<!-- start: PAGE CONTENT -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                Edit partner                
            </div>
            <div class="panel-body">
                <?php
                $this->title = Yii::t('app','Edit partner');
                $this->params['breadcrumbs'][] = ['label' => Yii::t('app','Particles'), 'url' => Yii::$app->urlManager->createAbsoluteUrl('particles')];
                $this->params['breadcrumbs'][] = ['label' => Yii::t('app','Partner'), 'url' => Yii::$app->urlManager->createAbsoluteUrl('cmsparticles/partner')];
                $this->params['breadcrumbs'][] = $this->title;
                echo $this->render('_form', array('model' => $model));
                ?>
            </div>            
        </div>
    </div>
</div>
