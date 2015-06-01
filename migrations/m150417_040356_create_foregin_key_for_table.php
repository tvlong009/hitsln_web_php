<?php

use yii\db\Schema;
use yii\db\Migration;

class m150417_040356_create_foregin_key_for_table extends Migration
{
    public function up()
    {
        try{
            $table = Yii::$app->db->schema->getTableSchema('{{%user_property_value}}');
            if(empty($table))
                $table = Yii::$app->db->schema->getTableSchema('{{user_property_value}}');
            if (isset($table->columns['property_id'])) {
                $this->createIndex('property_id', '{{%user_property_value}}', 'property_id');
                $this->addForeignKey('fk_user_group_value', '{{%user_property_value}}', 'property_id', '{{%user_property}}', 'property_id', 'RESTRICT', 'RESTRICT');
            }
            if (isset($table->columns['user_id'])) {
                $this->createIndex('user_id', '{{%user_property_value}}', 'user_id');
                $this->addForeignKey('fk_user_group_value_user', '{{%user_property_value}}', 'user_id', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
            }
            $table = Yii::$app->db->schema->getTableSchema('{{%user_property}}');
            if(empty($table))
                $table = Yii::$app->db->schema->getTableSchema('{{user_property}}');
            if (isset($table->columns['group_id'])) {
                $this->createIndex('group_id', '{{%user_property}}', 'group_id');
                $this->addForeignKey('fk_user_group_property', '{{%user_property}}', 'group_id', '{{%user_property_group}}', 'group_id', 'RESTRICT', 'RESTRICT');
            }
            $table = Yii::$app->db->schema->getTableSchema('{{%page_content}}');
            if(empty($table))
                $table = Yii::$app->db->schema->getTableSchema('{{page_content}}');
            if (isset($table->columns['language']))
                $this->addForeignKey('fk_languages_page_content', '{{%page_content}}', 'language', '{{%languages}}', 'id', 'RESTRICT', 'RESTRICT');
            if (isset($table->columns['page_id']))
                $this->addForeignKey('fk_pages_page_content', '{{%page_content}}', 'page_id', '{{%pages}}', 'id', 'RESTRICT', 'RESTRICT');
        } catch(Exception $ex){
            
        }
        

    }

    public function down()
    {
        echo "m150417_040356_create_foregin_key_for_table cannot be reverted.\n";

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
