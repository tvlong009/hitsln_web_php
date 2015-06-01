<?php

use yii\db\Schema;
use yii\db\Migration;

class m150421_034840_create_slide_item_table extends Migration {

    public function up() {
        $tableOptions = "";
        if ($this->db->schema->getTableSchema('{{%slide_item}}', true) === null) {
            $this->createTable('{{%slide_item}}', [
                'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`id`)',
                'image' => 'VARCHAR(255) NOT NULL',
                'link' => 'VARCHAR(255) NOT NULL',
                'title' => 'TEXT NOT NULL',
                'description' => 'TEXT NOT NULL',
                'is_active' => 'INT(1) NOT NULL',
                'open_new_window' => 'INT(1) NOT NULL',
                    ], $tableOptions);
        }
    }

    public function down() {
        $this->dropTable('{{%slide_item}}');
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
