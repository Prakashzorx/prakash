<?php
require_once "../controller/functions.php";
require_once "../controller/device_datatables.php";
$con = connectDM();
//$machine=$mid=$ptype=$type=$brand=$user=$store=$countryname=$statename=$cityname=[];
$query = '';
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = '`assigned_divices`.`id`'; //$_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = 'desc'; //$_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($con, $_POST['search']['value']); // Search value

## Search 
$searchQuery = " ";
if ($searchValue != '') {
    $searchQuery = " and (`machines`.`name` like '%" . $searchValue . "%' or 
    `brand_tbl`.`brand_name` like '%" . $searchValue . "%' or 
    `store`.`store_name` like'%" . $searchValue . "%' or 
    `countries`.`name` like'%" . $searchValue . "%' or 
    `states`.`name` like'%" . $searchValue . "%' or 
    `cities`.`name` like'%" . $searchValue . "%' or 
    `users`.`name` like'%" . $searchValue . "%' or 
    CONCAT(`product_type`.`name`,' ', `product_type`.`version`)  like'%" . $searchValue . "%') ";
}
$data = array();
$totalRecords = getDeviceDataCount();
$totalRecordwithFilter = getDeviceDataSearchCount($searchQuery, $query);
if (!$totalRecordwithFilter) {
    $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
    );
    echo json_encode($response);
    exit;
}


$i = 0;
$devices = [];
$devices = getDeviceRecordsTcpData($searchQuery, $columnName, $columnSortOrder, $row, $rowperpage, $query);
$i = $row;
// print_r($devices);exit;
if (!$devices) {
    $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
    );
    echo json_encode($response);
    exit;
}
foreach ($devices as $device) {
    $i++;
    // print_r($device);exit;
    // $machine = getSingleMachine($device['machine_id']);
    //$machine = getSingleMachine($id);
    $id = $mid = $type = $ptype =$brandid=$storeid=$userid=$brand = $user = $store = $countryname = $statename = $cityname = $machineid = $phone = $email = $pincode = '';
    $id = $device['id'];
    $mid = $device['ptype'];
    //$ptype = getptype($mid);



    $type = $device['ptype'];
    $mid = $device['machine_id'];
    $brandid = $device['brand_id'];
    $userid = $device['user_id'];
    $storeid = $device['store_id'];
    $brand = $device['brand_name'];
    $user = $device['user name'];
    $store = $device['store_name'];
    $countryname = $device['country'];
    $statename = $device['state'];
    $cityname = $device['city'];
    $machineid = $device['machine'];
    $phone = $device['phone'];
    $email = $device['email'];
    $pincode = $device['pincode'];

    $data[] = array(
        // "id" => $id,
        "slno" => $i,
        "action" => '<button type="submit" class="btn btn-success" onclick="viewmodel(' . $id . ')"><i class="far fa-edit"></i></button>',

        "machinenumber" => $machineid,
        "machinetype" => $type,
        "brand" => $brand,
        "user" => $user,
        "store" => $store,
        "country" => $countryname,
        "state" => $statename,
        "city" => $cityname,
        "pincode" => $pincode,
        "phone" => $phone,
        "email" => $email,

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
