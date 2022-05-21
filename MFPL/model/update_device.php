<?php

require_once "../controller/functions.php";

//$response = array("error" => 0);
//print_r($_POST);
//exit;
//print_r($_FILES);
// Array
// (
//     [machineid] => 1
//     [machinetype] => WOKIE VS2
//     [brand] => 2
//     [user] => 10
//     [store] => 1
//     [country] => 101
//     [state] => 2
//     [city] => 6
//     [pincode] => 590000
//     [mname] => Muruli
//     [mphone] => 8095843663
//     [memail] => muruli@gmail.com
//     [reason] => no reason
//     [updateby] => muruli
// )

 if (!empty($_POST['machineid'])  && !empty($_POST['brand'])  && !empty($_POST['user']) && !empty($_POST['store']) && !empty($_POST['recipeversionedit'])  && !empty($_POST['reason']) && !empty($_POST['updateby']) ) {

    // receiving the post params
    $Deviceid = $_POST['machineid'];
    $brand = $_POST['brand'];
    $user = $_POST['user'];
    $store = $_POST['store'];
    $recipeversion = $_POST['recipeversionedit'];
    $reason = $_POST['reason'];
    $updateby = $_POST['updateby'];
   
    

    $x = updateDevice($Deviceid, $brand, $user, $store,$reason,$updateby,$recipeversion);
    //echo($x);exit;
    if ($x == 0) {
        // user already existed

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1';
        //     </script>");
        $response["error"] = 0;
        $response["error_msg"] = "Device updated successfully ";
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
        $response["error_msg"] = " device  not updated";
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
