<?php

use yii\db\Schema;
use yii\db\Migration;
use \app\models\Particles;

class m150522_094806_create_default_particles_data extends Migration
{
    public function up()
    {
        $particleKey = array(
            'Contact Form' => 'contact_form',
            'Newsletter' => 'newsletter',
            'Partners' => 'partner',
            'Portfolio' => 'portfolio',
            'Content List' => 'content_list'
        );
        foreach ($particleKey as $type => $key) {
            $particleContactForm = Particles::findOne(['key' => $key]);
            if (!$particleContactForm) {
                $particleContactForm = new \app\models\Particles();
                $particleContactForm->type = (string)$type;
                $particleContactForm->key = (string)$key;
                $particleContactForm->save();
            }
        }
    }

    public function down()
    {
        echo "m150522_094806_create_default_particles_data cannot be reverted.\n";

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
