<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "api/dao/ECarsharingDao.class.php";

$dao = new ECarsharingDao();

$op = $_REQUEST['op'];

switch ($op) {

  case 'insert':
  $car_brand=$_REQUEST['car_brand'];
  $car_model=$_REQUEST['car_model'];
  $license_plate=$_REQUEST['license_plate'];
  $price_per_hour=$_REQUEST['price_per_hour'];

  $results = $dao->add($car_brand, $car_model, $license_plate, $price_per_hour);
  break;

  case 'delete':
  $id=$_REQUEST['id'];
  $results = $dao->delete($id);
  break;

  case 'update':
  $id=$_REQUEST['id'];
  $car_brand=$_REQUEST['car_brand'];
  $car_model=$_REQUEST['car_model'];
  $license_plate=$_REQUEST['license_plate'];
  $price_per_hour=$_REQUEST['price_per_hour'];

  $results = $dao->update($id, $car_brand, $car_model, $license_plate, $price_per_hour);
  break;

  case 'get':
  default:
  $results = $dao->get_all();
  print_r($results);
  break;
}
