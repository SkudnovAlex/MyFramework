<?php
define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . "/public");
define("APP", ROOT . "/app");
define("CORE", ROOT . "/vendor/ishop/core");
define("LIB", ROOT . "/vendor/ishop/core/lib");
define("CACHE", ROOT . "/tmp/cache");
define("CONF", ROOT . "/config");
define("TEMPLATE", "default");

//http://my.framework/public/index.php
$appPath = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
//http://my.framework/public/
$appPath = preg_replace('#[^/]+$#', '', $appPath);
//http://my.framework
$appPath = str_replace('/public/', '', $appPath);
define("PATH", $appPath);
define("ADMIN", PATH . "/admin");

require_once ROOT . '/vendor/autoload.php';
