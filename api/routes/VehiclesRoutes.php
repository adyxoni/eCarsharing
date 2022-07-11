<?php

  require_once __DIR__.'/../config.php';

  Flight::route('GET /vehicles', function(){
    Flight::json(Flight::vehicleService()->get_all());
  });

  Flight::route('GET /vehicles/@id', function($id){
    Flight::json(Flight::vehicleService()->get_by_id($id));
  });

  Flight::route('POST /vehicles', function(){
    Flight::json(Flight::vehicleService()->add(Flight::request()->data->getData()));
  });

  Flight::route('DELETE /vehicles/@id', function($id){
    Flight::vehicleService()->delete($id);
    Flight::json(["message" => "deleted"]);
  });

  Flight::route('PUT /vehicles/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::vehicleService()->update($id, $data));
  });

?>
