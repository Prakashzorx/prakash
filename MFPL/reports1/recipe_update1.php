<?php
require_once "../controller/recipe_update_functions.php";
// print_r($_POST);exit;
if(isset($_POST)){
    $recipe_version=$_POST['rversion'];
    $pre_heating_temp=$_POST['heatingtemp'];
    $sleep_time_Temp=$_POST['temp1'];
    $sleep_time=$_POST['sleeptime'];
    $deep_sleep_time=$_POST['deepsleep'];
    // print_r($_POST);exit;
    $x = recipe_update_query($recipe_version,$pre_heating_temp,$sleep_time_Temp,$sleep_time,$deep_sleep_time);
    if($x==0){
        $response["error"] = 0;
        $response["error_msg"] = " Recipe version added successfully ";
        echo json_encode($response);

    }else if($x==2){
        $response["error"] = 2;
        $response["error_msg"] = " Not Inserted";
        echo json_encode($response);
    }
    else if($x==3) {
        $response["error"] = 3;
        $response["error_msg"] = " Recipe version already exist";
        echo json_encode($response);
    }
}