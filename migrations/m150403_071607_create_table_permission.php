<?php

use yii\db\Schema;
use yii\db\Migration;

class m150403_071607_create_table_permission extends Migration
{

    public function up()
    {
        if ($this->db->schema->getTableSchema('{{%permission}}', true) === null) {
            $tableOptions = "";
            /* MYSQL */
            $this->createTable('{{%permission}}', [
                'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`id`)',
                'action' => 'VARCHAR(255) NOT NULL',
                'user_id' => 'INT(11) NOT NULL',
                    ], $tableOptions);
            $this->addForeignKey('fk_user_permission', '{{%permission}}', 'user_id', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
        }
    }

    public function down()
    {

        $this->dropTable('{{%permission}}');
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
