<?php

require_once "../controller/functions.php";


// print_r($_POST);

$id=0;
$version=0;
$Heat_temp=0;
$V_Temp=0;
$Sleep_time=0;
$Deep_sleep=0;
$Ver_Id=0;



if(isset($_POST)){

$value=$_POST['idvalue'];
$version=$value['version'];
    // print_r($_POST['idvalue']);exit;
// print_r($version);exit;


if(!empty($version['id5'])){
    $id=$version['id5'];
}
// print_r($id);exit;

if(!empty($version['vrversion'])){
    $versionn =$version['vrversion'];
}


if(!empty($version['heatingtemp'])){
    $Heat_temp =$version['heatingtemp'];
}


if(!empty($version['vtemp1'])){
    $V_Temp = $version['vtemp1'];
}
    // print_r($V_Temp);


if(!empty($version['vsleeptime'])){
    $Sleep_time = $version['vsleeptime'];
}


if(!empty($version['deepsleep'])){
    $Deep_sleep = $version['deepsleep'];
}


if(!empty($version['version_id'])){
    $Ver_Id =$version['version_id'];
}


    $rcp_upD = rcpUpdate_details($id,$versionn,$Heat_temp,$V_Temp,$Sleep_time, $Deep_sleep,$Ver_Id);
    // print_r($rcp_upD);exit;
    if ($rcp_upD == 0) {
        // user already existed

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1';--------------------------
        //     </script>");
        $response["error"] = 0;
        $response["error_msg"] = "Portions Updated ";
        echo json_encode($response);
    } else if ($rcp_upD == 2) {

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('unknown error occurred in adding');
        //     window.location.href='../add_product.php';
        //     </script>");
        $response["error"] = 2;
        $response["error_msg"] = "Portions already updated";
        echo json_encode($response);
    }


  




    
}
