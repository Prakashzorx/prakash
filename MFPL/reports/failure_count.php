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
        $todate=date('Y-m-d', strtotime("+1 day", strtotime($todate)));
        $query .= "AND  `rcpdata`.`timestamp` BETWEEN '$fromdate' AND '$todate'";
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
// if ($_POST["machine"]) {
//     $machine = $_POST["machine"];
//     $query .= "AND `machines`.`id`='$machine'";
// }else {
//     $query .= "";
// }
if ($_POST["ptype"]) {
    $ptype = $_POST["ptype"];
    $query .= "AND `machines`.`ptype_id`='$ptype'";
} else {
    $query .= "";
}
//print_r($query);exit;

$getValues = getFailureCounts($query);
//print_r($getValues);
//exit;



//$brands = getUniqueBrands();


//$i=0;
//foreach ($brands as $brand) {
    $j = 0; 
    foreach ($getValues as $value) {


        //if (strcmp($brand['brand_name'],$value['brand_name'])==0) {

            $count[$j]= $value['count'];
            $brandlist[$j]= $value['brand_name'];
            $j++;
        //}
    }
   // $ecc[$i]=$eccc;
   // $brandlist[$i]=$brand['brand_name'];
   // $i++;

//}


///print_r($brands);
//print_r($ecc);
//exit;
$response["error"] = 0;
$response["count"] = $count;
$response["brands"] = $brandlist;
echo json_encode($response);
exit;
