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
$store = getSingleStore($id);
$country=$store['country'];
$countryname=getCountriesById($country);
$state=$store['state'];
$statename=getStatesById($state);
$city=$store['city'];
$cityname=getCityById($city);


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

echo json_encode($response);

?>