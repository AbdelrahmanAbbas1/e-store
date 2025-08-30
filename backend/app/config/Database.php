<?php

// Database class
require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

class Database
{

  private $host;
  private $user;
  private $pass;
  private $name;
  private $conn;

  public function __construct()
  {

    $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();

    $this->host = $_ENV['DB_HOST'];
    $this->user = $_ENV['DB_USER'];
    $this->pass = $_ENV['DB_PASS'];
    $this->name = $_ENV['DB_NAME'];
  }


  // Establish a connection to the database
  public function connect()
  {
    $this->conn = null;

    try {
      $dsn = "mysql:host=$this->host;dbname=$this->name";
      $this->conn = new PDO($dsn, $this->user, $this->pass);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Connection failed ", $e->getMessage();
    }

    return $this->conn;
  }

  // Initiate a connection to the database
  public function getConnection()
  {

    if (!$this->conn) {
      $this->connect();
    }
    return $this->conn;
  }
}
