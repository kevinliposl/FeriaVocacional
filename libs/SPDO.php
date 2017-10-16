<?php

class SPDO extends PDO {

    private static $instance = null;

    function __construct() {
        $config = Config::singleton();
        parent::__construct('mysql:host=' . $config->get('dbhost') . ';dbname=' . $config->get('dbname'), $config->get('dbuser'), $config->get('dbpass'));
    }

    static function singleton() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}
