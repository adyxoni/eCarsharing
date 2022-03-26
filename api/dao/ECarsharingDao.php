<?php
class ECarsharingDao{
  protected $conn;
  public function __construct(){
  $servername = "localhost";
  $username = "carsharing";
  $password = "carsharing";
  $name="carsharing";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$name", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
  }
}
