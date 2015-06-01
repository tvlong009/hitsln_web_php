<?php
if (!empty($groups)) {
    $content = '';
    foreach ($groups as $groupName => $quickLinks) {
        $item = '';
        $contentGroup = str_replace(array(
            '{group_name}'
        ), array(
            $groupName
        ), $itemTemplateGroup);

        if (is_array($quickLinks)) {
            foreach ($quickLinks as $quickLink) {
                $item .= str_replace(array(
                    '{name}'
                ), array(
                    '<a '.($quickLink['is_blank'] == 1 ? 'target="_blank"' : '').' href="'.
                    ($quickLink['type'] == \app\models\QuickLink::TYPE_URL ? $quickLink['url'] : str_replace(['app', 'app', 'frontend'], $quickLink['prefix'], \app\controllers\MediaController::get_full_url()) . '/' . $quickLink['action'])
                    .'">'.$quickLink['label'].'</a>'
                ), $itemTemplate);
            }

            $itemContent = str_replace(array(
                '{item}'
            ), array(
                $item
            ), $wrapper);
        }
        $content .= str_replace(array(
            '{groupItem}',
            '{items}'
        ), array(
            $contentGroup,
            $itemContent
        ), $wrapperGroup);
    }

    echo $content;
}
?>