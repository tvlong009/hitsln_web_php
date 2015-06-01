<?php

namespace app\modules\menuwidget\models;

use Yii;

/**
 * This is the model class for table "menu_item".
 *
 * @property integer $menu_id
 * @property integer $id
 * @property string $link
 * @property integer $parent_id
 * @property integer $is_active
 * @property integer $is_blank
 * @property integer $displayorder
 * @property integer $is_ajax
 * @property string $created
 * @property string $modified
 *
 * @property MenuItem $parent
 * @property MenuItem[] $menuItems
 * @property Menu $menu
 * @property MenuItemLanguage[] $menuItemLanguages
 */
class MenuItem extends \yii\db\ActiveRecord
{
  
  /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_id'], 'required'],
            [['menu_id', 'parent_id', 'is_active', 'is_blank', 'displayorder', 'is_ajax'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['link'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menu_id' => Yii::t('app', 'Menu ID'),
            'id' => Yii::t('app', 'ID'),
            'link' => Yii::t('app', 'Link'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_blank' => Yii::t('app', 'Open new tab'),
            'is_ajax' => Yii::t('app', 'Is ajax'),
            'displayorder' => Yii::t('app', 'Displayorder'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(MenuItem::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuItems()
    {
        return $this->hasMany(MenuItem::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menu::className(), ['id' => 'menu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuItemLanguages()
    {
        return $this->hasMany(MenuItemLanguage::className(), ['item_id' => 'id']);
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

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $maxOrder = (int)$this->find()->max('displayorder') + 1;

            $this->displayorder = $maxOrder;
        }

        return parent::beforeSave($insert);
    }
}