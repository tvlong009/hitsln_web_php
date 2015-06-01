<?php
/**
 * Created by PhpStorm.
 * User: longvo
 * Date: 24/04/2015
 * Time: 13:24
 */

namespace app\modules\userpropertywidget\widgets;


use yii\base\Widget;
use app\modules\userpropertywidget\models\UserPropertyValue;
use app\modules\userpropertywidget\models\UserProperty;

class UserPropertyWidget extends Widget
{
    public $model = null;
    public $user = null;
    private $value = null;

    public function init()
    {
        parent::init();

        $this->model = $this->model != null ? $this->model : new UserProperty();

        if ($this->user->id > 0) {
            $propertyValue = UserPropertyValue::findAll(['user_id' => $this->user->id, 'property_id' => $this->model->property_id]);
            if (!in_array($this->model->type, array(UserProperty::TYPE_SELECT, UserProperty::TYPE_SELECT_MULTIPLE, UserProperty::TYPE_CHECKBOX, UserProperty::TYPE_RADIO)) && $propertyValue) {
                $this->value = $propertyValue[0]->value;
            } else {
                foreach ($propertyValue as $item) {
                    $this->value[] = $item->value;
                }
            }
        }
    }

    public function run()
    {
        return $this->render('userproperty', array(
            'model' => $this->model,
            'value' => $this->value,
        ));
    }
}