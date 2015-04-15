<?php

use yii\db\Schema;
use yii\db\Migration;

class m150320_083025_create_table_pages extends Migration
{

    public function up()
    {
        $tableOptions = "";
        if ($this->db->schema->getTableSchema('{{%pages}}', true) === null) {
            $this->createTable('{{%pages}}', [
                'page_id' => 'INT(4) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`page_id`)',
                'page_key' => 'VARCHAR(50) NOT NULL',
                'status' => 'ENUM(\'draft\',\'published\') NOT NULL',
                'publish_date' => 'DATETIME  NULL',
                'sort_order' => 'SMALLINT(2) NOT NULL',
                'parent_id' => 'INT(4) NOT NULL',
                'created' => 'DATETIME NOT NULL',
                'modified' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ',
                    ], $tableOptions);
            $this->addForeignKey('fk_pages_pages', '{{%pages}}', 'parent_id', '{{%pages}}', 'page_id', 'RESTRICT', 'RESTRICT');
        }
    }

    public function down()
    {
        $this->dropTable('{{%pages}}');
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
