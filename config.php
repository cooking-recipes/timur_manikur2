<?php
// HTTP
define('HTTP_SERVER', 'http://'.$_SERVER['SERVER_NAME'].'/');

// HTTPS
define('HTTPS_SERVER', 'http://'.$_SERVER['SERVER_NAME'].'/');

//var_dump($_SERVER['DOCUMENT_ROOT']);
// DIR
// DIR
define('DIR_APPLICATION', $_SERVER['DOCUMENT_ROOT'].'/catalog/');
define('DIR_SYSTEM', $_SERVER['DOCUMENT_ROOT'].'/system/');
define('DIR_LANGUAGE', $_SERVER['DOCUMENT_ROOT'].'/catalog/language/');
define('DIR_TEMPLATE', $_SERVER['DOCUMENT_ROOT'].'/catalog/view/theme/');
define('DIR_CONFIG', $_SERVER['DOCUMENT_ROOT'].'/system/config/');
define('DIR_IMAGE', $_SERVER['DOCUMENT_ROOT'].'/image/');
define('DIR_CACHE', $_SERVER['DOCUMENT_ROOT'].'/system/cache/');
define('DIR_DOWNLOAD', $_SERVER['DOCUMENT_ROOT'].'/system/download/');
define('DIR_UPLOAD', $_SERVER['DOCUMENT_ROOT'].'/system/upload/');
define('DIR_MODIFICATION', $_SERVER['DOCUMENT_ROOT'].'/system/modification/');
define('DIR_LOGS', $_SERVER['DOCUMENT_ROOT'].'/system/logs/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'localhost2');
define('DB_PREFIX', 'oc_');
