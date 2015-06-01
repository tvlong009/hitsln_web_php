<?php
use yii\helpers\FileHelper;
if (!empty($model)) {
    $items = '';
    foreach ($model as $key => $portfolio) {

        $filesPath = FileHelper::findFiles($uploadDir . $portfolio->id, [
                        'only' => ['*.jpg', '*.jpeg', '*.jpe', '*.png', '*.gif']]);
        $image = '';
        if (is_array($filesPath) && !empty($filesPath)) {
            $image = $imagePath . '/' . $portfolio->id . '/' . basename($filesPath[0]);
        }


        $items .= str_replace(
            array(
                '{name}',
                '{imageUrl}',
                '{description}',
                '{url}',
                '{id}'
            ),
            array(
                '<a href="'.($portfolio->link != '' ? $portfolio->link : 'javascript:void(0)').'">'
                    .$portfolio->name.'</a>',
                $image,
                $portfolio->description,
                ($portfolio->link != '' ? $portfolio->link : '#'),
                'portfolio_' . $portfolio->id,
            ),
            $itemTemplate
        );
    }

    $content =  str_replace('{item}', $items, $wrapper);
    echo $content;
}