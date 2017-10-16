<?php

class UserController {

    function __construct() {
        $this->view = new View();
    }

    function insert() {
        $this->view->show("insertAdminView.php");
    }

    function delete() {
        require 'model/AdminModel.php';
        $model = new AdminModel();
        $result = $model->selectAllAdmin();
        $this->view->show("deleteAdminView.php", $result);
    }

    function insertAdmin() {
        if (isset($_POST["id"]) && isset($_POST["email"]) && isset($_POST["name"]) && isset($_POST["firstLastName"]) && isset($_POST["secondLastName"])) {
            require 'model/AdminModel.php';
            $model = new AdminModel();
            $result = $model->insertAdmin($_POST["id"], $_POST["email"], $_POST["name"], $_POST["firstLastName"], $_POST["secondLastName"]);
            echo json_encode($result);
        } else {
            $this->view->show("insertAdminView.php");
        }
    }

    function selectAdmin() {
        if (isset($_POST["id"])) {
            require 'model/AdminModel.php';
            $model = new AdminModel();
            $result = $model->selectAdmin($_POST["id"]);
            echo json_encode($result);
        } else {
            $this->view->show("deleteAdminView.php");
        }
    }

    function deleteAdmin() {
        if (isset($_POST["id"])) {
            require 'model/AdminModel.php';
            $model = new AdminModel();
            $result = $model->deleteAdmin($_POST["id"]);
            echo json_encode($result);
        } else {
            $this->view->show("deleteAdminView.php");
        }
    }

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
