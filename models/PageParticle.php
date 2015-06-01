<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "page_particle".
 *
 * @property integer $id
 * @property integer $id
 * @property integer $particle_id
 * @property integer $order
 * @property integer $creator
 * @property string $date_created
 */
class PageParticle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page_particle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'particle_id', 'order', 'creator'], 'required'],
            [['id', 'particle_id', 'order', 'creator'], 'integer'],
            [['date_created'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'id' => Yii::t('app','Page ID'),
            'particle_id' => Yii::t('app','Particle ID'),
            'order' => Yii::t('app','Order'),
            'creator' => Yii::t('app','Creator'),
            'date_created' => Yii::t('app','Date Created'),
        ];
    }
}
