<?php

use yii\db\Schema;
use yii\db\Migration;

class m150330_072256_create_table_roles extends Migration
{

    public function up()
    {
        $tableOptions = "";
        if ($this->db->schema->getTableSchema('{{%roles}}', true) === null) {
            $this->createTable('{{%roles}}', [
                'id' => 'SMALLINT(6) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`id`)',
                'name' => 'VARCHAR(255) NOT NULL',
                'level' => 'TINYINT(4) NOT NULL',
                'is_master' => 'TINYINT(4) NOT NULL',
                'is_default' => 'TINYINT(4) NOT NULL',
                    ], $tableOptions);
        }
    }

    public function down()
    {
        $this->dropTable('{{%roles}}');
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
