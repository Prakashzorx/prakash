<?php
require_once "../controller/recipe_update_functions.php";
// print_r($_POST);exit;

$tcp_pri_user=0;
$tcp_store=0;
if(isset($_POST)){


    if(isset($_POST['tcp_machineid'])){
        $tcp_machineid = $_POST['tcp_machineid'];

    }

   

    if(isset($_POST['brand'])){
        $tcp_brand = $_POST['brand'];

    }

   
    if(isset($_POST['store'])){
        $tcp_store = $_POST['store'];
    }

    $i=0;
    if(!empty($_POST['user'])){
        $users[$i]=$_POST['user'];
        $i++;
    }
    if(!empty($_POST['useropt1'])){
        $users[$i]=$_POST['useropt1'];
        $i++;
    }
    if(!empty($_POST['useropt2'])){
        $users[$i]=$_POST['useropt2'];
        $i++;
    }
// print_r($users);exit; 
    foreach ($users as $user) {
        $x = assignTCPDevice($tcp_machineid, $tcp_brand, $user, $tcp_store);
        //echo($x);exit;
       
    }

    // $x=assignTCPDevice($tcp_machineid,$tcp_brand,$tcp_pri_user,$tcp_store);
    // print_r($x);
    if ($x == 0) {
        // user already existed
    
        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1';
        //     </script>");
        $response["error"] = 0;
        $response["error_msg"] = "TCP Device Assigned successfuly";
        echo json_encode($response);
    }else if($x==2) {
        // user already existed
    
        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1';
        //     </script>");
        $response["error"] = 2;
        $response["error_msg"] = "TCP Device Not Registered";
        echo json_encode($response);
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
        // exit;
    }
}