<?php

use yii\db\Schema;
use yii\db\Migration;

class m150601_033040_truncate_page_contents extends Migration
{
    public function up()
    {
        $this->dropForeignKey('fk_pages_page_content', 'page_content');
        $this->truncateTable('page_content');
        $this->truncateTable('pages');
        $this->addForeignKey('fk_pages_page_content', 'page_content', 'page_id', 'pages', 'id');
    }

    public function down()
    {
        echo "m150601_033040_truncate_page_contents cannot be reverted.\n";

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
