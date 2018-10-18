<?php
  class Database
  {

    private $host = "127.0.0.1";
    private $dbName = "api";
    private $username = "root";
    private $password = "";
    public $conn;


    public function getConnection()
    {
      $this->conn = null;

      try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->username, $this->password);
            $this->conn->exec("set names utf8");
      } catch(PDOExeception $exception) {
        echo "Connection error : "  . $exception->getMessage();
      }

      return $this->conn;
    }

  }

 ?>
