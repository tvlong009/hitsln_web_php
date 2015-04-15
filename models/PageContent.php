<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "page_content".
 *
 * @property integer $content_id
 * @property integer $page_id
 * @property string $page_title
 * @property string $page_content
 * @property integer $page_language
 * @property string $page_header_img
 * @property string $created
 * @property string $modified
 *
 * @property Languages $pageLanguage
 * @property Pages $content
 */
class PageContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'page_title', 'page_content'], 'required'],
            [['page_id', 'page_language'], 'integer'],
            [['page_content'], 'string'],
            [['created', 'modified'], 'safe'],
            [['page_title', 'page_header_img'], 'string', 'max' => 255]
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
            'content_id' => Yii::t('app','Content ID'),
            'page_id' => Yii::t('app','Page ID'),
            'page_title' => Yii::t('app','Page Title'),
            'page_content' => Yii::t('app','Page Content'),
            'page_language' => Yii::t('app','Page Language'),
            'page_header_img' => Yii::t('app','Page Header Img'),
            'created' => Yii::t('app','Created'),
            'modified' => Yii::t('app','Modified'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageLanguage()
    {
        return $this->hasOne(Languages::className(), ['language_id' => 'page_language']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContent()
    {
        return $this->hasOne(Pages::className(), ['page_id' => 'content_id']);
    }
}
