<?php app\assets\HomeAsset::register($this);
if ($model) {
    if (is_file($model->content)) {
        eval('?> '.file_get_contents($model->content));
    } else {
        echo $model->content;
    }
}

?>

