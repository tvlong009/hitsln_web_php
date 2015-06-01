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
if (Yii::$app->session->hasFlash('warning')) {
    ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('warning'); ?>
    </div>
<?php
}
if (Yii::$app->session->hasFlash('error')) {
    ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
<?php
}
?>

<div class="message">

</div>


<?php
$form = ActiveForm::begin([
          'id' => 'my-form',
          'options' => ['class' => 'form-horizontal',
            'enctype' => 'multipart/form-data'
          ],
        ]);
echo Html::hiddenInput('id', $model['id'], ['id' => 'id']);
echo Html::hiddenInput('Page[publish_date]', $model['publish_date'], ['id' => 'publishdate']);
?>
<div class="col-md-6">
    <?php
    echo $form->field($model, 'key')->textInput(['placeholder' => 'Name']);
    echo $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(Page::find()->all(), 'id', 'key'), ['prompt' => 'No parent selected']);
    ?>
    <div class="form-group">
        <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-picture"></i> <?= Yii::t('app', 'Upload multiple') ?></button>
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

    <div class="form-group">
        <div class="radio">
              <label>
                  <input type="radio" value="1" <?php echo empty($checkTypePHP) ? 'checked' : '' ?> name="content_type" class="content_type" />
                  <?php echo Yii::t('app', 'Content HTML'); ?>
              </label>
              <label>
                  <input type="radio" value="2" <?php echo !empty($checkTypePHP) ? 'checked' : '' ?> name="content_type" class="content_type" />
                  <?php echo Yii::t('app', 'PHP page'); ?>
              </label>
        </div>
    </div>
</div>

<div class="col-md-12" style="padding-left: 0">
    <ul id="myTab" class="nav nav-tabs tab-bricky">
        <?php
        if (count($languages) > 0) {
          foreach ($languages as $key => $language) {
            echo '<li role="presentation" class="' . ($key == 0 ? 'active' : '') . '">'
            . '<a href="#tab_' . Html::encode($language['id']) . '" onclick="currentLangID=\'' . $language['id'] . '\'" id="' .
            Html::encode($language['id']) . '-tab" role="tab" data-toggle="tab">' .
            Html::encode($language['name']) . '</a></li>';
          }
        }
        ?>
        <li class="pull-right">
            <a href="javascript:void(0)" id="preview" data-target="#previewPage" class="color_blue">
                <?= Yii::t('app', 'Preview') ?> <i class="fa fa-eye icon_16 "></i>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <?php
        foreach ($languages as $key => $language) {
          ?>
          <div role="tabpanel" class="tab-pane <?php echo ($key == 0 ? 'in active' : '') ?>" 
               data-id="<?php echo $language['id'] ?>"
               id="tab_<?php echo $language['id'] ?>" aria-labelledby="<?php echo $language['id'] ?>-tab">
              <div id="page-title" class="row" style="margin-bottom: 10px">
                  <label class="col-md-12"><?php echo Yii::t('app', 'Page title') ?></label>
                  <div class="col-md-6">
                      <input class="form-control" type="text" name="page_content[<?= $language['id'] ?>][title]" value="<?= $pageContent[$language['id']]['title'] ?>">
                  </div>
              </div>
              <div id="page-title" class="row" style="margin-bottom: 15px">
                  <label class="col-md-12"><?php echo Yii::t('app', 'Image Header') ?></label>
                  <?php if (isset($pageContent[$language['id']]['header_img']) && $pageContent[$language['id']]['header_img'] != '') { ?>
                    <?php echo Html::img('@web/uploads/pages/header_img/' . $pageContent[$language['id']]['header_img'], ['width' => '100', 'height' => '100', 'style' => 'margin-left:10px;']) ?>
                    <div class="checkbox" style="margin-left: 15px;">
                        <label>
                            <input type="checkbox" value="1"
                                   name="delete_header_img"/> <?php echo Yii::t('app', 'Delete this image ?'); ?>
                        </label>
                    </div>
                  <?php } ?>
                  <input type="file" style="padding-left: 15px;" name="PageContent[image_header_<?php echo $language->id ?>]"/>
              </div>
              <div class="content_html">
                  <?php
                  echo yii\redactor\widgets\Redactor::widget([
                    'model' => $pageContent[$language['id']],
                    'attribute' => 'content',
                    'options' => [
                      'id' => 'content_' . $language['id'],
                      'name' => 'page_content[' . $language['id'] . '][content]',
                      'class' => 'form-control'
                    ],
                    'clientOptions' => [
                      'plugins' => ['imagemanager', 'clips', 'fontcolor', 'particles'],
                      'imageManagerJson' => \yii\helpers\Url::toRoute('/media/image-json'),
                      'imageUpload' => \yii\helpers\Url::toRoute('/redactor/upload/image'),
                      'fileUpload' => \yii\helpers\Url::toRoute('/redactor/upload/file'),
                      'buttonSource' => TRUE,
                      'replaceDivs' => false
                    ],
                  ]);
                  ?>
              </div>

              <div class="hidden content_php">
                  <label class=""><?php echo Yii::t('app', 'Upload PHP file') ?></label>
                  <input type="file" name="PageContent[php_<?php echo $language->id ?>]"/>
                  <?php if (!empty($checkTypePHP)) { ?>
                  <br/>
                  <a href="javascript:void(0)" class="view_file" id="<?php echo $pageContent[$language['id']]->content ?>"><?php echo $pageContent[$language['id']]->content ?></a>
                  <?php } ?>
              </div>
          </div>
          <?php
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
            <?= Yii::t('app', 'Please check information before clicking the submit button') ?>
        </p>
    </div>


    <div class="col-md-6">
        <div class="pull-right">
            <button class="btn btn-success" type="submit" name="submit" value="draft">
                <i class="fa fa-save"></i> <?= Yii::t('app', 'Save as draft'); ?>
            </button>

            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#Scheduled_Publish" id="schedulepublish">
                <i class="fa fa-clock-o"></i> <?= Yii::t('app', 'Scheduled Publish'); ?>
            </button>

            <button class="btn btn-warning" type="submit" name="submit" value="publish">
                <i class="fa fa-arrow-circle-right"></i> <?= Yii::t('app', 'Publish') ?>
            </button>

        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<div class="modal hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Modal header</h3>
    </div>
    <div class="modal-body">
    </div>
</div>
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
                        <input type="text" data-date-format="mm/dd/yyyy" name="publish_date" id="publish_date" data-date-viewmode="years" class="form-control date-picker" value="<?php echo (!$model->isNewRecord && $model->publish_date != null) ? date('m/d/Y', strtotime($model->publish_date)) : ''; ?>">
                        <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
                    </div>
                    <hr>

                    <p>
                        <?= Yii::t('app', 'Time ') ?>
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
                <button type="button" class="btn btn-primary" id="savepublishdate"><?= Yii::t('app', 'Publish') ?></button>
            </div>
        </div>
    </div>
</div>
<!-- END:Scheduled_Publish -->

<!-- my modal to reactor edit -->
<!-- Modal -->
<script type="text/javascript">
  var particles_html = '';
<?php
if ($particles) {
  $counter = count($particles->all());
  $particleItems = $particles->all();
  $rowCount = round($counter / 2);
  ?>
    particles_html += '<table class = "table particle">';
  <?php
  $i = 0;
  $j = $rowCount;
  for ($row = 0, $rowCount; $row < $rowCount; $row++) {
    ?>
      particles_html += '<tr>';
    <?php if (isset($particleItems[$i])) { ?>
        particles_html += '<td><input type="checkbox" value="<?php echo $particleItems[$i]->key ?>"' +
                ' class="particle-item" style="margin-right:10px;"/><?php echo $particleItems[$i]->key ?></td>';
      <?php
    }
    if (isset($particleItems[$j])) {
      ?>
        particles_html += '<td><input type="checkbox" value="<?php echo $particleItems[$j]->key ?>"' +
                ' class="particle-item" style="margin-right:10px;"/><?php echo $particleItems[$j]->key ?></td>';
    <?php } ?>
      particles_html += '</tr>';
    <?php
    $i++;
    $j++;
  }
  ?>
    particles_html += '</table>';
  <?php
}
?>
  if (!RedactorPlugins)
      var RedactorPlugins = {};
  RedactorPlugins.particles = function () {
      return {
          getTemplate: function () {
              return String() + '<section id="redactor-modal-particles">' + particles_html + '</section>';
          },
          init: function () {
              var button = this.button.add('particles', 'Particles list');
              this.button.addCallback(button, this.particles.show);
              this.button.setAwesome('particles', 'fa-book');
          },
          show: function () {
              this.modal.addTemplate('particles', this.particles.getTemplate());
              this.modal.load('particles', 'Particles list', 400);
              this.modal.createCancelButton();
              var button = this.modal.createActionButton('Insert');
              button.on('click', this.particles.insert);
              this.selection.save();
              this.modal.show();
          },
          insert: function () {
              var html = '';
              $('.particle-item').each(function (index, item) {
                  if ($(this).is(':checked')) {
                      var particle_key = $(this).val();
                      html += '{{' + particle_key + '}}';
                  }
              });
              this.modal.close();
              this.selection.restore();
              this.insert.html(html);
              this.code.sync();
          }
      };
  };</script>
<script type="text/javascript">
  var urlMedia = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/media') ?>";
  var urlPages = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/pages') ?>";
  var urlPageFrontEnd = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/home/index') ?>";
  var urlPreviewPageFrontEnd = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/home/preview-page') ?>";
  var currentLangID = <?php echo isset($languages[0]) ? $languages[0]['id'] : 0 ?>;
</script>

<div class="modal fade" id="preview_modal" tabindex="-1" role="dialog" 
     style="z-index: 1053"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:90%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Preview page</h4>
            </div>
            <div class="modal-body">
                <iframe id="page_preview_modal" style="width:100%;height:400px;border:none"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

