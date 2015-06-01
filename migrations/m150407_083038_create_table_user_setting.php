<?php

use yii\db\Schema;
use yii\db\Migration;

class m150407_083038_create_table_user_setting extends Migration {

    public function up() {
        if ($this->db->schema->getTableSchema('{{%user_setting}}', true) === null) {
            $tableOptions = "";
            $this->createTable('{{%user_setting}}', [
                'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`id`)',
                'user_id' => 'INT(11) NOT NULL',
                'key' => 'VARCHAR(255) NOT NULL',
                'value' => 'MEDIUMTEXT NOT NULL',
                    ], $tableOptions);
            $this->addForeignKey('fk_user_user_setting', '{{%user_setting}}', 'user_id', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
        }
    }

    public function down() {
          $this->dropTable('{{%user_setting}}');
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
