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

    function galery() {
        $this->view->show("galeryView.php");
    }

    function contact() {
        $this->view->show("contactView.php");
    }

    function aboutus() {
        $this->view->show("aboutView.php");
    }

    function instruments() {
        $this->view->show("coursesView.php");
    }

    function profesors() {
        $this->view->show("coursesView.php");
    }

    function ejemploProfesor() {
        $this->view->show("profileProfesorView.php");
    }

    function val() {
        $this->view->show("pruebaValidacion.php");
    }

    function report() {
        $this->view->show("reportView.php");
    }

}

// fin clase
