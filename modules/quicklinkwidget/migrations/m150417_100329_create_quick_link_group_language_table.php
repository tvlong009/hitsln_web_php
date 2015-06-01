<?php

use yii\db\Schema;
use yii\db\Migration;

class m150417_100329_create_quick_link_group_language_table extends Migration
{
    public function up()
    {
        $tableOptions = "";
        if ($this->db->schema->getTableSchema('{{%quick_link_group_language}}', true) === null) {
            $this->createTable('{{quick_link_group_language}}', [
                'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`id`)',
                'language_id' => 'SMALLINT(2) NOT NULL',
                'group_link_id' => 'INT(11) NOT NULL',
                'value' => 'VARCHAR(255) NOT NULL',
                'created' => 'DATETIME NOT NULL',
                'modified' => 'DATETIME NOT NULL',
            ], $tableOptions);
            $this->addForeignKey('fk_languages_quick_link_group_language', '{{%quick_link_group_language}}', 'language_id', '{{%languages}}', 'id', 'RESTRICT', 'RESTRICT' );
            $this->addForeignKey('fk_quick_link_group_quick_link_group_language', '{{%quick_link_group_language}}', 'group_link_id', '{{%quick_link_group}}', 'id', 'RESTRICT', 'RESTRICT' );
        }
    }

    public function down()
    {
       $this->dropTable('{{%quick_link_group_language}}');
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
