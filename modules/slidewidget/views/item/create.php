<?php

use yii\helpers\Html;

?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?= Yii::t('app','Create Item')?>
            </div>
            <div class="panel-body">
                <?php
                $this->title = Yii::t('app','Create Item');
                $this->params['breadcrumbs'][] = ['label' => Yii::t('app','Slide Widget Items'), 'url' => Yii::$app->urlManager->createAbsoluteUrl(['/slidewidget/item'])];
                $this->params['breadcrumbs'][] = $this->title;
                echo $this->render('_form', array(
                    'model' => $model,
                ));
                ?>
            </div>
        </div>           
        <!-- end: FORM WIZARD PANEL -->        
    </div>
</div>