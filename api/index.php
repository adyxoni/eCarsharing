<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'dao/VehiclesDao.class.php';
require_once '../vendor/autoload.php';

Flight::register('vehiclesDao', 'VehiclesDao');

Flight::route('/', function(){
  echo 'HI';
});

Flight::route('/cars', function(){
    echo 'hello world!';
  });
Flight::route('GET /vehicles', function(){
  $vehicles = Flight::vehiclesDao()->get_all();
  Flight::json($vehicles);
});

Flight::route('GET/vehicles/@id', function($id){
  $vehicle = Flight::vehiclesDao()->get_by_id($id);
  Flight::json($vehicle);
});

Flight::route('POST /vehicles', function(){
  Flight::json(Flight::vehicleDao()->add(Flight::request()->data->getData()));
});

Flight::route('DELETE /vehicles/@id', function($id){
  Flight::vehiclesDao()->delete($id);
  Flight::json(["message" => "deleted"]);
});

Flight::route('PUT /vehicles/@id', function($id){
  $data = Flight::request()->data->getData();
  $data['id'] = $id;
  Flight::json(Flight::vehiclesDao()->update($data));
});
Flight::start();
?>
