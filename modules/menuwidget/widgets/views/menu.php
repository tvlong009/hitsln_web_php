<?php \app\modules\menuwidget\assets\MenuAsset::register($this); ?>
<ul id="<?php echo $idRootMenu; ?>" class="<?php echo $classRootMenu; ?>">
    <?php display($menuItems, $controller, $action, $activeClass);?>
</ul>
<?php
function display($items, $controller, $action, $activeClass, $parentId = 0){
    if (!empty($items)) {
        foreach ($items[$parentId] as $key => $item) {
            if ($item['parent_id'] == $parentId) {

                $link = $item['link'] != ''
                    ? (preg_match('/^http(s)?/', $item['link']) ? $item['link'] : urldecode(\Yii::$app->urlManager->createAbsoluteUrl($item['link']))) : 'javascript:void(0)';
                $page = Yii::$app->request->get('page');

                if ($page) {
                    $isActive = strpos($link, $controller.'/' . $action . '?page=' . $page);

                    if ($isActive == false && $action == 'index') {
                        $isActive = strpos($link . '/index', $controller . '/' . $action . '?page=' . $page);
                    }
                } else {
                    $isActive = false;
                }

                if ($isActive == false) {
                   echo '<li>';
                } else {
                   echo '<li class="'.$activeClass.'">';
                }
                echo '<a '.($item['is_blank'] && $link != '' ? 'target="_blank"' : ''). (empty($item['is_ajax']) ? 'href="'.$link.'"' : 'href="javascript:void(0)" onclick="render_page(\''.$link.'\')"') . '>'.$item['label'].'</a>';

                if (isset($items[$item['id']])) {
                    echo '<ul>';
                    display($items, $controller, $action, $activeClass, $item['id']);
                    unset($item);
                    echo '</ul>';
                }

                echo '</li>';
            }
        }

    } else {
        echo '';
    }
}
?>
<script type="text/javascript">
    var menuId = "<?php echo $idRootMenu; ?>";
</script>