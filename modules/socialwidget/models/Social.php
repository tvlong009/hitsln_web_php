<?php

namespace app\modules\socialwidget\models;

use Yii;

class Social extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'social_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'unique'],
            [['link'], 'url'],
            ['order', 'integer'],
            ['css_class', 'string'],
            ['js_action', 'string'],
            [['icon'], 'file', 'extensions' => 'gif, jpg, png, jpeg'],
            ['is_active', 'integer'],
            [['created', 'modified'], 'safe'],
            [['name'], 'string', 'max' => 100]
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
            'id' =>  Yii::t('app','Social ID'),
            'name' =>  Yii::t('app','Name'),
            'link' =>  Yii::t('app','Link'),
            'icon' =>  Yii::t('app','Icon'),
            'is_active' =>  Yii::t('app','Is Active'),
            'css_class' =>  Yii::t('app','Css Class'),
            'order' =>  Yii::t('app','Order'),
            'created' =>  Yii::t('app','Created'),
            'modified' =>  Yii::t('app','Modified'),
        ];
    }
    
    public function beforeSave($insert)
    {                    
        return parent::beforeSave($insert);       
    }
}
