<?php

namespace app\modules\cmsparticles\models;

use Yii;

/**
 * This is the model class for table "partner".
 *
 * @property integer $partner_id
 * @property string $partner_name
 * @property string $partner_description
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
            ['partner_name', 'required'],
            ['partner_name', 'unique'],
            [['partner_description'], 'string'],
            [['status', 'displayorder'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['partner_name', 'link'], 'string', 'max' => 255]
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
            'partner_id' =>  Yii::t('app','Partner ID'),
            'partner_name' =>  Yii::t('app','Name'),
            'partner_description' =>  Yii::t('app','Description'),
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
