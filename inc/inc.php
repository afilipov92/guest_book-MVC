<?php

define('DEFAULT_CONTROLLER', 'main');
define('BASE_URL', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));

require_once('service/autoloaders.php');