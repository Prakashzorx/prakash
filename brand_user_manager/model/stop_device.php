<?php

require_once "../controller/functions.php";

//$response = array("error" => 0);
//print_r($_POST);exit;
//print_r($_FILES);
// Array
// (
//     [id] => 3
//     [reason] => no reason
//     [person] => vasu
// )

 if (!empty($_POST['id'])  && !empty($_POST['reason'])  && !empty($_POST['person']) ) {

    // receiving the post params
    $Deviceid = $_POST['id'];

    $device=getSingleAssignedDevice($Deviceid);
    //print_r($device);exit;
  
    $machine = $device['machine_id'];

    $brand = $device['brand_id'];
    $user = $device['user_id'];
    $store = $device['store_id'];
    
    $reason = $_POST['reason'];
    $updateby = $_POST['person'];
   
    

    $x = stopDevice($Deviceid,$machine, $brand, $user, $store,$reason,$updateby);
    //echo($x);exit;
    if ($x == 0) {
        // user already existed

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1';
        //     </script>");
        $response["error"] = 0;
        $response["error_msg"] = "Device Stopped successfully ";
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
        $response["error_msg"] = " device is not Stopped";
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
