<?php

use yii\db\Schema;
use yii\db\Migration;

class m150514_090941_create_menu_data extends Migration
{
    public function up()
    {
        $menuItems = array(
            'About us' => 'About us',
            'Music Labels' => 'Music Labels',
            'Our Services' => 'Our Services',
            'Our Technology' => 'Our Technology',
            'Our Portfolio' => 'Our Portfolio'
        );

        $languages = \app\models\Languages::find()->all();

        //create menu
        $menu = new app\modules\menuwidget\models\Menu();
        $menu->key = 'Main';
        $menu->effect = 'superfish.js';
        $menu->is_active = 1;

        if ($menu->save() && !empty($languages)) {
            //create menu item
            foreach ($menuItems as $menuName => $pageKey) {
                $menuItem = new \app\modules\menuwidget\models\MenuItem();
                $menuItem->menu_id = $menu->id;
                $menuItem->link = '/home/index?page=' . $pageKey;
                $menuItem->is_active = 1;
                $menuItem->is_ajax = 0;
                $menuItem->is_blank = 0;
                if ($menuItem->save()) {
                    foreach ($languages as $language) {
                        $menuItemLanguage = new \app\modules\menuwidget\models\MenuItemLanguage();
                        $menuItemLanguage->language_id = $language->id;
                        $menuItemLanguage->item_id = $menuItem->id;
                        $menuItemLanguage->value = (string)$menuName;
                        $menuItemLanguage->save();
                    }
                }
            }
        }
    }

    public function down()
    {
        echo "m150514_090941_create_menu_data cannot be reverted.\n";

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
