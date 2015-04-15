<?php

namespace app\modules\loginwidget\models;

use Yii;

/**
 * This is the model class for table "login_widget_setting".
 *
 * @property integer $id
 * @property string $key_name
 * @property string $value
 * @property integer $displayorder
 * @property string $created
 * @property string $modified
 */
class LoginSetting extends \yii\db\ActiveRecord
{
    public $logo;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'login_widget_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key_name', 'value', 'displayorder', 'created', 'modified'], 'required'],
            [['value'], 'string'],
            [['displayorder'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['key_name'], 'string', 'max' => 255],
            [['logo'], 'file', 'extensions' => 'gif, jpg, png, jpeg'],
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
            'id' => Yii::t('app', 'ID'),
            'key_name' => Yii::t('app', 'Key Name'),
            'value' => Yii::t('app', 'Value'),
            'displayorder' => Yii::t('app', 'Displayorder'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
        ];
    }
}