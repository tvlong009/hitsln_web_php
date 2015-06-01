<?php

use yii\db\Schema;
use yii\db\Migration;

class m150427_104810_create_table_user_activity extends Migration
{

    public function up()
    {
        $tableOptions = "";
        if ($this->db->schema->getTableSchema('{{%user_activity}}', true) === null) {
            $this->createTable('{{%user_activity}}', [
                'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`id`)',
                'user_id' => 'INT(11) NOT NULL',
                'module' => 'VARCHAR(50) NOT NULL',
                'controller' => 'VARCHAR(50) NOT NULL',
                'action' => 'VARCHAR(50) NOT NULL',
                'old_data' => 'TEXT NOT NULL',
                'new_data' => 'TEXT NOT NULL',
                'description' => 'TEXT NULL',
                'created' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ',
                    ], $tableOptions);
        }
    }

    public function down()
    {
        $this->dropTable('{{%user_activity}}');
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
