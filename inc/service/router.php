<?php

class Router {
    /**
     * выбирает контроллер и метод контроллера
     */
    public function __construct() {
        $url = isset($_GET['url']) ? trim($_GET['url']) : DEFAULT_CONTROLLER;

        $parts = explode('/', rtrim($url, '/'));

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