<?php
if(!isset($_SESSION)) session_start();
!isset($_SERVER["HTTPS"]) || strtolower($_SERVER["HTTPS"])!="on" ? define("PROTOCOL", "http://") : define("PROTOCOL", "https://");

# Spajanje na bazu
define("SQLSERVER", 'localhost');			//SQL servers address, usually localhost
define("SQLUSER", 'root');					//Your username to sqlserver
define("SQLPASS", '');						//Your password to sqlserver
define("SQLDB", 'pwaformsdb');		 	//Name of site database

#REWRITE WEB
define("REW_ROOT", '/');

# ROOT WEB-a
define("WWW_ROOT", PROTOCOL.'pwaforms'.REW_ROOT);

# ROOT filea
define("WEB_ROOT", 'C:/wamp64/www/pwaforms'.REW_ROOT);

define("DO_CACHE", false);
define("FILE", "index.php");
define("PRODUCTION", false);
define("INCLUDE_LANG", true);

class Connection {

    private static $instance = null;
    private $conn;

    private function __construct()
    {
        $this->conn = mysqli_connect(SQLSERVER, SQLUSER, SQLPASS, SQLDB) or die("Database conn not established.");
		$this->conn->set_charset("utf8mb4");
		$this->conn->query("SET collation_connection = utf8mb4_general_ci");
    }

    public static function link() {
        if (self::$instance === null) {
            self::$instance = new Connection();
        }
        return self::$instance; 
    }

    public function getConnection(){
        return $this->conn;
    }

    /* Spriječava dupliciranje konekcije */
    private function __clone(){}
}