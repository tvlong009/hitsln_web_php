<?php

namespace app\modules\signupwidget\models;

use Yii;

/**
 * This is the model class for table "signup_widget_setting".
 *
 * @property integer $id
 * @property string $key_name
 * @property string $value
 * @property integer $displayorder
 * @property string $created
 * @property string $modified
 */
class SignupSetting extends \yii\db\ActiveRecord
{
    public $logo;

    const TYPE_STRING = 1;
    const TYPE_SELECT = 3;
    const TYPE_SELECT_MULTIPLE = 5;
    const TYPE_CHECKBOX = 7;
    const TYPE_RADIO = 9;
    const TYPE_EMAIL= 11;
    const TYPE_URL = 13;
    const TYPE_PHONE = 15;
    const TYPE_PASSWORD = 17;
    const TYPE_DATETIME = 19;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'signup_widget_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key_name'], 'required'],
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

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $maxOrder = (int)$this->find()->max('displayorder') + 1;

            $this->displayorder = $maxOrder;
        }

        return parent::beforeSave($insert);
    }

    public static function getTypeList()
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
}