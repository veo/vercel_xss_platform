<?php
date_default_timezone_set('Asia/Shanghai');
error_reporting(0);

$act = !empty($_GET['a']) ? $_GET['a'] : 'index';
$act = str_replace(['/', ' ', '\\'], '', $act);

include __DIR__ . '/../'.$act.'.php';