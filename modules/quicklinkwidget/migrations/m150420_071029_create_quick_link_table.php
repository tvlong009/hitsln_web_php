<?php

use yii\db\Schema;
use yii\db\Migration;

class m150420_071029_create_quick_link_table extends Migration
{
    public function up()
    {
        $tableOptions = "";
        if ($this->db->schema->getTableSchema('{{%quick_link}}', true) === null) {
            $this->createTable('{{quick_link}}', [
                'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`id`)',
                'group_id' => 'INT(11) NULL',
                'type' => 'SMALLINT(3) NOT NULL',
                'url' => 'VARCHAR(255) NOT NULL',
                'action' => 'VARCHAR(255) NOT NULL',
                'displayorder' => 'INT(11) NOT NULL',
                'status' => 'SMALLINT(3) NOT NULL',
                'created' => 'DATETIME NOT NULL',
                'modified' => 'DATETIME NOT NULL',
            ], $tableOptions);
            $this->addForeignKey('fk_quick_link_group_quick_link', '{{%quick_link}}', 'group_id', '{{%quick_link_group}}', 'id', 'RESTRICT', 'RESTRICT' );
        }
    }

    public function down()
    {
        $this->dropTable('{{%quick_link}}');
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
