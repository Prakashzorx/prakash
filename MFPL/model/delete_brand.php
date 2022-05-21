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
$removeby = $_POST['removeby'];

if (empty($_POST['brandname'])) {
    $response["error"] = 3;

    $response["error_msg"] = "Enter brand Name";
    echo json_encode($response);
} else if (empty($_POST['reason'])) {
    //echo "6";


    $response["error"] = 3;
    $response["error_msg"] = "Enter Reason";
    echo json_encode($response);
} else  if (empty($_POST['removeby'])) {
    //echo "6";


    $response["error"] = 3;
    $response["error_msg"] = "Enter Updated by whom";
    echo json_encode($response);
} else if (!empty($_POST['brandname'])  && !empty($_POST['id']) && !empty($reason)  && !empty($removeby)) {

    // receiving the post params
   
    $id = test_input($_POST['id']);
    $brandname = test_input($_POST['brandname']);

    // print_r($id);
    // print_r($brandname);exit;

    $x = deleteBrand($id, $reason, $removeby);
    //echo($x);exit;
    if ($x == 4) {
        // user already existed

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1';
        //     </script>");
        $response["error"] = 1;
        $response["error_msg"] = "This Brand Contains some Users.. Remove Them First..";
        echo json_encode($response);
    } else if ($x == 3) {
        // user already existed

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1';
        //     </script>");
        $response["error"] = 1;
        $response["error_msg"] = "This Brand Contains some Stores.. Remove Them First..";
        echo json_encode($response);
    } else if ($x == 2) {
        // user already existed

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1';
        //     </script>");
        $response["error"] = 1;
        $response["error_msg"] = "This Brand is Assigned to some Machines.. Remove Them First..";
        echo json_encode($response);
    } else if ($x == 1) {
        // user already existed

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1';
        //     </script>");
        $response["error"] = 0;
        $response["error_msg"] = "brand deleted successfully ";
        echo json_encode($response);
    } else {

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('unknown error occurred in adding');
        //     window.location.href='../add_product.php';
        //     </script>");
        $response["error"] = 1;
        $response["error_msg"] = " brand not deleted";
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
