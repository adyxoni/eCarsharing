<?php

require_once __DIR__.'/../config.php';

Flight::route('GET /tasks', function(){
  Flight::json(Flight::taskService()->get_all());
});

Flight::route('GET /tasks/@id', function($id){
  Flight::json(Flight::taskService()->get_by_id($id));
});

Flight::route('POST /tasks', function(){
  Flight::json(Flight::taskService()->add(Flight::request()->data->getData()));
});

Flight::route('DELETE /tasks/@id', function($id){
  Flight::taskService()->delete($id);
  Flight::json(["message" => "deleted"]);
});

Flight::route('PUT /tasks/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::taskService()->update($id, $data));
});

?>