<?php \app\modules\menuwidget\assets\MenuAsset::register($this) ?>
<!-- ============================================ -->
<div class="row">
    <div class="col-sm-12">

        <!-- start: FORM WIZARD PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?= Yii::t('app', 'Menu item of ') . $menu->key; ?>

                <div class="panel-tools">
                    <a class=" btn btn-xs btn-link " href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['menuwidget/menu-item/create?menu_id=' . $menu->id]); ?>">
                        <i class="fa fa-plus icon_18 color_green"></i>
                    </a>
                    <!-- btn add -->

                    <a class="btn btn-xs btn-link panel-config" href="javascript:void(0)" id="edit-menu-item">
                        <i class="fa fa-wrench icon_18 color_blue"></i>
                    </a>
                    <!-- btn edit -->

                    <a class=" btn btn-xs btn-link " href="javascript:void(0)" id="delete-menu-item">
                        <i class="fa fa-trash-o icon_18 color_red"></i>
                    </a>
                    <!-- btn delete -->


                    <a class="btn btn-xs btn-link panel-refresh" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('menuwidget/menu-item?menu_id=' . $menu->id) ?>">
                        <i class="fa fa-refresh icon_18"></i>
                    </a>
                    <!-- btn refresh -->


                    <a class="btn btn-xs btn-link panel-expand" href="javascript:void(0)">
                        <i class="fa fa-resize-full icon_18"></i>
                    </a>

                </div>

            </div>
            <div class="panel-body">
                <div id="error"></div>
                <?php
                use \yii\helpers\Html;
                $this->title = Yii::t('app', 'Menu item');
                $this->params['breadcrumbs'][] = ['label' => 'Menu', 'url' => Yii::$app->urlManager->createAbsoluteUrl('menuwidget/menu')];
                $this->params['breadcrumbs'][] = $this->title;

                if (Yii::$app->session->hasFlash('success')) {
                    ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <?php echo Yii::$app->session->getFlash('success'); ?>
                    </div>
                <?php
                }

                echo Html::beginForm('', 'post', ['id' => 'my_form']);
                ?>
                <div id="items">
                    <?php echo $this->render('_items', array('items' => $items)); ?>
                </div>

                <?php Html::endForm(); ?>
            </div>
            <!-- end: FORM WIZARD PANEL -->
        </div>
    </div>
</div>
<!-- end: PAGE CONTENT-->
<!-- ============================================ -->
<?php // $this->registerJsFile('/js/page.js', array('position' => yii\web\View::POS_END) )  ?>
<script type="text/javascript">
    var url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('menuwidget/menu-item') ?>";
    var menu_id = "<?php echo $menu->id ?>";
</script>