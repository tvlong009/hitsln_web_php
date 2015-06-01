<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PublishPageController extends Controller {

  /**
   * This command echoes what you have entered as the message.
   * @param string $max the message to be echoed.
   */
  public function actionIndex($max = 10) {
    $format = '"%Y-%m-%d"';
    $pages = \app\models\Page::find()->where('publish_date < STR_TO_DATE("' . date('Y-m-d') . '", ' . $format . ') and status = "draf" ')->all();
    foreach($pages as $page){
      $page->status = 'published';
      $page->save();
    }
  }

}
