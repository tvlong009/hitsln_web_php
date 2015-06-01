<?php

use yii\helpers\Html; ?>
<?php app\modules\useractivity\assets\ActivityAsset::register($this) ?>
<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <!-- start: FORM WIZARD PANEL -->
            <div class="panel panel-default">

                <div class="panel-heading">
                    User Activity Log
                </div>

                <div class="panel-body">
                    <?php
                    if (is_array($model)) {
                        echo '<table class="table table-bordered table-striped">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>' . Yii::t('app', 'ID') . '</th>';
                        echo '<th>' . Yii::t('app', 'User ID') . '</th>';
                        echo '<th>' . Yii::t('app', 'Action') . '</th>';
                        echo '<th colspan="2" style="text-align:center">' . Yii::t('app', 'Data') . '</th>';
                        //echo '<th>' . Yii::t('app', 'New Data') . '</th>';
                        echo '<th>' . Yii::t('app', 'Description') . '</th>';
                        echo '<th>' . Yii::t('app', 'Created Time') . '</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody id="t_body">';
                        foreach ($model as $activity) {
                            echo "<tr>";
                            echo '<td>' . $activity->id . '</td>';
                            echo '<td>' . $activity->user_id . '</td>';
                            echo '<td>' . $activity->module.'/'.$activity->controller .'/'.$activity->action . '</td>';
                            echo '<td>';
                            $oldData = json_decode($activity->old_data, true);
                            if (is_array($oldData)) {
                                unset($oldData['created']);
                                unset($oldData['modified']);
                                foreach ($oldData as $key => $old) {
                                    echo '<p><b>' . $key . '</b>: ' . htmlentities($old) . '</p>';
                                }
                            } else {
                                echo $activity->old_data;
                            }
                            echo '</td>';
                            echo '<td>';
                            $newData = json_decode($activity->new_data, true);
                            if (is_array($newData)) {
                                unset($newData['created']);
                                unset($newData['modified']);
                                foreach ($newData as $key => $new) {
                                    echo '<p><b>' . $key . '</b>: ' . htmlentities($new) . '</p>';
                                }
                            } else {
                                echo $activity->new_data;
                            }
                            echo '</td>';
                            echo '<td>' . $activity->description . '</td>';
                            echo '<td>' . $activity->created . '</td>';
                            echo "</tr>";
                        }
                        echo '</tbody>';
                        echo '</table>';
                        echo Html::beginForm(Yii::$app->urlManager->createAbsoluteUrl('/useractivity/activity/see'), 'post', ['id' => 'frsee']);
                        echo Html::hiddenInput('limit', $limit, ['id' => 'limit']);
                        echo Html::hiddenInput('offset', $limit, ['id' => 'offset']);
                        echo '<button class="btn btn-primary" type="submit">' . Yii::t('app', 'See more') . '</button>';
                        echo Html::endForm();
                    }
                    ?>
                </div> <!--Panel body -->

            </div> <!--panel panel-default-->
        </div>
    </div>
</div>


