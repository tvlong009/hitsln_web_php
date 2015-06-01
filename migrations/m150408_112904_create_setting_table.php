<?php

use yii\db\Schema;
use yii\db\Migration;

class m150408_112904_create_setting_table extends Migration {

    public function up() {
        $tableOptions = "";
        $dbType = 'mysql';
        if ($dbType == "mysql") {
            /* MYSQL */
            if ($this->db->schema->getTableSchema('{{%setting}}', true) === null) {
                $this->createTable('{{%setting}}', [
                    'key' => 'VARCHAR(255) NOT NULL',
                    0 => 'PRIMARY KEY (`key`)',
                    'value' => 'TEXT NOT NULL',
                        ], $tableOptions);
            }
        }
    }

    public function down() {
        echo "m150408_112904_create_setting_table cannot be reverted.\n";

        return false;
    }

    /*
      // Use safeUp/safeDown to run migration code within a transaction
      public function safeUp()
      {
      }

      public function safeDown()
      {
      }
     */
}
