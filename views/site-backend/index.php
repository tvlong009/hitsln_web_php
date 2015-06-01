<div class="row">
    <div class="col-sm-12">

        <!-- start: PAGE TITLE & BREADCRUMB -->
        <ol class="breadcrumb">
            <li>
                <i class="clip-file"></i>
                <a href="#">
                    <?php echo Yii::t('app', 'Home') ?>
                </a>
            </li>
            <li class="active">
                <?php echo Yii::t('app', 'Control Panel') ?>
            </li>
            <li class="search-box">
                <form class="sidebar-search">
                    <div class="form-group">
                        <input type="text" placeholder="<?php echo Yii::t('app', 'Start Searching...') ?>">
                        <button class="submit">
                            <i class="clip-search-3"></i>
                        </button>
                    </div>
                </form>
            </li>
        </ol>
        <div class="page-header">
            <h1><?php echo Yii::t('app', 'Home') ?> <small><?php echo Yii::t('app', 'Control panel') ?></small></h1>
        </div>
        <!-- end: PAGE TITLE & BREADCRUMB -->
    </div>
</div>
<?php if (Yii::$app->session->hasFlash('error')) { ?>
    <div class="errorHandler alert alert-danger">
        <i class="fa fa-remove-sign"></i> <?php echo Yii::$app->session->getFlash('error') ?>
    </div>
<?php } ?>
<div class="row">
    <div class="rowd">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon-external-link-sign"></i>
                    <?php echo Yii::t('app', 'Quick Menu') ?>
                    <div class="panel-tools">
                        <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                        </a>
                        <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                            <i class="icon-wrench"></i>
                        </a>
                        <a class="btn btn-xs btn-link panel-refresh" href="#">
                            <i class="icon-refresh"></i>
                        </a>
                        <a class="btn btn-xs btn-link panel-expand" href="#">
                            <i class="icon-resize-full"></i>
                        </a>
                        <a class="btn btn-xs btn-link panel-close" href="#">
                            <i class="icon-remove"></i>
                        </a>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="row">

                        <div class="col-sm-3">
                            <a class="btn btn-icon btn-block quick_icon" 
                               href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('pages') ?>">
                                <i class="clip-screen"></i>  <?php echo Yii::t('app', 'Pages') ?> </a>					
                        </div>

                        <div class="col-sm-3">
                            <a class="btn btn-icon btn-block quick_icon" 
                               href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('media') ?>"> 
                                <i class="clip-grid-6"></i>  <?php echo Yii::t('app', 'Media Library') ?> </a>						
                        </div>

                        <div class="col-sm-3">
                            <a class="btn btn-icon btn-block quick_icon" 
                               href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('particles') ?>"> 
                                <i class="clip-pencil"></i> 
                                <?php echo Yii::t('app', 'Particles') ?> </a>		
                        </div>

                        <div class="col-sm-3">
                            <a class="btn btn-icon btn-block quick_icon" 
                               href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('languages') ?>"> 
                                <i class="clip-earth-2"></i> 
                                <?php echo Yii::t('app', 'Languages') ?> </a>		
                        </div>

                    </div>
                    <!-- ===== End A Row ===== -->
                    <div class="row">

                        <div class="col-sm-3">
                            <a class="btn btn-icon btn-block quick_icon" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('users') ?>"> 
                                <i class="clip-user"></i> <?php echo Yii::t('app', 'Users') ?> </a>						
                        </div>

                        <div class="col-sm-3">
                            <a class="btn btn-icon btn-block quick_icon" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('roles') ?>">
                                <i class="fa fa-group"></i> <?php echo Yii::t('app', 'Roles') ?> </a>						
                        </div>

                        <div class="col-sm-3">
                            <a class="btn btn-icon btn-block quick_icon" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('permission') ?>">
                                <i class="fa fa-hand-o-up"></i> <?php echo Yii::t('app', 'Access rules') ?> </a>						
                        </div>

                        <div class="col-sm-3">
                            <a class="btn btn-icon btn-block quick_icon" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('setting') ?>"> 
                                <i class="clip-cogs"></i> <?php echo Yii::t('app', 'Setting') ?>  </a>						
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ====================  END Pannel Left ====================  -->
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon-external-link-sign"></i>
                    New 5th Article
                    <div class="panel-tools">
                        <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                        </a>
                        <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                            <i class="icon-wrench"></i>
                        </a>
                        <a class="btn btn-xs btn-link panel-refresh" href="#">
                            <i class="icon-refresh"></i>
                        </a>
                        <a class="btn btn-xs btn-link panel-expand" href="#">
                            <i class="icon-resize-full"></i>
                        </a>
                        <a class="btn btn-xs btn-link panel-close" href="#">
                            <i class="icon-remove"></i>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="/binh/article/editarticle/15.html"><i class="clip-pencil"></i> Liên hệ</a>									</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="/binh/article/editarticle/14.html"><i class="clip-pencil"></i> Hồ sơ gói 30.000 tỷ</a>									</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="/binh/article/editarticle/13.html"><i class="clip-pencil"></i> Cập nhật tiến độ</a>									</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="/binh/article/editarticle/12.html"><i class="clip-pencil"></i> Mặt bằng B1</a>									</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="/binh/article/editarticle/11.html"><i class="clip-pencil"></i> Mặt bằng A1-A2</a>									</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>           
        </div>
    </div>		
</div>