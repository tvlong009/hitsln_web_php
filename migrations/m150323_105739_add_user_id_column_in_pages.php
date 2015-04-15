<?php

use yii\db\Schema;
use yii\db\Migration;

class m150323_105739_add_user_id_column_in_pages extends Migration
{
    public function up()
    {
        $this->addColumn('pages', 'user_id', 'integer');
    }

    public function down()
    {
        $this->dropColumn('pages', 'user_id');
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
