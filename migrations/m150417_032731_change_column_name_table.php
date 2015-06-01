<?php

use yii\db\Schema;
use yii\db\Migration;

class m150417_032731_change_column_name_table extends Migration
{
    public function up()
    {
        try{
            $this->dropForeignKey('fk_pages_page_content', '{{%page_content}}');
            $this->dropForeignKey('fk_pages_pages', '{{%pages}}', 'parent_id');
            $this->dropForeignKey('fk_languages_page_content', '{{%page_content}}');
            $table = Yii::$app->db->schema->getTableSchema('{{%pages}}');
            if(empty($table))
                $table = Yii::$app->db->schema->getTableSchema('{{pages}}');
            if(isset($table->columns['page_id']))
                $this->renameColumn('{{%pages}}', 'page_id', 'id');
            if(isset($table->columns['page_key']))
                $this->renameColumn('{{%pages}}', 'page_key', 'key');
            $table = Yii::$app->db->schema->getTableSchema('{{%page_content}}');
            if(empty($table))
                $table = Yii::$app->db->schema->getTableSchema('{{page_content}}');
            if(isset($table->columns['content_id']))
                $this->renameColumn('{{%page_content}}', 'content_id', 'id');
            if(isset($table->columns['page_title']))
                $this->renameColumn('{{%page_content}}', 'page_title', 'title');
            if(isset($table->columns['page_content']))
                $this->renameColumn('{{%page_content}}', 'page_content', 'content');
            if(isset($table->columns['page_language']))
                $this->renameColumn('{{%page_content}}', 'page_language', 'language');
            if(isset($table->columns['page_header_img']))
                $this->renameColumn('{{%page_content}}', 'page_header_img', 'header_img');
            $table = Yii::$app->db->schema->getTableSchema('{{%languages}}');
            if(empty($table))
                $table = Yii::$app->db->schema->getTableSchema('{{languages}}');
            if(isset($table->columns['language_id']))
                $this->renameColumn('{{%languages}}', 'language_id', 'id');
            $table = Yii::$app->db->schema->getTableSchema('{{%content_list}}');
            if(empty($table))
                $table = Yii::$app->db->schema->getTableSchema('{{content_list}}');
            if(isset($table->columns['contentlist_id']))
                $this->renameColumn('{{%content_list}}', 'contentlist_id', 'id');
            $table = Yii::$app->db->schema->getTableSchema('{{%newsletter}}');
            if(empty($table))
                $table = Yii::$app->db->schema->getTableSchema('{{newsletter}}');
            if(isset($table->columns['newsletter_id']))
                $this->renameColumn('{{%newsletter}}', 'newsletter_id', 'id');
            if(isset($table->columns['newsletter_email']))
                $this->renameColumn('{{%newsletter}}', 'newsletter_email', 'email');
            $table = Yii::$app->db->schema->getTableSchema('{{%particles}}');
            if(empty($table))
                $table = Yii::$app->db->schema->getTableSchema('{{particles}}');
            if(isset($table->columns['particle_id']))
                $this->renameColumn('{{%particles}}', 'particle_id', 'id');
            if(isset($table->columns['particle_type']))
                $this->renameColumn('{{%particles}}', 'particle_type', 'type');
            if(isset($table->columns['particle_key']))
                $this->renameColumn('{{%particles}}', 'particle_key', 'key');
            $table = Yii::$app->db->schema->getTableSchema('{{%partner}}');
            if(empty($table))
                $table = Yii::$app->db->schema->getTableSchema('{{partner}}');
            if(isset($table->columns['partner_id']))
                $this->renameColumn('{{%partner}}', 'partner_id', 'id');
            if(isset($table->columns['partner_name']))
                $this->renameColumn('{{%partner}}', 'partner_name', 'name');
            if(isset($table->columns['partner_description']))
                $this->renameColumn('{{%partner}}', 'partner_description', 'description');
            $table = Yii::$app->db->schema->getTableSchema('{{%portfolio}}');
            if(empty($table))
                $table = Yii::$app->db->schema->getTableSchema('{{portfolio}}');
            if(isset($table->columns['portfolio_id']))
                $this->renameColumn('{{%portfolio}}', 'portfolio_id', 'id');
            if(isset($table->columns['portfolio_name']))
                $this->renameColumn('{{%portfolio}}', 'portfolio_name', 'name');
            if(isset($table->columns['portfolio_description']))
                $this->renameColumn('{{%portfolio}}', 'portfolio_description', 'description');
            $table = Yii::$app->db->schema->getTableSchema('{{%users_roles}}');
            if(empty($table))
                $table = Yii::$app->db->schema->getTableSchema('{{users_roles}}');
            if(isset($table->columns['user_id']))
                $this->alterColumn('{{%users_roles}}', 'user_id', 'int(11)');
        } catch(Exception $ex){
        }

    }

    public function down()
    {
        echo "m150417_032731_change_column_name_table cannot be reverted.\n";

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
