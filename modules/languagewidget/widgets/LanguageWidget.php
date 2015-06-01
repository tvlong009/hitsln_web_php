<?php

namespace app\modules\languagewidget\widgets;

use app\models\Languages;
use yii\base\Widget;
use Yii;

class LanguageWidget extends Widget
{
    public $templateItem = '';
    public $urlChangeLanguage = '';
    public $flagIconUrl = '';
    public $wrapper = '';
    public $activeClass = '';

    public function init()
    {
        if ($this->wrapper == '') {
            $this->wrapper = '<ul>{item}</ul>';
        }

        if ($this->activeClass == '') {
            $this->activeClass = 'active';
        }

        if ($this->urlChangeLanguage == '') {
            $this->urlChangeLanguage = Yii::$app->urlManager->createAbsoluteUrl('/app/change-lang/');
        }

        if ($this->flagIconUrl == '') {
            $this->flagIconUrl = Yii::$app->urlManager->getBaseUrl() . '/clipone/assets/images/flag/';
        }

        if ($this->templateItem == '') {
            $this->templateItem = '<li {is_active}><a class="todo-actions" href="{url}">
                <span class="desc" style="opacity: 1; text-decoration: none;"><strong>{name}</strong></span>
                <span class="label flag_label" style="opacity: 1;">{image}</span>
                </a></li>';
        }
    }

    public function run()
    {
        $languages = Languages::find()->where(array('is_active' => 1))->all();

        return $this->render('language', array(
            'languages' => $languages,
            'urlChangeLanguage' => $this->urlChangeLanguage,
            'flagIconUrl' => $this->flagIconUrl,
            'template' => $this->templateItem,
            'wrapper' => $this->wrapper,
            'activeClass' => $this->activeClass
        ));
    }
}