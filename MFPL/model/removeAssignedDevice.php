<?php

require_once "../controller/functions.php";

$id = $_POST["id"];

$assignedDevice = getSingleAssignedDevice($id);

//print_r($assignedDevice);
//exit;     
$machine_id = $assignedDevice['machine_id'];
$machine=getSingleMachine($machine_id);
//print_r($machine);
$id=$machine['ptype_id'];

$ptype=getptype($id);
//print_r($ptype);
$response['ptype']=$ptype['name']." ".$ptype['version'];


$user_id = $assignedDevice['user_id'];
$user=getSingleuser($user_id);

$id=$user['user_id'];
$username=$user['name'];
$useremail=$user['email'];
$userphone=$user['phone'];

$response['user']=$username;
$response['useremail']=$useremail;
$response['userphone']=$userphone;
//print_r($user);


$brand_id=$assignedDevice['brand_id'];
$brand=getBrand($brand_id);

$id=$brand['id']; 
$brandname=$brand['brand_name'];
$response['brand']=$brandname;

$store_id=$assignedDevice['store_id'];
$store=getSingleStore($store_id);


$storename=$store['store_name'];
$storecountry=$store['country'];
$storestate=$store['state'];
$storecity=$store['city'];

$country=getCountriesById($storecountry);
$state=getStatesById($storestate);
$city=getCityById($storecity);

$response['store']=$storename;
$response['country']=$country['name'];
$response['state']=$state['name'];
$response['city']=$city['name'];
//print_r($response);
//exit;  




echo json_encode($response);




?>