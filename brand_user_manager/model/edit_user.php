<?php

require_once "../controller/functions.php";

//$response = array("error" => 0);
//print_r($_POST);
//exit;
//print_r($_FILES);
// Array
// (
//     [userid] => 4
//     [brandid] => 4
//     [country] => 4
//     [state] => 164
//     [city] => 6414
//     [username] => sadasdasda
//     [useremail] => bapu12@gmail.com
//     [userrphone] => 9087654321
// )
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$id = test_input($_POST['userid']);
$user=getSingleuser($id);
//print_r($user);exit;
$brandid = test_input($user['brand']);
$useremail = test_input($_POST["useremail"]);

$username = test_input($_POST["username"]);
$userphone = test_input($_POST["userrphone"]);
$country = test_input($_POST["country"]);

$state = test_input($_POST["state"]);
$city = test_input($_POST["city"]);
$reason = $_POST['reason'];
$updateby = $_POST['updateby'];
// check if name only contains letters and whitespace
//
$phone = preg_replace("/[^0-9]/", "", $userphone);
//print_r($phone);exit;

(int)$output = substr($phone, -10, -9);
//print_r(strlen($phone));exit;
if (empty($_POST['username'])) {
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
} else  if (empty($_POST['reason'])) {
    //echo "6";


    $response["error"] = 3;
    $response["error_msg"] = "Enter Reason";
    echo json_encode($response);
} else  if (empty($_POST['updateby'])) {
    //echo "6";


    $response["error"] = 3;
    $response["error_msg"] = "Enter Updated by whom";
    echo json_encode($response);
} else if(!empty($id)  && !empty($brandid)  && !empty($useremail) && !empty($username) && !empty($reason)  && !empty($updateby)) {

    // receiving the post params
   
    
$x=editUser($id,$brandid,$username,$useremail,$userphone,$reason,$updateby);
//echo($x);exit;
if ($x==0) {
        // user already existed
    
    // echo ("<script LANGUAGE='JavaScript'>
    //     window.alert('Succesfully Updated');
    //     window.location.href='../add_product.php?display=1';
    //     </script>");
     $response["error"] = 0;
        $response["error_msg"] = "User updated successfully ";
        echo json_encode($response);


}
else{

    // echo ("<script LANGUAGE='JavaScript'>
    //     window.alert('unknown error occurred in adding');
    //     window.location.href='../add_product.php';
    //     </script>");
     $response["error"] = 1;
            $response["error_msg"] = " user not updated";
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

?>
