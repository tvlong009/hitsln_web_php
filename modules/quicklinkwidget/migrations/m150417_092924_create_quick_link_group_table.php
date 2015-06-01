<?php

use yii\db\Schema;
use yii\db\Migration;

class m150417_092924_create_quick_link_group_table extends Migration
{
    public function up()
    {
        $tableOptions = "";
        if ($this->db->schema->getTableSchema('{{%quick_link_group}}', true) === null) {
            $this->createTable('{{quick_link_group}}', [
                'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`id`)',
                'displayorder' => 'INT(11) NOT NULL',
                'status' => 'TINYINT(1) NOT NULL',
                'created' => 'DATETIME NOT NULL',
                'modified' => 'DATETIME NOT NULL',
            ], $tableOptions);
        }
    }

    public function down()
    {
        $this->dropTable('{{%quick_link_group}}');
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
