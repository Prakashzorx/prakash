<?php 
// Load the database configuration file 
require_once "../controller/functions.php";
// echo "hi";exit;
// Filter the excel data 

// Filter Customer Data
function filterCustomerData(&$str) {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"'))
        $str = '"' . str_replace('"', '""', $str) . '"';
}

// File Name & Content Header For Download
$file_name = "customers_data.xls";
header("Content-Disposition: attachment; filename=\"$file_name\"");
header("Content-Type: application/vnd.ms-excel");
 
// Column names 
$fields = array('ID', 'Machine number', 'Days', 'Brand', 'City', 'State', 'Country', 'Product Type'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$result = getLivemachines();
$i = 0;
 //print_r($result);exit;

if(!empty($result[1])) {
    // Output each row of the data 
    foreach ($result as $row) {
        $i++;
    
        $ptype_name=getptype($row['ptype_id']);
//print_r($ptype_name);exit;
        //$status = ($row['status'] == 1)?'Active':'Inactive'; 
        $lineData = array($i, $row['SLN'], $row['timestamp'], $row['brand_name'], $row['city'], $row['state'], $row['country'], $ptype_name['name'].' '.$ptype_name['version']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 

 
// Render excel data 
echo $excelData; 
 
exit;