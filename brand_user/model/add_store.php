<?php

require_once "../controller/functions.php";

//$response = array("error" => 0);
//print_r($_POST);exit;
//print_r($_FILES);
// Array
// (
//     [storebrandid] => 2
//     [storename] => asd
//     [storeperson] => ddd
//     [storecontact] => 8888888888
//     [country] => 101
//     [state] => 17
//     [city] => 1523
//     [pincode] => 45645
// )
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$id = test_input($_POST['id']);
$storebrandid = test_input($_POST['storebrandid']);
$storename = test_input($_POST["storename"]);

$storeperson = test_input($_POST["storeperson"]);
$storecontact = test_input($_POST["storecontact"]);
// check if name only contains letters and whitespace
//
$phone = preg_replace("/[^0-9]/", "", $storecontact);
$pincode=$_POST['pincode'];
(int)$output = substr($phone, -10, -9);
if (empty($_POST['storename'])) {
    $response["error"] = 3;
    
    $response["error_msg"] = "Enter store Name";
    echo json_encode($response); 
} else if (!(strlen($phone) == 10)) {
    $response["error"] = 3;
    
    $response["error_msg"] = "Phone Number should be 10 digit";
    echo json_encode($response);
} else if ($output < 6) {
    //echo "6";


    $response["error"] = 3;
    $response["error_msg"] = "Phone Number Should start with 6,7,8,9";
    echo json_encode($response);
} else if (!(strlen($pincode) == 6)) {
    $response["error"] = 3;
    
    $response["error_msg"] = "pincode should be 6 digit";
    echo json_encode($response);
} else if(!empty($_POST['storebrandid'])  && !empty($_POST['storename'])  && !empty($_POST['storeperson']) && !empty($_POST['storecontact']) && !empty($_POST['country'])&& !empty($_POST['state'])&& !empty($_POST['city'])) {

    // receiving the post params
    $brandname = $_POST['storebrandid'];
    $storename = $_POST['storename'];
    $storeperson = $_POST['storeperson'];
    $storecontact = $_POST['storecontact'];
    $country = $_POST['country'];

    $state = $_POST['state'];
    $city = $_POST['city'];
  


    $x = addStore($brandname, $storename, $storeperson, $storecontact,$country,$state,$city,$pincode);
    //echo($x);exit;
    if ($x == 0) {
        // user already existed

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1';
        //     </script>");
        $response["error"] = 0;
        $response["error_msg"] = "store added successfully ";
        echo json_encode($response);
    } else if ($x == 2) {

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('unknown error occurred in adding');
        //     window.location.href='../add_product.php';
        //     </script>");
        $response["error"] = 2;
        $response["error_msg"] = " store already exist";
        echo json_encode($response);
    } else {

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('unknown error occurred in adding');
        //     window.location.href='../add_product.php';
        //     </script>");
        $response["error"] = 1;
        $response["error_msg"] = " store not inserted";
        echo json_encode($response);
    }
} else {
    // echo ("<script LANGUAGE='JavaScript'>
    //    window.alert('required parameters are missing');
    //    window.location.href='../add_product.php';
    //    </script>");
    $response["error"] = 3;
    $response["error_msg"] = "Required parameters  is missing!";
    echo json_encode($response);
}
