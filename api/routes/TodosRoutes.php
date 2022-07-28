<?php

  require_once __DIR__.'/../config.php';

  Flight::route('GET /todos', function(){
    Flight::json(Flight::todoService()->get_all());
  });

  Flight::route('GET /todos/@id', function($id){
    Flight::json(Flight::todoService()->get_by_id($id));
  });

  Flight::route('POST /todos', function(){
    Flight::json(Flight::todoService()->add(Flight::request()->data->getData()));
  });

  Flight::route('DELETE /todos/@id', function($id){
    Flight::todoService()->delete($id);
    Flight::json(["message" => "deleted"]);
  });

  Flight::route('PUT /todos/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::todoService()->update($id, $data));
  });

?>
