<?php \app\modules\languagewidget\assets\LanguageAsset::register($this);

if (!empty($languages)) {
    $items = '';

    foreach ($languages as $language) {
        $items .= str_replace(array(
            '{url}',
            '{name}',
            '{image}',
            '{is_active}',
        ), array(
            $urlChangeLanguage . '?lang=' . $language->code,
            $language->name,
            //getimagesize($flagIconUrl . '/' . $language->code) != false ? $flagIconUrl . $language->code . '.png' : '',
            '<img src="'.$flagIconUrl . $language->code . '.png'.'" />',
            ($language->code == Yii::$app->language) ? ' class="'.$activeClass.'"' : '',
        ), $template);
    }
    $content =  str_replace('{item}', $items, $wrapper);
    echo $content;
}
?>