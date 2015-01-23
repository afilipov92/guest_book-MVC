<?php

define('DEFAULT_CONTROLLER', 'main');
define('BASE_URL', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('BASE_PATH', __DIR__ . DIRECTORY_SEPARATOR);

define('DB_HOST', 'localhost');
define('DB_NAME', 'study4');
define('DB_USER', 'root');
define('DB_PASSWORD', 'Blackpearl99');
define('DB_PREFIX', 'st_');

define('CHAR_SET', 'UTF-8');
define('SMTP_SEC', 'ssl');
define('MAIL_HOST', 'smtp.yandex.ru');
define('MAIL_PORT', 465);
define('MAIL_USERNAME', 'al.oz2015@yandex.ru');
define('MAIL_PASSWORD', 'Paradise90');

define('PAGE_SIZE', 5);

define('ID_ADMIN', 1);
define('ID_USER', 2);

require_once(__DIR__ . '/service/autoloaders.php');
require_once('helpers/PHPMailer/PHPMailerAutoload.php');
