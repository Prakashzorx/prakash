<?php

require_once "../controller/functions.php";

//$response = array("error" => 0);
//print_r($_POST);exit;
//print_r($_FILES);

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$reason = $_POST['reason'];
$updateby = $_POST['person'];
if (empty($_POST['reason'])) {
    //echo "6";


    $response["error"] = 3;
    $response["error_msg"] = "Enter Reason";
    echo json_encode($response);
} else  if (empty($_POST['person'])) {
    //echo "6";


    $response["error"] = 3;
    $response["error_msg"] = "Enter removed by whom";
    echo json_encode($response);
} else


 if(!empty($_POST['userid']) && !empty($reason)  && !empty($updateby) ) {

    // receiving the post params
    $id=test_input($_POST['userid']);
    
   
// print_r($id);
// print_r($brandname);exit;
    
$x=deleteUser($id,$reason,$updateby);
//echo($x);exit;
if ($x==1) {
        // user already existed
    
    // echo ("<script LANGUAGE='JavaScript'>
    //     window.alert('Succesfully Updated');
    //     window.location.href='../add_product.php?display=1';
    //     </script>");
     $response["error"] = 0;
        $response["error_msg"] = "User deleted successfully ";
        echo json_encode($response);


}
else{

    // echo ("<script LANGUAGE='JavaScript'>
    //     window.alert('unknown error occurred in adding');
    //     window.location.href='../add_product.php';
    //     </script>");
     $response["error"] = 1;
            $response["error_msg"] = " User not deleted";
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
