<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "languages".
 *
 * @property integer $language_id
 * @property string $name
 * @property string $code
 * @property string $description
 * @property integer $is_active
 * @property integer $is_default
 * @property PageContent[] $pageContents
 */
class Languages extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            ['name', 'unique'],
            ['code', 'unique'],
            [['description', 'name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 2],
            [['is_active', 'is_default'], 'integer'],
                //[['is_active','is_default'], 'tinyint', 'default'=>1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'language_id' => Yii::t('app', 'Language ID'),
            'name' => Yii::t('app', 'Name'),
            'language_id' => Yii::t('app', 'Code'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageContents()
    {
        return $this->hasMany(PageContent::className(), ['page_language' => 'language_id']);
    }

}
