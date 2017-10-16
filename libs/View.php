<?php

class View {

    function show($nombreVista, $vars = array()) {
        $config = Config::singleton();
        $path = $config->get('viewFolder') . $nombreVista;

        if (is_file($path) == FALSE) {
            include $config->get('viewFolder') . "404View.php";
            return FALSE;
        }

        if (is_array($vars)) {
            foreach ($vars as $key => $value) {
                $key = $value;
            }
        }
        include $path;
    }

}
