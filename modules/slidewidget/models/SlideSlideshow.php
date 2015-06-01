<?php

namespace app\modules\slidewidget\models;

use Yii;

/**
 * This is the model class for table "slide_widget".
 *
 * @property integer $id
 * @property string $name
 * @property integer $effect
 * @property integer $is_active
 *
 * @property SlideItemWidget[] $slideItemWidgets
 * @property ItemsOfSlide[] $items
 */
class SlideSlideshow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slide_slideshow';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'effect', 'is_active'], 'required'],
            [['name','effect'], 'string','max' => 255],
            [['is_active'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'effect' => Yii::t('app', 'Effect'),
            'is_active' => Yii::t('app', 'Is Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlideSlideItems()
    {
        return $this->hasMany(SlideSlideItem::className(), ['slide_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(SlideItem::className(), ['id' => 'item_id'])->viaTable('SlideSlideItem', ['slide_id' => 'id']);
    }
}
