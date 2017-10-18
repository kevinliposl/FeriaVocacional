<?php

class UserController {

    function __construct() {
        $this->view = new View();
    }

//
//    function insertUser() {
//        if (isset($_POST["email"])) {
//            require 'model/UserModel.php';
//            $model = new UserModel();
//            $result = $model->insertAdmin($_POST["id"], $_POST["email"], $_POST["name"], $_POST["firstLastName"], $_POST["secondLastName"]);
//            echo json_encode($result);
//        } else {
//            $this->view->show("insertAdminView.php");
//        }
//    }

    function logIn() {
        require 'model/UserModel.php';
        $model = new UserModel();

        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = $model->logIn($email, $password);

        if ($result == "true") {
            $session = SSession::getInstance();
            $session->email = $_POST['email'];
        }
        echo json_encode(array("result" => $result));
    }

    function signOff() {
        $session = SSession::getInstance();
        $session->destroy();
        $this->view->show("indexView.php");
    }

}
