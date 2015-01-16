<?php

/**
 * Подргузка моделей
 */
spl_autoload_register(function ($class) {
    $modelFlag = strpos($class, 'Model');
    if ($modelFlag === false) {
        return false;
    }
    $modelName = str_replace('model', '', strtolower($class));
    $modelFileName = BASE_PATH . 'models' . DIRECTORY_SEPARATOR . $modelName . '.php';

    if (file_exists($modelFileName)) {
        require_once($modelFileName);
        return true;
    }
});

/**
 * Подргузка контроллеров
 */
spl_autoload_register(function ($class) {
    $controllerFlag = strpos($class, 'Controller');
    if ($controllerFlag === false) {
        return false;
    }
    $controllerName = str_replace('controller', '', strtolower($class));
    $controllerFileName = BASE_PATH . 'controllers' . DIRECTORY_SEPARATOR . $controllerName . '.php';

    if (file_exists($controllerFileName)) {
        require_once($controllerFileName);
        return true;
    }
});

/**
 * Подргузка сервисных классов
 */
spl_autoload_register(function ($class) {
    $classFileName = BASE_PATH . 'service' . DIRECTORY_SEPARATOR . strtolower($class) . '.php';

    if (file_exists($classFileName)) {
        require_once($classFileName);
        return true;
    }
});

/**
 * Подргузка классов helpers
 */
spl_autoload_register(function ($class) {
    $classFileName = BASE_PATH . 'helpers' . DIRECTORY_SEPARATOR . strtolower($class) . '.php';

    if (file_exists($classFileName)) {
        require_once($classFileName);
        return true;
    }
});