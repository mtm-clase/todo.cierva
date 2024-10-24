<?php
class DB {
    public $connection;
    public function __construct() {
        $db_user = 'example_user';
        $db_pass = 'password';
        $this -> connection = new mysqli("localhost", $db_user, $db_pass, "example_database");
        //$this -> connection = new PDO("$dsn, $db_user, $db_pass");
    }

    public function __destruct() {
        $this-> connection = null;
    }
    public function query($sql) {
        return $this->connection->query($sql);
    }
}
?>