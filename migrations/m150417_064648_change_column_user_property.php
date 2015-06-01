<?php

use yii\db\Schema;
use yii\db\Migration;

class m150417_064648_change_column_user_property extends Migration
{
    public function up()
    {
        $table = Yii::$app->db->schema->getTableSchema('{{%user_property}}');
        if(empty($table))
            $table = Yii::$app->db->schema->getTableSchema('{{user_property}}');
        if (isset($table->columns['group_id']))
            $this->alterColumn('{{user_property}}', 'group_id', 'int(11) Null');
    }

    public function down()
    {
        echo "m150417_064648_change_column_user_property cannot be reverted.\n";

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
