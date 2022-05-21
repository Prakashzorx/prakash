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
        //$query .= "AND `date` BETWEEN '$fromdate' AND '$todate'";
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





if ($_POST["city"]) {
    $city = $_POST["city"];
    $query .= "AND `store`.`city`='$city'";
} else {
    $query .= "";
}

if ($_POST["state"]) {
    $state = $_POST["state"];
    $query .= "AND `store`.`state`='$state'";
} else {
    $query .= "";
}

if ($_POST["country"]) {
    $country = $_POST["country"];
    $query .= "AND `store`.`country`='$country'";
} else {
    $query .= "";
}

if ($_POST["store"]) {
    $store = $_POST["store"];
    $query .= "AND `store`.`id`='$store'";
} else {
    $query .= "";
}
if ($_POST["user"]) {
    $user = $_POST["user"];
    $query .= "AND `users`.`user_id`='$user'";
} else {
    $query .= "";
}
if ($_POST["brand"]) {
    $brand = $_POST["brand"];
    $query .= "AND `brand_tbl`.`id`='$brand'";
} else {
    $query .= "";
}
if ($_POST["machine"]) {
    $machine = $_POST["machine"];
    $query .= "AND `machines`.`id`='$machine'";
} else {
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
for ($k = 1; $k < ($diff->days)+1; $k++) {

    $dates[$k] = date('Y-m-d', strtotime("+1 day", strtotime($dates[$j])));
    $j++;
}
//print_r($dates);exit;


//print_r($diff->days);exit;
$j = 0;
$todate1=date('Y-m-d H:i:s', strtotime($todate));
$fromdate1 = date('Y-m-d H:i:s', strtotime($todate));
$hourly[0] = date('Y-m-d H:i:s', strtotime($fromdate));
if($diff->days<=3){
    $kk=$diff->days+1;
    for ($k = 1; $k < ($kk* 24); $k++) {

        $hourly[$k] = date('Y-m-d H:i:s', strtotime("+1 hour", strtotime($hourly[$j])));
        $j++;
    }
}

//print_r($hourly);exit;

$j = 0;

$threehourly[0] = date('Y-m-d H:i:s', strtotime($fromdate));
for ($k = 1; $k < ($diff->days * 8) ; $k++) {

    $threehourly[$k] = date('Y-m-d H:i:s', strtotime("+3 hour", strtotime($threehourly[$j])));
    $j++;
}
//print_r($threehourly);exit;
$j = 0;
$todate5=date('Y-m-d', strtotime($todate));
$fromdate5 = date('Y-m-d', strtotime("-7 days", strtotime($todate5)));
$sevendays[0] = date('Y-m-d', strtotime($fromdate5));
for ($k = 1; $k < 7; $k++) {

    $sevendays[$k] = date('Y-m-d', strtotime("+1 day", strtotime($sevendays[$j])));
    $j++;
}
//print_r($sevendays);exit;
$j = 0;
$m=$diff->days%7;
//print_r($m);exit;
if($m==0){
    $t=$diff->days/7;
}else{
    $t=($diff->days/7)+1;
}
$todate2=date('Y-m-d H:i:s', strtotime($todate));
//$fromdate2 = date('Y-m-d H:i:s', strtotime("-28 days", strtotime($todate2)));
$fromdate2 = date('Y-m-d H:i:s', strtotime($fromdate));
$weekly[0] = date('Y-m-d H:i:s', strtotime($fromdate2));
$weekly[1] = date('Y-m-d H:i:s', strtotime("+$m day", strtotime($weekly[$j])));
$j++;
for ($k = 2; $k < $t; $k++) {

    $weekly[$k] = date('Y-m-d H:i:s', strtotime("+7 day", strtotime($weekly[$j])));
    $j++;
}
// if($m>0){
    
// }else{
//     $weekly[$k++] = date('Y-m-d H:i:s', strtotime("+7 day", strtotime($weekly[$j])));
// }
// $j = 0;
// $todate3=date('Y-m-d H:i:s', strtotime($todate));
// $fromdate3 = date('Y-m-d H:i:s', strtotime("-1 year", strtotime($todate3)));
// $monthly[0] = date('Y-m', strtotime($fromdate3));
// for ($k = 1; $k < 13; $k++) {

//     $monthly[$k] = date('Y-m', strtotime("+1 month", strtotime($monthly[$j]))); 
//     $j++;
// }
 

$j = 0;
$m=$diff->m+1;$s=$diff->m;
//print_r($m);exit;
$todate3=date('Y-m-d H:i:s', strtotime($todate));
//$fromdate3 = date('Y-m-d H:i:s', strtotime("-$s month", strtotime($todate3)));
$fromdate3 = date('Y-m-d H:i:s', strtotime($fromdate));
$monthly[0] = date('Y-m', strtotime($fromdate3));
for ($k = 1; $k < $m; $k++) {

    $monthly[$k] = date('Y-m', strtotime("+1 month", strtotime($monthly[$j]))); 
    $j++;
}

  
$j = 0;

$count = 0;
foreach ($dates as $date) {

    $count = getRecipeCountReport($query, $date);

    $product[$j] = $count[1]['count'];
    $j++;
}

$j = 0;
$count = 0;
foreach ($sevendays as $date) {

    $count = getRecipeCountReport($query, $date);

    $productsevendays[$j] = $count[1]['count'];
    $j++;
}
//print_r($sevendays);
//print_r($productsevendays);exit;
$j = 0;

$count = 0;
if($diff->days<=3){
foreach ($hourly as $hour) {
    //print_r($hour);

    $hourwise = date('Y-m-d H', strtotime($hour));
    //print_r($hourwise);
    $count = getRecipeCountReport($query, $hourwise);

    $producthourly[$j] = $count[1]['count'];
    $j++;
}
}
//exit;
//print_r($producthourly);exit;

$j = 0;

$count = 0;
foreach ($threehourly as $hour) {
   
    $hour1 = date('Y-m-d H', strtotime("+3 hour", strtotime($hour)));
    $threehourwise = "AND `timestamp` BETWEEN '$hour' AND '$hour1'";
    $count = getRecipeCountReportWeekly($query, $threehourwise);

    $productthreehourly[$j] = $count[1]['count'];
    $j++;
}
//print_r($productthreehourly);exit;

 
$j = 0;

$count = 0;
$m=$diff->days%7;
//print_r($m);exit;
if($m==0){
    $t=$diff->days/7;
}else{
    $t=($diff->days/7)+1;
}
$mm=$m-1;
//print_r($weekly);//exit;
foreach ($weekly as $week) {
    $hourwise = '';
    if($j=='0'){
        $week1 = date('Y-m-d H:i:s', strtotime("+$mm day", strtotime($week)));
        $weekwise = "AND `rcpdata`.`timestamp` BETWEEN '$week' AND '$week1'";
       // print_r($weekwise);
        $count = getRecipeCountReportWeekly($query, $weekwise);
    
        $productweekly[$j] = $count[1]['count'];
        $j++;
    }else{
        $week1 = date('Y-m-d H:i:s', strtotime("+6 day", strtotime($week)));
        $weekwise = "AND `rcpdata`.`timestamp` BETWEEN '$week' AND '$week1'";
       // print_r($weekwise);
        $count = getRecipeCountReportWeekly($query, $weekwise);
    
        $productweekly[$j] = $count[1]['count'];
        $j++;
    }
   
}
//print_r($productweekly);exit;


$j = 0;

$count = 0;
foreach ($monthly as $month) {
    $hourwise = '';

    //$month1 = date('Y-m', strtotime("+1 month", strtotime($month)));
    //$weekwise = "AND `timestamp` BETWEEN '$week' AND '$week1'";
    $count = getRecipeCountReport($query, $month);

    $productmonthly[$j] = $count[1]['count'];
    $j++;
}
//print_r($monthly);
//print_r($productmonthly);
//exit;

$response["error"] = 0;
$response["error_msg"] = $product;
$response["dates"] = $dates;
$response["hourlywiserc"] = $producthourly;
$response["hourly"] = $hourly;
$response["weeklywiserc"] = $productweekly;
$response["weekly"] = $weekly;
$response["monthlywiserc"] = $productmonthly;
$response["monthly"] = $monthly;
// $response["productthreehourly"] = $productthreehourly;
$response["threehourly"] = $threehourly;
// $response["productsevendays"] = $productsevendays;
$response["sevendays"] = $sevendays;
echo json_encode($response);
exit;
