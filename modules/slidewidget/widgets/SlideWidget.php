<?php

namespace app\modules\slidewidget\widgets;

use yii\base\Widget;
use app\modules\slidewidget\models\SlideItem;
use app\modules\slidewidget\models\SlideSlideItem;
use app\modules\slidewidget\models\SlideSlideshow;

class SlideWidget extends Widget {

    public $name = '';
    public $template = '';
    public $page = '';
    protected $format = [
        'begin' => '{{begin slide}}',
        'end' => '{{end slide}}',
        'name' => '{{name}}',
        'effect' => '{{effect}}',
        'item' => [
            'begin' => '{{begin item}}',
            'end' => '{{end item}}',
            'image' => '{{image}}',
            'link' => '{{link}}',
            'title' => '{{title}}',
            'description' => '{{description}}',
            'open_new_window' => '{{open_new_window}}'
        ]
    ];

    public function init() {
        parent::init();
        if ($this->name != '') {
            $file_name = __DIR__ . '/views/' . (empty($this->template) ? 'default' : $this->template) . '.php';
            if (file_exists($file_name)) {
                $this->template = file_get_contents($file_name);
            }
        }
    }

    public function renderTemplate($template, SlideSlideshow $slide) {

        $slide_items = [];
        if ($slide_item_couplings = SlideSlideItem::findAll(["slide_id" => $slide->id])) {
            foreach ($slide_item_couplings as $slide_item_coupling) {
                $slide_items[] = SlideItem::findOne(['id' => $slide_item_coupling->item_id]);
            }
        }

        $slidewidget = $view_block = '';
        if ($template && $slide_items) {
            $start = stripos($template, $this->format['begin']) + strlen($this->format['begin']);
            $end = stripos($template, $this->format['end']);
            if ($start !== false && $end !== false) {

                $slidewidget = substr($template, $start, ($end - $start));
                $slidewidget = str_replace(array($this->format['name'], $this->format['effect']), array($slide->name, $slide->effect), $slidewidget);

                $item_start = stripos($slidewidget, $this->format['item']['begin']) +
                        strlen($this->format['item']['begin']);
                $item_end = strrpos($slidewidget, $this->format['item']['end']);
                if ($item_start !== false && $end !== false) {
                    $view_block = '';
                    $item = substr($slidewidget, $item_start, ($item_end - $item_start));
                    foreach ($slide_items as $slide_item) {
                        $block = $item;
                        if (isset($slide_item->image)) {
                                $slide_item->image = \Yii::$app->urlManagerApp->createAbsoluteUrl('/uploads/slidewidget/' . $slide_item->image);
                            $block = str_replace($this->format['item']['image'], $slide_item->image, $block);
                        }
                        if (isset($slide_item->link)) {
                            $block = str_replace($this->format['item']['link'], $slide_item->link, $block);
                        }
                        if (isset($slide_item->title)) {
                            $block = str_replace($this->format['item']['title'], $slide_item->title, $block);
                        }
                        if (isset($slide_item->description)) {
                            $block = str_replace($this->format['item']['description'], $slide_item->description, $block);
                        }
                        if (isset($slide_item->open_new_window)) {
                            $slide_item->open_new_window = $slide_item->open_new_window ? '_blank' : '_self';
                            $block = str_replace($this->format['item']['open_new_window'], $slide_item->open_new_window, $block);
                        }
                        $view_block .= $block;
                    }
                }
                $view_block = preg_replace("/{$this->format['item']['begin']}.*{$this->format['item']['end']}/is", $view_block, $slidewidget);
            }
            $view_block = preg_replace("/{$this->format['begin']}.*{$this->format['end']}/is", $slidewidget, $view_block);
        }
        return empty($view_block) ? $template : $view_block;
    }

    public function run() {
        if ($this->name) {
            $model_slide = SlideSlideshow::findOne(['name' => $this->name, 'is_active' => '1']);
        }
        if (!empty($model_slide)) {
            echo $this->render('slide', array(
                'page' => $this->page,
                'template' => $this->renderTemplate($this->template, $model_slide)));
        } else {
            echo '';
        }
    }

}
