<?php

namespace app\modules\menuwidget\controllers;

use app\modules\menuwidget\models\Menu;
use app\modules\menuwidget\models\MenuItem;
use app\modules\menuwidget\models\MenuItemLanguage;
use Yii;
use app\controllers\BackendController;
use app\models\Languages;
use app\models\Page;


class MenuItemController extends BackendController
{

    private $menu;
    private $language;
    public static $itemList = array();

    public function __construct($id, $module)
    {
        parent::__construct($id, $module);
        $menuId = Yii::$app->request->get('menu_id');
        $this->menu = $this->getMenu($menuId);
        if (!$this->menu) {
            Yii::$app->session->setFlash('error', 'Menu is not exist');
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('menuwidget/menu'));
        }

        $this->language = Languages::findOne(['code' => Yii::$app->language]);
        if (!$this->language) {
            $this->language = Languages::findOne(['is_default' => 1]);

            if (!$this->language) {
                $this->language = Languages::findOne(['is_active' => 1]);
            }
            if (!$this->language) {
                $languages = Languages::find()->all();
                if (!empty($languages)) {
                    $this->language = $languages[0];
                } else {
                    Yii::$app->session->setFlash('warning', 'Please create language before create menu item');
                    return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('languages/create'));
                }
            }
        }
    }

    public function actionIndex()
    {
        $items = array();
        $menuItems = MenuItem::find()->where(['menu_id' => $this->menu->id])->orderBy(['displayorder' => SORT_ASC]);

        if ($menuItems->count() > 0) {
            foreach ($menuItems->all() as $item) {
                $menuItemLanguage  = MenuItemLanguage::findOne(['item_id' => $item->id, 'language_id' => $this->language->id]);
                if ($menuItemLanguage) {
                    $items[$item->id] = array(
                        'id' => $item->id,
                        'label' => $menuItemLanguage->value,
                        'link' => preg_match('/^http(s)?/', $item->link)
                            ? $item->link : Yii::$app->urlManager->createAbsoluteUrl($item->link),
                        'is_active' => $item->is_active,
                        'parent_id' => (int)$item->parent_id,
                        'displayorder' => $item->displayorder

                    );
                }
            }
        }
        $this->createList($items);

        return $this->render('index', ['menu' => $this->menu, 'items' => self::$itemList]);
    }

    public function actionCreate()
    {
        $model = new MenuItem();

        if ($model->load(Yii::$app->request->post())) {
            if ($this->validData()) {
                $model->menu_id = $this->menu->id;
                if ($model->save()) {

                    $itemLanguage = Yii::$app->request->post('labelitem');

                    if (!empty($itemLanguage)) {
                        foreach ($itemLanguage as $languageId => $value) {
                            $language = Languages::findOne($languageId);
                            if ($language && $value != '') {
                                $menuitemLanguage = new MenuItemLanguage();
                                $menuitemLanguage->language_id = $language->id;
                                $menuitemLanguage->item_id = $model->id;
                                $menuitemLanguage->value = (string)$value;

                                $menuitemLanguage->save();
                            }
                        }
                    }

                    Yii::$app->session->setFlash('success', Yii::t('app', 'Create menu item success'));
                    return $this->redirect('index?menu_id=' . $this->menu->id);
                }
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Please fill full information'));
            }
        }

        $pages = Page::find()->from('(select * from pages order by created DESC) as page')->groupBy(['key'])->all();
        self::createList($pages);
        $pages = self::$itemList;


        $items = $this->getItems();
        return $this->render('create', [
            'menu' => $this->menu,
            'model' => $model,
            'items' => $items,
            'languages' => Languages::find()->all(),
            'pages' => $pages,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = MenuItem::findOne($id);

        if ($model) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $itemLanguage = Yii::$app->request->post('labelitem');

                if (!empty($itemLanguage)) {
                    foreach ($itemLanguage as $languageId => $value) {
                        $language = Languages::findOne($languageId);
                        if ($language && $value != '') {
                            $menuitemLanguage = MenuItemLanguage::findOne(['item_id' => $model->id, 'language_id' => $language->id]);
                            if ($menuitemLanguage) {
                                $menuitemLanguage->value = (string)$value;
                                $menuitemLanguage->save();
                            } else {
                                $menuitemLanguage = new MenuItemLanguage();
                                $menuitemLanguage->language_id = $language->id;
                                $menuitemLanguage->item_id = $model->id;
                                $menuitemLanguage->value = (string)$value;

                                $menuitemLanguage->save();
                            }
                        }
                    }
                }
                Yii::$app->session->setFlash('success', Yii::t('app', 'Update menu item success'));
            }

            $itemLanguages = array();
            $menuItemLanguages = MenuItemLanguage::findAll(['item_id' => $model->id]);
            if ($menuItemLanguages) {
                foreach ($menuItemLanguages as $itemLanguage) {
                    $itemLanguages[$itemLanguage->language_id] = $itemLanguage->value;
                }
            }

            $pages = Page::find()->from('(select * from pages order by created DESC) as page')->groupBy(['key'])->all();
            self::createList($pages);
            $pages = self::$itemList;
            $items = $this->getItems($id);
            return $this->render('update', [
                'menu' => $this->menu,
                'model' => $model,
                'items' => $items,
                'languages' => Languages::find()->all(),
                'itemLanguages' => $itemLanguages,
                'pages' => $pages,
            ]);
        } else {
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('menuwidget/menu-item/index?menu_id=' . $this->menu->id));
        }
    }

    public function actionDelete()
    {
        $data = [];
        if (Yii::$app->getRequest()->isAjax) {
            $menuItemIdList = Yii::$app->getRequest()->post('id');
            if (!empty($menuItemIdList)) {
                foreach ($menuItemIdList as $menuItemId) {
                    $menuItem = MenuItem::findOne($menuItemId);
                    if ($menuItem) {
                        $childItems = MenuItem::findAll(['parent_id' => $menuItem->id]);
                        if ($childItems) {
                            MenuController::deleteMenuItem($childItems);
                        }
                        MenuItemLanguage::deleteAll(['item_id' => $menuItem->id]);
                        $menuItem->delete();
                    }
                }
                Yii::$app->session->setFlash('success', Yii::t('app', 'Delete menu item success'));
                $data['success'] = '1';
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Delete menu item error'));
                $data['error'] = 1;
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $data['error'] = 1;
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    public function actionChangeDisplayOrder()
    {
        $jsonData = array();
        if (Yii::$app->request->isAjax) {
            $currentId = Yii::$app->request->post('current_id');
            $type = Yii::$app->request->post('type');

            $currentItem = MenuItem::findOne(['id' => $currentId, 'menu_id' => $this->menu->id]);
            $isOk = true;

            if ($currentItem) {
                switch ($type) {
                    case 1:
                        $prevId = Yii::$app->request->post('prev_id');
                        $prevItem = MenuItem::findOne(['id' => $prevId, 'menu_id' => $this->menu->id]);
                        if ($prevItem) {
                            $temp = $currentItem->displayorder;
                            $currentItem->displayorder = $prevItem->displayorder;
                            $prevItem->displayorder = $temp;
                            $currentItem->save();
                            $prevItem->save();
                        } else {
                            $isOk = false;
                        }
                        break;
                    case 2:
                        $nextId = Yii::$app->request->post('next_id');
                        $nextItem = MenuItem::findOne(['id' => $nextId, 'menu_id' => $this->menu->id]);
                        if ($nextItem) {
                            $temp = $currentItem->displayorder;
                            $currentItem->displayorder = $nextItem->displayorder;
                            $nextItem->displayorder = $temp;
                            $currentItem->save();
                            $nextItem->save();
                            $currentItem->save();
                            $nextItem->save();
                        } else {
                            $isOk = false;
                        }
                        break;
                }
                if ($isOk) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Change display order item success'));
                    $jsonData['success'] = 1;
                } else {
                    $jsonData['error'] = 1;
                }
            } else {
                $jsonData['error'] = 1;
            }
        } else {
            $jsonData['error'] = 1;
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $jsonData;
    }

    private function getMenu($menuId = 0)
    {
        if ($menuId > 0) {
            return Menu::findOne($menuId);
        } else {
            return null;
        }
    }

    /**
     * @param $items
     * @return mixed
     */
    private function getItems($escape = 0)
    {
        $items = array();
        $data = MenuItem::find()->where('menu_id = :menu_id and id != :id', ['menu_id' => $this->menu->id, 'id' => $escape])->all();
        if (!empty($data) && $this->language) {
            foreach ($data as $item) {
                $itemLanguage = MenuItemLanguage::findOne(['item_id' => $item->id, 'language_id' => $this->language->id]);
                if ($itemLanguage) {
                    $items[$item->id] = $itemLanguage->value;
                }
            }
            return $items;
        }
        return $items;
    }

    private function validData()
    {
        $pass = true;
        $itemLabels = Yii::$app->request->post('labelitem');
        if (!empty($itemLabels)) {
            foreach ($itemLabels as $item) {
                if ($item == '') {
                    $pass = false;
                    break;
                }
            }
        }

        return $pass;
    }

    public static function createList($items, $parentId = 0)
    {
        if (!empty($items)) {
            foreach ($items as $item) {
                if ($item['parent_id'] == $parentId) {
                    self::$itemList[$parentId][] = $item;
                    self::createList($items, $item['id']);
                    unset($item);
                }
            }
        }
    }
}