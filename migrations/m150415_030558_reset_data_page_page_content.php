<?php

use yii\db\Schema;
use yii\db\Migration;

class m150415_030558_reset_data_page_page_content extends Migration
{
    public function up()
    {     
        $this->dropForeignKey('fk_pages_page_content', '{{%page_content}}');
        $this->truncateTable('{{%page_content}}');                                       
        $this->truncateTable('{{%pages}}');        
        $this->addForeignKey('fk_pages_page_content', '{{%page_content}}', 'page_id', '{{%pages}}', 'page_id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        echo "m150415_030558_reset_data_page_page_content cannot be reverted.\n";

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
