<?php

date_default_timezone_set('America/Bahia');

class Connection {

    private $user;
    private $pass;
    private $db;
    private $server;
    private static $pdo;

    public function __construct() {
        $this->server = "localhost";
        $this->db = "rrbank";
        $this->user = "root";
        $this->pass = "12345";
    }

    public function connect() {
        try {
            if (is_null(self::$pdo)) {
                $exceptions = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
                self::$pdo = new PDO("mysql:host=" . $this->server . ";dbname=" . $this->db, $this->user, $this->pass, $exceptions);
            }
            return self::$pdo;
        } catch (PDOException $ex) {
            var_dump($ex);
            exit('<center>Oops, it looks like something went wrong while trying to connect to the database<br> refresh the page<br> if the error persists contact an administrator</center>');
        }
    }

}
