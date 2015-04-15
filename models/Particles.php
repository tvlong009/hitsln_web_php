<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "particles".
 *
 * @property integer $particle_id
 * @property string $particle_type
 * @property string $particle_key
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
            [['particle_type', 'particle_key', 'attributes'], 'required'],
            [['attributes'], 'string'],
            [['created', 'modified'], 'safe'],
            [['particle_type'], 'string', 'max' => 20],
            [['particle_key'], 'string', 'max' => 255]
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
            'particle_id' => Yii::t('app','Particle ID'),
            'particle_type' => Yii::t('app','Particle Type'),
            'particle_key' => Yii::t('app','Particle Key'),
            'attributes' => Yii::t('app',''),
            'created' => Yii::t('app','Created'),
           'modified' => Yii::t('app','Modified'),
        ];
    }
}
