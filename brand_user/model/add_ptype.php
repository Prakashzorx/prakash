<?php

require_once "../controller/functions.php";

//$response = array("error" => 0);
//print_r($_POST);exit;
//print_r($_FILES);
// Array
// (
//     [name] => WOKIE
//     [revision] => VS4
// )


 if (!empty($_POST['name'])  && !empty($_POST['revision']) ) {

    // receiving the post params
    $name = $_POST['name'];
    $revision = $_POST['revision'];



    $x = addProductType($name, $revision);
    //echo($x);exit;
    if ($x == 0) {
        // user already existed

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1';
        //     </script>");
        $response["error"] = 0;
        $response["error_msg"] = "Product Type added successfully ";
        echo json_encode($response);
    } else if ($x == 2) {

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('unknown error occurred in adding');
        //     window.location.href='../add_product.php';
        //     </script>");
        $response["error"] = 2;
        $response["error_msg"] = " Product Type already exist";
        echo json_encode($response);
    } else {

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('unknown error occurred in adding');
        //     window.location.href='../add_product.php';
        //     </script>");
        $response["error"] = 1;
        $response["error_msg"] = " Product Type not inserted";
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
