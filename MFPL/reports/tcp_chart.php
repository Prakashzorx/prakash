<?php

require_once "../controller/tcp_function.php";
require_once "../controller/functions.php";
require_once "../controller/device_datatables.php";

$con = connect();
//   print_r($_POST);
//   exit;

$low_tcp_threshold ="";
$high_tcp_threshold ="";


$data = [];
$imei = $_POST['imei'];
$alarm = $_POST['alarm'];
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
//  print_r($imei);
//   exit;
$query = "";
if (!empty($fromdate)) {
    
} else {
    $response["error"] = 2;
    $response["error_msg"] = "Enter From-Date";
    echo json_encode($response);
    exit;
}


if (!empty($todate)) {
   

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
  
    $query .= "AND `imei`='$imei'";
    $tcpthresholds= gettcpthresholds($imei);
    //$tcpthresholds =$tcpthreshold[1];
foreach($tcpthresholds as $rowt)
{
$low_tcp_threshold = $rowt['tcp_low_threshold'];
$high_tcp_threshold = $rowt['tcp_high_threshold'];
}


} else {
    $query .= "";
}

if ($alarm) {
   
    $query .= "AND `alarm_type`='$alarm'";
} else {
    $query .= "";
}


$time=0;
$data = array();
$empRecords = getRcpGraphData($query);
$i = 0;$response=[];
foreach ($empRecords as $row1) {
    // print_r($row1);
    $date=$row1['rct_timestamp'];
    $time = strtotime($date);
    $time=$time+19800;
    $dateInLocal = date("Y-m-d H:i:s", $time);
    $response['dateInLocal'][$i] = $dateInLocal;

    $response['temp'][$i]= round($row1['temp'],2);
   
    // print_r($temp);exit;

    $i++;


    // print_r($date);
    // print_r($time);
    // print_r($dateInLocal);exit;
}
$response['tcp_low_threshold']= $low_tcp_threshold;
$response['tcp_high_threshold']= $high_tcp_threshold;

## Response
// $response = array(
    
//     "temp" => $temp,
//     "date" => $dateInLocal
//     // "iTotalDisplayRecords" => $totalRecordwithFilter,
//     // "aaData" => $data
// );

echo json_encode($response);
exit;