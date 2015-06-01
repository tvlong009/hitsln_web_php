<?php
use yii\helpers\FileHelper;
if (!empty($model)) {
    $items = '';
    foreach ($model as $key => $partner) {

        $filesPath = FileHelper::findFiles($uploadDir . $partner->id, [
                        'only' => ['*.jpg', '*.jpeg', '*.jpe', '*.png', '*.gif']]);
        $image = '';
        if (is_array($filesPath) && !empty($filesPath)) {
            $image = $imagePath . '/' . $partner->id . '/' . basename($filesPath[0]);
        }


        $items .= str_replace(
            array(
                '{name}',
                '{imageUrl}',
                '{description}',
                '{url}',
            ),
            array(
                $partner->name,
                $image,
                $partner->description,
                ($partner->link != '' ? $partner->link : '#'),

            ),
            $itemTemplate
        );
    }

    $content =  str_replace('{item}', $items, $wrapper);
    echo $content;
}