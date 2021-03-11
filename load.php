<?php
if (file_exists(dirname(__FILE__) . '/config.php')) {
    require_once(dirname(__FILE__) . '/config.php');
} else {
    echo("缺少config文件，转至install.php");
    header("Location: install.php");
    exit();
}
