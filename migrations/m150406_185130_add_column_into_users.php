<?php

use yii\db\Schema;
use yii\db\Migration;

class m150406_185130_add_column_into_users extends Migration
{

    public function up()
    {
        $table = Yii::$app->db->schema->getTableSchema('{{%user}}');
        if (!isset($table->columns['require_change_password'])) {
            $this->addColumn('{{%user}}', 'require_change_password', 'tinyint(1)');
            $this->addColumn('{{%user}}', 'avatar', 'varchar(255)');
        }        
    }

    public function down()
    {
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
