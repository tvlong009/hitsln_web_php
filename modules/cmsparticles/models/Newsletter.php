<?php

namespace app\modules\cmsparticles\models;

use Yii;
/**
 * This is the model class for table "newsletter".
 *
 * @property integer $newsletter_id
 * @property string $newsletter_email
 * @property string $created
 * @property string $modified
 */
class Newsletter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'newsletter';
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
    public function rules()
    {
        return [
            [['newsletter_email'], 'required'],
            ['newsletter_email', 'unique'],
            ['newsletter_email', 'email'],
            [['created', 'modified'], 'safe'],
            [['newsletter_email'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'newsletter_id' =>  Yii::t('app','Newsletter ID'),
            'newsletter_email' =>  Yii::t('app','Email'),
            'created' =>  Yii::t('app','Created'),
            'modified' =>  Yii::t('app','Modified'),
        ];
    }
}
