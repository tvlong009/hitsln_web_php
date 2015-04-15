<?php

namespace app\controllers;

use Yii;
use yii\i18n\MessageSource;
use app\models\Languages;
use app\models\Message;
use app\models\SourceMessage;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\BackendController;

/**
 * LanguagesController implements the CRUD actions for Languages model.
 */
class LanguagesController extends BackendController {

    public function init() {
        parent::init();
    }

    /**
     * Lists all Languages models.
     * @return mixed
     */
    public function actionIndex() {
        //get all pages
        $sortBy = Yii::$app->getRequest()->get('sort') != '' ? Yii::$app->getRequest()->get('sort') : 'language_id';

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
            'query' => Languages::find()->orderBy([$sortBy => $sortType]),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Languages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Languages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Languages();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->is_default == 1 && $model->is_active == 1) {
                Languages::updateAll(['is_default' => '0']);
            }
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Create language successfully'));
                return $this->redirect('index');
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Languages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->is_active == 0) {
                Languages::updateAll(['is_default' => '0']);
                $model->is_default = 0;
            } else {
                if ($model->is_default == 1) {
                    Languages::updateAll(['is_default' => '0']);
                }
            }

            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Update language successfully'));
            }
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Languages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete() {
        $data = [];
        if (Yii::$app->getRequest()->isAjax) {
            $languageList = Yii::$app->getRequest()->post('id');
            if (!empty($languageList)) {
                foreach ($languageList as $languageId) {
                    $language = Languages::findOne($languageId);
                    if ($language) {
                        $language->delete();
                    }
                }
                Yii::$app->session->setFlash('success', Yii::t('app', 'Delete language success'));
                $data['success'] = '1';
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Delete language error'));
                $data['error'] = 1;
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Request not valid'));
            $data['error'] = 1;
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    /**
     * Finds the Languages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Languages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Languages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    public function actionDeletecheckbox() {
        if (Yii::$app->request->isAjax) {
            $checkboxes = Yii::$app->request->post('selection');
            if (!empty($checkboxes)) {
                if (is_array($checkboxes)) {
                    foreach ($checkboxes as $id) {
                        $this->findModel($id)->delete();
                    }
                } else {
                    $this->findModel($checkboxes)->delete();
                }
            }
            echo json_encode(array('message' => Yii::t('app', 'Delete success'), 'status' => 200));
        } else {
            return $this->redirect(['index']);
        }
    }

    public function actionLanguagesetting() {

        $model = new Languages();
        $language_array = Languages::find()->all();
        if (empty($language_array)) {
            Yii::$app->session->setFlash('error', 'Please define language');
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
        $source_messages = SourceMessage::find()->all();
        if (empty($source_messages)) {
            Yii::$app->session->setFlash('error', 'Please define message in db');
            return $this->render('languagesetting', [
                        'model' => $model,
            ]);
        }
        return $this->render('languagesetting', array(
                    'model' => $model,
                    'language_array' => $language_array
        ));
    }

    public function actionSavelangmessages() {
        $data = [];
        if (Yii::$app->request->isAjax) {
            $messages = Yii::$app->request->post('messages');
            $messages_id = Yii::$app->request->post('messages_id');
            $langcode = Yii::$app->request->post('langcode');
            if (!empty($messages) && !empty($messages_id)) {
                $flag = TRUE;
                foreach ($messages_id as $i => $msg) {
                    if (!empty($messages[$i])) {
                        $model_message = new Message();
                        $model_message = Message::findOne(['id' => $msg, 'language' => $langcode]);
                        if (empty($model_message)) {
                            $model_message = new Message();
                            $model_message->id = $msg;
                            $model_message->language = $langcode;
                        } else if ($model_message->translation == $messages[$i]) {
                            continue;
                        }
                        $model_message->translation = $messages[$i];
                        if (!$model_message->save()) {
                            $flag = FALSE;
                        }
                    }
                }
                if ($flag) {
                    $data['success'] = 1;
                    $data['notification'] = 'Messages save successfully';
                } else {
                    $data['error'] = 0;
                    $data['notification'] = 'Has some messages cannot save';
                }
            } else {
                $data['error'] = 0;
                $data['notification'] = 'No data saved';
            }
        } else {
            $data['error'] = 0;
            $data['notification'] = 'Load data falsed';
        }
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    public function actionDisplaylanguage() {
        $lang = Yii::$app->request->post('langcode');
        $messages = array();
        $source_messages = SourceMessage::find()->all();
        if (empty($source_messages)) {
            Yii::$app->session->setFlash('error', 'Please define source message');
            return $this->render('languagesetting');
        }
        foreach ($source_messages as $src_msg) {
            if (!empty($src_msg->message))
                $messages[$src_msg->id] = Message::findOne(array('language' => $lang, 'id' => $src_msg->id));
        }
        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('_message_list', array(
                        'messages' => $messages,
                        'lang' => $lang,
                        'source_messages' => $source_messages));
        } else {
            return $this->render('_message_list', array(
                        'messages' => $messages,
                        'lang' => $lang,
                        'source_messages' => $source_messages));
        }
    }

}
