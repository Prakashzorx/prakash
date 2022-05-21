<?php



// $sname= "localhost";

// $unmae= "root";

// $password = "Mukunda@123";

// $db_name = "mk_db";

// $conn = mysqli_connect($sname, $unmae, $password, $db_name);

// if (!$conn) {

//     echo "Connection failed!";

// }

function connectDB()
{


    $conn = mysqli_connect("localhost", "root", "Mukunda@123", "mk_db");

    return $conn;
}

function getRaawdata()
{
    $conn = connectDB();
    $user = "";
    $i = -1;
    $rawdata[] = "";
    if ($conn) {
        $sql = "SELECT * FROM `rawdata` WHERE `sts`= 0 ";
        $Subject = mysqli_query($conn, $sql);
        if ($Subject->num_rows > 0) {

            //print_r($user);exit;

            while ($row = mysqli_fetch_assoc($Subject)) {
                $i++;

                $rawdata[$i] = $row;
            }
            return $rawdata;
        } else {
            return false;
        }
    }
    mysqli_close($conn);
}

function getUniqueProducts()
{
    $conn = connectDB();
    $user = "";
    $i = -1;
    $products[] = "";
    if ($conn) {
        $sql = "SELECT DISTINCT(SLN) FROM `products`";
        $Subject = mysqli_query($conn, $sql);
        if ($Subject->num_rows > 0) {

            //print_r($user);exit;

            while ($row = mysqli_fetch_assoc($Subject)) {
                $i++;

                $products[$i] = $row;
            }
            return $products;
        } else {
            return false;
        }
    }
    mysqli_close($conn);
}


function insertNewProduct($value)
{
    $SLN = $value['SLN'];
    $ptype = $value['ptype'];
    $macid = $value['macid'];
    $sv = $value['sv'];
    $av = $value['av'];
    $appname = $value['appname'];
    $location = $value['location'];
    $hb = $value['hb'];
    $rc = $value['rc'];
    $mil = $value['time'];
    $seconds = ceil($mil / 1000);
    //print_r(date("d-m-Y H:i:s", $seconds));
    
    $dateonly = strtotime(date("d-m-Y H:i:s", $seconds));
    //$dateonly=strtotime('2021-11-26 13:04:48');
    $date = date('Y-m-d', $dateonly);
    $time = date('H:i:s', $dateonly);
    $timestamp = $value['timestamp'];


    $conn = connectDB();
    $user = "";
    $i = -1;
    $products[] = "";
    if ($conn) {
        $sql = "INSERT INTO `products`( `SLN`, `p_type`, `mac_id`, `sv`, `av`, `appname`, `location`, `hb`, `rc` ,`time`,`timestamp`) 
                VALUES ('$SLN','$ptype','$macid','$sv','$av','$appname','$location','$hb','$rc','$mil','$timestamp')";
        //print_r($sql);exit;
        $Subject = mysqli_query($conn, $sql);
        if ($Subject) {

            //print_r($user);exit;
            return true;
        } else {
            return false;
        }
    }
    mysqli_close($conn);
}

function updateNewProduct($value)
{
    $SLN = $value['SLN'];
    $ptype = $value['ptype'];
    $macid = $value['macid'];
    $sv = $value['sv'];
    $av = $value['av'];
    $appname = $value['appname'];
    $location = $value['location'];
    $hb = $value['hb'];
    $rc = $value['rc'];
   // $time = $value['time'];

    // $dateonly = strtotime($value['timestamp']);
    //$dateonly=strtotime('2021-11-26 13:04:48');
    //$date = date('Y-m-d', $dateonly);
    // $time = date('H:i:s', $dateonly);
    //print_r($date);
    //$timestamp = $value['timestamp'];
    $mil = $value['time'];
    $seconds = ceil($mil / 1000);
    //print_r(date("d-m-Y H:i:s", $seconds));
    
    $dateonly = strtotime(date("d-m-Y H:i:s", $seconds));
    //$dateonly=strtotime('2021-11-26 13:04:48');
    $date = date('Y-m-d', $dateonly);
    $time = date('H:i:s', $dateonly);
    $timestamp = $value['timestamp'];

    $conn = connectDB();
    $user = "";
    $i = -1;
    $products[] = "";
    if ($conn) {
        $sql = "UPDATE `products` SET `location`='$location',`hb`='$hb',`rc`='$rc',`time`='$mil',`timestamp`='$timestamp' WHERE `SLN`= '$SLN'";
        //print_r($sql);exit;
        $Subject = mysqli_query($conn, $sql);
        if ($Subject) {

            //print_r($user);exit;
            return true;
        } else {
            return false;
        }
    }
    mysqli_close($conn);
}

function dayWiseProductRC($value)
{
    $SLN = $value['SLN'];
    $ptype = $value['ptype'];
    $macid = $value['macid'];
    //$sv=$value['sv'];
    //$av=$value['av'];
    //$appname=$value['appname'];
    //$location=$value['location'];
    //$hb=$value['hb'];
    $rc = $value['rc'];

    $dateonly = strtotime($value['timestamp']);
    //$dateonly=strtotime('2021-11-26 13:04:48');
    $date = date('Y-m-d', $dateonly);
    $time = date('H:i:s', $dateonly);
    //print_r($date);
    $timestamp = $value['timestamp'];

    $conn = connectDB();
    $user = "";
    $i = -1;
    $products[] = "";
    if ($conn) {

        $stmt = "SELECT `id` FROM `products_daily_rc` WHERE `SLN`='$SLN' AND `date`='$date'";
        $Subject1 = mysqli_query($conn, $stmt);
        //print_r($stmt);
        //print_r($Subject1->num_rows);exit;
        if ($Subject1->num_rows > 0) {

            $row = mysqli_fetch_assoc($Subject1);
            // print_r($row['id']);
            $p_id = $row['id'];
            // if($row['rc']<$rc){
            $query = "UPDATE `products_daily_rc` SET `rc`='$rc',`time`='$time',`timestamp`='$timestamp' WHERE  `id`='$p_id'";
            $done = mysqli_query($conn, $query);
            //  }

            return true;
            //echo "hi";
        } else {

            //print_r($device_name);
            // user not existed
            $query = "INSERT INTO `products_daily_rc`(`SLN`, `ptype`, `macid`, `rc`,`date`, `time`,`timestamp`) VALUES ('$SLN','$ptype','$macid','$rc','$date','$time','$timestamp')";
            // print_r($query);
            $done = mysqli_query($conn, $query);
            return true;
        }
        // $sql = "INSERT INTO `products_daily_rc`(`SLN`, `ptype`, `macid`, `date`, `time`) VALUES ('$SLN','$ptype','$macid','$date','$time')";
        // //print_r($sql);exit;
        // $Subject = mysqli_query($conn, $sql);
        // if ($Subject) {

        //     //print_r($user);exit;
        //     return true;
        // } else {
        //     return false;
        // }
    }
    mysqli_close($conn);
}


function getRcpdata()
{
    $conn = connectDB();
    $user = "";
    $i = -1;
    $rcpdata[] = "";
    if ($conn) {
        $sql = "SELECT * FROM `rcpdata` WHERE `sts`= 0 ";
        $Subject = mysqli_query($conn, $sql);
        if ($Subject->num_rows > 0) {

            //print_r($user);exit;

            while ($row = mysqli_fetch_assoc($Subject)) {
                $i++;

                $rcpdata[$i] = $row;
            }
            //print_r($rcpdata);exit;
            return $rcpdata;
        } else {
            return false;
        }
    }
    mysqli_close($conn);
}


function getUniqueRecepe()
{
    $conn = connectDB();
    $user = "";
    $i = -1;
    $products[] = "";
    if ($conn) {
        $sql = "SELECT `rcptype`,`rcpname` FROM `unique_recepe`";
        $Subject = mysqli_query($conn, $sql);
        if ($Subject->num_rows > 0) {

            //print_r($user);exit;

            while ($row = mysqli_fetch_assoc($Subject)) {
                $i++;

                $products[$i] = $row;
            }
            return $products;
        } else {
            return false;
        }
    }
    mysqli_close($conn);
}


function insertNewUniqueRecepe($value)
{
    $conn = connectDB();
    //print_r($value);exit;
    $SLN = $value['SLN'];
    $ptype = $value['ptype'];
    $macid = $value['macid'];
    $rcptype = $value['rcptype'];
    $rcpname = $value['rcpname'];
    // $appname = $value['appname'];
    // $location = $value['location'];
    // $hb = $value['hb'];
    //$dateonly = strtotime($value['timestamp']);
    //$dateonly=strtotime('2021-11-26 13:04:48');
    //$date = date('Y-m-d', $dateonly);
    $time = $value['time'];
   // $dateonly = strtotime($value['timestamp']);
    //$dateonly=strtotime('2021-11-26 13:04:48');
    //$date = date('Y-m-d', $dateonly);
    //$time = date('H:i:s', $dateonly);
    //print_r($date);
    $timestamp = $value['timestamp'];

    //$timestamp=$value['timestamp'];
    $rc = 1;
   
    $products[] = "";
    if ($conn) {
        $sql = "INSERT INTO `unique_recepe`( `rcptype`, `rcpname`, `rc`, `time`,`timestamp`) VALUES ('$rcptype','$rcpname','$rc','$time','$timestamp')";
       // print_r($sql);exit;
        $Subject = mysqli_query($conn, $sql);
        if ($Subject) {

            //print_r($user);exit;
            return true;
        } else {
            return false;
        }
    }
    mysqli_close($conn);
}


function updateUniqueRecepe($value)
{
    $conn = connectDB();
    //print_r($value);exit;
    $SLN = $value['SLN'];
    $ptype = $value['ptype'];
    $macid = $value['macid'];
    $rcptype = $value['rcptype'];
    $rcpname = $value['rcpname'];
    // $appname = $value['appname'];
    // $location = $value['location'];
    // $hb = $value['hb'];
    //$dateonly = strtotime($value['timestamp']);
    //$dateonly=strtotime('2021-11-26 13:04:48');
    //$date = date('Y-m-d', $dateonly);
    //$dateonly = strtotime($value['timestamp']);
    //$dateonly=strtotime('2021-11-26 13:04:48');
    //$date = date('Y-m-d', $dateonly);
   // $time = date('H:i:s', $dateonly);
    //print_r($date);
    $time=$value['time'];
    $timestamp = $value['timestamp'];

    //$timestamp=$value['timestamp'];


    $sql = "SELECT * FROM `unique_recepe` WHERE `rcptype`='$rcptype' AND `rcpname`='$rcpname'";
    $Subject = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($Subject);
    //print_r($row);
    $rc = $row['rc'];
    $rc++;
    //print_r($rc);
    $user = "";
    $i = -1;
    $products[] = "";
    if ($conn) {
        $sql = "UPDATE `unique_recepe` SET `rc`='$rc',`time`='$time',`timestamp`='$timestamp' WHERE `rcptype`='$rcptype' AND `rcpname`='$rcpname'";
        //print_r($sql);exit;
        $Subject = mysqli_query($conn, $sql);
        if ($Subject) {

            //print_r($user);exit;
            return true;
        } else {
            return false;
        }
    }
    mysqli_close($conn);
}


function insertRcpSLN($value)
{
    $conn = connectDB();
    //print_r($value);exit;
    $SLN = $value['SLN'];
    $ptype = $value['ptype'];
    $macid = $value['macid'];
    $rcptype = $value['rcptype'];
    $rcpname = $value['rcpname'];
    // $appname = $value['appname'];
    // $location = $value['location'];


    $mil = $value['time'];
    $seconds = ceil($mil / 1000);
    //print_r(date("d-m-Y H:i:s", $seconds));
    $rc = 1;
    $dateonly = strtotime($value['timestamp']);
    //$dateonly=strtotime('2021-11-26 13:04:48');
    $date = date('Y-m-d', $dateonly);
    $time = date('H:i:s', $dateonly);
    //print_r($date);
    $timestamp = $value['timestamp'];


    $user = "";
    $i = -1;
    $products[] = "";
    if ($conn) {
        $sql = "INSERT INTO `recepe_count_sln`(`rcpname`, `rectype`, `SLN`, `ptype`, `rc`, `date`, `time`,`timestamp`) VALUES ('$rcpname','$rcptype','$SLN','$ptype','$rc','$date','$time','$timestamp')";
        //print_r($sql);exit;
        $Subject = mysqli_query($conn, $sql);
        if ($Subject) {


            $sql = "SELECT * FROM `products` WHERE `SLN`='$SLN'";
            //print_r($sql);
           // exit;
            $Subject = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($Subject);
            $rc = $row['rc'];
            $rc++;
            $sql = "UPDATE `products` SET `rc`='$rc' WHERE `SLN`='$SLN'";
            //print_r($sql);exit;
            $Subject = mysqli_query($conn, $sql);
    
    
    
            $sql = "SELECT * FROM `products_daily_rc` WHERE `SLN`='$SLN' AND `date`='$date'";
            //print_r($sql);exit;
            $Subject = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($Subject);
            $rc = $row['rc'];
            $rc++;
            $sql = "UPDATE `products_daily_rc` SET `rc`='$rc',`date`='$date',`time`='$time',`timestamp`='$timestamp' WHERE `SLN`='$SLN' AND `date`='$date'";
            //print_r($sql);exit;
            $Subject = mysqli_query($conn, $sql);
            //print_r($user);exit;
            return true;
        } else {
            return false;
        }


      
    }
    mysqli_close($conn);
}


function updateRcpSLN($value)
{
    $conn = connectDB();
    //print_r($value);exit;
    $SLN = $value['SLN'];
    $ptype = $value['ptype'];
    $macid = $value['macid'];
    $rcptype = $value['rcptype'];
    $rcpname = $value['rcpname'];
    // $appname = $value['appname'];
    // $location = $value['location'];
    // $hb = $value['hb'];
    $mil = $value['time'];
    $dateonly = strtotime($value['timestamp']);
    //$dateonly=strtotime('2021-11-26 13:04:48');
    $date = date('Y-m-d', $dateonly);
    $time = date('H:i:s', $dateonly);
    //print_r($date);
    $timestamp = $value['timestamp'];

    $rc = 0;
    $sql = "SELECT * FROM `recepe_count_sln` WHERE `rectype`='$rcptype' AND `rcpname`='$rcpname' AND `SLN`='$SLN' AND `date`='$date'";
    //print_r($sql);exit;
    $Subject = mysqli_query($conn, $sql);
    //print_r($Subject."\n");
    if ($Subject->num_rows > 0) {
        $row = mysqli_fetch_assoc($Subject);

        $rc = $row['rc'];
        $rc++;



        $sql = "UPDATE `recepe_count_sln` SET `rc`='$rc',`date`='$date',`time`='$time',`timestamp`='$timestamp' WHERE `rectype`='$rcptype' AND `rcpname`='$rcpname' AND `SLN`='$SLN' AND `date`='$date'";
        $Subject = mysqli_query($conn, $sql);
        if ($Subject) {

            $sql = "SELECT * FROM `products` WHERE `SLN`='$SLN'";
           // print_r($sql);
           // exit;
            $Subject = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($Subject);
            $rc = $row['rc'];
            $rc++;
            $sql = "UPDATE `products` SET `rc`='$rc' WHERE `SLN`='$SLN'";
            //print_r($sql);
            //exit;
            $Subject = mysqli_query($conn, $sql);
        
        
        
            $sql = "SELECT * FROM `products_daily_rc` WHERE `SLN`='$SLN' AND `date`='$date'";
           // print_r($sql);
            //exit;
            $Subject = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($Subject);  
            $rc = $row['rc'];
            $rc++;
            $sql = "UPDATE `products_daily_rc` SET `rc`='$rc',`date`='$date',`time`='$time',`timestamp`='$timestamp' WHERE `SLN`='$SLN' AND `date`='$date'";
           // print_r($sql);
            //exit;
            $Subject = mysqli_query($conn, $sql);

            return true;
        } else {
            return false;
        }

        
    } else {
        $sql = "INSERT INTO `recepe_count_sln`(`rcpname`, `rectype`, `SLN`, `ptype`, `rc`, `date`, `time`,`timestamp`) VALUES ('$rcpname','$rcptype','$SLN','$ptype','$rc','$date','$time','$timestamp')";
        $Subject = mysqli_query($conn, $sql);
        if ($Subject) {



            $sql = "SELECT * FROM `products` WHERE `SLN`='$SLN'";
            //print_r($sql);
           // exit;
            $Subject = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($Subject);
            $rc = $row['rc'];
            $rc++;
            $sql = "UPDATE `products` SET `rc`='$rc' WHERE `SLN`='$SLN'";
           // print_r($sql);exit;
            $Subject = mysqli_query($conn, $sql);
        
        
        
            $sql = "SELECT * FROM `products_daily_rc` WHERE `SLN`='$SLN' AND `date`='$date'";
            //print_r($sql);exit;
            $Subject = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($Subject);
            $rc = $row['rc'];
            $rc++;
            $sql = "UPDATE `products_daily_rc` SET `rc`='$rc',`date`='$date',`time`='$time',`timestamp`='$timestamp' WHERE `SLN`='$SLN' AND `date`='$date'";
            //print_r($sql);exit;
            $Subject = mysqli_query($conn, $sql);
            return true;
        } else {
            return false;  
        }
    }

  

    mysqli_close($conn);
}


function getSLNfromRecepeCountSlnTable($rcptype, $rcpname)
{

    $conn = connectDB();
    $user = "";
    $i = -1;
    $products[] = "";
    if ($conn) {
        $sql = "SELECT * FROM `recepe_count_sln` WHERE `rectype`='$rcptype' AND `rcpname`='$rcpname'";
        $Subject = mysqli_query($conn, $sql);
        if ($Subject->num_rows > 0) {

            //print_r($user);exit;

            while ($row = mysqli_fetch_assoc($Subject)) {
                $i++;

                $products[$i] = $row;
            }
            return $products;
        } else {
            return false;
        }
    }
    mysqli_close($conn);
}


function updateRcpdataToOne($value)
{
    $conn = connectDB();
    //print_r($value);exit;
    $id = $value['id'];



    if ($conn) {
        $sql = "UPDATE `rcpdata` SET `sts`='1' WHERE `id`='$id'";
        //print_r($sql);
        $Subject = mysqli_query($conn, $sql);
        if ($Subject) {

            //print_r($user);exit;
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }



    mysqli_close($conn);
}


function updateRawdataToOne($value)
{
    $conn = connectDB();
    //print_r($value);exit;
    $id = $value['id'];



    if ($conn) {
        $sql = "UPDATE `rawdata` SET `sts`='1' WHERE `id`='$id'";
        $Subject = mysqli_query($conn, $sql);
        if ($Subject) {

            //print_r($user);exit;
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }



    mysqli_close($conn);
}
