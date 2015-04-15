<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Page;

if (Yii::$app->session->hasFlash('success')) {
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success'); ?>
    </div>
    <?php
}
?>

<?php
$form = ActiveForm::begin([
            'id' => 'my-form',
            'options' => ['class' => 'form-horizontal'],
        ]);
    echo Html::hiddenInput('id', $model['page_id'], ['id' => 'page_id']);
    echo Html::hiddenInput('Page[publish_date]', $model['publish_date'], ['id' => 'publishdate']);
?>
<div class="col-md-6">
    <?php
    echo $form->field($model, 'page_key')->textInput(['placeholder' => 'Name']);
    echo $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(Page::find()->all(), 'page_id', 'page_key'), ['prompt' => 'No parent selected']);
    ?>
    <div class="form-group">
        <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-picture"></i> <?= Yii::t('app', 'Add media') ?></button>
    </div>
    <!-- Modal -->
    <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" style="z-index: 1100;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                ...
            </div>
        </div>
    </div>
    <!-- end of modal -->
</div>

<div class="col-md-12" style="padding-left: 0">
    <ul id="myTab" class="nav nav-tabs tab-bricky">
        <?php
        if (count($languages) > 0) {
            foreach ($languages as $key => $language) {
                echo '<li role="presentation" class="' . ($key == 0 ? 'active' : '') . '"><a href="#' . Html::encode($language['description']) . '" id="' . Html::encode($language['description']) . '-tab" role="tab" data-toggle="tab">' . Html::encode($language['name']) . '</a></li>';
            }
        }
        ?>
        <li class="pull-right">
            <a href="#" class="color_blue">
                <?= Yii::t('app', 'Preview') ?> <i class="fa fa-eye icon_16 "></i>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <?php
        foreach ($languages as $key => $language) {
            echo '<div role="tabpanel" class="tab-pane ' . ($key == 0 ? 'in active' : '') . '" id="' . $language['description'] . '" aria-labelledby="' . $language['description'] . '-tab">';
            echo yii\redactor\widgets\Redactor::widget([
                'model' => $pageContent[$language['language_id']],
                'attribute' => 'page_content',
                'options' => [
                    'id' => 'content_' . $language['name'],
                    'name' => 'page_content[' . $language['language_id'] . ']',
                    'class' => 'form-control'
                ],
                'clientOptions' => [
                    'plugins' => ['imagemanager'],
                    'imageManagerJson' => Yii::$app->urlManager->createAbsoluteUrl('media/image-json'),
                    'imageUpload' => '/redactor/upload/image',
                    'fileUpload' => '/redactor/upload/file'
                ],
            ]);
            echo '</div>';
        }
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div>
            <hr>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <p>
            <?= Yii::t('app','Please check information before clicking the submit button') ?>
        </p>
    </div>


    <div class="col-md-6">
        <div class="pull-right">

            <button class="btn btn-success" type="submit" name="savedraft">
                <i class="fa fa-save"></i> <?= Yii::t('app','Save as draft'); ?>
            </button>

            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#Scheduled_Publish" id="schedulepublish">
                <i class="fa fa-clock-o"></i> <?= Yii::t('app', 'Scheduled Publish');  ?>
            </button>

            <button class="btn btn-warning" type="submit" name="publish">
                <i class="fa fa-arrow-circle-right"></i> <?= Yii::t('app','Publish') ?>
            </button>

        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<!-- Scheduled_Publish		 -->

<!-- Modal -->
<div class="modal fade" id="Scheduled_Publish" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1100">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Publish On : </h4>
            </div>
            <div class="modal-body">
                <!-- Content -->
                <div id="publishdate_error">

                </div>
                <form action="" method="post" class="form-horizontal">
                    <p>
                        <?= Yii::t('app', 'Date'); ?>:
                    </p>
                    <div class="input-group">
                        <input type="text" data-date-format="mm/dd/yyyy" name="publish_date" id="publish_date" data-date-viewmode="years" class="form-control date-picker" value="<?php echo !$model->isNewRecord ? date('m/d/Y', strtotime($model->publish_date)) : ''; ?>">
                        <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
                    </div>
                    <hr>

                    <p>
                        <?= Yii::t('app','Time ') ?>
                    </p>
                    <div class="input-group input-append bootstrap-timepicker">
                        <input type="text" class="form-control time-picker" name="publish_time" id="publish_time">
                        <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
                    </div>

                </form>
                <!-- eND CONTENT -->
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                <button type="button" class="btn btn-primary" id="savepublishdate"><?=Yii::t('app', 'Publish') ?></button>
            </div>
        </div>
    </div>
</div>
<!-- END:Scheduled_Publish -->

<!-- my modal to reactor edit -->
<!-- Modal -->
<div class="modal fade" id="myParticle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1100">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?= Yii::t('app','Particle list' ) ?></h4>
            </div>
            <div class="modal-body">
                <div id="particle-data">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if ($particles) {
                                $counter = count($particles->all());
                                $particleItems = $particles->all();
                                $rowCount = round($counter/2);
                            ?>
                            <table class="table particle">
                                <?php
                                $i = 0;
                                $j = $rowCount;
                                for($row = 0, $rowCount; $row < $rowCount; $row++){
                                    echo '<tr>';
                                    if (isset($particleItems[$i])) {
                                        echo '<td><input type="checkbox" value="'.$particleItems[$i]->particle_key.'" class="particle-item" style="margin-right:10px;"/>'.$particleItems[$i]->particle_key.'</td>';
                                    }

                                    if (isset($particleItems[$j])) {
                                        echo '<td><input type="checkbox" value="'.$particleItems[$j]->particle_key.'" class="particle-item" style="margin-right:10px;"/>'.$particleItems[$j]->particle_key.'</td>';
                                    }
                                    echo '</tr>';
                                    $i++;
                                    $j++;
                                }
                                ?>
                            </table>
                            <?php
                             }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="save"><?= Yii::t('app','Save changes') ?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var urlMedia = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/media') ?>";
    var urlPages = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/pages') ?>";
</script>