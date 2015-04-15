<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_property_value".
 *
 * @property integer $property_value_id
 * @property integer $property_id
 * @property integer $user_id
 * @property string $value
 * @property string $created
 * @property string $modified
 */
class UserPropertyValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_property_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['property_id', 'user_id'], 'required'],
            [['property_id', 'user_id'], 'integer'],
            [['value'], 'string'],
            [['created', 'modified'], 'safe']
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
            'property_value_id' => Yii::t('app', 'Property Value ID'),
            'property_id' => Yii::t('app', 'Property ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'value' => Yii::t('app', 'Value'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
        ];
    }
}
