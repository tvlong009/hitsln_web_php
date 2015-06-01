<?php app\assets\UserAsset::register($this) ?>
<!-- ============================================ -->
<!-- start: PAGE CONTENT -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                <?php echo   Yii::t('app', 'View user');?>             
            </div>
            <div class="panel-body">
                <?php

                use yii\helpers\Html;
                use yii\helpers\BaseHtml;
                use yii\widgets\DetailView;
                use yii\widgets\ActiveForm;
                use app\models\UsersRoles;
                use app\models\Roles;
                use yii\helpers\Url;

/* @var $this yii\web\View */
                /* @var $model backend\models\User */

                $this->title = $model->name;
                $this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
                $this->params['breadcrumbs'][] = $this->title;
                
                $rootUrl = Yii::$app->urlManager->showScriptName ? $rootUrl = Yii::$app->urlManager->baseUrl . '/' 
                        : Yii::$app->urlManager->createAbsoluteUrl('/');
                ?>
                <div class="user-view">


                    <?php
                    if ($model->avatar) {
                        echo Html::img($rootUrl . "uploads/" . $model->avatar, array('width' => 200, 'height' => 150));
                    } else {
                       echo  Html::img($rootUrl . "clipone/assets/images/user_avatar.png");
                    }
                    ?>
                    <?php
                    //show status
                    $status = '';
                    if ($model->status == '0') {
                        $status = Yii::t('app', "New");
                    } elseif ($model->status == '1') {
                        $status = Yii::t('app', "Active");
                    } elseif ($model->status == '2') {
                        $status = Yii::t('app', "Inactive");
                    }
                    //show roles
                    $arrayrole = array();
                    $arrayrole = UsersRoles::findAll(["user_id" => $model->id]);
                    $role = '';
                    for ($i = 0; $i < count($arrayrole); $i++) {
                        $arrayrolename = array();
                        $arrayrolename = Roles::findAll(['id' => $arrayrole[$i]->role_id]);
                        for ($x = 0; $x < count($arrayrolename); $x++) {
                            $role = $role . $arrayrolename[$x]->name . ', ';
                        }
                    }

                    $dataView = array(
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'username',
                            'name',
                            'auth_key',
                            'password',
                            'password_reset_token',
                            'email:email',
                            //'role',
                            array(
                                'label' => Yii::t('app', 'Role'),
                                'value' => $role,
                            ),
                            array(
                                'label' => Yii::t('app', 'Status'),
                                'value' => $status,
                            ),
                            array(
                                'label' => Yii::t('app', 'Create at'),
                                'value' => date('m/d/Y', $model->created_at),
                            ),
                            array(
                                'label' => Yii::t('app', 'Update at'),
                                'value' => date('m/d/Y', $model->updated_at),
                            ),                            
                        ],
                    );
                    ?>

                    <?=                    
                    DetailView::widget($dataView)
                    ?>
                    <div class="col-md-12">
                        <div class="pull-right">
                            <?= Html::a(Yii::t('app', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        
                        </div>
                    </div>


                </div>
            </div>
        </div>           
        <!-- end: FORM WIZARD PANEL -->        
    </div>
</div>
<!-- end: PAGE CONTENT-->
<!-- ============================================ -->	