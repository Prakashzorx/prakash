<?php

require_once "../controller/functions.php";


$id = $_POST["id"];
$brandname = getBrand($id);
//print_r($brandname);exit;
// Array
// (
//  [id] => 1558
// [brand_name] => CENTURY
// [outlets] => 100 above
// [address] => 545/15, SURVEY NUMBER 13/5
// [pincode] => 560068
// [country] => 101
// [state] => 17
// [city] => 1558
// [bp_name] => Vivek.B.M.
// [bp_designation] => Manager
// [bp_phone] => 9986589959
// [bp_email] => vivek.bm9@gmail.com
// [password] => 
// [status] => 1
// [active] => 1
// [sortname] => IN
// [name] => Bengaluru
// [phonecode] => 91
// [country_id] => 101
// [state_id] => 17
// [cityname] => Bengaluru
// [statename] => Karnataka
// [countryname] => India
// )

//print_r($statename);
//print_r($brandname);exit;

$response["brandname"] = $brandname ['brand_name'];
$response["id"] = $brandname ['id'];
$response["outlets"] = $brandname ['outlets'];
$response["address"] = $brandname ['address'];
$response["pincode"] = $brandname ['pincode'];
$response["outlets"] = $brandname ['outlets'];
$response["country"] = $brandname ['country'];
$response["state"] = $brandname ['state'];
$response["city"] = $brandname ['city'];
$response["bp_name"] = $brandname ['bp_name'];
$response["bp_designation"] = $brandname ['bp_designation'];
$response["bp_phone"] = $brandname ['bp_phone'];
$response["bp_email"] = $brandname ['bp_email'];
$response["password"] = $brandname ['password'];
$response["countryname"] = $brandname ['countryname'];
$response["statename"] = $brandname ['statename'];
$response["cityname"] = $brandname ['cityname'];



echo json_encode($response);
