<?php app\assets\AssignmentAsset::register($this) ?>

<!-- ============================================ -->
<div class="row">
    <div class="col-sm-12">

        <!-- start: FORM WIZARD PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">

                <?php echo Yii::t('app', 'Assignment'); ?>

            </div>


            <?php
            /* @var $this yii\web\View */

            use yii\helpers\Html;
            use yii\widgets\ActiveForm;
            use app\models\Roles;
            use app\models\UsersRoles;
            use app\models\User;
            use yii\data\ActiveDataProvider;
            use yii\widgets\LinkPager;

$rootUrl = Yii::$app->urlManager->showScriptName ? $rootUrl = Yii::$app->urlManager->baseUrl . '/' : Yii::$app->urlManager->createAbsoluteUrl('/');

            $this->title = Yii::t('app', 'Assignments');
            $this->params['breadcrumbs'][] = $this->title;
            ?>
            <?php if (Yii::$app->session->hasFlash('success')) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo Yii::$app->session->getFlash('success'); ?>
                </div>
            <?php } ?>
            
                <?php if (Yii::$app->session->hasFlash('error')) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo Yii::$app->session->getFlash('error'); ?>
                </div>
            <?php } ?>
            
                <?php if (Yii::$app->session->hasFlash('warning')) { ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo Yii::$app->session->getFlash('warning'); ?>
                </div>
            <?php } ?>

            <div class="alert-messages"></div>
            <br><br>
            <div class="container">
                <div class="well col-md-12">
                    <?php
                    echo "<div class='recordperpage' id='" . $recordperpage . "'></div>";
                    for ($i = 0; $i < $recordperpage; $i++) {
                        ?>
                        <div class='row user-row'>
                            <div class='col-xs-3 col-sm-2 col-md-1 col-lg-1'>
                                <?php
                                if ($array_user[$i]->avatar) {
                                    echo Html::img($rootUrl . "uploads/" . $array_user[$i]->avatar, array('style' => 'max-width:50px;max-height:100px;'));
                                } else {
                                    echo Html::img($rootUrl . "clipone/assets/images/user_avatar.png");
                                }
                                ?>
                            </div>
                            <div class='col-xs-8 col-sm-9 col-md-10 col-lg-10'>
                                <strong><?php echo $array_user[$i]->username ?></strong><br>
                                <span class='text-muted'><?php echo $array_user[$i]->name ?></span>
                            </div>
                            <div class='col-xs-1 col-sm-1 col-md-1 col-lg-1 dropdown-user' 
                                 data-for='<?php echo str_replace(' ', '', $array_user[$i]->username . '-' . $array_user[$i]->id) ?>'>
                                <i class='glyphicon glyphicon-chevron-down text-muted'></i>
                            </div>
                        </div>
                        <div class='row user-infos <?php echo str_replace(' ', '', $array_user[$i]->username . '-' . $array_user[$i]->id) ?>' <?php if ($i > 0) { ?>style="display: none;" <?php } ?>>               
                            <div class='col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1'>
                                <div class='panel panel-primary'>
                                    <div class='panel-heading'>
                                        <h3 class='panel-title'><?php echo Yii::t('app', 'Assign User Role'); ?></h3>
                                    </div>
                                    <div class='panel-body'>
                                        <div class='row'>
                                            <div class='col-sm-1 col-md-2 col-lg-1'>
                                                <?php
                                                if ($array_user[$i]->avatar) {
                                                    echo Html::img($rootUrl . "uploads/" . $array_user[$i]->avatar, array('style' => 'max-width:50px;max-height:100px;'));
                                                } else {
                                                    echo Html::img($rootUrl . "clipone/assets/images/user_avatar.png");
                                                }
                                                ?>
                                            </div>
                                            <div class='col-sm-11 col-md-10 col-lg-11'>
                                                <strong><?php echo $array_user[$i]->username ?></strong><br>
                                                <table class='table table-user-information'>
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo Yii::t('app', 'Name:'); ?></td>
                                                            <td><?php echo $array_user[$i]->name ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo Yii::t('app', 'Create date:'); ?></td>
                                                            <td><?php echo date('m/d/Y', $array_user[$i]->created_at) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2"><?php echo Yii::t('app', 'Roles'); ?></td>
                                                        </tr>
                                                        <tr>

                                                            <td colspan="2">

                                                                <?php
                                                                if (Yii::$app->session->hasFlash('error')) {
                                                                    echo "<a href='" . $rootUrl . 'roles/create' . "' style= 'color: red'>" . Yii::$app->session->getFlash('error') . "</a>";
                                                                } else {
                                                                    echo Html::checkboxList('Roles', $list, $arrayname);
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='panel-footer' style='padding-bottom: 40px'>
                                        <span class='pull-right'>
                                            <button id='<?php echo $array_user[$i]->id ?>' 
                                                    rel='<?php echo str_replace(' ', '', $array_user[$i]->username . '-' . $array_user[$i]->id) ?>'
                                                    class='btn btn-sm btn-warning' type='button' 
                                                    data-toggle='tooltip'
                                                    data-original-title='Edit user roles'><i class='glyphicon glyphicon-edit'></i></button>

                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <!-- end: FORM WIZARD PANEL -->
        </div>
        <div class="col-md-12" >
            <div class='pagination-centered' >
                <ul class='pagination pull-right' >
                    <?php
                    $num_user = count($array_user);
                    $pagelimit = floor($num_user / $recordperpage) + ($num_user % $recordperpage > 0 ? 1 : 0);
                    if ($pagelimit == 0) {
                        echo "<div style='color: red' >" . Yii::t('app', 'No User') . "</div>";
                    } else {
                        ?>

                        <?php if ($pagelimit > 1) { ?>
                            <li class='arrow '>
                                <a class="glyphicon glyphicon-fast-backward"></a>
                            </li>
                            <li class='arrow '>
                                <a class="glyphicon glyphicon-backward" ></a>
                            </li>
                        <?php } ?>
                        <?php
                        for ($i = 0; $i < $pagelimit; $i++) {
                            if ($i == 0)
                                echo "<li class='active'> <a class='item' rel='" . ($i + 1) . "'  id='paging_" . ($i + 1) . "' >" . ($i + 1) . "</a></li>";
                            else {
                                echo "<li class=''> <a class='item' rel='" . ($i + 1) . "' id='paging_" . ($i + 1) . "'>" . ($i + 1) . "</a></li>";
                            }
                        }
                        ?>
                        <?php if ($pagelimit > 1) { ?>
                            <li class='arrow '>
                                <a class="glyphicon glyphicon-forward" ></a>
                            </li>
                            <li class='arrow'>
                                <a class="glyphicon glyphicon-fast-forward"></a>
                            </li>
                        <?php } ?>
                    <?php } ?>



                </ul>
                <div class='pagelimit' id ='<?php echo $pagelimit ?>'></div>
            </div>

        </div>
    </div>
</div>
<!-- end: PAGE CONTENT-->
<!-- ============================================ -->    
<script type="text/javascript">
    var url = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('/assignment') ?>";
    var root_url = "<?php echo Yii::$app->urlManager->baseUrl; ?>";
</script>