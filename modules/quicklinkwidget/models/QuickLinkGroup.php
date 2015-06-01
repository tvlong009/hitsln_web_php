<?php

namespace app\modules\quicklinkwidget\models;

use Yii;

/**
 * This is the model class for table "quick_link_group".
 *
 * @property integer $id
 * @property integer $displayorder
 * @property integer $status
 * @property string $created
 * @property string $modified
 */
class QuickLinkGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quick_link_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['displayorder', 'status'], 'integer'],
            [['created', 'modified'], 'safe'],
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
            'displayorder' => Yii::t('app', 'Display order'),
            'status' => Yii::t('app', 'Status'),
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
}
