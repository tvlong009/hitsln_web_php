<?php

/**
 * ModuleMigrateController class file
 * @copyright Copyright (c) 2014 Galament
 * @license http://www.yiiframework.com/license/
 */

namespace console\controllers;

use yii\console\Application;
use yii\console\controllers\MigrateController;
use yii\console\Exception;
use Yii;

/**
 * Runs migrations from module /migrations folder.
 *
 * @author Pavel Bariev <bariew@yandex.ru>
 */
class TMMigrateController extends MigrateController {

    protected function getMigrationPath($base_dir) {
        $migrations = glob($base_dir . '/*', GLOB_ONLYDIR);
        $paths = array();
        if (!empty($migrations)) {
            foreach ($migrations as $migration) {
                if (basename($migration) == 'migrations') {
                    $paths[] = $migration;
                } else {
                    $paths = array_merge($paths, $this->getMigrationPath($migration));
                }
            }
        }
        return $paths;
    }

    public function actionUp($app = 'console', $limit = 0) {
        $paths = $this->getMigrationPath($app);
        if (!empty($paths)) {
            foreach ($paths as $path) {
                $this->migrationPath = $path;
                parent::getNewMigrations();
                parent::actionUp($limit);
            }
        }
    }

}
