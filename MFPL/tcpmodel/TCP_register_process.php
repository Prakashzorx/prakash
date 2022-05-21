<?php
require_once "../controller/recipe_update_functions.php";
// print_r($_POST);exit;
if(isset($_POST)){

    $imei = $_POST['imei'];
    $machine_type = $_POST['tcp_machine_type'];
    $tcp_sr = $_POST['tcp_sr'];
    $tcp_instaldate = $_POST['tcp_instaldate'];

    $tcp_low_threshold =$_POST['tcp_low_threshold'];
    $tcp_high_threshold =$_POST['tcp_high_threshold'];

    $x=tcp_register_function($imei,$machine_type,$tcp_sr,$tcp_instaldate,$tcp_low_threshold,$tcp_high_threshold);
    // print_r($x);exit;
    if ($x == 0) {
        // user already existed
    
        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1'; 
        //     </script>");
        $response["error"] = 0;
        $response["error_msg"] = "TCP Registered successfuly";
        echo json_encode($response);
        exit;
    }else if($x==2) {
        // user already existed
    
        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1';
        //     </script>");
        $response["error"] = 2;
        $response["error_msg"] = "TCP Not Registered";
        echo json_encode($response);
        exit;
    }

    else {
        // user already existed
    
        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1';
        //     </script>");
        $response["error"] = 3;
        $response["error_msg"] = "IMEI Number already taken";
        echo json_encode($response);
         exit;
    }
}