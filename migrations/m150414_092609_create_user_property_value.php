<?php

use yii\db\Schema;
use yii\db\Migration;

class m150414_092609_create_user_property_value extends Migration
{
    public function up()
    {
    	$tableOptions = "";
    	$this->createTable('{{%user_property_value}}', [
    			'property_value_id' => 'INT(11) NOT NULL AUTO_INCREMENT',
    			0 => 'PRIMARY KEY (`property_value_id`)',
    			'property_id' => 'INT(11) NOT NULL',
    			'user_id' => 'INT(11) NOT NULL',
    			'value' => 'TEXT NOT NULL',
    			'created' => 'DATETIME NOT NULL',
    			'modified' => 'DATETIME NOT NULL',
    	], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user_property_value}}');
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
