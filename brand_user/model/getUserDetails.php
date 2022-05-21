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
$user = getSingleuser($id);
//print_r($user);exit;


//print_r($statename);
//print_r($cityname);exit;

$response["p_name"] = $user['name'];
$response["p_phone"] = $user['phone'];
$response["p_email"] = $user['email'];


echo json_encode($response);

?>