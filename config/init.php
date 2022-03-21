<?php

define("DEBUG", 1);// режим отладки (показывать ошибки в браузере) 0-выкл 1-вкл
define("ROOT", dirname(__DIR__)); //указывает на корень сайта
define("WWW", ROOT . '/public'); //указывает на публичную папку
define("APP", ROOT . '/app'); // ведет в файлам приложения
define("CORE", ROOT . '/vendor/pronajemonline/core');//ведет к ядру
define("LIBS", ROOT . '/vendor/pronajemonline/core/libs');
define("CACHE", ROOT . '/tmp/cache');
define("CONF", ROOT . '/config');
define("LAYOUT", 'pronajem'); // шаблон сайта по умолчанию

// http://pronajemonline.cz/public/index.php
$app_path = "http://{$_SERVER['HTTP_HOST']} {$_SERVER['PHP_SELF']}"; //путь к файлу апликции

// http://pronajemonline.cz /public/
$app_path = preg_replace("#[^/]+$#", '',$app_path);
//"#[^/]+$#" - найти все кроме слэша, начиная с конца строки

// http://pronajemonline.cz
$app_path = str_replace("/public/", '',$app_path);

define("PATH", $app_path); //url сайта HTTP
define("ADMIN", PATH . '/admin'); //путь к админке

require_once ROOT . '/vendor/autoload.php';