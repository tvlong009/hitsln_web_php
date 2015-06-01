<?php app\assets\PageAsset::register($this) ?>
<!-- ============================================ -->
<!-- start: PAGE CONTENT -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?= Yii::t('app','Edit pages')?>
            </div>
            <div class="panel-body">
                <?php
                $this->title = Yii::t('app','Edit page');
                $this->params['breadcrumbs'][] = ['label' => Yii::t('app','Pages'), 'url' => Yii::$app->urlManager->createAbsoluteUrl(['/pages'])];
                $this->params['breadcrumbs'][] = $this->title;
                echo $this->render('_form', array(
                    'model' => $model,
                    'pageContent' => $pageContent,
                    'languages' => $languages,
                    'particles' => $particles,
                    'checkTypePHP' => $checkTypePHP
                ));
                ?>
            </div>
        </div>
        <!-- end: FORM WIZARD PANEL -->
    </div>
</div>
<!-- end: PAGE CONTENT-->
<!-- ============================================ -->

