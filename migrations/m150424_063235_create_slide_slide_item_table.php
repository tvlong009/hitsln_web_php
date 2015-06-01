<?php

use yii\db\Schema;
use yii\db\Migration;

class m150424_063235_create_slide_slide_item_table extends Migration {

    public function up() {
        $tableOptions = "";
        if ($this->db->schema->getTableSchema('{{%slide_slide_item}}', true) === null) {
            $this->createTable('{{%slide_slide_item}}', [
                'slide_id' => 'INT(11) NOT NULL',
                'item_id' => 'INT(11) NOT NULL',
                1 => 'PRIMARY KEY (`item_id`,`slide_id`)',
                    ], $tableOptions);
            $this->addForeignKey('fk_slide_slideshow_slide_slide_item', '{{%slide_slide_item}}', 'slide_id', '{{%slide_slideshow}}', 'id', 'CASCADE', 'RESTRICT');
            $this->addForeignKey('fk_slide_item_slide_slide_item', '{{%slide_slide_item}}', 'item_id', '{{%slide_item}}', 'id', 'CASCADE', 'RESTRICT');
        }
    }

    public function down() {
        $this->dropTable('{{%slide_slide_item}}');
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
