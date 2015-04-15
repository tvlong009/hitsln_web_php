<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $page_id
 * @property string $page_key
 * @property string $status
 * @property string $publish_date
 * @property integer $sort_order
 * @property integer $parent_id
 * @property string $created
 * @property string $modified
 *
 * @property PageContent $pageContent
 * @property Page $parent
 * @property Page[] $pages
 */
class Page extends \yii\db\ActiveRecord
{
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
            [['page_key'], 'required'],
            ['parent_id', 'default', 'value' => 0 ],
            [['status'], 'string'],
            [['publish_date', 'created', 'modified'], 'safe'],
            [['sort_order', 'parent_id'], 'integer'],
            [['page_key'], 'string', 'max' => 50]
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
            'page_id' => Yii::t('app','Page ID'),
            'page_key' => Yii::t('app','Name'),
            'status' => Yii::t('app','Status'),
            'publish_date' => Yii::t('app',''),
            'sort_order' => Yii::t('app','Sort Order'),
            'parent_id' => Yii::t('app','Parent ID'),
            'created' => Yii::t('app','Created'),
            'modified' => Yii::t('app','Modified'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageContent()
    {
        return $this->hasOne(PageContent::className(), ['content_id' => 'page_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Page::className(), ['page_id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['parent_id' => 'page_id']);
    }
    
    public function beforeSave($insert)
    {                    
        if ($this->parent_id == 0) {
            $this->parent_id = null;
        }    
        
        return parent::beforeSave($insert);       
    }
}
