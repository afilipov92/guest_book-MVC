<?php

class Router {
    public function __construct() {
        $url = isset($_GET['url']) ? $_GET['url'] : DEFAULT_CONTROLLER;

        $parts = explode('/', rtrim($url, '/'));

        $controllerFile = 'inc/controllers/' . $parts[0] . '.php';

        if (file_exists($controllerFile)) {
            require_once($controllerFile);
        } else {
            echo "Такой контроллер не существует";
            die;
        }

        $controllerName = $parts[0] . 'Controller';
        $controller = new $controllerName();

        $action = isset($parts[1]) ? $parts[1] . 'Action' : 'indexAction';

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            echo "Такой метод не существует";
            die;
        }

    }
}