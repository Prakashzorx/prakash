<?php

require_once "../controller/functions.php";

//print_r($_POST);exit; 
//SELECT `products`.`SLN`,`products`.`timestamp`,`machines`.`ptype_id`,`brand_tbl`.`brand_name`,`countries`.`name` AS `country`,`states`.`name` AS `state`,`cities`.`name` AS `city` FROM `products` JOIN `machines` ON `machines`.`name`=`products`.`SLN` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` JOIN `countries` ON `countries`.`id`=`store`.`country` JOIN `states` ON `states`.`id`=`store`.`state` JOIN `cities` ON `cities`.`id`=`store`.`city`AND `brand_tbl`.`id`='2' AND `countries`.`id`='101' AND `states`.`id`='17' AND `cities`.`id`='1551' AND `machines`.`ptype_id`='13' ORDER BY `timestamp`;
// Array
// (
//     [ptype] => 
//     [machine] => 
//     [brand] => 
//     [user] => 
//     [store] => 
//     [country] => 
//     [fromdate] => 
//     [todate] => 
// )
// if (!empty($_POST["fromdate"])) {
//     $fromdate = $_POST["fromdate"];
// } else {
//     $response["error"] = 2;
//     $response["error_msg"] = "Enter From-Date";
//     echo json_encode($response);
//     exit;
// }


// if (!empty($_POST["todate"])) {
//     $todate = $_POST["todate"];

//     $date1 = date_create($fromdate);
//     $date2 = date_create($todate);
//     $diff = date_diff($date1, $date2);
//     // echo $diff->format("%R%a days");exit;
//     //print_r($diff);exit;
//     if (($diff->d > 0 || $diff->d == 0) && $diff->invert == 0) {
//         //if (($diff->d < 8 || $diff->d == 0) && $diff->invert == 0) {
//        // } else {
//         //    $response["error"] = 2;
//         //    $response["error_msg"] = "You can enter Max 7 days";
//         //    echo json_encode($response);
//         //    exit;
//        // }
//     } else {
//         $response["error"] = 2;
//         $response["error_msg"] = "To Date should be equal or greater than From date";
//         echo json_encode($response);
//         exit;
//     }
// } else {
//     $response["error"] = 2;
//     $response["error_msg"] = "Enter To-Date";
//     echo json_encode($response);
//     exit;
// }


$query="";



if ($_POST["city"]) {
    $city = $_POST["city"];
    $query.= "AND `cities`.`id`='$city'";
}else{
    $query.="";
}

if ($_POST["state"]) {
    $state = $_POST["state"];
    $query.= "AND `states`.`id`='$state'";
}else{
    $query.="";
}

if ($_POST["country"]) {
    $country = $_POST["country"];
    $query .= "AND `countries`.`id`='$country'";
}else{
    $query.="";
}

// if ($_POST["store"]) {
//     $store = $_POST["store"];
// }
// if ($_POST["user"]) {
//     $user = $_POST["user"];
// }
if ($_POST["brand"]) {
    $brand = $_POST["brand"];
    $query.= "AND `brand_tbl`.`id`='$brand'";
}else{
    $query.="";
}
// if ($_POST["machine"]) {
//     $machine = $_POST["machine"];
// }
if ($_POST["ptype"]) {
    $ptype = $_POST["ptype"];
    $query.= "AND `machines`.`ptype_id`='$ptype'";
}else{
    $query.="";
}


$getValues=getLivemachines($query);
//print_r($getValues);exit;

// if(!empty($brand) && !empty($ptype) && !empty($country) && !empty($state) && !empty($city)){

// }else 
// if(!empty($brand) && !empty($ptype) && !empty($country) && !empty($state) && !empty($city)){

// }else
// if(!empty($brand) && !empty($ptype) && !empty($country) && !empty($state) && !empty($city)){

// }else
// if(!empty($brand) && !empty($ptype) && !empty($country) && !empty($state) && !empty($city)){

// }else
// if(!empty($brand) && !empty($ptype) && !empty($country) && !empty($state) && !empty($city)){

// }


