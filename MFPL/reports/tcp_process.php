<?php

require_once "../controller/tcp_function.php";

//   print_r($_POST);
//   exit;
$data = [];
$imei = $_POST['0']['imei'];
$alarm = $_POST['1']['alarm'];
$fromdate = $_POST['2']['fromdate'];
$todate = $_POST['3']['todate'];
//  print_r($imei);
//   exit;
$query = "";
if (!empty($fromdate)) {
    $fromdate = $fromdate;
} else {
    $response["error"] = 2;
    $response["error_msg"] = "Enter From-Date";
    echo json_encode($response);
    exit;
}


if (!empty($todate)) {
    $todate = $todate;

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
        $query .= "AND `rct_timestamp` BETWEEN '$fromdate' AND '$todate'";
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





if ($imei) {
    $imei = $imei;
    $query .= "AND `imei`='$imei'";
} else {
    $query .= "";
}

if ($alarm) {
    $alarm = $alarm;
    $query .= "AND `alarm_type`='$alarm'";
} else {
    $query .= "";
}


## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = 'desc';//$_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($con, $_POST['search']['value']); // Search value

## Search 
$searchQuery = " ";
if ($searchValue != '') {
    $searchQuery = " and (rct_timestamp like '%" . $searchValue . "%' or 
        imei like '%" . $searchValue . "%' or 
        temp like'%" . $searchValue . "%' or 
        battery_voltage like'%" . $searchValue . "%' or 
        wifi like'%" . $searchValue . "%'  or 
        alarm_type like'%" . $searchValue . "%'  or 
        wifistatus like'%" . $searchValue . "%') ";
}

## Total number of records without filtering
// $sel = mysqli_query($con, "select count(*) as allcount from employee"); 
// $records = mysqli_fetch_assoc($sel);
$totalRecords = getTcpDataCount();
// print_r($totalRecords);exit; 
## Total number of record with filtering
// $sel = mysqli_query($con, "select count(*) as allcount from employee WHERE 1 " . $searchQuery);
// $records = mysqli_fetch_assoc($sel);
//$totalRecordwithFilter = $records['allcount'];
//print_r($searchQuery);exit; 
// print_r($query);exit; 

$totalRecordwithFilter = getTcpDataSearchCount($searchQuery, $query);
//print_r($totalRecordwithFilter);exit; 

## Fetch records
// $empQuery = "select * from tcpdata  where startbits='TZ' " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
// // print_r($empQuery);exit;
// $empRecords = mysqli_query($con, $empQuery);
$data = array();
$empRecords = getRecordsTcpData($searchQuery, $columnName, $columnSortOrder, $row, $rowperpage, $query);
$i = 0;
foreach ($empRecords as $row1) {
    // print_r($row1);exit;
    $date=$row1['rct_timestamp'];
    $time = strtotime($date);
    //$time=$time+19800;
    $dateInLocal = date("Y-m-d H:i:s", $time);
    // print_r($date);
    // print_r($time);
    // print_r($dateInLocal);exit;
    $at = $row1['alarm_type'];
    if (strcmp($at, 'aa') == 0) {
        $alarm_type = 'Interval Data';
    } else
    if (strcmp($at, '10') == 0) {
        $alarm_type = 'Low Battery Alarm';
    } else
    if (strcmp($at, 'a0') == 0) {
        $alarm_type = 'Temperature Over Threshold';
    } else
    if (strcmp($at, 'a1') == 0) {
        $alarm_type = 'Temperature sensor abnormal';
    } else
    if (strcmp($at, '61') == 0) {
        $alarm_type = 'External Power Disconnected';
    }
    $data[] = array(
        "rct_timestamp" => $dateInLocal,
        "imei" => $row1['imei'],
        "alarm_type" => $alarm_type,
        "wifi" => $row1['wifi'],
        "status" => $row1['wifistatus'],
        "temp" => $row1['temp'],
        "bv" => $row1['battery_voltage'],

    );
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
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
// $query = "";
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
//     // print_r($diff);exit;
//     if (($diff->d > 0 || $diff->d == 0) && $diff->invert == 0) {
//         // if (($diff->d < 8 || $diff->d == 0) && $diff->invert == 0) {
//         // } else {
//         //     $response["error"] = 2;
//         //     $response["error_msg"] = "You can enter Max 7 days";
//         //     echo json_encode($response);
//         //     exit;
//         // } 
//         $query .= "`rct_timestamp` BETWEEN '$fromdate' AND '$todate'";
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





// if ($_POST["imei"]) {
//     $imei = $_POST["imei"];
//     $query .= "AND `imei`='$imei'";
// } else {
//     $query .= "";
// }

// if ($_POST["alarm"]) {
//     $alarm = $_POST["alarm"];
//     $query .= "AND `alarm_type`='$alarm'";
// } else {
//     $query .= "";
// }




// // $j = 0;
// // $dates[0] = $fromdate;
// // for ($k = 1; $k < ($diff->days) + 1; $k++) {

// //     $dates[$k] = date('Y-m-d', strtotime("+1 day", strtotime($dates[$j])));
// //     $j++;
// // }
// //print_r($dates);exit;

// $j = 0;

// // $count = 0;
// // foreach ($dates as $date) {
// // print_r($query);exit;
// $count = gettcpcount($query);
// // print_r($count);exit;
// foreach ($count as $date) {
//     $product[$j] = $date;
//     $j++;
// }

// // print_r($product);exit;
// $response["error"] = 0;
// $response["result"] = $product;
// // $response["dates"] = $dates;

// echo json_encode($response);
// exit;
