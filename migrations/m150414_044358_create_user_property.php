<?php

use yii\db\Schema;
use yii\db\Migration;

class m150414_044358_create_user_property extends Migration
{
    public function up()
    {
    	$tableOptions = "";
    	$this->createTable('{{%user_property}}', [
    			'group_id' => 'INT(11) NOT NULL',
    			'property_id' => 'INT(11) NOT NULL AUTO_INCREMENT',
    			1 => 'PRIMARY KEY (`property_id`)',
    			'property_name' => 'VARCHAR(255) NOT NULL',
    			'type' => 'SMALLINT(3) NOT NULL',
    			'value' => 'TEXT NOT NULL',
    			'displayorder' => 'INT(11) NOT NULL',
    			'status' => 'SMALLINT(3) NOT NULL',
    			'created' => 'DATETIME NOT NULL',
    			'modified' => 'DATETIME NOT NULL',
    	], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user_property}}');
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
