<?php

require_once "../controller/functions.php";

//$response = array("error" => 0);
//print_r($_POST);exit;
//print_r($_FILES);
// Array
// (
//     [id] => 8
//     [name] => sadad
//     [ptypeid] => 7
//     [macid] => asdasd
//     [sr] => asdasd
//     [mainboard] => sadas
//     [manufacturedate] => 2021-12-22
//     [dipatchedate] => 1111-11-11
//     [instaldate] => 1111-11-11
// )

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$id = test_input($_POST["id"]);
$name = test_input($_POST["name"]);

$ptypeid = test_input($_POST["ptypeid"]);
$macid = test_input($_POST["macid"]);
$sr = test_input($_POST["sr"]);
$mainboard = test_input($_POST["mainboard"]);
$manufacturedate = test_input($_POST["manufacturedate"]);


// check if name only contains letters and whitespace
//
if (!empty($_POST["dipatchedate"])) {
    $dipatchedate = test_input($_POST["dipatchedate"]);

    $date1=date_create($manufacturedate);
    $date2=date_create($dipatchedate);
    $diff=date_diff($date1,$date2);
   // echo $diff->format("%R%a days");exit;
    //print_r($diff->d);exit;
    if($diff->d >= 0 && $diff->invert==0){

    }else{
        $response["error"] = 2;
        $response["error_msg"] = "Dispatche Date should be greater than Or Equal to  Manufacture Date";
        echo json_encode($response);
        exit;
    }
} else {
    $dipatchedate = NULL;
} 

if (!empty($_POST["instaldate"])) {
    if(empty($dipatchedate)){
        $response["error"] = 2;
        $response["error_msg"] = "First Enter Dispatche Date";
        echo json_encode($response);
        exit;
    }
    $instaldate = test_input($_POST["instaldate"]);
    $date3=date_create($dipatchedate);
    $date4=date_create($instaldate);
    $diff1=date_diff($date3,$date4);
   //echo $diff1->format("%R%a days");exit;
    //print_r($diff1);print_r($diff);
    //exit;
    if($diff1->d >= 0 && $diff1->invert==0){
//echo "hhhh";exit;
    }else{
        $response["error"] = 2;
        $response["error_msg"] = "Installation Date should be greater than Or Equal to Dispatche Date"; 
        echo json_encode($response);
        exit;
    }
} else {
    $instaldate = NULL;
}


if (!empty($name)  && !empty($ptypeid)  && !empty($macid) && !empty($sr) && !empty($mainboard) && !empty($manufacturedate)) {

    // receiving the post params



    $x = editMachine($id,$name, $ptypeid, $macid, $sr, $mainboard, $manufacturedate, $dipatchedate, $instaldate);
    //echo($x);exit;
    if ($x == 0) {
        // user already existed

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1';
        //     </script>");
        $response["error"] = 0;
        $response["error_msg"] = "Machine added successfully ";
        echo json_encode($response);
    } else if ($x == 2) {

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('unknown error occurred in adding');
        //     window.location.href='../add_product.php';
        //     </script>");
        $response["error"] = 2;
        $response["error_msg"] = " Machine already exist";
        echo json_encode($response);
    } else {

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('unknown error occurred in adding');
        //     window.location.href='../add_product.php';
        //     </script>");
        $response["error"] = 1;
        $response["error_msg"] = " Machine not inserted";
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
