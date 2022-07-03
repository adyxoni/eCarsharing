<?php
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");
error_log( "Hello, errors!" );




Flight::route('/', function(){
    echo 'HI';
  });
  
  Flight::route('/cars', function(){
      echo 'hello world!';
    });
  
  Flight::route('GET /vehicles', function(){
    Flight::json(Flight::VehicleService()->get_all());
  });
  
  Flight::route('GET /vehicles/@id', function($id){
    Flight::json(Flight::VehicleService()->get_by_id($id));
  });
  
  Flight::route('POST /vehicles', function(){
    Flight::json(Flight::VehicleService()->add(Flight::request()->data->getData()));
  });
  
  Flight::route('DELETE /vehicles/@id', function($id){
    Flight::VehicleService()->delete($id);
    Flight::json(["message" => "deleted"]);
  });
  
  Flight::route('PUT /vehicles/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::VehicleService()->update($id, $data));
  });

?>