<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "api/dao/ECarsharingDao.class.php";

$dao= new ECarsharingDao();

$results = $dao->get_all();
print_r($results);
?>
