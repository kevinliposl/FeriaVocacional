<?php

class UserModel {

    private $db;

    function __construct() {
        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }

    function insertUser($email) {
        $query = $this->db->prepare("call sp_insert_user('$email')");
        $query->execute();
        $result = $query->fetch();
        return $result;
    }

}
