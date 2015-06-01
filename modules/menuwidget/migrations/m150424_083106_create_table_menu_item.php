<?php

use yii\db\Schema;
use yii\db\Migration;

class m150424_083106_create_table_menu_item extends Migration
{
    public function up()
    {
        $tableOptions = "";
        if ($this->db->schema->getTableSchema('{{%menu_item}}', true) === null) {
            $this->createTable('{{menu_item}}', [
                'menu_id' => 'INT(11) NOT NULL',
                'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                1 => 'PRIMARY KEY (`id`)',
                'link' => 'VARCHAR(255) NOT NULL',
                'parent_id' => 'INT(11) NULL',
                'is_active' => 'TINYINT(1) NOT NULL',
                'is_blank' => 'TINYINT(1) NOT NULL',
                'displayorder' => 'INT(11) NOT NULL',
                'created' => 'DATETIME NOT NULL',
                'modified' => 'DATETIME NOT NULL',
            ], $tableOptions);
            $this->addForeignKey('fk_menu_item_menu_item', '{{%menu_item}}', 'parent_id', '{{%menu_item}}', 'id', 'RESTRICT', 'RESTRICT' );
            $this->addForeignKey('fk_menu_menu_item', '{{%menu_item}}', 'menu_id', '{{%menu}}', 'id', 'RESTRICT', 'RESTRICT' );
        }
    }

    public function down()
    {
        $this->dropTable('{{%menu_item}}');
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
