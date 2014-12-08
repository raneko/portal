<?php

/**
 * Debug
 * @author Harry Lesmana <harry@raneko.com>
 * @since 2014-12-08
 */
defined("VENDOR_PATH") || define("VENDOR_PATH", realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . "vendor"));
$vendor = VENDOR_PATH . DIRECTORY_SEPARATOR . "autoload.php";
require VENDOR_PATH . DIRECTORY_SEPARATOR . "autoload.php";

/* -- DO NOT ALTER ANYTHING ABOVE THIS LINE -- */
echo "Hello World!";