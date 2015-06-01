<?php

use yii\db\Schema;
use yii\db\Migration;

class m150414_041643_create_table_message extends Migration
{
    public function up()
    {
        $tableOptions = "";
        if ($this->db->schema->getTableSchema('{{%message}}', true) === null) {
            	$this->createTable('{{%message}}', [
		'id' => 'INT(11) NOT NULL',
		'language' => 'VARCHAR(16) NOT NULL',
		1 => 'PRIMARY KEY (`id`, `language`)',
		'translation' => 'TEXT NULL',
	], $tableOptions);
        }
        
    }

    public function down()
    {
          $this->dropTable('{{%message}}');
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
