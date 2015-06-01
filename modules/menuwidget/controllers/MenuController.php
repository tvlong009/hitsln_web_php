<?php


namespace app\modules\menuwidget\controllers;

use app\modules\menuwidget\models\Menu;
use app\controllers\BackendController;
use app\modules\menuwidget\models\MenuItem;
use app\modules\menuwidget\models\MenuItemLanguage;
use yii\data\ActiveDataProvider;
use Yii;

class MenuController extends BackendController
{
    private $js = array('superfish.js' => 'superfish.js');
    public function actionIndex()
    {
        //get all pages
        $sortBy = Yii::$app->getRequest()->get('sort') != '' ? Yii::$app->getRequest()->get('sort') : 'id';

        if (Yii::$app->getRequest()->get('sort') != '') {
            $posType = strpos($sortBy, '-');


            if (is_numeric($posType)) {
                $sortBy = substr($sortBy, $posType + 1);
                $sortType = SORT_DESC;
            } else {
                $sortType = SORT_ASC;
            }
        } else {
            $sortType = SORT_DESC;
        }



        $dataProvider = new ActiveDataProvider([
            'query' => Menu::find()->orderBy([$sortBy => $sortType]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Menu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Create menu success'));
            return $this->redirect('index');
        }

        return $this->render('create', array('model' => $model, 'js' => $this->js));
    }

    public function actionUpdate($id)
    {
        $model = Menu::findOne($id);
        if ($model) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Update menu success'));
            }
            return $this->render('update', array('model' => $model, 'js' => $this->js));
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $this->redirect('index');
        }
    }

    public function actionDelete()
    {
        $data = [];
        if (Yii::$app->getRequest()->isAjax) {
            $menuIdList = Yii::$app->getRequest()->post('id');
            if (!empty($menuIdList)) {
                foreach ($menuIdList as $menuId) {
                    $menu = Menu::findOne($menuId);
                    if ($menu) {
                        $menuItems = MenuItem::findAll(['menu_id' => $menu->id]);
                        self::deleteMenuItem($menuItems);
                        $menu->delete();
                    }
                }
                Yii::$app->session->setFlash('success', Yii::t('app', 'Delete menu success'));
                $data['success'] = '1';
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Delete menu error'));
                $data['error'] = 1;
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $data['error'] = 1;
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    public static function deleteMenuItem($menuItems)
    {
        if (!empty($menuItems)) {
            foreach ($menuItems as $menuItem) {
                $childItems = MenuItem::findAll(['parent_id' => $menuItem->id]);
                if ($childItems) {
                    foreach ($childItems as $child) {
                        $list = MenuItem::findAll(['parent_id' => $child->id]);
                        if ($list) {
                            self::deleteMenuItem($list);
                        } else {
                            MenuItemLanguage::deleteAll(['item_id' => $child->id]);
                            $child->delete();
                        }
                    }
                }
                MenuItemLanguage::deleteAll(['item_id' => $menuItem->id]);
                $menuItem->delete();
            }
        }
    }
}
