<?php

require_once "../controller/functions.php";

$id = $_POST["id"];

//$assignedDevice = getSingleAssignedDevice($id);

//$machine_id = $assignedDevice['machine_id'];

$machine=getSingleMachine($id);
//print_r($machine);
$ptype=getptype($machine['ptype_id']);
//print_r($ptype);exit;
$response["ptype"] = $ptype['name']." " .$ptype['version'];
$response["brand_id"] = $assignedDevice['brand_id'];
$response["user_id"] = $assignedDevice['user_id'];
$response["store_id"] = $assignedDevice['store_id'];
//$response["state"] = $assignedDevice['state'];
//$response["city"] = $assignedDevice['city'];

echo json_encode($response);




?>