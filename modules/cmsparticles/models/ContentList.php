<?php

namespace app\modules\cmsparticles\models;

use Yii;

/**
 * This is the model class for table "content_list".
 *
 * @property integer $id
 * @property string $title
 * @property string $short_description
 * @property integer $displayorder
 * @property integer $status
 * @property string $created
 * @property string $modified
 */
class ContentList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'short_description'], 'required'],
            ['title', 'unique'],
            [['short_description'], 'string'],
            [['displayorder', 'status'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['title'], 'string', 'max' => 255]
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
            'id' =>  Yii::t('app','Contentlist ID'),
            'title' =>  Yii::t('app','Title'),
            'short_description' =>  Yii::t('app','Short Description'),
            'displayorder' =>  Yii::t('app','Display order'),
            'status' =>  Yii::t('app','Status'),
            'created' =>  Yii::t('app','Created'),
            'modified' =>  Yii::t('app','Modified'),
        ];
    }
    
    public function beforeSave($insert)
    {                    
        if ($this->isNewRecord) {
            $maxOrder = (int)$this->find()->max('displayorder') + 1;
            
            $this->displayorder = $maxOrder;
        }      
        
        return parent::beforeSave($insert);       
    }
}
