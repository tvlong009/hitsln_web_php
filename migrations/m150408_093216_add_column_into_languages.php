<?php

use yii\db\Schema;
use yii\db\Migration;

class m150408_093216_add_column_into_languages extends Migration
{
    public function up()
    {
        $table = Yii::$app->db->schema->getTableSchema('{{%languages}}');
        if (!isset($table->columns['name'])) {
            $this->addColumn('{{%languages}}', 'name', 'varchar(255)');
        } 
        if (!isset($table->columns['code'])) {
            $this->addColumn('{{%languages}}', 'code', 'char(2)');
        }  
    }

    public function down()
    {
        $table = Yii::$app->db->schema->getTableSchema('{{%languages}}');
        $this->dropColumn($table, 'name');
        $this->dropColumn($table, 'code');
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
