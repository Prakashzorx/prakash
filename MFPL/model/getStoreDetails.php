<?php

require_once "../controller/functions.php";
// Array
// (
//     [id] => 54
//     [brand_id] => 62
//     [store_name] => saada
//     [p_name] => dsadadas
//     [p_phone] => 8435342343
//     [country] => 14
//     [state] => 290
//     [city] => 7098
//     [pincode] => 425131
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
//print_r($store);exit;
$response["id"] = $store['id'];
$response["brandid"] = $store['brand_id'];
$response["storename"] = $store['store_name'];
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