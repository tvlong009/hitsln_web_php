<?php
if(empty($page))
    $page = 'default';
switch($page){
    case 'index':
        app\modules\slidewidget\assets\IndexSlideShowAsset::register($this);
        break;
    default:
        app\modules\slidewidget\assets\DefaultSlideShowAsset::register($this);
}
?>

<?php echo $template ?>
