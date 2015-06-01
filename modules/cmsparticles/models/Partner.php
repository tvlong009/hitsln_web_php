<?php

namespace app\modules\cmsparticles\models;

use Yii;

/**
 * This is the model class for table "partner".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $link
 * @property integer $status
 * @property integer $displayorder
 * @property string $created
 * @property string $modified
 */
class Partner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'unique'],
            [['description'], 'string'],
            [['status', 'displayorder'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['name', 'link'], 'string', 'max' => 255]
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
            'id' =>  Yii::t('app','Partner ID'),
            'name' =>  Yii::t('app','Name'),
            'description' =>  Yii::t('app','Description'),
            'link' =>  Yii::t('app','Link'),
            'status' =>  Yii::t('app','Status'),
            'displayorder' =>  Yii::t('app','Display order'),
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
