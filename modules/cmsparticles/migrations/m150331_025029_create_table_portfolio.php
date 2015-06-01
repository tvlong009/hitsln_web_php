<?php

use yii\db\Schema;
use yii\db\Migration;

class m150331_025029_create_table_portfolio extends Migration
{

    public function up()
    {
        if ($this->db->schema->getTableSchema('{{%portfolio}}', true) === null) {
            $tableOptions = "";
            $this->createTable('{{%portfolio}}', [
                'portfolio_id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`portfolio_id`)',
                'portfolio_name' => 'VARCHAR(255) NOT NULL',
                'portfolio_description' => 'TEXT NOT NULL',
                'status' => 'TINYINT(1) NOT NULL',
                'link' => 'VARCHAR(255) NOT NULL',
                'created' => 'DATETIME NOT NULL',
                'modified' => 'DATETIME NOT NULL',
                    ], $tableOptions);
        }
    }

    public function down()
    {
        $this->dropTable('{{%portfolio}}');
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
