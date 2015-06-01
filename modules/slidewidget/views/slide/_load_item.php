<?php
foreach($items as $item){
    echo '<li class="list-group-item" id="item_'.$item->id.'">'.$item->title.'</li>';
}
?>
