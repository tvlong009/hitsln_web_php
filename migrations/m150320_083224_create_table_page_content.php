<?php

use yii\db\Schema;
use yii\db\Migration;

class m150320_083224_create_table_page_content extends Migration
{

    public function up()
    {
        $tableOptions = "";

        if ($this->db->schema->getTableSchema('{{%page_content}}', true) === null) {
            $this->createTable('{{%page_content}}', [
                'content_id' => 'INT(4) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`content_id`)',
                'page_id' => 'INT(4) NOT NULL',
                'page_title' => 'VARCHAR(255) NOT NULL',
                'page_content' => 'TEXT NOT NULL',
                'page_language' => 'SMALLINT(2) NOT NULL',
                'page_header_img' => 'VARCHAR(255) NOT NULL',
                'created' => 'DATETIME NOT NULL',
                'modified' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ',
                    ], $tableOptions);
            $this->addForeignKey('fk_pages_page_content', '{{%page_content}}', 'page_id', '{{%pages}}', 'page_id', 'RESTRICT', 'RESTRICT');
        }
    }

    public function down()
    {
        $this->dropTable('{{%page_content}}');
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
