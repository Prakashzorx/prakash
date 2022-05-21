<?php

require_once "../controller/functions.php";

//$response = array("error" => 0);
//print_r($_POST);exit;
//print_r($_FILES);
// Array
// (
//     [machineid] => 8
//     [machinetype] => WOKIE VS2
//     [brand] => 2
//     [user] => 10
//     [store] => 1
//     [country] => 101
//     [state] => 2
//     [city] => 6
//     [pincode] => 590000
// )

if (!empty($_POST['machineid'])  && !empty($_POST['brand'])  && !empty($_POST['user']) && !empty($_POST['store'])) {

    // receiving the post params
    $machineid = $_POST['machineid'];
    $brand = $_POST['brand'];



    $store = $_POST['store'];
    $i=0;
    if(!empty($_POST['user'])){
        $users[$i]=$_POST['user'];
        $i++;
    }
    if(!empty($_POST['useropt1'])){
        $users[$i]=$_POST['useropt1'];
        $i++;
    }
    if(!empty($_POST['useropt2'])){
        $users[$i]=$_POST['useropt2'];
        $i++;
    }

    foreach ($users as $user) {
        $x = assignDevice($machineid, $brand, $user, $store);
        //echo($x);exit;
       
    }
    if ($x == 0) {
        // user already existed

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1';
        //     </script>");
        $response["error"] = 0;
        $response["error_msg"] = "Device Assiged successfully ";
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
        $response["error_msg"] = " device  not inserted";
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
