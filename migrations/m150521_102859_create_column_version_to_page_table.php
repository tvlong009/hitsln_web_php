<?php

use yii\db\Schema;
use yii\db\Migration;

class m150521_102859_create_column_version_to_page_table extends Migration
{
    public function up()
    {
        $table = Yii::$app->db->schema->getTableSchema('{{%pages}}');
        if(empty($table))
            $table = Yii::$app->db->schema->getTableSchema('{{$pages}}');
        if(!isset($table->columns['version']))
            $this->addColumn('pages', 'version', 'float default 0.1');
    }

    public function down()
    {
        echo "m150521_102859_create_column_version_to_page_table cannot be reverted.\n";

        return false;
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
