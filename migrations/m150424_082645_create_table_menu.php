<?php

use yii\db\Schema;
use yii\db\Migration;

class m150424_082645_create_table_menu extends Migration
{
    public function up()
    {
        $tableOptions = "";
        if ($this->db->schema->getTableSchema('{{%menu}}', true) === null) {
            $this->createTable('{{menu}}', [
                'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`id`)',
                'key' => 'VARCHAR(255) NOT NULL',
                'effect' => 'VARCHAR(255) NOT NULL',
                'is_active' => 'TINYINT(1) NOT NULL',
                'created' => 'DATETIME NOT NULL',
                'modified' => 'DATETIME NOT NULL',
            ], $tableOptions);
        }
    }

    public function down()
    {
        $this->dropTable('{{%menu}}');
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
