<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_property_group".
 *
 * @property integer $group_id
 * @property string $group_name
 * @property integer $displayorder
 * @property string $created
 * @property string $modified
 */
class UserPropertyGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_property_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_name'], 'required'],
        	['group_name', 'unique'],
            [['displayorder'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['group_name'], 'string', 'max' => 255]
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
            'group_id' => Yii::t('app', 'Group ID'),
            'group_name' => Yii::t('app', 'Group Name'),
            'displayorder' => Yii::t('app', 'Display order'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
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
