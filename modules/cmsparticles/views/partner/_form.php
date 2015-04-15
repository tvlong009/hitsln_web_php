<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin([
            'id' => 'my-form-partner',
            'options' => ['class' => 'form-horizontal'],            
        ]);
if (Yii::$app->session->hasFlash('success')) {
    ?>                
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success'); ?>
    </div>
<?php }
?>
<div class="col-md-6">
    <?php
    echo $model->isNewRecord ? Html::hiddenInput('partner_add', '1', ['id' => 'partner_add']) : Html::hiddenInput('partner_id', $model->primaryKey, ['id' => 'partner_id']);
    echo $form->field($model, 'partner_name')->textInput(['placeholder' => Yii::t('app','Title')]);
    echo $form->field($model, 'link')->textInput(['placeholder' => Yii::t('app','Link')]);
    echo $form->field($model, 'partner_description')->textarea(['class' => 'form-control', 'placeholder' => 'Description']);

    echo $form->field($model, 'status')->dropDownList(['1' => Yii::t('app','Enable'), '0' => Yii::t('app','Disable')]);
    ?>
</div>
<div id="images">

</div>
<!-- end of modal -->
<?php ActiveForm::end(); ?>
<div class="col-md-12" style="padding-left:0">
    <form id="fileupload_partner" action="<?php echo Yii::$app->urlManager->createAbsoluteUrl('media/upload') ?>" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value=""></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
                <div class="col-lg-9">
                    <!-- The fileinput-button span is used to style the file input field as button -->
                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span><?=Yii::t('app','Add files...')?></span>
                        <input type="file" name="files[]" multiple>
                    </span>
                    <button type="submit" class="btn btn-primary start">
                        <i class="glyphicon glyphicon-upload"></i>
                        <span><?=Yii::t('app','Start upload')?></span>
                    </button>
                    <button type="reset" class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span><?=Yii::t('app','Cancel upload')?></span>
                    </button>
                    <button type="button" class="btn btn-danger delete">
                        <i class="glyphicon glyphicon-trash"></i>
                        <span><?=Yii::t('app','Delete')?></span>
                    </button>
                    <input type="checkbox" class="toggle">
                    <!-- The global file processing state -->
                    <span class="fileupload-process"></span>
                </div>
                <!-- The global progress state -->
                <div class="col-lg-5 fileupload-progress fade">
                    <!-- The global progress bar -->
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                    </div>
                    <!-- The extended global progress state -->
                    <div class="progress-extended">&nbsp;</div>
                </div>
            </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped" style="width:70%;"><tbody class="files"></tbody></table>
    </form>
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
            <?= Yii::t('app', 'Please check information before clicking the submit button')?>
        </p>
    </div>


    <div class="col-md-6">
        <div class="pull-right">

<?php echo Html::submitButton($model->isNewRecord ? Yii::t('app','Add') : Yii::t('app','Edit'), ['class' => 'btn btn-primary pull-right', 'id' => 'add_partner']); ?>

        </div>												
    </div>                    
</div>

<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">                    
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size"><?=Yii::t('app','Processing...')?></p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span><?=Yii::t('app','Start')?></span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span><?=Yii::t('app','Cancel')?></span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <input type="hidden" class="image-item" value="{%=file.name%}" />        
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger"><?=Yii::t('app','Error')?></span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span><?=Yii::t('app','Delete')?></span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span><?=Yii::t('app','Cancel')?></span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<script type="text/javascript">
    var urlMedia = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/media') ?>";
</script>