<?php

namespace app\modules\quicklinkwidget\models;

use Yii;

/**
 * This is the model class for table "quick_link".
 *
 * @property integer $id
 * @property integer $group_id
 * @property integer $type
 * @property string $url
 * @property string $action
 * @property integer $is_blank
 * @property string $prefix
 * @property integer $displayorder
 * @property integer $status
 * @property string $created
 * @property string $modified
 */
class QuickLink extends \yii\db\ActiveRecord
{
    const TYPE_ACTION = 1;
    const TYPE_URL = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quick_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['group_id', 'type', 'displayorder', 'status'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['url', 'action'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_id' => Yii::t('app', 'Group ID'),
            'type' => Yii::t('app', 'Type'),
            'url' => Yii::t('app', 'Url'),
            'action' => Yii::t('app', 'Action'),
            'is_blank' => Yii::t('app', 'Open new tab'),
            'prefix' => Yii::t('app', 'Prefix'),
            'displayorder' => Yii::t('app', 'Displayorder'),
            'status' => Yii::t('app', 'Status'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
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

    public function getTypeList()
    {
        $output = array();

        $output[self::TYPE_ACTION] = Yii::t('app', 'Action');
        $output[self::TYPE_URL] = Yii::t('app', 'Url');

        return $output;
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