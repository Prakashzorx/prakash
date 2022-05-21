<?php
require_once   "../controller/device_datatables.php";
require_once "../controller/tcp_function.php";
$con = connect();
//   print_r($_POST);
//   exit;

$data = [];
$uid = $_POST['userid'];
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
        $todate = date('Y-m-d', strtotime("+1 day", strtotime($todate)));
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
} else {
    $ptypes = [];
    //print_r($uid);
    $ptypes = gettcpdata_ses($uid);
    //print_r($ptypes);exit;  
    $x = 0;
    foreach ($ptypes as $type) {
        $imeis = $type['imei'];
        if ($x == 0) {
            $query .= "AND `imei`='$imeis'";
        } else {
            $query .= "OR `imei`='$imeis'";
        }
        $x++;
    }
    // $query .= "";
}

if ($alarm) {

    $query .= "AND `alarm_type`='$alarm'";
} else {
    $query .= "";
}



$data = array();
$empRecords = getRcpGraphData($query);
$response = [];

//print_r($row1);
$ptypes = [];
//print_r($uid);
$ptypes = gettcpdata_ses($uid);
//print_r($ptypes);exit;  
$x = 0;
foreach ($ptypes as $type) {
    $imeis = $type['imei'];
    $i = 0;
    foreach ($empRecords as $row1) {

        // if ($imeis == $row1['imei']) {
        //     $date = $row1['rct_timestamp'];
        //     $time = strtotime($date);
        //     $time = $time + 19800;
        //     $response['dateInLocal'][$imeis][$i] = date("Y-m-d H:i:s", $time);

        //     $response['temp'][$imeis][$i] = round($row1['temp'], 2);
        //     $i++;
        // }

              $date = $row1['rct_timestamp'];
            $time = strtotime($date);
            $time = $time + 19800;
            $response['dateInLocal'][$i] = date("Y-m-d H:i:s", $time);

            $response['temp'][$i] = round($row1['temp'], 2);
            $i++;
      
    }
    $response['imei'][$x] = $imeis;
    $x++;

    // print_r($temp);exit;




    // print_r($date);
    // print_r($time);
    // print_r($dateInLocal);exit;
}

## Response
// $response = array(

//     "temp" => $temp,
//     "date" => $dateInLocal
//     // "iTotalDisplayRecords" => $totalRecordwithFilter,
//     // "aaData" => $data
// );

echo json_encode($response);
exit;
