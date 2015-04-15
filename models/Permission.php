<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "permission".
 *
 * @property integer $id
 * @property string $action
 * @property integer $object_id
 * @property string $object_class
 *
 * @property User $user
 */
class Permission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action', 'object_id', 'object_class'], 'required'],
            [['object_id'], 'integer'],
            [['object_class'], 'string', 'max' => 100],
            [['action'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'action' => Yii::t('app','Action'),
            'object_id' => Yii::t('app','Object ID'),
             'object_class' => Yii::t('app','Object class'),
        ];
    }   
}
