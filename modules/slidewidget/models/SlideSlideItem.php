<?php

namespace app\modules\slidewidget\models;

use Yii;

/**
 * This is the model class for table "slide_slide_item".
 *
 * @property integer $id
 * @property integer $slide_id
 * @property integer $item_id
 *
 * @property ItemsOfSlide $item
 * @property SlideWidget $slide
 */
class SlideSlideItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slide_slide_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slide_id', 'item_id'], 'required'],
            [['slide_id', 'item_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'slide_id' => Yii::t('app', 'Slide ID'),
            'item_id' => Yii::t('app', 'Item ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(SlideItem::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlide()
    {
        return $this->hasOne(SlideSlideshow::className(), ['id' => 'slide_id']);
    }
}
