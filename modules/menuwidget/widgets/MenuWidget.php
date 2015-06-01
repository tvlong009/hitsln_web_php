<?php

namespace app\modules\menuwidget\widgets;

use app\models\Languages;
use app\modules\menuwidget\controllers\MenuItemController;
use app\modules\menuwidget\models\Menu;
use app\modules\menuwidget\models\MenuItem;
use app\modules\menuwidget\models\MenuItemLanguage;
use \yii\base\Widget;

class MenuWidget extends Widget
{

    public $menuKey = '';
    public $classRootMenu = '';
    public $idRootMenu = '';
    public $languageCode = '';
    public $activeClass = '';

    public function init()
    {
        if ($this->classRootMenu == '') {
            $this->classRootMenu = 'sf-menu';
        }

        if ($this->idRootMenu == '') {
            $this->idRootMenu = 'sf-menu';
        }

        if ($this->activeClass == '') {
            $this->activeClass = 'active_page';
        }
    }

    public function run()
    {
        $menu = null;
        $this->languageCode = $this->languageCode != '' ? $this->languageCode : \Yii::$app->session->get('frontend_language');
        $language = Languages::findOne(['code' => $this->languageCode]);
        if (!$language) {
            $language = Languages::findOne(['is_default' => 1]);

            if (!$language) {
                $language = Languages::findOne(['is_active' => 1]);
            }
            if (!$language) {
                $languages = Languages::find()->all();
                if (!empty($languages)) {
                    $language = $languages[0];
                }
            }
        }
        $menuItems = array();
        if ($this->menuKey == '') {
            $menus = Menu::findAll(['is_active' => 1]);
            if ($menus) {
                $menu = $menus[0];
            }
        } else {
            $menu = Menu::findOne(['key' => $this->menuKey]);
        }

        if ($menu && $language) {
            $menuItemList = MenuItem::find()->andWhere(['menu_id' => $menu->id, 'is_active' => 1])
                ->orderBy(['displayorder' => SORT_ASC])->all();

            if (!empty($menuItemList)) {
                foreach ($menuItemList as $menuItem) {
                    $menuitemLanguage = MenuItemLanguage::findOne([
                        'item_id' => $menuItem->id,
                        'language_id' => $language->id
                    ]);

                    if ($menuitemLanguage) {
                        $menuItems[] = array(
                            'id' => $menuItem->id,
                            'label' => $menuitemLanguage->value,
                            'link' => $menuItem->link,
                            'is_active' => $menuItem->is_active,
                            'is_blank' => $menuItem->is_blank,
                            'parent_id' => (int)$menuItem->parent_id,
                            'displayorder' => $menuItem->displayorder,
                            'is_ajax' => $menuItem->is_ajax,
                        );
                    }
                }

                MenuItemController::createList($menuItems);
                $menuItems = MenuItemController::$itemList;
            }
        }

        $controller = \Yii::$app->controller->id;
        $action = \Yii::$app->controller->action->id;


        return $this->render('menu', [
            'menuItems' => $menuItems,
            'idRootMenu' => $this->idRootMenu,
            'classRootMenu' => $this->classRootMenu,
            'controller' => $controller,
            'action' => $action,
            'activeClass' => $this->activeClass,
        ]);
    }
}