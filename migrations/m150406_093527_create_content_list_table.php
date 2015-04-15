<?php

use yii\db\Schema;
use yii\db\Migration;

class m150406_093527_create_content_list_table extends Migration
{

    public function up()
    {
        if ($this->db->schema->getTableSchema('{{%content_list}}', true) === null) {
            $tableOptions = "";
            $this->createTable('{{%content_list}}', [
                'contentlist_id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`contentlist_id`)',
                'title' => 'VARCHAR(255) NOT NULL',
                'short_description' => 'TEXT NOT NULL',
                'displayorder' => 'INT(11) NOT NULL',
                'status' => 'TINYINT(1) NOT NULL',
                'created' => 'DATETIME NOT NULL',
                'modified' => 'DATETIME NOT NULL',
                    ], $tableOptions);
        }
    }

    public function down()
    {
        $this->dropTable('{{%content_list}}');
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
