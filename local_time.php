<?php
echo "hi";

$servername = "localhost";
$username = "root";
$password = "Mukunda@123";
$dbname = "test";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT * FROM `rawdata` WHERE 1";
//print_r($sql);exit;
$i = 0;
$data = mysqli_query($conn, $sql);
if ($data) {
    while ($row = mysqli_fetch_assoc($data)) {
        $i++;

        $id=$row['id'];
        $time=$row['time'];
       // print_r($row['time']);
       // exit;
        date_default_timezone_set("Asia/Kolkata");
       
        $local=date("Y-m-d H:i:s T",$time/1000);
        $sql2 = "UPDATE `rawdata` SET`local_time`='$local' WHERE `id`='$id'";
        //print_r($sql2);
       
        $data2 = mysqli_query($conn, $sql2);
       // exit;
    }
    //print_r($products);exit;
    //return $products;
} else {
    echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);



// if ($data) {

//     foreach ($data as $value) {
//         print_r($value);exit; 
// date_default_timezone_set("Asia/Kolkata");
// echo "The time is " . date("Y-m-d H:i:s T",1641465594347/1000);

//     }
// }
