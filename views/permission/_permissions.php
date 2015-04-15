<?php
if (!empty($routers) && is_array($routers)) {
    foreach ($routers as $controller => $methods) {
        if ($methods && $controller !== 'BackendController') {
            ?>

            <li class='list-group-item'>
                <h5><?php echo $controller ?></h5>

                <?php if (!empty($methods) && is_array($methods)) { ?>
                    <ul>
                        <?php foreach ($methods as $method) { ?>
                            <li rel='<?php echo $controller . "\\" . $method->name ?>'
                                class='can_click list-group-item <?php echo (!empty($method->selected) ? ' active' : '') ?>'>
                                <?php echo $method->name ?></li>
                                <?php }
                            ?>
                    </ul>
                <?php } ?>
            </li>
        <?php } ?>
        <?php
    }
}
?>