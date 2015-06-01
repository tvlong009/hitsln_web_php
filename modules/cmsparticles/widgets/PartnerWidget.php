<?php
namespace app\modules\cmsparticles\widgets;

use yii\base\Widget;
use \app\controllers\MediaController;

class PartnerWidget extends Widget
{
    public $wrapper;
    public $itemTemplate;

    public function init()
    {
        if ($this->wrapper == '') {
            $this->wrapper = '<ul>{item}</ul>';
        }

        if ($this->itemTemplate == '') {
            $this->itemTemplate = '<li><img src="{imageUrl}" />{name}</li>';
        }

        parent::init();
    }

    public function run()
    {
        $model = \app\modules\cmsparticles\models\Partner::findAll(['status' => 1]);

        $imagePath = str_replace('/index.php', '', MediaController::get_full_url());
        $imagePath .= '/files/partner/';

        $uploadDir = dirname(MediaController::get_server_var('SCRIPT_FILENAME')) . '/files/partner/';

        return $this->render('partner', [
            'model' => $model,
            'wrapper' => $this->wrapper,
            'itemTemplate' => $this->itemTemplate,
            'imagePath' => $imagePath,
            'uploadDir' => $uploadDir,
        ]);
    }
}
