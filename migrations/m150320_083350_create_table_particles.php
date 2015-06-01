<?php

use yii\db\Schema;
use yii\db\Migration;

class m150320_083350_create_table_particles extends Migration
{

    public function up()
    {
        if ($this->db->schema->getTableSchema('{{%particles}}', true) === null) {
            $tableOptions = "";
            $this->createTable('{{%particles}}', [
                'particle_id' => 'INT(4) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`particle_id`)',
                'particle_type' => 'VARCHAR(20) NOT NULL',
                'particle_key' => 'VARCHAR(255) NOT NULL',
                'attributes' => 'TEXT NOT NULL',
                'created' => 'DATETIME NOT NULL',
                'modified' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ',
                    ], $tableOptions);
        }
    }

    public function down()
    {
        $this->dropTable('{{%particles}}');
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
