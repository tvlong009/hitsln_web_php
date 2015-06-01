<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quick_link_group_language".
 *
 * @property integer $id
 * @property integer $language_id
 * @property integer $group_link_id
 * @property string $value
 * @property string $created
 * @property string $modified
 *
 * @property Languages $language
 * @property QuickLinkGroup $groupLink
 */
class QuickLinkGroupLanguage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quick_link_group_language';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language_id', 'group_link_id', 'value'], 'required'],
            [['language_id', 'group_link_id'], 'integer'],
            [['created', 'modified'], 'safe']
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
            'language_id' => Yii::t('app', 'Language ID'),
            'group_link_id' => Yii::t('app', 'Group Link ID'),
            'value' => Yii::t('app', 'Value'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
        ];
    }
}
