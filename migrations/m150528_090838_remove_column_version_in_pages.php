<?php

use yii\db\Schema;
use yii\db\Migration;

class m150528_090838_remove_column_version_in_pages extends Migration
{
    public function up()
    {
        $table = Yii::$app->db->schema->getTableSchema('{{%pages}}');
        if(empty($table))
            $table = Yii::$app->db->schema->getTableSchema('{{$pages}}');

        if(isset($table->columns['version']))
            $this->dropColumn('pages', 'version');
    }

    public function down()
    {
        echo "m150528_090838_remove_column_version_in_pages cannot be reverted.\n";

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
