<?php app\assets\PermissionAsset::register($this) ?>
<?php

use yii\helpers\Html; ?>
<!-- ============================================ -->
<div class="row">
    <div class="col-sm-12">

        <!-- start: FORM WIZARD PANEL -->
        <div class="panel panel-default user_permission">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?php echo Yii::t('app', 'User Permission'); ?>             
            </div>
            <div class="panel-body">

                <?php
                /* @var $this yii\web\View */

                $this->title = Yii::t('app', 'Permission');
                $this->params['breadcrumbs'][] = $this->title;
                ?>
                <div class="row col-sm-12 col-md-12 col-lg-12">
                    <div class="dual-list list-left col-sm-5 col-md-5 col-lg-5">
                        <div class="well text-right">
                            <div class="row">
                                <div class="col-md-12" align="center">

                                    <div class="input-group">
                                        <span class="input-group-addon glyphicon glyphicon-search"></span>
                                        <input type="text" name="SearchUserNameList" class="form-control" placeholder="<?php echo Yii::t('app', 'Search username') ?>" />
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group">
                                <div class="User_list" style="overflow: auto; height: 200px;">
                                    <?php foreach ($user_array as $user) { ?>
                                        <li align='left' id='<?php echo $user->id ?>'class='list-group-item'><?php echo $user->username ?></li>
                                    <?php }
                                    ?>
                                </div>
                            </ul>

                        </div>
                    </div>
                    <div class="dual-list list-right col-sm-7 col-md-7 col-lg-7">
                        <div class="well"  style="width: 100%">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="btn-group">
                                        <a class="btn btn-default selector" title="select all"><i class="glyphicon glyphicon-unchecked"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-10" >
                                    <div class="input-group">
                                        <b><?php echo Yii::t('app', 'Actions') ?></b>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group">
                                <div class="user_permission_list" style="overflow: auto; height: 200px; ">
                                    <div id ="scroll" style='margin: 0 auto;' >
                                        <!--- output here-->
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class=" col-md-12">
                    <button  type="button" class="btn btn-success buttonSaveUserPermission pull-right"><?php echo Yii::t('app', 'Save'); ?></button>
                </div>
            </div>
            <!-- end: FORM WIZARD PANEL -->
        </div>
        <div class="panel panel-default role_permission">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?php echo Yii::t('app', 'Role Permission'); ?>             

            </div>
            <div class="panel-body">
                <?php
                /* @var $this yii\web\View */
                $this->title = Yii::t('app', 'Permission');
                $this->params['breadcrumbs'][] = $this->title;
                ?>
                <div class="row col-sm-12 col-md-12 col-lg-12">
                    <div class="dual-list list-left col-sm-5 col-md-5 col-lg-5">
                        <div class="well text-right">
                            <div class="row">
                                <div class="col-md-12" align="center">

                                    <div class="input-group">
                                        <span class="input-group-addon glyphicon glyphicon-search"></span>
                                        <input type="text" name="SearchUserNameList" class="form-control" placeholder="<?php echo Yii::t('app', 'Search role') ?>" />
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group">
                                <div class="role_list" style="overflow: auto; height: 200px;">
                                    <?php if (!empty($roles) && is_array($roles)) { ?>
                                        <div class="">
                                            <?php foreach ($roles as $role) { ?>
                                                <li align='left' id='<?php echo $role->id ?>'class='list-group-item'><?php echo $role->name ?></li>
                                            <?php }
                                            ?>
                                        <?php }
                                        ?>
                                    </div>
                            </ul>

                        </div>
                    </div>
                    <div class="dual-list list-right col-sm-7 col-md-7 col-lg-7">
                        <div class="well"  style="width: 100%">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="btn-group">
                                        <a class="btn btn-default selector" title="select all"><i class="glyphicon glyphicon-unchecked"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-10" >
                                    <div class="input-group">
                                        <b><?php echo Yii::t('app', 'Actions') ?></b>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group">
                                <div class="role_permission_list" style="overflow: auto; height: 200px; ">
                                    <div id ="scroll" style='margin: 0 auto;' >
                                        <!--- output here-->
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class=" col-md-12">
                    <button  type="button" class="btn btn-success buttonSaveRolePermission pull-right"><?php echo Yii::t('app', 'Save Permission'); ?></button>
                </div>
            </div>
            <!-- end: FORM WIZARD PANEL -->
        </div>
    </div>
</div>
<!-- end: PAGE CONTENT-->
<!-- ============================================ -->    
<script type="text/javascript">
    var url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/permission') ?>";
    var root_url = "<?php echo Yii::$app->urlManager->baseUrl; ?>";
</script>