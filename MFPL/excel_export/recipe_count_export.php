<?php
// Load the database configuration file 
require_once "../controller/functions.php";
// echo "hi";exit;
// Filter the excel data 
//print_r($_POST);exit;
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
        $query .= "AND `date` BETWEEN '$fromdate' AND '$todate'";
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

// $ptype=$_POST['ptype'];
// $machine=$_POST['machine'];
// $brand=$_POST['brand'];
// $user=$_POST['user'];
// $store=$_POST['store'];
// $country=$_POST['country'];
// $state=$_POST['state'];
// $city=$_POST['city'];
// $fromdate=$_POST['fromdate'];
// $todate=$_POST['todate'];
//print_r($_POST);exit;
function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

$file_name = "customers_data.xls";
header("Content-Disposition: attachment; filename=\"$file_name\"");
header("Content-Type: application/vnd.ms-excel");

// Column names 

    $fields = array('#', 'recipe type', 'recipe count', 'date');

    //$fields = array('#', 'recipe type', 'recipe count', 'date');



// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n";

// Fetch records from database 
$result = getCountReport($query);

$unique = getUniqueRecepeType();
//print_r($unique);exit;
$j = 0;
if (!empty($result)) {
    foreach ($result as $value) {
        //if($unirecipe['rcptype']==$value['rectype']){
        //  $product[$i]['name'] = $value['rectype'];


        if (!in_array($value['date'], $dates) && !empty($value['date'])) {

            $dates[$j] = $value['date'];
            $j++;
        }

        //}
        // print_r($product[$i]['name']);exit;
    }
    $i = 0;
    $dates[] = "";

    foreach ($unique as $unirecipe) {
        // print_r($unirecipe);

        $j = 0;


        foreach ($dates as $date) {
            //print_r($date);
            $k = 0;
            $product_data = 0;
            foreach ($result as $value) {
                //if($unirecipe['rcptype']==$value['rectype']){
                $product[$i]['name'] = $unirecipe['rcptype'];
                if ($date == $value['date'] && $unirecipe['rcptype'] == $value['rectype']) {
                    $product_data += $value['rc'];
                    $product[$i]['data'][$j] = $product_data;
                    $lineData = array($k, $product[$i]['name'], $product[$i]['data'][$j], $date);
                    array_walk($lineData, 'filterData');
                    $excelData .= implode("\t", array_values($lineData)) . "\n";
                }


                $k++;
                //}
                // print_r($product[$i]['name']);exit;
            }


            $j++;
        }
        $i++;
    }
} else {
    $excelData .= 'No records found...' . "\n";
}



// Render excel data 
//echo $excelData;
//print_r($result);exit;
exit;

?>
