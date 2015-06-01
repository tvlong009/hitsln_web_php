<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_104703_add_two_column_permisons extends Migration
{
    public function up()
    {
        $table = Yii::$app->db->schema->getTableSchema('{{%permission}}');
        if(empty($table))
            $table = Yii::$app->db->schema->getTableSchema('{{permission}}');
        if (!isset($table->columns['object_id'])) {
            $this->addColumn('{{%permission}}', 'object_id', 'int');
        } 
        if (!isset($table->columns['object_class'])) {
            $this->addColumn('{{%permission}}', 'object_class', 'varchar(100)');
        } 
        
        if (isset($table->columns['user_id'])) {
            $this->dropForeignKey('fk_user_permission', '{{%permission}}');
            $this->dropColumn('{{%permission}}', 'user_id');
        } 
    }

    public function down()
    {
        echo "m150409_104703_add_two_column_permisons cannot be reverted.\n";

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
