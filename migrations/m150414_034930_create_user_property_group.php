<?php

use yii\db\Schema;
use yii\db\Migration;

class m150414_034930_create_user_property_group extends Migration
{
    public function up()
    {
    	$tableOptions = "";
		$this->createTable ( '{{%user_property_group}}', [ 
				'group_id' => 'INT(11) NOT NULL AUTO_INCREMENT',
				0 => 'PRIMARY KEY (`group_id`)',
				'group_name' => 'VARCHAR(255) NOT NULL',
				'displayorder' => 'INT(11) NOT NULL',
				'created' => 'DATETIME NOT NULL',
				'modified' => 'DATETIME NOT NULL' 
		], $tableOptions );
    }

    public function down()
    {
        $this->dropTable('{{%user_property_group}}');
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
