<?php
foreach($slides as $slide){
    echo '<li class="list-group-item" id="slide_'.$slide->id.'">'.$slide->name.'</li>';
}
?>