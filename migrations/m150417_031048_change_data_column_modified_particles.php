<?php

use yii\db\Schema;
use yii\db\Migration;

class m150417_031048_change_data_column_modified_particles extends Migration
{
    public function up()
    {
        $table = Yii::$app->db->schema->getTableSchema('{{%particles}}');
        if(empty($table))
            $table = Yii::$app->db->schema->getTableSchema('{{particles}}');
        if(isset($table->columns['modified']))
            $this->alterColumn('{{%particles}}', 'modified', 'datetime');
    }

    public function down()
    {
        echo "m150417_031048_change_data_column_modified_particles cannot be reverted.\n";

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
