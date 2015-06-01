<?php

use yii\db\Schema;
use yii\db\Migration;

class m150513_083958_add_column_into_user_to_signup extends Migration
{
    public function up()
    {
        $table = Yii::$app->db->schema->getTableSchema('{{%user}}');
        if(empty($table)) {
            if(!isset($table->columns['active_code'])) {
                $this->addColumn('user', 'active_code', 'varchar(255)');
            }

            if(!isset($table->columns['birth_date'])) {
                $this->addColumn('user', 'birth_date', 'date');
            }

            if(!isset($table->columns['gender'])) {
                $this->addColumn('user', 'gender', 'tinyint(1)');
            }
        }
    }

    public function down()
    {
        echo "m150513_083958_add_column_into_user_to_signup cannot be reverted.\n";

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
