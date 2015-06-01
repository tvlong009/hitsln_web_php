<?php

namespace app\modules\quicklinkwidget\controllers;

use app\controllers\BackendController;
use app\models\Languages;
use app\modules\quicklinkwidget\models\QuickLinkGroup;
use app\modules\quicklinkwidget\models\QuickLinkGroupLanguage;
use yii\data\ActiveDataProvider;
use Yii;

class QuickLinkGroupController extends BackendController
{
    public function __construct($id, $module) {
        parent::__construct($id, $module);
        $countLanguage = Languages::find()->count();

        if ($countLanguage == 0) {
            Yii::$app->session->setFlash('warning', 'Please create language before create quick link group');
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
            'query' => QuickLinkGroup::find()->orderBy([$sortBy => $sortType]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new QuickLinkGroup();

        $languages = Languages::find()->all();

        if (Yii::$app->request->post()) {
            $names = Yii::$app->request->post('name');
            if (!empty($names)) {
                if ($this->validName($names)) {
                    $quickLinkGroup = new QuickLinkGroup();
                    $quickLinkGroup->status = Yii::$app->request->post('status');

                    $quickLinkGroup->save();
                    foreach ($names as $languageId => $name) {
                        $quickLinkGroupLanguage = new QuickLinkGroupLanguage();
                        $quickLinkGroupLanguage->group_link_id = $quickLinkGroup->primaryKey;
                        $language = Languages::findOne($languageId);
                        $quickLinkGroupLanguage->language_id = $language->id;
                        $quickLinkGroupLanguage->value = (string)$name;

                        $quickLinkGroupLanguage->save();
                    }

                    Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Create quick link group successfully'));
                    return $this->redirect('index');
                } else {
                    Yii::$app->session->setFlash('error_name', Yii::t('app', 'Please fill full name of group.'));
                }
            }
        }

        return $this->render('create', array('model' => $model, 'languages' => $languages));
    }

    public function actionUpdate($id)
    {
        $formData = array();
        $model = QuickLinkGroup::findOne($id);
        $languages = Languages::find()->all();

        if (Yii::$app->request->post()) {
            $names = Yii::$app->request->post('name');
            if (!empty($names)) {
                if ($this->validName($names)) {
                    $model->displayorder = Yii::$app->request->post('displayorder');
                    $model->status = Yii::$app->request->post('status');

                    if ($model->save()) {
                        foreach ($names as $languageId => $name) {
                            $language = Languages::findOne($languageId);
                            $quickLinkGroupLanguage = QuickLinkGroupLanguage::findOne([
                                'language_id' => $language->id,
                                'group_link_id' => $model->primaryKey
                            ]);

                            if ($quickLinkGroupLanguage) {
                                $quickLinkGroupLanguage->value = (string)$name;
                                $quickLinkGroupLanguage->save();
                            } else {
                                $quickLinkGroupLanguage = new QuickLinkGroupLanguage();
                                $quickLinkGroupLanguage->group_link_id = $model->primaryKey;
                                $language = Languages::findOne($languageId);
                                $quickLinkGroupLanguage->language_id = $language->id;
                                $quickLinkGroupLanguage->value = (string)$name;

                                $quickLinkGroupLanguage->save();
                            }
                        }
                    }
                    Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Update quick link group successfully'));
                } else {
                    Yii::$app->session->setFlash('error_name', Yii::t('app', 'Please fill full name of group.'));
                }
            }
        }

        $quickLinkGroupLanguages = QuickLinkGroupLanguage::findAll(['group_link_id' => $model->primaryKey]);
        foreach ($quickLinkGroupLanguages as $quickLinkGroupLanguage) {
            $formData[$quickLinkGroupLanguage->language_id] = $quickLinkGroupLanguage->value;
        }
        return $this->render('update', array(
            'model' => $model,
            'languages' => $languages,
            'formData' => $formData,
        ));
    }

    public function actionDelete()
    {
        $data = [];
        if (Yii::$app->getRequest()->isAjax) {
            $quickLinkGroupList = Yii::$app->getRequest()->post('id');
            if (!empty($quickLinkGroupList)) {
                foreach ($quickLinkGroupList as $quickLinkGroupId) {
                    $quickLinkGroup = QuickLinkGroup::findOne($quickLinkGroupId);
                    if ($quickLinkGroup) {
                        QuickLinkGroupLanguage::deleteAll(['group_link_id' => $quickLinkGroup->primaryKey]);
                        $quickLinkGroup->delete();
                    }
                }
                Yii::$app->session->setFlash('success', Yii::t('app', 'Delete quick link group success'));
                $data['success'] = '1';
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Delete quick link group error'));
                $data['error'] = 1;
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $data['error'] = 1;
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
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

        return $valid;
    }
}
