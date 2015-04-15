<?php

use yii\db\Schema;
use yii\db\Migration;

class m150331_105557_create_table_users_roles extends Migration
{

    public function up()
    {
        if ($this->db->schema->getTableSchema('{{%users_roles}}', true) === null) {
            $tableOptions = "";
            $this->createTable('{{%users_roles}}', [
                'id' => 'INT(255) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`id`)',
                'user_id' => 'INT(255) NOT NULL',
                'role_id' => 'SMALLINT(6) NOT NULL',
                    ], $tableOptions);
            $this->addForeignKey('fk_roles_users_roles', '{{%users_roles}}', 'role_id', '{{%roles}}', 'id', 'RESTRICT', 'RESTRICT');
            $this->addForeignKey('fk_user_users_roles', '{{%users_roles}}', 'user_id', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
        }
    }

    public function down()
    {
        $this->dropTable('{{%users_roles}}');
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
