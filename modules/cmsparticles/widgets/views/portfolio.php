<?php
echo '<ul>';
foreach ($model as $portfolio) {
    echo '<li>'.$portfolio->portfolio_name.'</li>';
}
echo '</ul>';