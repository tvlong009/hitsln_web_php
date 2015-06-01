<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "page_content".
 *
 * @property integer $id
 * @property integer $page_id
 * @property string $title
 * @property string $content
 * @property integer $language
 * @property string $header_img
 * @property string $created
 * @property string $modified
 */
class PageContent extends \yii\db\ActiveRecord
{
    public $file;
    public $header_image;
    
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
            [['page_id', 'title'], 'required'],
            [['page_id', 'language'], 'integer'],
            [['content'], 'string'],
            [['created', 'modified', 'file'], 'safe'],
            [['title', 'header_img'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => 'php', 'checkExtensionByMimeType' => false],
            [['header_image'], 'file', 'extensions' => 'gif, jpg, png, jpeg'],
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
            'id' => Yii::t('app','Content ID'),
            'page_id' => Yii::t('app','Page ID'),
            'title' => Yii::t('app','Page Title'),
            'content' => Yii::t('app','Page Content'),
            'language' => Yii::t('app','Page Language'),
            'header_img' => Yii::t('app','Page Header Img'),
            'created' => Yii::t('app','Created'),
            'modified' => Yii::t('app','Modified'),
        ];
    }
}
