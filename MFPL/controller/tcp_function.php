<?php
//session_start();
function connect()
{

    //$con = mysqli_connect("localhost", "root", "", "disciple");
    $con = mysqli_connect("localhost", "root", "Mukunda@123", "test");

    return $con;
}


function getTcpDataCount()
{
    $con = connect();
    $data = "";
    $i=0;
    if ($con) {
        $stmt = "SELECT COUNT(*) as count FROM `tcpdata` where startbits='TZ' ORDER BY `imei`";


        // print_r($stmt);exit;
        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        $row = mysqli_fetch_assoc($data);
       // print_r($row['count']);exit;
        return $row['count'];
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getTcpDataSearchCount($searchQuery,$query)
{
    $con = connect();
    $data = "";
    $i=0;
    if ($con) {
        $stmt = "SELECT COUNT(*) as Allcount FROM `tcpdata` where startbits='TZ' ".$searchQuery." ".$query."";


        //  print_r($stmt);exit;
        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        $row = mysqli_fetch_assoc($data);
        //print_r($row['Allcount']);exit;
        return $row['Allcount'];
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getRecordsTcpData($searchQuery,$columnName,$columnSortOrder,$row,$rowperpage,$query)
{
    $con = connect();
    $data = "";
    $i=0;
    $products=[]; 
    if ($con) {
        $stmt = "select `rct_timestamp`,`imei`,`alarm_type`,`wifi`,`wifistatus`,`temp`,`battery_voltage` from tcpdata  where startbits='TZ' ".$query." ". $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;


        // print_r($stmt);exit;
        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $i++;

                $products[$i] = $row;
                // print_r($row);


 


            }
            // print_r($products);exit;
            return $products;
        } else {
            return false;
        }
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}




function gettcpcount($query)
{
    $con = connect();
    $data = "";
    $products=[];
    $i=0;
    if ($con) {
        $stmt = "SELECT `id`,`imei`,`rct_timestamp`,`alarm_type`,`wifi`,`wifistatus`,`temp`,`battery_voltage` FROM `tcpdata` where $query ORDER BY 'id'";


        // print_r($stmt);exit;
        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $i++;

                $products[$i] = $row;
                // print_r($row);





            }
            // print_r($products);exit;
            return $products;
        } else {
            return false;
        }
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}



function getRcpGraphData($query){
    $con = connect();
    $data = "";
    $i=0;
    $products=[];
    if ($con) {
        $stmt = "SELECT `rct_timestamp`,`temp` FROM `tcpdata` where startbits='TZ' $query ORDER BY `rct_timestamp` DESC";


         //print_r($stmt);exit;
        $data = mysqli_query($con, $stmt);
        // print_r($data);exit; 
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $i++;

                $products[$i] = $row;
                // print_r($row);





            }
            // print_r($products);exit;
            return $products;
        } else {
            return false;
        }
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);


}

function getallTcpDataBySts($imei,$datetoday){
    $con = connect(); 
    $data = ""; 
    $i=0;
    $products=[];
    if ($con) {
        $stmt = "SELECT * FROM `tcpdata` where startbits='TZ' AND 'sts'=0 AND `imei` LIKE '$imei' AND `timestamp` > '$datetoday' ORDER BY `id` DESC LIMIT 1";


        // print_r($stmt);exit;
        $data = mysqli_query($con, $stmt);
        // print_r($data);exit; 
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $i++;

                $products[$i] = $row;
                 //print_r($row);





            }
            // print_r($products);exit;
            return $products;
        } else {
            return false;
        }
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);


}

function getnooftcpdata()
{
    $con = connect();
    $data = "";
    $i=0;
    $products=[];
    if ($con) {
        $stmt = "SELECT `tcpdata`.`imei`,MAX(`tcpdata`.`timestamp`) AS `timestamp` FROM `tcpdata` where startbits='TZ' group by `tcpdata`.`imei`";


        // print_r($stmt);exit;
        $data = mysqli_query($con, $stmt);
        // print_r($data);exit; 
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $i++;

                $products[$i] = $row;
                // print_r($row);

            }
            // print_r($products);exit;
            return $products;
        } else {
            return false;
        }
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);


}

?>