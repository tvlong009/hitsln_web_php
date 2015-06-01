<?php \app\modules\menuwidget\assets\MenuAsset::register($this) ?>

<!-- ============================================ -->
<!-- start: PAGE CONTENT -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?=Yii::t('app','Create menu item')?>
            </div>
            <div class="panel-body">
                <?php
                /* @var $this yii\web\View */
                /* @var $model app\models\Languages */

                $this->title = Yii::t('app','Create menu item');
                $this->params['breadcrumbs'][] = ['label' => Yii::t('app','Menu'), 'url' => Yii::$app->urlManager->createAbsoluteUrl('menuwidget/menu')];
                $this->params['breadcrumbs'][] = ['label' => Yii::t('app','Menu item'), 'url' => ['index?menu_id=' . $menu->id]];
                $this->params['breadcrumbs'][] = $this->title;

                ?>
                <?= $this->render('_form', [
                    'model' => $model,
                    'menu' => $menu,
                    'items' => $items,
                    'languages' => $languages,
                    'pages' => $pages,
                ]) ?>
            </div>
        </div>
        <!-- end: FORM WIZARD PANEL -->
    </div>
</div>
<!-- end: PAGE CONTENT-->
<!-- ============================================ -->