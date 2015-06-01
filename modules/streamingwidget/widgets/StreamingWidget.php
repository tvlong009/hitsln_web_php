<?php

namespace app\modules\streamingwidget\widgets;

use yii\base\Widget;
use Yii;
use app\modules\streamingwidget\models\Api;

class StreamingWidget extends Widget {

    public $type = '';
    public $data = '';
    public $protocol = 'rtmp';
    public $handler = 'preView';
    public $debug = FALSE;

    public function init() {
        parent::init();
    }

    public function run() {
        $api = new Api();

        switch ($this->type) {
            case 'toptracks' :
                $tracks = $api->getTopTracks();
                break;
            default:
                $tracks = array();
        }
        $urls = array();
        if (!empty($tracks)) {
            foreach ($tracks as $track) {
                if (isset($track->id)) {
                    $urls[$track->title] = $api->streamingURL($track->id, $this->protocol, $this->handler);
                    if($this->debug)
                        break;
                }
            }
        }
        return $this->render('streamingwidget', ['urls' => $urls]);
    }

}
