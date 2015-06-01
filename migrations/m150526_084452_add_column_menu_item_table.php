<?php

use yii\db\Schema;
use yii\db\Migration;

class m150526_084452_add_column_menu_item_table extends Migration
{
    public function up()
    {
        $table = Yii::$app->db->schema->getTableSchema('{{%menu_item}}');
        if(empty($table))
            $table = Yii::$app->db->schema->getTableSchema('{{$menu_item}}');

        if(!isset($table->columns['is_ajax'])) {
            $this->addColumn('menu_item', 'is_ajax', 'tinyint(1) default 0');
        }
    }

    public function down()
    {
        echo "m150526_084452_add_column_menu_item_table cannot be reverted.\n";

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
