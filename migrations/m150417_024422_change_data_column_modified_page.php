<?php

use yii\db\Schema;
use yii\db\Migration;

class m150417_024422_change_data_column_modified_page extends Migration
{
    public function up()
    {
        $table = Yii::$app->db->schema->getTableSchema('{{%pages}}');
        if(empty($table))
            $table = Yii::$app->db->schema->getTableSchema('{{pages}}');
        if(isset($table->columns['modified']))
            $this->alterColumn('{{%pages}}', 'modified', 'datetime');
    }

    public function down()
    {
        echo "m150417_024422_change_data_column_modified_page cannot be reverted.\n";

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
