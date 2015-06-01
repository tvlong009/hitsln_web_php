<?php

namespace app\controllers;

use app\controllers\BackendController;
use app\models\QuickLink;
use app\models\QuickLinkGroup;
use app\models\QuickLinkGroupLanguage;
use app\models\QuickLinkLanguage;
use Yii;
use app\models\Languages;
use yii\data\ActiveDataProvider;

class QuickLinkController extends BackendController
{
    private $controllers = array();

    public function __construct($id, $module) {
        parent::__construct($id, $module);
        $countLanguage = Languages::find()->count();

        if ($countLanguage == 0) {
            Yii::$app->session->setFlash('warning', 'Please create language before create quick link');
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('languages/create'));
        }
    }

    public function actionIndex()
    {
        //get all pages
        $sortBy = Yii::$app->getRequest()->get('sort') != '' ? Yii::$app->getRequest()->get('sort') : 'displayorder';

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
            'query' => QuickLink::find()->orderBy([$sortBy => $sortType]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new QuickLink();
        $languages = Languages::find()->all();
        $this->getControllers(dirname(dirname(\Yii::getAlias('@webroot'))));
        $routers = $this->getRouters($this->controllers);


        if (Yii::$app->request->post()) {
            $names = Yii::$app->request->post('name');
            if (!empty($names)) {
                if ($this->validName($names)) {
                    $quickLink = new QuickLink();
                    $quickLink->type = Yii::$app->request->post('type');
                    if ($quickLink->type == QuickLink::TYPE_ACTION) {
                        $actions = explode('/', Yii::$app->request->post('action'));
                        $quickLink->action = $actions[1] . '/' . $actions[2];
                        $quickLink->prefix = $actions[0];
                    } else {
                        $quickLink->url = Yii::$app->request->post('url');
                    }

                    $quickLink->group_id = Yii::$app->request->post('group') > 0 ?  Yii::$app->request->post('group') : null;

                    $quickLink->status = Yii::$app->request->post('status');

                    if ($quickLink->save()) {
                        foreach ($names as $languageId => $name) {
                            $quickLinkLanguage = new QuickLinkLanguage();
                            $language = Languages::findOne($languageId);
                            $quickLinkLanguage->language_id = $language->primaryKey;
                            $quickLinkLanguage->quick_link_id = $quickLink->primaryKey;
                            $quickLinkLanguage->value = (string)$name;

                            $quickLinkLanguage->save();
                        }

                        Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Create quick link successfully'));
                        return $this->redirect('index');
                    }
                } else {
                    Yii::$app->session->setFlash('error_name', Yii::t('app', 'Please fill full label link of quick link.'));
                }
            }
        }

        return $this->render('create', array('model' => $model, 'languages' => $languages, 'routers' => $routers, 'groups' => $this->getQuickLinkGroup()));
    }

    public function actionUpdate($id)
    {
        $formData = array();
        $model = QuickLink::findOne($id);
        $languages = Languages::find()->all();
        $this->getControllers(dirname(dirname(\Yii::getAlias('@webroot'))));
        $routers = $this->getRouters($this->controllers);

        if ($model) {

            if (Yii::$app->request->post()) {
                $names = Yii::$app->request->post('name');
                if (!empty($names)) {
                    if ($this->validName($names)) {
                        $model->type = Yii::$app->request->post('type');
                        if ($model->type == QuickLink::TYPE_ACTION) {
                            $actions = explode('/', Yii::$app->request->post('action'));
                            $model->action = $actions[1] . '/' . $actions[2];
                            $model->prefix = $actions[0];
                            $model->url = '';
                        } else {
                            $model->url = Yii::$app->request->post('url');
                            $this->action = '';
                        }

                        $model->group_id = Yii::$app->request->post('group') > 0 ?  Yii::$app->request->post('group') : null;

                        $model->status = Yii::$app->request->post('status');

                        if ($model->save()) {
                            foreach ($names as $languageId => $name) {
                                $language = Languages::findOne($languageId);
                                $quickLinkLanguage = QuickLinkGroupLanguage::findOne([
                                    'language_id' => $language->id,
                                    'group_link_id' => $model->primaryKey
                                ]);

                                if ($quickLinkLanguage) {
                                    $quickLinkLanguage->value = (string)$name;
                                } else {
                                    $quickLinkLanguage = new QuickLinkLanguage();
                                    $language = Languages::findOne($languageId);
                                    $quickLinkLanguage->language_id = $language->primaryKey;
                                    $quickLinkLanguage->quick_link_id = $model->primaryKey;
                                    $quickLinkLanguage->value = (string)$name;

                                    $quickLinkLanguage->save();
                                }
                            }
                            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Update quick link successfully'));
                        }
                    }
                }
            }


            $quickLinkLanguages = QuickLinkLanguage::findAll(['quick_link_id' => $model->primaryKey]);
            foreach ($quickLinkLanguages as $quickLinkLanguage) {
                $formData[$quickLinkLanguage->language_id] = $quickLinkLanguage->value;
            }
            return $this->render('update', array('model' => $model, 'languages' => $languages, 'routers' => $routers, 'groups' => $this->getQuickLinkGroup(), 'formData' => $formData));
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $this->redirect('index');
        }
    }

    public function actionDelete()
    {
        $data = [];
        if (Yii::$app->getRequest()->isAjax) {
            $quickLinkList = Yii::$app->getRequest()->post('id');
            if (!empty($quickLinkList)) {
                foreach ($quickLinkList as $quickLinkId) {
                    $quickLink = QuickLink::findOne($quickLinkId);
                    if ($quickLink) {
                        QuickLinkLanguage::deleteAll(['quick_link_id' => $quickLink->primaryKey]);
                        $quickLink->delete();
                    }
                }
                Yii::$app->session->setFlash('success', Yii::t('app', 'Delete quick link success'));
                $data['success'] = '1';
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Delete quick link error'));
                $data['error'] = 1;
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $data['error'] = 1;
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }


    private function getControllers($path, $ignoreFolder = array('nbproject', 'vendor'), $ignoreController = array('BackendController', 'SiteController'))
    {
        $controllers = glob($path . '/*', GLOB_ONLYDIR);

        if (!empty($controllers)) {
            foreach ($controllers as $controller) {
                if (!in_array(basename($controller), $ignoreFolder)) {
                    if (basename($controller) == 'controllers') {
                        $controllerList = glob($controller . '/*Controller.php');
                        if (!empty($controllerList)) {
                            foreach ($controllerList as $controllerName) {
                                if (!in_array(substr(basename($controllerName), 0, -4), $ignoreController)) {
                                    $controllerContent = file_get_contents($controllerName);
                                    $namespace = substr($controllerContent, strpos($controllerContent, 'namespace'), strpos($controllerContent, ';') - strpos($controllerContent, 'namespace'));
                                    $namespace = explode(' ', $namespace);
                                    $this->controllers[substr(basename($controllerName), 0, -4)] = $namespace[1];
                                }
                            }
                        }
                    } else {
                        $this->getControllers($controller);
                    }
                }
            }
        }
        return $this->controllers;
    }

    private function getRouters($controllers)
    {
        $routers = array();
        if (!empty($controllers)) {
            foreach ($controllers as $controller => $namespace) {
                $prefix = explode('\\', $namespace);
                if ($controller[0] !== '.') {
                    $controller = str_replace('.php', '', $controller);
                    $controllerName = substr($controller, 0, strpos($controller, 'Controller'));
                    $controllerName = $this->createLinkController($controllerName);
                    $routers[$controller] = array();
                    $class = $namespace . '\\' . $controller;
                    $reflectorController = new \ReflectionClass($class);
                    $methods = $reflectorController->getMethods(\ReflectionMethod::IS_PUBLIC);

                    if (!empty($methods)) {
                        foreach ($methods as $method) {
                            if (preg_match('/^action[A-Z]+/', $method->name) && $method->class == $class) {
                                $routers[$prefix[0] . '/' .$controllerName][] = strtolower(substr($method->name, strlen('action')));
                            }
                        }
                    }
                }
            }
        }

        return $routers;
    }

    private function validName($names)
    {
        $valid = true;
        foreach ($names as $name) {
            if ($name == '') {
                $valid = false;
                break;
            }
        }


        if (Yii::$app->request->post('type') == QuickLink::TYPE_URL && Yii::$app->request->post('url') == '') {
            $valid = false;
        }

        return $valid;
    }

    /**
     * @return array
     */
    private function getQuickLinkGroup()
    {
        $quickLinkGroups = QuickLinkGroup::findAll(['status' => 1]);
        $groups = array();
        $language = \app\models\Languages::findOne(['code' => strtolower(Yii::$app->language)]);
        foreach ($quickLinkGroups as $quickLinkGroup) {
            $quickLinkGroupLanguage = QuickLinkGroupLanguage::findOne(['group_link_id' => $quickLinkGroup->id, 'language_id' => $language->id]);
            if ($quickLinkGroupLanguage) {
                $groups[$quickLinkGroup->id] = (string)$quickLinkGroupLanguage->value;
            }
        }
        return $groups;
    }

    private function createLinkController($controllerName)
    {
        $controller = '';
        for ($i = 0; $i < strlen($controllerName); $i++) {

            $controller .= (ctype_upper($controllerName[$i]) && $i > 0) ? '-' . $controllerName[$i] : $controllerName[$i];
        }
        return strtolower($controller);
    }
}