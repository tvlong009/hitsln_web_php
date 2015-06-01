<?php

echo app\modules\streamingwidget\widgets\StreamingWidget::widget(array('debug' => TRUE, 'type' => 'toptracks'));
?>
<style>
    nav, footer{
        display: none;
    }
    </style>