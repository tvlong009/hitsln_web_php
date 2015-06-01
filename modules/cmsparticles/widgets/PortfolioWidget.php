<?php
namespace app\modules\cmsparticles\widgets;

use yii\base\Widget;
use \app\controllers\MediaController;

class PortfolioWidget extends Widget
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
        $model = \app\modules\cmsparticles\models\Portfolio::findAll(['status' => 1]);

        $imagePath = str_replace('/index.php', '', MediaController::get_full_url());

        $uploadDir = dirname(MediaController::get_server_var('SCRIPT_FILENAME')) . '/files/portfolio/';
        $imagePath .= '/files/portfolio/';

        return $this->render('portfolio', [
            'model' => $model,
            'wrapper' => $this->wrapper,
            'itemTemplate' => $this->itemTemplate,
            'imagePath' => $imagePath,
            'uploadDir' => $uploadDir,
        ]);
    }
}
