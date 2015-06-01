<?php

use yii\db\Schema;
use yii\db\Migration;

class m150417_025949_change_data_column_modified_page_content extends Migration
{
    public function up()
    {
        $table = Yii::$app->db->schema->getTableSchema('{{%page_content}}');
        if(empty($table))
            $table = Yii::$app->db->schema->getTableSchema('{{page_content}}');
        if(isset($table->columns['modified']))
            $this->alterColumn('{{%page_content}}', 'modified', 'datetime');
    }

    public function down()
    {
        echo "m150417_025949_change_data_column_modified_page_content cannot be reverted.\n";

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
