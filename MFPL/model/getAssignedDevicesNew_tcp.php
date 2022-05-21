<?php

require_once "../controller/functions.php";
require_once "../controller/device_datatables.php";

$id = $_POST["id"];

$device = getDeviceRecords_Tcp($id);
// print_r($device);exit;
//$id = $mid = $type = $ptype = $brand = $user = $store = $countryname = $statename = $cityname = $machineid = $phone = $email = $pincode = '';

$response["id"] = $device['id'];
$response["mid"] = $device['machine_id'];
$response["bid"] = $device['brand_id'];
$response["sid"] = $device['store_id'];
$response["uid"] = $device['user_id'];

$response["type"] = $device['ptype'];

$response["brand"] = $device['brand_name'];
$response["user"] = $device['user name'];
$response["store"] = $device['store_name'];
$response["countryid"] = $device['countryid'];
$response["stateid"] = $device['stateid'];
$response["cityid"] = $device['cityid'];
$response["countryname"] = $device['country'];
$response["statename"] = $device['state'];
$response["cityname"] = $device['city'];
$response["machineid"] = $device['machine'];
$response["phone"] = $device['phone'];
$response["email"] = $device['email'];
$response["pincode"] = $device['pincode'];

echo json_encode($response);




?>