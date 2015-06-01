<?php

if ($template == '') {
    if (is_array($model)) {
        foreach ($model as $social) {
            echo '<a href="' . $social->link . '" class="' . $social->css_class . '">';
            if ($social->icon != '') {
                $src = Yii::$app->urlManager->createUrl(''). 'uploads/social/' . $social->icon;
                echo '<img src="' . $src . '" class="social_icon"/>';
            }
            echo '</a>';
            if(strpos($social->js_action, '<script>') !== false){
                echo $social->js_action;
            } else {
                echo '<script>'.$social->js_action.'</script>';
            }
            
        }
    }
} else {
    echo $template;
}
    
