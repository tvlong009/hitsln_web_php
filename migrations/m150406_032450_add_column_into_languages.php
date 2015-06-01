<?php

use yii\db\Schema;
use yii\db\Migration;

class m150406_032450_add_column_into_languages extends Migration
{

    public function up()
    {
        $table = Yii::$app->db->schema->getTableSchema('{{%languages}}');
        if(empty($table))
            $table = Yii::$app->db->schema->getTableSchema('{{languages}}');
        if (!isset($table->columns['is_active'])) {
            $this->addColumn('{{%languages}}', 'is_active', 'tinyint(1)');
        }
        if (!isset($table->columns['is_default'])) {
            $this->addColumn('{{%languages}}', 'is_default', 'tinyint(1)');
        }
    }

    public function down()
    {
        $this->dropColumn('{{%languages}}', 'is_active');
        $this->dropColumn('{{%languages}}', 'is_default');
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
