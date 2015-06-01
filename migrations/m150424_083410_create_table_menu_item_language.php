<?php

use yii\db\Schema;
use yii\db\Migration;

class m150424_083410_create_table_menu_item_language extends Migration
{
    public function up()
    {
        $tableOptions = "";
        /* MYSQL */
        if ($this->db->schema->getTableSchema('{{%menu_item_language}}', true) === null) {
            $this->createTable('{{menu_item_language}}', [
                'language_id' => 'SMALLINT(2) NOT NULL',
                'item_id' => 'INT(11) NOT NULL',
                'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                2 => 'PRIMARY KEY (`id`)',
                'value' => 'VARCHAR(255) NOT NULL',
                'created' => 'DATETIME NOT NULL',
                'modified' => 'DATETIME NOT NULL',
            ], $tableOptions);
            $this->addForeignKey('fk_menu_item_menu_item_language', '{{%menu_item_language}}', 'item_id', '{{%menu_item}}', 'id', 'RESTRICT', 'RESTRICT' );
            $this->addForeignKey('fk_languages_menu_item_language', '{{%menu_item_language}}', 'language_id', '{{%languages}}', 'id', 'RESTRICT', 'RESTRICT' );
        }
    }

    public function down()
    {
        echo "m150424_083410_create_table_menu_item_language cannot be reverted.\n";

        return false;
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
