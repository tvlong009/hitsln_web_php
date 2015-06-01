<?php

namespace app\models;

use app\components\ContentListsWidget;
use app\modules\cmsparticles\widgets\ContactFormWidgets;
use app\modules\cmsparticles\widgets\PartnerWidget;
use app\modules\cmsparticles\widgets\PortfolioWidget;
use app\modules\newsletterwidget\widgets\NewsletterWidget;
use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $key
 * @property string $status
 * @property string $publish_date
 * @property integer $sort_order
 * @property integer $parent_id
 * @property integer $user_id
 * @property string $created
 * @property string $modified
 *
 * @property PageContent $pageContent
 * @property Page $parent
 * @property Page[] $pages
 */
class Page extends \yii\db\ActiveRecord
{
    public $content;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            ['parent_id', 'default', 'value' => 0 ],
            [['status'], 'string'],
            [['publish_date', 'created', 'modified'], 'safe'],
            [['sort_order', 'parent_id', 'user_id'], 'integer'],
            [['key'], 'string', 'max' => 50]
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'modified'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['modified'],
                ],
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','Page ID'),
            'key' => Yii::t('app','Name'),
            'status' => Yii::t('app','Status'),
            'publish_date' => Yii::t('app',''),
            'sort_order' => Yii::t('app','Sort Order'),
            'parent_id' => Yii::t('app','Parent ID'),
            'version' => Yii::t('app', 'Version'),
            'created' => Yii::t('app','Created'),
            'modified' => Yii::t('app','Modified'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageContent()
    {
        return $this->hasOne(PageContent::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Page::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['parent_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if ($this->parent_id == 0) {
            $this->parent_id = null;
        }

        return parent::beforeSave($insert);
    }

    public static function getPageContentData($id = 0, $languageId = 0)
    {
        $result= null;
        if ($languageId == 0) {
            $language = Languages::findOne(['code' => \Yii::$app->session->get('frontend_language')]);
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
        } else {
            $language = Languages::findOne($languageId);
        }

        if ($id > 0 && $language) {
            $pageContent = PageContent::findOne(['page_id' => $id, 'language' => $language->id]);

            if ($pageContent) {
                $content = $pageContent->content;

                if (preg_match_all('/.php/', $content, $matches)) {
                    $uploadDir = dirname(self::get_server_var('SCRIPT_FILENAME')) . '/uploads/pages/';
                    $file = $uploadDir . $content;
                    $content = $file;
                } else {
                    preg_match_all('/{{[a-z0-9 -_]+}}/', $content, $matches);
                    if (!empty($matches)) {
                        foreach ($matches as $items) {
                            if (!empty($items)) {
                                foreach ($items as $item) {
                                    $particle_key = strip_tags(trim(str_replace(['{{', '}}'], '', $item)));
                                    if ($particle_key == 'header_img') {
                                        $content = str_replace($item, Html::img('@web/uploads/pages/header_img' . $pageContent->header_img), $content);
                                    } else {
                                        $particle = Particles::findOne(['key' => $particle_key]);
                                        if ($particle) {
                                            $content = str_replace($item, self::getParticleWidget($particle->type), $content);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if ($content != '') {
                    $result = $content;
                }
            }
        }
        return $result;
    }

    public static function getParticleWidget($type)
    {
        $particleContent = '';
        switch ($type) {
            case 'Portfolio':
                $particleContent =  PortfolioWidget::widget();
                break;
            case 'Partners':
                $particleContent = PartnerWidget::widget();
                break;
            case 'Contact Form':
                $particleContent = ContactFormWidgets::widget();
                break;
            case 'Content List':
                $particleContent = ContentListsWidget::widget();
                break;
            case 'Newsletter':
                $particleContent = NewsletterWidget::widget();
                break;
        }


        return $particleContent;
    }

    private function get_server_var($id)
    {
        return @$_SERVER[$id];
    }
}
