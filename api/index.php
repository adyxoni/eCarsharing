<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__).'/services/AccountService.class.php';
require_once dirname(__FILE__).'/services/UserService.class.php';
require_once dirname(__FILE__).'/services/VehicleService.class.php';

Flight::set('flight.log_errors',TRUE);
/*error handling for API*/
Flight::map('error', function(Exception $ex){
Flight::json(["message" => $ex->getMessage()], $ex->getCode() ? $ex->getCode() : 500);
});
/* utility function for reading query parameters from URL */
Flight::map('query',function($name, $default_value=NULL){
$request= Flight::request();
$query_parameter= @$request->query->getData()[$name];
$query_parameter= $query_parameter ? $query_parameter : $default_value;
return $query_parameter;
});
/* utility function for getting header parameters */
Flight::map('header', function($name){
  $headers = getallheaders();
  return @$headers[$name];
});
/* utility function for generating JWT token */
Flight::map('jwt', function($user){
  $jwt = \Firebase\JWT\JWT::encode(["exp" => (time() + Config::JWT_TOKEN_TIME), "id" => $user["id"], "aid" => $user["accountID"], "r" => $user["role"]], Config::JWT_SECRET);
  return ["token" => $jwt];
});


require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/services/VehicleService.class.php';

Flight::register('vehicleService', 'VehicleService');
Flight::register('accountService', 'AccountService');
Flight::register('userService', 'UserService');

require_once __DIR__.'/routes/VehiclesRoutes.php';
require_once __DIR__.'/routes/UserRoutes.php';

Flight::start();
?>
