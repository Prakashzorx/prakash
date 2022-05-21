<?php

require_once "../controller/functions.php";

//$response = array("error" => 0);
//print_r($_POST);exit;
//print_r($_FILES);
// Array
// ( 
//     [brandname] => 23
//     [country] => 101
//     [state] => 2
//     [city] => 7
//     [username] => bapu
//     [useremail] => bapu@gmail.com
//     [userrphone] => 8095483633
// )

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$brandid = test_input($_POST["brandname"]);

//$country = test_input($_POST["country"]);
//$state = test_input($_POST["state"]);
//$city = test_input($_POST["city"]);
$username = test_input($_POST["username"]);
$useremail = test_input($_POST["useremail"]);
$userphone = test_input($_POST["userrphone"]);
// check if name only contains letters and whitespace
//
$phone = preg_replace("/[^0-9]/", "", $userphone);
//print_r($phone);exit;

(int)$output = substr($phone, -10, -9);
//print_r(strlen($phone));exit;
if (empty($_POST['brandname'])) {
    $response["error"] = 3;
    
    $response["error_msg"] = "Enter brand Name";
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
} else if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
    $response["error"] = 3;
    $response["error_msg"] = "Email Format not valid";
    echo json_encode($response);
} else if (!empty($brandid)  && !empty($username)  && !empty($useremail) && !empty($userphone) ) {

  
    //$emailcheck= 

    $x = addUser($brandid, $username, $useremail, $userphone);
    //echo($x);exit;
    if ($x == 0) {
        // user already existed

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1';
        //     </script>");
        $response["error"] = 0;
        $response["error_msg"] = "user added successfully ";
        echo json_encode($response);
    } else if ($x == 2) {

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('unknown error occurred in adding');
        //     window.location.href='../add_product.php';
        //     </script>");
        $response["error"] = 2;
        $response["error_msg"] = " user already exist";
        echo json_encode($response);
    } else {

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('unknown error occurred in adding');
        //     window.location.href='../add_product.php';
        //     </script>");
        $response["error"] = 1;
        $response["error_msg"] = " user not inserted";
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
