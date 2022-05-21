<?php

require_once "../controller/functions.php";
require_once "../controller/recipe_update_functions.php";
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
// print_r($machine);exit;
$Assign_id=$machine['id'];
$brand_id=$machine['brand_id'];
$store_id=$machine['store_id'];
$user_id=$machine['user_id'];
$versionid=$machine['versionid'];
$version=select_version_ID($versionid);
//print_r($version['recipe_version']);exit;
$vname=$version['recipe_version'];

//print_r($machine['store_id']);exit;

$machinedetails = getSingleMachine($id);
// print_r($machinedetails);exit;
// Array
// (
//     [id] => 70
//     [name] => TR2U9MRZ7F
//     [ptype_id] => 7
//     [mac_id] => 02:00:00:00:00
//     [sr] => MUWK-02
//     [mainboard] => MFWK
//     [manufacturedate] => 2022-03-01
//     [dipatchedate] => 2022-03-02
//     [instaldate] => 2022-03-03
//     [assign_status] => 1
//     [status] => 1
//     [active] => 1
// )

$mid = $machinedetails['ptype_id'];
$machinename=$machinedetails['name'];
$manufacturedate = $machinedetails['manufacturedate'];
$dipatchedate=$machinedetails['dipatchedate'];
$instaldate = $machinedetails['instaldate'];
$sr=$machinedetails['sr'];
$mac_id=$machinedetails['mac_id'];
$mainboard=$machinedetails['mainboard'];

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


$response["manufacturedate"] = $manufacturedate; 
$response["dipatchedate"] = $dipatchedate; 
$response["instaldate"] = $instaldate; 
$response["sr"] = $sr; 
$response["mac_id"] = $mac_id; 
$response["mainboard"] = $mainboard; 


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

$response["versionid"] = $versionid;
$response["vname"] = $vname;

$response["p_name"] = $store['p_name'];
$response["p_phone"] = $store['p_phone'];
// $response["p_email"] = $store['p_email'];
$response["country"] = $store['country'];
$response["state"] = $store['state'];
$response["city"] = $store['city'];
$response["countryname"] = $countryname['name'];
$response["statename"] = $statename['name'];
$response["cityname"] = $cityname['name'];
$response["pincode"] = $store['pincode'];
$response["mid"] = $id;
//print_r($response);exit;
echo json_encode($response);
