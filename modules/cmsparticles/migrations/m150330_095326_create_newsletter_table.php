<?php

use yii\db\Schema;
use yii\db\Migration;

class m150330_095326_create_newsletter_table extends Migration
{

    public function up()
    {
        if ($this->db->schema->getTableSchema('{{%newsletter}}', true) === null) {
            $tableOptions = "";

            $this->createTable('{{%newsletter}}', [
                'newsletter_id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`newsletter_id`)',
                'newsletter_email' => 'VARCHAR(255) NOT NULL',
                'created' => 'DATETIME NOT NULL',
                'modified' => 'DATETIME NOT NULL',
                    ], $tableOptions);
        }
    }

    public function down()
    {
        $this->dropTable('{{%newsletter}}');
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
