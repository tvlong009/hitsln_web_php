<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "roles".
 *
 * @property integer $id
 * @property string $name
 * @property integer $level
 * @property integer $is_master
 * @property integer $is_default
 *
 * @property User $id0
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'level', 'is_master', 'is_default'], 'required'],
            [['level', 'is_master', 'is_default'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'name' => Yii::t('app','Role Name'),
            'level' => Yii::t('app','Level'),
            'is_master' => Yii::t('app','Is Master'),
            'is_default' => Yii::t('app','Is Default'),

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(User::className(), ['role' => 'id']);
    }


}
