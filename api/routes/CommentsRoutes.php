<?php

require_once __DIR__.'/../config.php';

Flight::route('GET /comments', function(){
  Flight::json(Flight::commentService()->get_all());
});

Flight::route('GET /comments/@id', function($id){
  Flight::json(Flight::commentService()->get_by_id($id));
});

Flight::route('POST /comments', function(){
  Flight::json(Flight::vehicleService()->add(Flight::request()->data->getData()));
});

Flight::route('DELETE /comments/@id', function($id){
  Flight::commentService()->delete($id);
  Flight::json(["message" => "deleted"]);
});

Flight::route('PUT /comments/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::commentService()->update($id, $data));
});

?>