<?php

use yii\db\Schema;
use yii\db\Migration;

class m150421_021432_add_column_in_quick_link_group extends Migration
{
    public function up()
    {
        $table = Yii::$app->db->schema->getTableSchema('{{%quick_link}}');
        if(empty($table))
            $table = Yii::$app->db->schema->getTableSchema('{{quick_link}}');
        if (!isset($table->columns['is_blank'])) {
            $this->addColumn('{{%quick_link}}', 'is_blank', 'tinyint(1)');
        }

        if (!isset($table->columns['prefix'])) {
            $this->addColumn('{{%quick_link}}', 'prefix', 'varchar(255)');
        }
    }

    public function down()
    {
        echo "m150421_021432_add_column_in_quick_link_group cannot be reverted.\n";

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
