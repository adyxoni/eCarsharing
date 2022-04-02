<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "api/dao/ECarsharingDao.class.php";

$dao= new ECarsharingDao();
$id=$_REQUEST['id'];

$results = $dao->delete($id);
echo "DELETED";
?>
