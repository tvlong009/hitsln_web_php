<?php app\assets\ErrorAsset::register($this); ?>

<!DOCTYPE html>
<!--Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.3 Author: ClipTheme -->
<!--[if IE 8]><html class = "ie8 no-js" lang = "en"><![endif] -->
<!--[if IE 9]><html class = "ie9 no-js" lang = "en"><![endif] -->
<!--[if!IE]><!-->
<?php $this->beginPage()
?>

<html lang="en" class="no-js">
    <!--<![endif]-->
    <!-- start: HEAD -->
    <head>
        <title><?php echo Yii::t('app', 'Targetmusic CMS - Amin Control panel') ?></title>
        <!-- start: META -->
        <meta charset="utf-8" />
        <?php $this->head() ?>
    </head>

    <!-- end: HEAD -->
    <!-- start: BODY -->
    <body class="error-full-page">
        <div id="sound" style="z-index: -1;"></div>
        <img id="background" src="" />
        <div id="cholder">
            <canvas id="canvas"></canvas>
        </div>
        <!-- start: PAGE -->
        <div class="container">
            <div class="row">
                <!-- start: 404 -->
                <div class="col-sm-12 page-error">
                    <div class="error-number teal">
                        404
                    </div>
                    <div class="error-details col-sm-6 col-sm-offset-3">
                        <h3><?php echo Yii::t('app', 'Oops! You are stuck at 404') ?></h3>
                        <p>
                            <?php echo Yii::t('app', 'Unfortunately the page you were looking for could not be found.') ?>
                            <br>
                            <?php echo Yii::t('app', 'It may be temporarily unavailable, moved or no longer exist.') ?>
                            <br>
                            <?php echo Yii::t('app', 'Check the URL you entered for any mistakes and try again.') ?>
                            <br>
                            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('') ?>" class="btn btn-teal btn-return">
                                <?php echo Yii::t('app', 'Return home') ?>
                            </a>
                            <br>
                            <?php echo Yii::t('app', 'Still no luck?') ?>
                            <br>
                            <?php echo Yii::t('app', 'Search for whatever is missing, or take a look around the rest of our site.') ?>
                        </p>
                        <form action="#" class="hidden">
                            <div class="input-group">
                                <input type="text" placeholder="<?php echo Yii::t('app', 'keyword...') ?>" size="16" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn btn-teal">
                                        <?php echo Yii::t('app', 'Search') ?>
                                    </button> </span>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6 col-sm-offset-3 error-details">
                        <?= $content ?>
                    </div>
                </div>
                <!-- end: 404 -->
            </div>
        </div>
        <script type="text/javascript">
            var root_url = '<?php echo Yii::$app->urlManager->createAbsoluteUrl(); ?>';
        </script>
        <?php $this->endBody() ?>
        <?php $this->registerJs('Main.init();Error404.init();') ?>
    </body>
    <!-- end: BODY -->
</html>
<?php $this->endPage() ?>