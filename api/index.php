<?php


require_once __DIR__.'../vendor/autoload.php';
require_once __DIR__.'/services/VehicleService.class.php';

Flight::register('vehicleService', 'VehicleService');

require_once __DIR__.'/routes/VehicleRoutes.php';

Flight::start();
?>
