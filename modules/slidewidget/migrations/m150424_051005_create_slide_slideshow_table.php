<?php

use yii\db\Schema;
use yii\db\Migration;

class m150424_051005_create_slide_slideshow_table extends Migration
{
    public function up()
    {
        $tableOptions = "";
        if ($this->db->schema->getTableSchema('{{%slide_slideshow}}', true) === null) {
            $this->createTable('{{%slide_slideshow}}', [
                'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`id`)',
                'name' => 'VARCHAR(255) NOT NULL',
                'effect' => 'VARCHAR(255) NOT NULL',
                'is_active' => 'INT(1) NOT NULL',
                    ], $tableOptions);
        }
    }

    public function down()
    {
        $this->dropTable('{{%slide_slideshow}}');
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
