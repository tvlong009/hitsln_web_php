<?php

use yii\db\Schema;
use yii\db\Migration;

class m150415_091229_create_login_widget_setting_table extends Migration
{

    public function up()
    {
        $tableOptions = "";
        if ($this->db->schema->getTableSchema('{{%login_widget_setting}}', true) === null) {
        $this->createTable('{{%login_widget_setting}}', [
            'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
            0 => 'PRIMARY KEY (`id`)',
            'key_name' => 'VARCHAR(255) NOT NULL',
            'value' => 'TEXT NOT NULL',
            'displayorder' => 'INT(11) NOT NULL',
            'created' => 'DATETIME NOT NULL',
            'modified' => 'DATETIME NOT NULL',
                ], $tableOptions);
        }
    }

    public function down()
    {
        $this->dropTable('{{%login_widget_setting}}');
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
