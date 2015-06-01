<?php

namespace app\modules\userpropertywidget\models;

use Yii;

/**
 * This is the model class for table "user_property".
 *
 * @property integer $group_id
 * @property integer $property_id
 * @property string $property_name
 * @property integer $type
 * @property string $value
 * @property integer $displayorder
 * @property integer $status
 * @property string $created
 * @property string $modified
 */
class UserProperty extends \yii\db\ActiveRecord
{
	const TYPE_STRING = 1;
	const TYPE_SELECT = 3;
	const TYPE_SELECT_MULTIPLE = 5;
	const TYPE_CHECKBOX = 7;
    const TYPE_RADIO = 9;
    const TYPE_EMAIL= 11;
    const TYPE_URL = 13;
    const TYPE_PHONE = 15;
    const TYPE_PASSWORD = 17;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_property';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['property_name'], 'required'],
        	['property_name', 'unique'],
            [['group_id', 'type', 'displayorder', 'status'], 'integer'],
            [['value'], 'string'],        	
            [['created', 'modified'], 'safe'],
            [['property_name'], 'string', 'max' => 255]
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
            'group_id' => Yii::t('app', 'Group'),
            'property_id' => Yii::t('app', 'Property ID'),
            'property_name' => Yii::t('app', 'Property Name'),
            'type' => Yii::t('app', 'Type'),
            'value' => Yii::t('app', 'Value'),
            'displayorder' => Yii::t('app', 'Displayorder'),
            'status' => Yii::t('app', 'Status'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
        ];
    }
    
    public function getTypeList()
    {
    	return array(
            static::TYPE_STRING => Yii::t('app', 'String'),
            static::TYPE_SELECT => Yii::t('app', 'Selectbox'),
            static::TYPE_SELECT_MULTIPLE => Yii::t('app', 'Selectbox multiple'),
            static::TYPE_CHECKBOX => Yii::t('app', 'Checkbox'),
            static::TYPE_RADIO => Yii::t('app', 'Radio'),
            static::TYPE_EMAIL => Yii::t('app', 'Email'),
            static::TYPE_URL => Yii::t('app', 'Url'),
            static::TYPE_PHONE => Yii::t('app', 'Phone'),
            static::TYPE_PASSWORD => Yii::t('app', 'Password'),
                
    	);
    }
    
    public function getTypeName()
    {
    	$type = '';
    	 
    	switch ($this->type) {
    		case static::TYPE_STRING:
    			$type = Yii::t('app', 'String');
    			break;
    		case static::TYPE_SELECT:
    			$type = Yii::t('app', 'Selectbox');
    			break;
    		case static::TYPE_SELECT_MULTIPLE:
    			$type = Yii::t('app', 'Selectbox multiple');
    			break;
    		case static::TYPE_CHECKBOX:
    			$type = Yii::t('app', 'Checkbox');
    			break;
            case static::TYPE_RADIO:
    			$type = Yii::t('app', 'Radio');
    			break;
            case static::TYPE_EMAIL:
    			$type = Yii::t('app', 'Email');
    			break;
            case static::TYPE_URL:
    			$type = Yii::t('app', 'Url');
    			break;
            case static::TYPE_PHONE:
    			$type = Yii::t('app', 'Phone');
    			break;
            case static::TYPE_PASSWORD:
    			$type = Yii::t('app', 'Password');
    			break;
    	}
    	 
    	return $type;
    }
    
    public function beforeSave($insert)
    {
    	$excludeType = array (
    		static::TYPE_STRING,
            static::TYPE_EMAIL,
            static::TYPE_URL,
            static::TYPE_PHONE,
            static::TYPE_PASSWORD,
    	);
    
    	if (! in_array ( $this->type, $excludeType ) && $this->value == '') {
    		$this->addError ( 'value', Yii::t ( 'app', 'Value cannot be blank' ) );
    		return false;
    	}             
    	 
    	if ($this->isNewRecord) {
    		$maxOrder = (int)$this->find()->max('displayorder') + 1;
    
    		$this->displayorder = $maxOrder;
    	}
    
    	return parent::beforeSave($insert);
    }
}
