<?php
require_once '../controller/recipe_update_functions.php';
//Start the session.
session_start();

$id = $_POST['id'];
$tcp_instaltable =[];
// print_r($id);exit;

$tcp_ID=select_Tcps($id);
// print_r($tcp_ID);exit;
$tcp_imei = $tcp_ID['imei'];
$tcp_Mtype = $tcp_ID['tcp_machine_type'];
$tcp_sr = $tcp_ID['tcp_sr'];
$tcp_instaltable = $tcp_ID['tcp_instaldate'];

$tcp_low_threshold=$tcp_ID['tcp_low_threshold'];
$tcp_high_threshold=$tcp_ID['tcp_high_threshold'];

$response['imei']=$tcp_imei;
$response['tcp_machine_type']=$tcp_Mtype;
$response['tcp_sr']=$tcp_sr;
$response['tcp_instaltable']=$tcp_instaltable;

$response['tcp_low_threshold']=$tcp_low_threshold;
$response['tcp_high_threshold']=$tcp_high_threshold;

echo json_encode($response);
















?>

