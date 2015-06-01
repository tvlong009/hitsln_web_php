<?php

namespace app\modules\useractivity\models;

use Yii;

class Activity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['user_id', 'required'],
            ['module', 'required'],
            [['controller'], 'required'],
            ['action', 'required'],
            ['old_data', 'string'],
            ['new_data', 'string'],
            ['description', 'string'],
            [['created'], 'safe'],
        ];
    }
    
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created'],
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
       
    }
    
    public function beforeSave($insert)
    {                    
        return parent::beforeSave($insert);       
    }
}
