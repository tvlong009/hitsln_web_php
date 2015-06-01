<?php

namespace app\modules\cmsparticles\models;

use Yii;
/**
 * This is the model class for table "portfolio".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property string $link
 * @property string $created
 * @property string $modified
 *
 * @property PortfolioItems[] $portfolioItems
 */
class Portfolio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'portfolio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'unique'],
            [['description', 'link'], 'string'],
            ['status', 'integer'],
            [['created', 'modified'], 'safe'],
            [['name'], 'string', 'max' => 255]
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
            'id' =>  Yii::t('app','Portfolio ID'),
            'name' =>  Yii::t('app','Name'),     
            'link' =>  Yii::t('app','Link'),     
            'status' =>  Yii::t('app','Status'),     
            'description' =>  Yii::t('app','Description'),
            'created' =>  Yii::t('app','Created'),
            'modified' =>  Yii::t('app','Modified'),
        ];
    }    
}
