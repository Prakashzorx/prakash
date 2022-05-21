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
$query1 = '';
$getValues = getErrorCountBrandWise($query, $query1, $date);
$i = 0;
$k = 0;
$brands[0] = '';
$s = 0;
foreach ($getValues as $value) {
    //$count[$i]=$value['COUNT'];
    //$errorcode[$i]=$value['rcpercd'];
    $x = strcmp($brands[$s - 1], $value['brand_name']);
    //print_r($x);
    if ($x == 0) {
        //$brand[$s]=$value['brand_name'];

    } else {
        $brands[$s] = $value['brand_name'];
        $s++;
    }

    $i++;
}

$errcode[] = '';
$s = 0;
foreach ($getValues as $value) {
    //$count[$i]=$value['COUNT'];
    //$errorcode[$i]=$value['rcpercd'];
    //$x = ;
    //print_r($x);
    if (in_array($value['rcpercd'], $errcode)) {
        //$brand[$s]=$value['brand_name'];

    } else {
        $errcode[$s] = $value['rcpercd'];
        $s++;
    }

    $i++;
}
//print_r($getValues);
//print_r($errcode);
// // print_r($brands);
// // exit;
// $value1[] = '';
// $i = 0;
// foreach ($brands as $brand) {

//     $k = 0;
//     foreach ($errcode as $code) {
//         $j = 0;
//         foreach ($getValues as $value) {


//             if (strcmp($brand, $value['brand_name']) == 0) {
//                 if (strcmp($code, $value['rcpercd']) == 0) {

//                     $value1[$i][$k]['name'] = $value['rcpercd'];
//                 }
//             }
//             $j++;
//         }
//         $k++;
//     }
//     $i++;
// }

//print_r($value1);
//print_r($brands);
//exit;







//$errorcodes = ['E1', 'E10', 'E11', 'E12', 'E2', 'E3', 'E4', 'E5', 'E6', 'E7', 'E8', 'E9','0','1','2','3','4','5'];



$i = 0;
foreach ($getValues as $value) {
    $k = 0;
    foreach ($errcode as $ec) {
        // print_r($ec);
        // exit;
        //$value1[$k]['data']=["0","0"];
        
        $l = 0;#s=0;
        foreach ($brands as $brand) {
           
            if (strcmp($ec, $value['rcpercd']) == 0) {
                if (strcmp($brand, $value['brand_name']) == 0) {
                    //print_r($value['rcpercd'].'\n');
                    // print_r($value['brand_name'].'\n');
                    // print_r($value['COUNT'].'\n');
                    $value1[$k]['name'] = $value['rcpercd'];
                    $value1[$k]['data'][$l] = $value['COUNT'];
                    
                } 
               
            }
            if(empty($value1[$k]['data'][$l])){
                $value1[$k]['data'][$l]="0";
            } 
            $l++;
           
        }
        $k++;
    }
    $i++;
}

// print_r($value1);
// print_r($brands);
// exit;

// $k = 0;
// foreach ($brands as $brand) {
//     $i = 0;
//     foreach ($getValues as $value) {

//         if (strcmp($brand, $value['brand_name']) == 0) {
//             $count[$k][$i] = $value['COUNT'];
//             $errorcode[$k][$i] = $value['rcpercd'];


//             $i++;
//         }
//     }
//     $k++;
// }


// print_r($count);
// print_r($errorcode);
// print_r($brand);
// exit;

//print_r($dates);`date` BETWEEN '2022-01-04' AND '2022-01-12'
$response["error"] = 0;
$response["value"] = $value1;
//$response["errorcode"] = $errorcode;
$response["brand"] = $brands;
echo json_encode($response);
exit;
