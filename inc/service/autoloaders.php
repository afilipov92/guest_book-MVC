<?php

/**
 * Подргузка моделей
 */
spl_autoload_register(function ($class) {
    $modelFlag = strpos($class, 'Model');
    if ($modelFlag === FALSE) {
        return FALSE;
    }

    $modelName = str_replace('model', '', strtolower($class));
    $modelFileName = 'inc/models/' . $modelName . '.php';

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
    $controllerFileName = 'inc/controllers/' . $controllerName . '.php';
    if (file_exists($controllerFileName)) {
        require_once($controllerFileName);
        return true;
    }
});

/**
 * Подргузка сервисных классов
 */
spl_autoload_register(function ($class) {
    $classFileName = 'inc/service/' . $class . '.php';

    if (file_exists($classFileName)) {
        require_once($classFileName);
        return true;
    }
});