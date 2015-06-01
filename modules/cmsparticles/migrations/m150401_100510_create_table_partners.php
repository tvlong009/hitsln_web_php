<?php

use yii\db\Schema;
use yii\db\Migration;

class m150401_100510_create_table_partners extends Migration
{

    public function up()
    {
        if ($this->db->schema->getTableSchema('{{%partner}}', true) === null) {
            $tableOptions = "";
            $this->createTable('{{%partner}}', [
                'partner_id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`partner_id`)',
                'partner_name' => 'VARCHAR(255) NOT NULL',
                'partner_description' => 'TEXT NOT NULL',
                'link' => 'VARCHAR(255) NOT NULL',
                'status' => 'TINYINT(1) NOT NULL',
                'displayorder' => 'INT(11) NOT NULL',
                'created' => 'DATETIME NOT NULL',
                'modified' => 'DATETIME NOT NULL',
                    ], $tableOptions);
        }
    }

    public function down()
    {
        $this->dropTable('{{%partner}}');
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
