<?php
define("DB_DRIVER", "mysql");
define("DB_HOST", "db4free.net");
define("DB_USER", "getsetlab");
define("DB_PASS", "GetSetLab*RA");
define("DB_DATABASE", "getsetlab");
define("DB_CHARSET", "utf8");

class Connection{
    private $driver;
    private $host, $user, $pass, $database, $charset;
    public function __construct() {
        $this->driver = DB_DRIVER;
        $this->host = DB_HOST;
        $this->user = DB_USER;
        $this->pass = DB_PASS;
        $this->database = DB_DATABASE;
        $this->charset = DB_CHARSET;
    }
    public function connect(){
        $bbdd = $this->driver
            . ':host=' . $this->host
            . ';dbname=' . $this->database
            . ';charset=' . $this->charset;
        $connection = new PDO($bbdd, $this->user, $this->pass);
        return $connection;
    }
}

?>