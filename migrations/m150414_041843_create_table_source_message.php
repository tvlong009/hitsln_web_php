<?php

use yii\db\Schema;
use yii\db\Migration;

class m150414_041843_create_table_source_message extends Migration
{
    public function up()
    {
        $tableOptions = "";
        if ($this->db->schema->getTableSchema('{{%source_message}}', true) === null) {
            $this->createTable('{{%source_message}}', [
		'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
		0 => 'PRIMARY KEY (`id`)',
		'category' => 'VARCHAR(32) NULL',
		'message' => 'TEXT NULL',
	], $tableOptions);
	$this->addForeignKey('fk_source_message_message', '{{%message}}', 'id', '{{%source_message}}', 'id', 'CASCADE', 'CASCADE' );
        }
    }

    public function down()
    {
      $this->dropTable('{{%source_message}}');
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
