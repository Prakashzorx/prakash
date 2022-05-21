<?php

require_once "../controller/functions.php";

//print_r($_POST);exit;

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
$query = "";
if (!empty($_POST["fromdate"])) {
    $fromdate = $_POST["fromdate"];
} else {
    $response["error"] = 2;
    $response["error_msg"] = "Enter From-Date";
    echo json_encode($response);
    exit;
}


if (!empty($_POST["todate"])) {
    $todate = $_POST["todate"];

    $date1 = date_create($fromdate);
    $date2 = date_create($todate);
    $diff = date_diff($date1, $date2);
    // echo $diff->format("%R%a days");exit;
    //print_r($diff);exit;
    if (($diff->d > 0 || $diff->d == 0) && $diff->invert == 0) {
        // if (($diff->d < 8 || $diff->d == 0) && $diff->invert == 0) {
        // } else {
        //     $response["error"] = 2;
        //     $response["error_msg"] = "You can enter Max 7 days";
        //     echo json_encode($response);
        //     exit;
        // } 
        //$query .= "AND `timestamp` BETWEEN '$fromdate' AND '$todate'";
    } else {
        $response["error"] = 2;
        $response["error_msg"] = "To Date should be equal or greater than From date";
        echo json_encode($response);
        exit;
    }
} else {
    $response["error"] = 2;
    $response["error_msg"] = "Enter To-Date";
    echo json_encode($response);
    exit;
}





// if ($_POST["city"]) {
//     $city = $_POST["city"];
//     $query .= "AND `store`.`city`='$city'";
// } else {
//     $query .= "";
// }

// if ($_POST["state"]) {
//     $state = $_POST["state"];
//     $query .= "AND `store`.`state`='$state'";
// } else {
//     $query .= "";
// }

// if ($_POST["country"]) {
//     $country = $_POST["country"];
//     $query .= "AND `store`.`country`='$country'";
// } else {
//     $query .= "";
// }

// if ($_POST["store"]) {
//     $store = $_POST["store"];
//     $query .= "AND `store`.`id`='$store'";
// } else {
//     $query .= "";
// }
// if ($_POST["user"]) {
//     $user = $_POST["user"];
//     $query .= "AND `users`.`user_id`='$user'";
// } else {
//     $query .= "";
// }
if ($_POST["brand"]) {
    $brand = $_POST["brand"];
    $query .= "AND `brand_tbl`.`id`='$brand'";
} else {
    $query .= "";
}
if ($_POST["machine"]) {
    $machine = $_POST["machine"];
    $query .= "AND `machines`.`id`='$machine'";
}else {
    $query .= "";
}
if ($_POST["ptype"]) {
    $ptype = $_POST["ptype"];
    $query .= "AND `machines`.`ptype_id`='$ptype'";
} else {
    $query .= "";
}
//print_r($query);exit;
$j = 0;
$dates[0] = $fromdate;
for ($k = 1; $k < $diff->days; $k++) {

    $dates[$k] = date('Y-m-d', strtotime("+1 day", strtotime($dates[$j])));
    $j++;
}


$i=0;
foreach($dates as $date){
    $result = getEndCleaningCounter($query,$date);
    $getValues[$i]=$result[1];
    $i++;
}

//print_r($getValues);
//exit;

$j = 0; 
foreach ($getValues as $value) {

    if(!empty($value)){
        if (in_array($value['brand_name'],$brandlist)==0) {

            //$count[$j]= $value['count'];
            $brandlist[$j]= $value['brand_name'];
            $j++;
        }
    }
    
}
//$brands = getUniqueBrands();
//print_r($brandlist);

$i=0;
foreach ($brandlist as $brand) {
    $j = 0; $eccc=0;
    foreach ($getValues as $value) {
       // print_r($value);exit;

        if (strcmp($brand,$value['brand_name'])==0) {

            $eccc+= 1;
            
        }
    }
    $ecc[$i]=$eccc;
    
    $i++;

}


// print_r($brandlist);
// print_r($ecc);
// exit;
$response["number_of_days"]=$diff->days;
$response["error"] = 0;
$response["ecc"] = $ecc;
$response["brands"] = $brandlist;
echo json_encode($response);
exit;
