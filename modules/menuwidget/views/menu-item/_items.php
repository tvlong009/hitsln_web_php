<?php

function display($items, $parentId = 0, $text = ''){
    if (!empty($items)) {
        foreach ($items[$parentId] as $key => $item) {
            if ($item['parent_id'] == $parentId) {
                echo '<tr>';
                echo '<td>' . $text  . $item['label'] . '</td>';
                echo '<td>';
                echo $key > 0 ? '<button id="'.$item['id'].'" class="btn btn-info btn-sm item level_'.$parentId
                    .'" rel="1" data-level="'.$parentId.'"><i class="glyphicon glyphicon-arrow-up"></i></button>&nbsp;' : '';
                echo $key < (count($items[$parentId]) - 1) ? '<button id="'.$item['id']
                    .'" class="btn btn-info btn-sm item level_'.$parentId.'" rel="2" data-level="'.$parentId.'"><i class="glyphicon glyphicon-arrow-down"></i></button>' : '';
                echo '</td>';
                echo '<td><input type="checkbox" name="id[]" class="menu_item_id" value="'.$item['id'].'" /></td>';
                echo '</tr>';
                if (isset($items[$item['id']])) {
                    display($items, $item['id'], $text . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
                    unset($item);
                }
            }
        }
    } else {
        echo '<tr><td colspan="3">' . Yii::t('app', 'No have result') . '</td></tr>';
    }
}
?>
<table class="table table-striped table-bordered">
    <thead>
        <th><?php echo Yii::t('app', 'Label'); ?></th>
        <th></th>
        <th></th>
    </thead>
    <tbody>
        <?php display($items) ?>
    </tbody>
</table>
