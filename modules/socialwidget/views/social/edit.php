<?php app\modules\socialwidget\assets\SocialAsset::register($this) ?>

<!-- ============================================ -->
<!-- start: PAGE CONTENT -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                Edit social                
            </div>
            <div class="panel-body">
                <?php
                $this->title = Yii::t('app','Edit social link');
                $this->params['breadcrumbs'][] = ['label' => Yii::t('app','Social Link'), 'url' => Yii::$app->urlManager->createAbsoluteUrl('socialwidget/social')];
                $this->params['breadcrumbs'][] = $this->title;
                echo $this->render('_form', array('model' => $model));
                ?>
            </div>            
        </div>
    </div>
</div>
