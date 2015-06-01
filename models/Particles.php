<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "particles".
 *
 * @property integer $id
 * @property string $type
 * @property string $key
 * @property string $attributes
 * @property string $created
 * @property string $modified
 */
class Particles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'particles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'key'], 'required'],
            [['attributes'], 'string'],
            [['created', 'modified'], 'safe'],
            [['type'], 'string', 'max' => 20],
            [['key'], 'string', 'max' => 255]
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
            'id' => Yii::t('app','Particle ID'),
            'type' => Yii::t('app','Particle Type'),
            'key' => Yii::t('app','Particle Key'),
            'attributes' => Yii::t('app',''),
            'created' => Yii::t('app','Created'),
           'modified' => Yii::t('app','Modified'),
        ];
    }
}
