<?php
echo '<ul>';
foreach ($model as $partner) {
    echo '<li>'.$partner->partner_name.'</li>';
}
echo '</ul>';
