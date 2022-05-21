<?php


require_once "../controller/tcp_function.php";

//   print_r($_POST);
//   exit;
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
    // print_r($diff);exit;
    if (($diff->d > 0 || $diff->d == 0) && $diff->invert == 0) {
        // if (($diff->d < 8 || $diff->d == 0) && $diff->invert == 0) {
        // } else {
        //     $response["error"] = 2;
        //     $response["error_msg"] = "You can enter Max 7 days";
        //     echo json_encode($response);
        //     exit;
        // } 
        $todate=date('Y-m-d', strtotime("+1 day", strtotime($todate))); 
        $query .= "`rct_timestamp` BETWEEN '$fromdate' AND '$todate'";
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





if ($_POST["imei"]) {
    $imei = $_POST["imei"];
    $query .= "AND `imei`='$imei'";
} else {
    $query .= "";
}

if ($_POST["alarm"]) {
    $alarm = $_POST["alarm"];
    $query .= "AND `alarm_type`='$alarm'";
} else {
    $query .= "";
}




// $j = 0;
// $dates[0] = $fromdate;
// for ($k = 1; $k < ($diff->days) + 1; $k++) {

//     $dates[$k] = date('Y-m-d', strtotime("+1 day", strtotime($dates[$j])));
//     $j++;
// }
//print_r($dates);exit;

$j = 0;
$items=[];
// $count = 0;
// foreach ($dates as $date) {
// print_r($query);exit;
$count = gettcpcount($query);
// print_r($count);exit;
foreach ($count as $date) {
    $items[$j] = $date;
    $j++;
}

$j = 0;

// $count = 0;
// foreach ($dates as $date) {
// print_r($query);exit;
$count = gettcpcount($query);
// print_r($count);exit;
foreach ($count as $date) {
    $product[$j] = $date;
    $j++;
}

// print_r($product);exit;
$response["error"] = 0;
$response["result"] = $product;
// $response["dates"] = $dates;
echo json_encode($response);
exit;
?>