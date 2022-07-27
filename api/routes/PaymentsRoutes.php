<?php

require_once __DIR__.'/../config.php';

Flight::route('GET /payments', function(){
  Flight::json(Flight::paymentService()->get_all());
});

Flight::route('GET /payments/@id', function($id){
  Flight::json(Flight::paymentService()->get_by_id($id));
});

Flight::route('POST /payments', function(){
  Flight::json(Flight::paymentService()->add(Flight::request()->data->getData()));
});

Flight::route('DELETE /payments/@id', function($id){
  Flight::paymentService()->delete($id);
  Flight::json(["message" => "deleted"]);
});

Flight::route('PUT /payments/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::paymentService()->update($id, $data));
});

?> 