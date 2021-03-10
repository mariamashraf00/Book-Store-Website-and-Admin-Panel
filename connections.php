<?php

class ConnectionDb
{
  private static $instance = null;
  private $conn;
  private $host = 'localhost';
  private $user = 'root';
  private $pass = '';
  private $name = 'bookstore';

  private function __construct()
  {
    $this->conn = new mysqli(
      $this->host,
      $this->user,
      $this->pass,
      $this->name
    );
    if (mysqli_connect_errno()>0)
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  public static function getInstance()
  {
    if (!self::$instance) {
      self::$instance = new ConnectionDb();
    }

    return self::$instance;
  }

  public function getConnection()
  {
    return $this->conn;
  }
}