<?php

require_once "../controller/functions.php";
// Array
// (
//     [id] => 1
//     [brand_id] => 2
//     [store_name] => store 1
//     [p_name] => Muruli
//     [p_phone] => 8095843663
//     [country] => 101
//     [state] => 2
//     [city] => 6
//     [status] => 1
//     [active] => 1
// )

$id = $_POST["id"];
$machine = getAssignedDevice($id);
$machine=$machine[1];
//print_r($machine);exit;
$Assign_id=$machine['id'];
$brand_id=$machine['brand_id'];
$store_id=$machine['store_id'];
$user_id=$machine['user_id'];
//print_r($machine['store_id']);exit;

$machinedetails = getSingleMachine($id);

$mid = $machinedetails['ptype_id'];
$machinename=$machinedetails['name'];
$ptype = getptype($mid);
$type = $ptype['name'] . " " . $ptype['version'];
$typeid= $ptype['id'];

$store = getSingleStore($store_id);

$country=$store['country'];
$countryname=getCountriesById($country);
$state=$store['state'];
$statename=getStatesById($state);
$city=$store['city'];
$cityname=getCityById($city);


$response["Assign_id"]=$Assign_id;
$response["machinename"] = $machinename; 
$response["ptype"] = $type; 
$response["ptypeid"] = $typeid; 
$response["brand_id"] = $brand_id; 
$brand=getBrand($brand_id); 
//print_r($brand);
$response["brand"] = $brand['brand_name']; 
$response["user_id"] = $user_id;
$user=getSingleuser($user_id); 
//print_r($user);exit;
$response["user"] = $user['name']; 
$response["phone"] = $user['phone']; 
$response["email"] = $user['email']; 
$response["store_id"] = $store_id;

$response["store"] = $store['store_name']; 
//print_r($statename);
//print_r($cityname);exit;

$response["p_name"] = $store['p_name'];
$response["p_phone"] = $store['p_phone'];
$response["p_email"] = $store['p_email'];
$response["country"] = $store['country'];
$response["state"] = $store['state'];
$response["city"] = $store['city'];
$response["countryname"] = $countryname['name'];
$response["statename"] = $statename['name'];
$response["cityname"] = $cityname['name'];
$response["pincode"] = $store['pincode'];
//print_r($response);exit;
echo json_encode($response);
