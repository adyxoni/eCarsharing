<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'dao/ECarsharingDao.class.php';
require_once '../vendor/autoload.php';

Flight::route('/', function(){
  echo 'HI';
});

Flight::route('/cars', function(){
    echo 'hello world!';
  });
Flight::route('/vehicles', function(){
  $dao = new ECarsharingDao();
  $results = $dao->get_all();
  Flight::json($results);
  echo "Hello";
});
Flight::route('GET/vehicles/@id', function($id){
  $dao = new ECarsharingDao();
  $result = $dao->get_by_id($id);
  Flight::json($result);
});

Flight::start();
?>
