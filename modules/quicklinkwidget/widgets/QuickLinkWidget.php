<?php

namespace app\modules\quicklinkwidget\widgets;

use app\modules\quicklinkwidget\models\QuickLink;
use app\modules\quicklinkwidget\models\QuickLinkGroup;
use app\modules\quicklinkwidget\models\QuickLinkLanguage;
use app\modules\quicklinkwidget\models\QuickLinkGroupLanguage;
use \app\models\Languages;
use yii\base\Widget;
use Yii;

class QuickLinkWidget extends Widget
{
    public $wrapperGroup;
    public $itemTemplateGroup;
    public $wrapper;
    public $itemTemplate;
    public $activeClass;

    public function init()
    {
        parent::init();
        if ($this->wrapperGroup == '') {
            $this->wrapperGroup = '
                <div class="col-xs-12 col-sm-4 col-md-3">
                {groupItem}
                {items}
                </div>
            ';

        }

        if ($this->itemTemplateGroup == '') {
            $this->itemTemplateGroup = '
                <p class="big_text"><strong> <span class="under_footer">{group_name}</span></strong></p>
            ';
        }

        if ($this->wrapper == '') {
            $this->wrapper = '<ul>{item}</ul>';
        }

        if ($this->itemTemplate == '') {
            $this->itemTemplate = '<li>{name}</li>';
        }

        if ($this->activeClass == '') {
            $this->activeClass = 'active';
        }
    }

    public function run()
    {
        $groups = array();
        $quickLinkGroups = QuickLinkGroup::find()->all();
        $language = Languages::findOne(['code' => strtolower(Yii::$app->language)]);

        if (!$language) {
            $language = \app\models\Languages::findOne(['is_default' => 1]);
            if (!$language) {
                $language = \app\models\Languages::findOne(['is_active' => 1]);
            }
        }

        if (!empty($quickLinkGroups) && $language) {
            foreach ($quickLinkGroups as $quickLinkGroup) {
                $quickLinkGroupLanguage = QuickLinkGroupLanguage::findOne([
                    'language_id' => $language->id, 'group_link_id' => $quickLinkGroup->id]);
                if ($quickLinkGroupLanguage) {
                    $quickLinks = QuickLink::findAll(['group_id' => $quickLinkGroup->id]);
                    if (!empty($quickLinks)) {
                        foreach ($quickLinks as $quickLink) {
                            $quickLinkLanguage = QuickLinkLanguage::findOne([
                                'quick_link_id' => $quickLink->id,
                                'language_id' => $language->id
                            ]);

                            if ($quickLinkLanguage) {
                                $groups[$quickLinkGroupLanguage->value][] = array(
                                    'type' => $quickLink->type,
                                    'action' => $quickLink->action,
                                    'url' => $quickLink->url,
                                    'label' => $quickLinkLanguage->value,
                                    'prefix' => $quickLink->prefix,
                                    'is_blank' => $quickLink->is_blank
                                );
                            }
                        }
                    }
                }
            }
        }

        return $this->render('quicklink', [
            'groups' => $groups,
            'itemTemplateGroup' => $this->itemTemplateGroup,
            'wrapperGroup' => $this->wrapperGroup,
            'wrapper' => $this->wrapper,
            'itemTemplate' => $this->itemTemplate,
        ]);
    }
}