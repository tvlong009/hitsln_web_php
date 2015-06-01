<?php

use yii\helpers\Html;

$rootUrl = Yii::$app->urlManager->showScriptName ? $rootUrl = Yii::$app->urlManager->baseUrl . '/' 
                    : Yii::$app->urlManager->createAbsoluteUrl('/');

for ($i = $firstrecordshow; $i < $totalrecord; $i++) {
    if ($i < count($array_user)) {
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
            <div class='col-xs-1 col-sm-1 col-md-1 col-lg-1 dropdown-user' data-for='.<?php echo str_replace(' ', '', $array_user[$i]->username . "-" . $array_user[$i]->id) ?>'>
                <i class='glyphicon glyphicon-chevron-down text-muted'></i>
            </div>
        </div>
        <div class='row user-infos <?php echo str_replace(' ', '', $array_user[$i]->username . "-" . $array_user[$i]->id) ?>' >               
            <div class='col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1'>
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'><?php echo Yii::t('app','Assign User Role');?></h3>
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
                                            <td><?php echo Yii::t('app','Name:');?></td>
                                            <td><?php echo $array_user[$i]->name ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo Yii::t('app','Create date:');?></td>
                                            <td><?php echo date('m/d/Y', $array_user[$i]->created_at) ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo Yii::t('app','Roles');?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>  
                                                <?php
                                                if (empty($list)) {
                                                    Yii::$app->session->setFlash('error', Yii::t('app','Please define roles'));
                                                }

                                                if (Yii::$app->session->hasFlash('error')) {
                                                   echo "<a href='".$rootUrl.'roles/create'."' style= 'color: red'>" . Yii::$app->session->getFlash('error') . "</a>";
                                                } else {
                                                    echo Html::checkboxList('Roles', $list, $arrayname);
                                                }
                                                ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class='panel-footer' style='padding-bottom: 40px'>
                        <span class='pull-right'>
                            <button id='<?php echo $array_user[$i]->id ?>' rel='<?php echo str_replace(' ', '', $array_user[$i]->username . "-" . $array_user[$i]->id) ?>' class='btn btn-sm btn-warning' type='button' 
                                    data-toggle='tooltip'
                                    data-original-title='Edit user roles'><i class='glyphicon glyphicon-edit'></i></button>
                        </span>
                    </div>
                </div>
            </div>

        </div>
            <?php
    }
}
?>
