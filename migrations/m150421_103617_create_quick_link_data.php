<?php

use yii\db\Schema;
use yii\db\Migration;
use app\models\Languages;

class m150421_103617_create_quick_link_data extends Migration
{
    public function up()
    {
        $this->delete('quick_link_group_language');
        $this->delete('quick_link_language');
        $this->delete('quick_link');
        $this->delete('quick_link_group');
        $id_group = array('1', '2', '3');

        //get language
        $language = Languages::findOne(['is_default' => 1]);

        if (!$language) {
            $language = Languages::findOne(['is_active' => 1]);
        }
        if (!$language) {
            $languages = Languages::find()->all();
            if (!empty($languages)) {
                $language = $languages[0];
            } else {
                $language = new Languages();
                $language->name = 'English';
                $language->code = 'en';
                $language->description = 'English';
                $language->is_default = 0;
                $language->is_active = 1;
                $language->save();
            }
        }

        if ($language) {
            // group 1
            $this->insert('quick_link_group', array(
                'id' => $id_group[0],
                'displayorder' => 1,
                'status' => 1
            ));
            $this->insert('quick_link_group_language', array(
                'language_id' => $language->id,
                'group_link_id' => $id_group[0],
                'value' => 'OUR COMPANY'
            ));
            // link 1
            $this->insert('quick_link', array(
                'id' => 1,
                'group_id' => $id_group[0],
                'type' => 1,
                'url' => '',
                'action' => 'home/index?page=About us',
                'displayorder' => 1,
                'status' => 1,
                'prefix' => 'app'
            ));
            $this->insert('quick_link_language', array(
                'language_id' => $language->id,
                'quick_link_id' => 1,
                'value' => 'About us'
            ));
            // link 2
            $this->insert('quick_link', array(
                'id' => 2,
                'group_id' => $id_group[0],
                'type' => 1,
                'url' => '',
                'action' => 'home/index?page=Our Services',
                'displayorder' => 1,
                'status' => 1,
                'prefix' => 'app'
            ));
            $this->insert('quick_link_language', array(
                'language_id' => $language->id,
                'quick_link_id' => 2,
                'value' => 'Our Services'
            ));
            // link 3
            $this->insert('quick_link', array(
                'id' => 3,
                'group_id' => $id_group[0],
                'type' => 1,
                'url' => '',
                'action' => 'home/index?page=Our Technology',
                'displayorder' => 1,
                'status' => 1,
                'prefix' => 'app'
            ));
            $this->insert('quick_link_language', array(
                'language_id' => $language->id,
                'quick_link_id' => 3,
                'value' => 'Our Technology'
            ));
            // link 4
            $this->insert('quick_link', array(
                'id' => 4,
                'group_id' => $id_group[0],
                'type' => 1,
                'url' => '',
                'action' => 'home/index?page=Our Partners',
                'displayorder' => 1,
                'status' => 1,
                'prefix' => 'app'
            ));
            $this->insert('quick_link_language', array(
                'language_id' => $language->id,
                'quick_link_id' => 4,
                'value' => 'Our Partners'
            ));
            //===============//////
            // group 2
            $this->insert('quick_link_group', array(
                'id' => $id_group[1],
                'displayorder' => 1,
                'status' => 1
            ));
            $this->insert('quick_link_group_language', array(
                'language_id' => $language->id,
                'group_link_id' => $id_group[1],
                'value' => 'PROJECTS'
            ));
            // link 1
            $this->insert('quick_link', array(
                'id' => 5,
                'group_id' => $id_group[1],
                'type' => 1,
                'url' => '',
                'action' => 'home/index?page=Download',
                'displayorder' => 1,
                'status' => 1,
                'prefix' => 'app'
            ));
            $this->insert('quick_link_language', array(
                'language_id' => $language->id,
                'quick_link_id' => 5,
                'value' => 'Download'
            ));
            // link 2
            $this->insert('quick_link', array(
                'id' => 6,
                'group_id' => $id_group[1],
                'type' => 1,
                'url' => '',
                'action' => 'home/index?page=Streaming',
                'displayorder' => 1,
                'status' => 1,
                'prefix' => 'app'
            ));
            $this->insert('quick_link_language', array(
                'language_id' => $language->id,
                'quick_link_id' => 6,
                'value' => 'Streaming'
            ));
            // link 3
            $this->insert('quick_link', array(
                'id' => 7,
                'group_id' => $id_group[1],
                'type' => 1,
                'url' => '',
                'action' => 'home/index?page=New Releases',
                'displayorder' => 1,
                'status' => 1,
                'prefix' => 'app'
            ));
            $this->insert('quick_link_language', array(
                'language_id' => $language->id,
                'quick_link_id' => 7,
                'value' => 'New Releases'
            ));
            //===============//////
            // group 3
            $this->insert('quick_link_group', array(
                'id' => $id_group[2],
                'displayorder' => 1,
                'status' => 1
            ));
            $this->insert('quick_link_group_language', array(
                'language_id' => $language->id,
                'group_link_id' => $id_group[2],
                'value' => 'TERMS AND CONDITIONS'
            ));
            // link 1
            $this->insert('quick_link', array(
                'id' => 8,
                'group_id' => $id_group[2],
                'type' => 1,
                'url' => '',
                'action' => 'home/index?page=Terms_Conditions',
                'displayorder' => 1,
                'status' => 1,
                'prefix' => 'app'
            ));
            $this->insert('quick_link_language', array(
                'language_id' => $language->id,
                'quick_link_id' => 8,
                'value' => 'Terms & Conditions'
            ));
            // link 2
            $this->insert('quick_link', array(
                'id' => 9,
                'group_id' => $id_group[2],
                'type' => 1,
                'url' => '',
                'action' => 'home/index?page=Disclaimer',
                'displayorder' => 1,
                'status' => 1,
                'prefix' => 'app'
            ));
            $this->insert('quick_link_language', array(
                'language_id' => $language->id,
                'quick_link_id' => 9,
                'value' => 'Disclaimer'
            ));
        }
        
    }

    public function down()
    {
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
