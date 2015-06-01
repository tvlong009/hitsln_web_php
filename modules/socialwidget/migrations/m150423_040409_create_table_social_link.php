<?php

use yii\db\Schema;
use yii\db\Migration;

class m150423_040409_create_table_social_link extends Migration
{
    public function up()
    {
        $tableOptions = "";
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        if ($this->db->schema->getTableSchema('{{%social_link}}', true) === null) {
            $this->createTable('{{%social_link}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(50) NOT NULL',
                    'link' => 'VARCHAR(100) NULL',
                    'icon' => 'VARCHAR(50) NULL',
                    'css_class' => 'VARCHAR(50) NULL',
                    'is_active' => 'INT(11) NULL',
                    'js_action' => 'TEXT NULL',
                    'order' => 'INT(11) NULL',
                    'created' => 'DATETIME NOT NULL',
                    'modified' => 'DATETIME NOT NULL',
            ], $tableOptions);
        }
    }

    public function down()
    {
        $this->dropTable('{{%social_link}}');
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
