<?php
class ECarsharingDao{
  protected $conn;
  public function __construct(){
  $servername = "localhost";
  $username = "carsharing";
  $password = "carsharing";
  $name="carsharing";

  try {
    $this->conn = new PDO("mysql:host=$servername;dbname=$name", $username, $password);
    // set the PDO error mode to exception
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
}
/**
* List all records from the database
*/
  public function get_all(){
  $stmt = $this->conn->prepare("SELECT * FROM vehicles");
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
/**
* Insert new vehicles into database
*/

  public function add($car_brand, $car_model, $license_plate, $price_per_hour){
  $stmt = $this->conn->prepare("INSERT INTO vehicles (car_brand, car_model, license_plate, price_per_hour) VALUES (:car_brand, :car_model, :license_plate, :price_per_hour)");
  $stmt->execute(['car_brand'=>$car_brand, 'car_model'=>$car_model, 'license_plate'=>$license_plate, 'price_per_hour'=>$price_per_hour]);
  }

/**
* Delete vehicle from the database
*/
  public function delete($id){
  $stmt = $this->conn->prepare("DELETE FROM vehicles WHERE id=:id");
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  }

/**
* Update vehicles
*/
  public function update($id, $car_brand, $car_model, $license_plate, $price_per_hour){
  $stmt = $this->conn->prepare("UPDATE vehicles SET car_brand=:car_brand, car_model=:car_model, license_plate=:license_plate, price_per_hour=:price_per_hour WHERE id=:id");
  $stmt->execute(['car_brand'=>$car_brand, 'car_model'=>$car_model, 'license_plate'=>$license_plate, 'price_per_hour'=>$price_per_hour,'id'=>$id]);
  }
}
