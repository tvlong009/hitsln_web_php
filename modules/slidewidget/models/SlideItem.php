<?php

namespace app\modules\slidewidget\models;

use Yii;
use yii\base\InvalidConfigException;
/**
 * This is the model class for table "slide_item".
 *
 * @property integer $id
 * @property string $image
 * @property string $link
 * @property string $title
 * @property string $description
 * @property integer $is_active
 *
 * @property SlideItemWidget[] $slideItemWidgets
 * @property SlideWidget[] $slides
 */
class SlideItem extends \yii\db\ActiveRecord
{
    public $file;
    
    public $upload_dir;
    /*
     * @overwrite constructor to initiate $upload_dir
     */
    public function __construct($config = array()){
        $this->upload_dir = Yii::getAlias('@app') . "/web/uploads/slidewidget";
        parent::__construct($config);
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slide_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'is_active','open_new_window'], 'required'],
            [['title', 'description'], 'string'],
            [['is_active'], 'integer'],
            [['image', 'link'], 'string', 'max' => 255, ],
            [['link'], 'url'],
            [['image'], 'match', 'pattern' => '(^[a-zA-Z0-9_-]{1,}$)', 'message' => 'Image name must not containt special characters'],
            [['file'], 'image', "skipOnEmpty" => true, 'extensions' => 'jpg, png']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image' => Yii::t('app', 'Image'),
            'link' => Yii::t('app', 'Link'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'is_active' => Yii::t('app', 'Is Active'),
            'open_new_window' => Yii::t('app', 'Open In New Window')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlideSlideItems()
    {
        return $this->hasMany(SlideSlideItem::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlides()
    {
        return $this->hasMany(SlideSlideShow::className(), ['id' => 'slide_id'])->viaTable('slide_slide_item', ['item_id' => 'id']);
    }
    
    public function checkUploadDir(){
        if(is_writable($this->upload_dir)){
            return true;
        } else {
            return false;
        }
    }
    
    public function createUploadDir(){
        if(!is_dir($this->upload_dir)){
            @mkdir($this->upload_dir, 0777);
        } elseif(!is_writable($this->upload_dir)) {
            throw new InvalidConfigException('Upload directory for slidewidget is not writable');
        }
    }
}
