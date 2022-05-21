<?php

require_once "../controller/recipe_update_functions.php";
// require_once "../controller/functions.php";
session_start();
//$response = array("error" => 0);
//print_r($_POST);exit;
//print_r($_FILES);
// Array
// (
//     [machineid] => 3
//     [user] => 10
//     [reason] => no reason
//     [person] => vasu
// )
// print_r(($_POST));exit;
 if (!empty($_POST['machineid'])  && !empty($_POST['reason'])  && !empty($_POST['person']) ) {

    // receiving the post params
    $id = $_POST['machineid'];  

    $device=getSingleAssignedDevice_TCP($id);
    // print_r($device);
  
    $machine = $device['tcp_machineid'];

    $brand = $device['tcp_brand'];
    $user = $device['tcp_pri_user'];
    $store = $device['tcp_store'];
    
    $reason = $_POST['reason'];
    $updateby = $_POST['person'];
   
    

    $x = removeDevice_TCP($id,$machine, $brand, $user, $store,$reason,$updateby);
    //echo($x);exit;
    if ($x == 0) {
        // user already existed

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1';
        //     </script>");
        $response["error"] = 0;
        $response["error_msg"] = "Device Removed successfully ";
        echo json_encode($response);
    } else if ($x == 2) {

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('unknown error occurred in adding');
        //     window.location.href='../add_product.php';
        //     </script>");
        $response["error"] = 2;
        $response["error_msg"] = " Device already assigned";
        echo json_encode($response);
    } else {

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('unknown error occurred in adding');
        //     window.location.href='../add_product.php';
        //     </script>");
        $response["error"] = 1;
        $response["error_msg"] = " device is not removed";
        echo json_encode($response);
    }
} else {
    // echo ("<script LANGUAGE='JavaScript'>
    //    window.alert('required parameters are missing');
    //    window.location.href='../add_product.php';
    //    </script>");
    $response["error"] = 3;
    $response["error_msg"] = "Required parameters  are missing!";
    echo json_encode($response);
}
