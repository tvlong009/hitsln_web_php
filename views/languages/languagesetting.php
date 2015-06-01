<?php app\assets\LanguageAsset::register($this) ?>
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->title = Yii::t('app', 'Translate Languages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
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
if (Yii::$app->session->hasFlash('error')) {
    ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
    <?php
}
?>
<div class="alert_messages"></div>
<?php if (!empty($source_messages)) { ?>
<div class="container">
    <div class="row">
        <div class="form-group col-md-12">
            <h2><?php echo Yii::t('app', 'Choose language'); ?></h2>
            <select class="form-control language_seleted">
                <?php
                if (!empty($language_array)) {
                    foreach ($language_array as $language) {
                        ?>
                        <option value= '<?php echo $language->code; ?>'><?php echo $language->name; ?></option>
                    <?php }
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-12">
            <h2><?php echo Yii::t('app', 'Translate language'); ?></h2>
            <div class="message_list" style="overflow: auto; height: 400px; ">
                <div class="source_messages"><!----output here--></div>
            </div>
        </div>
    </div>
</div>
<div class=" col-md-12" style="margin-top: 10px;">
    <button  type="button" class="btn btn-success buttonSaveLanguageMessage pull-right"><?php echo Yii::t('app', 'Save Translation'); ?></button>
</div>
<?php } ?>
<script type="text/javascript">
    var url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/languages') ?>";
    var root_url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/'); ?>";
</script>