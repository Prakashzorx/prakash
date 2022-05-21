<?php
require_once '../controller/recipe_update_functions.php';
//Start the session.
session_start();
// print_r($_POST);exit;

if(!empty($_POST['id'])){
    $id=$_POST['id'];

   
}else{
        
    $response["error"] =1;
    $response["error_msg"] = "Select TCP Machine";
    echo json_encode($response);
    exit;
}
$tcp_machine_id = getTCP_machines($id);
// print_r($tcp_machine_id);exit;
$response["error"] = 0;
$response["error_msg"] = $tcp_machine_id;
echo json_encode($response);

?>