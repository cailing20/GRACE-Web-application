<?php
  class Db {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        // parse without sections
        $config = parse_ini_file('../config/config.ini');
        $_host = $config['host'];
        $_dbname = $config['dbname'];
        $_username = $config['username'];
        $_password = $config['password'];
        self::$instance = new PDO("mysql:host=$_host;dbname=$_dbname", $_username, $_password, $pdo_options);
      }
      return self::$instance;
    }
  }
?>
