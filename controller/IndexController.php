<?php

class IndexController {

    function __construct() {
        $this->view = new View();
    }

    function defaultAction() {
        $this->view->show("indexView.php");
    }

    function notFound() {
        $this->view->show("404View.php");
    }

    function login() {
        $this->view->show("loginView.php");
    }
}

// fin clase
