<?php

define('DEFAULT_CONTROLLER', 'main');
define('BASE_URL', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('BASE_PATH', __DIR__ . DIRECTORY_SEPARATOR );

define('DB_HOST', 'localhost');
define('DB_NAME', '');
define('DB_USER', 'root');
define('DB_PASSWORD', 'Blackpearl99');
define('DB_PREFIX', 'st_');

require_once(__DIR__ . '/service/autoloaders.php');