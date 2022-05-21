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


if (empty($_POST['reason'])) {

    $response["error"] = 2;
    $response["error_msg"] = "Enter Reason for deleting this machine";
    echo json_encode($response);
    exit;
}
if (empty($_POST['person'])) {

    $response["error"] = 2;
    $response["error_msg"] = "Enter Person name who is deleting this machine";
    echo json_encode($response);
    exit;
}

$reason=$_POST['reason'];
$person=$_POST['person'];
if (!empty($_POST['id'])) {

    // receiving the post params
    $id = test_input($_POST['id']);


    // print_r($id);
    // print_r($brandname);exit;

    $x = deleteMachine($id,$reason,$person);
    //echo($x);exit;
    if ($x == 1) {
        // user already existed

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1';
        //     </script>");
        $response["error"] = 0;
        $response["error_msg"] = "Machine deleted successfully ";
        echo json_encode($response);
    } else {

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('unknown error occurred in adding');
        //     window.location.href='../add_product.php';
        //     </script>");
        $response["error"] = 1;
        $response["error_msg"] = " Machine not deleted";
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
