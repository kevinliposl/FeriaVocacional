<?php

class FrontController {

    static function main() {
        require 'libs/View.php';
        require 'libs/configuration.php';

        if (!empty(filter_input(INPUT_GET, 'controller'))) {
            $controllerName = filter_input(INPUT_GET, 'controller') . 'Controller';
        } else {
            $controllerName = 'IndexController';
        }
        if (!empty(filter_input(INPUT_GET, 'action'))) {
            $actionName = filter_input(INPUT_GET, 'action');
        } else {
            $actionName = 'defaultAction';
        }
        $config = Config::singleton();
        $controllerPath = $config->get('controllerFolder') . $controllerName . '.php';
        if (is_file($controllerPath)) {
            require $controllerPath;
        } else {
            include $config->get('viewFolder') . '404View.php';
            return FALSE;
            //die('Controlador no encontrado - 404 not found');
        }
        if (!is_callable(array($controllerName, $actionName))) {
            include $config->get('viewFolder') . '404View.php';
            return FALSE;
            //die($controllerName . ' -> ' . $actionName . ' no encontrado - 404 not found');
        }
        $controller = new $controllerName();
        $controller->$actionName();
    }

}
