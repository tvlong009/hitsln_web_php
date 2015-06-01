<?php

use yii\db\Schema;
use yii\db\Migration;

class m150320_083558_create_table_languages extends Migration
{

    public function up()
    {
        if ($this->db->schema->getTableSchema('{{%languages}}', true) === null) {
            $tableOptions = "";
            $this->createTable('{{%languages}}', [
                'language_id' => 'SMALLINT(2) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`language_id`)',
                'description' => 'VARCHAR(255) NOT NULL',
                    ], $tableOptions);
            $this->addForeignKey('fk_languages_page_content', '{{%page_content}}', 'page_language', '{{%languages}}', 'language_id', 'RESTRICT', 'RESTRICT');
        }
    }

    public function down()
    {
        $this->dropTable('{{%languages}}');
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
