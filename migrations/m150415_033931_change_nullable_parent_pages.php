<?php

use yii\db\Schema;
use yii\db\Migration;

class m150415_033931_change_nullable_parent_pages extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%pages}}', 'parent_id', 'integer null');
    }

    public function down()
    {
        echo "m150415_033931_change_nullable_parent_pages cannot be reverted.\n";

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
