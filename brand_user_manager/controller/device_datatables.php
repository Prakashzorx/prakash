<?php
//session_start();
function connectDM()
{
    $con = '';
    //$con = mysqli_connectDM("localhost", "root", "", "disciple");
    //$con = mysqli_connect("localhost", "root", "", "mk_db");
	$con = mysqli_connect("localhost", "root", "Mukunda@123", "mk_db");

    return $con;
}


function getDeviceDataCount()
{
    $con = connectDM();
    $data = $row = $count = "";
    $i = 0;
    if ($con) {
        $stmt = "SELECT COUNT('id') as count FROM `assigned_divices` WHERE `status`='1' ";


        // print_r($stmt);exit;
        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        $row = mysqli_fetch_assoc($data);
        //print_r($row);exit;
        return $row['count'];
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getDeviceDataSearchCount($searchQuery, $query)
{
    $con = connectDM();
    $data = "";
    $i = 0;
    if ($con) {
        $stmt = "SELECT COUNT(`assigned_divices`.`id`) as `Allcount` FROM `assigned_divices` JOIN `machines` ON `assigned_divices`.`machine_id`=`machines`.`id` JOIN `store` ON `assigned_divices`.`store_id`=`store`.`id` JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` JOIN `countries` ON `countries`.`id`=`store`.`country` JOIN `states` ON `states`.`id`=`store`.`state` JOIN `cities` ON `cities`.`id`=`store`.`city` JOIN `product_type` ON `product_type`.`id`=`machines`.`ptype_id` WHERE `assigned_divices`.`status`='1'" . $searchQuery . " " . $query . "";


        //print_r($stmt);exit;
        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        $row = mysqli_fetch_assoc($data);
        //print_r($row['Allcount']);exit;
        if (!empty($row)) {
            return $row['Allcount'];
        } else {
            return 0;
        }
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getDeviceRecordsTcpData($searchQuery, $columnName, $columnSortOrder, $row, $rowperpage, $query)
{
    $con = connectDM();
    $data = "";
    $i = 0;
    if ($con) {
        //$stmt = "select * FROM `assigned_divices` WHERE `status`='1' ".$query." ". $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
        $stmt = "
        SELECT `assigned_divices`.`id`,`assigned_divices`.`machine_id` as `machine_id`,`assigned_divices`.`brand_id` as `brand_id`,`assigned_divices`.`store_id` as `store_id`,`assigned_divices`.`user_id` as `user_id`,`machines`.`name` as `machine`,`machines`.`ptype_id` as `ptype`,`brand_tbl`.`brand_name`,`store`.`store_name`,`store`.`pincode`,`countries`.`name` as `country`,`states`.`name` as `state`,`cities`.`name`as `city`,`users`.`name` as `user name`,`users`.`email` as `email`, `users`.`phone` as `phone`,CONCAT(`product_type`.`name`,' ', `product_type`.`version`) AS `ptype` FROM `assigned_divices` JOIN `machines` ON `assigned_divices`.`machine_id`=`machines`.`id` JOIN `store` ON `assigned_divices`.`store_id`=`store`.`id` JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` JOIN `countries` ON `countries`.`id`=`store`.`country` JOIN `states` ON `states`.`id`=`store`.`state` JOIN `cities` ON `cities`.`id`=`store`.`city` JOIN `product_type` ON `product_type`.`id`=`machines`.`ptype_id`  WHERE `assigned_divices`.`status`='1'" . $query . " " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;

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


function getDeviceRecords($query)
{
    $con = connectDM();
    $data = "";
    $i = 0;
    if ($con) {
        //$stmt = "select * FROM `assigned_divices` WHERE `status`='1' ".$query." ". $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
        $stmt = "
        SELECT `assigned_divices`.`id`,`assigned_divices`.`machine_id` as `machine_id`,`assigned_divices`.`brand_id` as `brand_id`,`assigned_divices`.`store_id` as `store_id`,`assigned_divices`.`user_id` as `user_id`,`machines`.`name` as `machine`,`machines`.`ptype_id` as `ptype`,`brand_tbl`.`brand_name`,`store`.`store_name`,`store`.`pincode`,`countries`.`name` as `country`,`states`.`name` as `state`,`cities`.`name`as `city`,`users`.`name` as `user name`,`users`.`email` as `email`, `users`.`phone` as `phone`,CONCAT(`product_type`.`name`,' ', `product_type`.`version`) AS `ptype`,`product_type`.`id` as `ptype_id`,`countries`.`id` as `countryid`,`states`.`id` as `stateid`,`cities`.`id` as `cityid` FROM `assigned_divices` JOIN `machines` ON `assigned_divices`.`machine_id`=`machines`.`id` JOIN `store` ON `assigned_divices`.`store_id`=`store`.`id` JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` JOIN `countries` ON `countries`.`id`=`store`.`country` JOIN `states` ON `states`.`id`=`store`.`state` JOIN `cities` ON `cities`.`id`=`store`.`city` JOIN `product_type` ON `product_type`.`id`=`machines`.`ptype_id`  WHERE `assigned_divices`.`status`='1' AND `assigned_divices`.`id`=" . $query . "";

        // print_r($stmt);exit;
        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        $row = mysqli_fetch_assoc($data);


        if (!empty($row)) {
            return $row;
        } else {
            return false;
        }
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function getDeviceDataTCPCount()
{
    $con = connectDM();
    $data = $row = $count = "";
    $i = 0;
    if ($con) {
        $stmt = "SELECT COUNT('id') as count FROM `tcp_assign_machine` WHERE `status`='1' ";


        // print_r($stmt);exit;
        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        $row = mysqli_fetch_assoc($data);
        //print_r($row);exit;
        return $row['count'];
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function getDeviceDataSearchTCPCount($searchQuery, $query)
{
    $con = connectDM();
    $data = "";
    $i = 0;
    if ($con) {
        $stmt = "SELECT COUNT(`tcp_assign_machine`.`id`) as `Allcount` FROM `tcp_assign_machine` JOIN `tcp_register` ON `tcp_assign_machine`.`tcp_machineid`=`tcp_register`.`id` JOIN `store` ON `tcp_assign_machine`.`tcp_store`=`store`.`id` JOIN `brand_tbl` ON `brand_tbl`.`id`=`tcp_assign_machine`.`tcp_brand` JOIN `users` ON `users`.`user_id`=`tcp_assign_machine`.`tcp_pri_user` JOIN `countries` ON `countries`.`id`=`store`.`country` JOIN `states` ON `states`.`id`=`store`.`state` JOIN `cities` ON `cities`.`id`=`store`.`city` WHERE `tcp_assign_machine`.`status`='1'" . $searchQuery . " " . $query . "";


         //print_r($stmt);exit;
        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        $row = mysqli_fetch_assoc($data);
        //print_r($row['Allcount']);exit;
        if (!empty($row)) {
            return $row['Allcount'];
        } else {
            return 0;
        }
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function getDeviceRecordsTcp1Data($searchQuery, $columnName, $columnSortOrder, $row, $rowperpage, $query)
{
    $con = connectDM();
    $data = "";
    $i = 0;
    if ($con) {
        //$stmt = "select * FROM `assigned_divices` WHERE `status`='1' ".$query." ". $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
        $stmt = "
        SELECT `tcp_assign_machine`.`id`,`tcp_assign_machine`.`tcp_machineid` as `machine_id`,`tcp_assign_machine`.`tcp_brand` as `brand_id`,`tcp_assign_machine`.`tcp_store` as `store_id`,`tcp_assign_machine`.`tcp_pri_user` as `user_id`,`tcp_register`.`imei` as `machine`,`tcp_register`.`tcp_machine_type` as `ptype`,`brand_tbl`.`brand_name`,`store`.`store_name`,`store`.`pincode`,`countries`.`name` as `country`,`states`.`name` as `state`,`cities`.`name`as `city`,`users`.`name` as `user name`,`users`.`email` as `email`, `users`.`phone` as `phone`,`tcp_register`.`tcp_machine_type` AS `ptype` FROM `tcp_assign_machine` JOIN `tcp_register` ON `tcp_assign_machine`.`tcp_machineid`=`tcp_register`.`id` JOIN `store` ON `tcp_assign_machine`.`tcp_store`=`store`.`id` JOIN `brand_tbl` ON `brand_tbl`.`id`=`tcp_assign_machine`.`tcp_brand` JOIN `users` ON `users`.`user_id`=`tcp_assign_machine`.`tcp_pri_user` JOIN `countries` ON `countries`.`id`=`store`.`country` JOIN `states` ON `states`.`id`=`store`.`state` JOIN `cities` ON `cities`.`id`=`store`.`city` WHERE `tcp_assign_machine`.`status`='1'" . $query . " " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;

          //print_r($stmt);exit;
        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $i++;

                $products[$i] = $row;
                // print_r($row);





            }
            //print_r($products);exit;
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

function getDeviceRecords_Tcp($query)
{
    $con = connectDM();
    $data = "";
    $i = 0;
    if ($con) {
        //$stmt = "select * FROM `assigned_divices` WHERE `status`='1' ".$query." ". $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
        $stmt = "
        SELECT `tcp_assign_machine`.`id`,`tcp_assign_machine`.`tcp_machineid` as `machine_id`,`tcp_assign_machine`.`tcp_brand` as `brand_id`,`tcp_assign_machine`.`tcp_store` as `store_id`,`tcp_assign_machine`.`tcp_pri_user` as `user_id`,`tcp_register`.`imei` as `machine`,`tcp_register`.`tcp_machine_type` as `ptype`,`brand_tbl`.`brand_name`,`store`.`store_name`,`store`.`pincode`,`countries`.`name` as `country`,`states`.`name` as `state`,`cities`.`name`as `city`,`countries`.`id` as `countryid`,`states`.`id` as `stateid`,`cities`.`id`as `cityid`,`users`.`name` as `user name`,`users`.`email` as `email`, `users`.`phone` as `phone`,`tcp_register`.`tcp_machine_type` AS `ptype` FROM `tcp_assign_machine` JOIN `tcp_register` ON `tcp_assign_machine`.`tcp_machineid`=`tcp_register`.`id` JOIN `store` ON `tcp_assign_machine`.`tcp_store`=`store`.`id` JOIN `brand_tbl` ON `brand_tbl`.`id`=`tcp_assign_machine`.`tcp_brand` JOIN `users` ON `users`.`user_id`=`tcp_assign_machine`.`tcp_pri_user` JOIN `countries` ON `countries`.`id`=`store`.`country` JOIN `states` ON `states`.`id`=`store`.`state` JOIN `cities` ON `cities`.`id`=`store`.`city`  WHERE `tcp_assign_machine`.`status`='1' AND `tcp_assign_machine`.`id`=" . $query . "";

        // print_r($stmt);exit;
        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        $row = mysqli_fetch_assoc($data);


        if (!empty($row)) {
            return $row;
        } else {
            return false;
        }
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}





function gettcpdata_ses($managerbrandid)
{
    $con = connectDM();
    $data = "";
    $i=0;
    $products=[];
    if ($con) {
        $stmt = "SELECT `tcp_assign_machine`.`tcp_brand` , `tcp_register`.`imei` FROM `tcp_assign_machine` JOIN `tcp_register` ON tcp_assign_machine.tcp_machineid= tcp_register.id WHERE tcp_assign_machine.tcp_brand='$managerbrandid' ;";

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








function getDeviceRecordsTcpData_TCP($searchQuery, $columnName, $columnSortOrder, $row, $rowperpage, $query)
{
    $con = connectDM();
    $data = "";
    $i = 0;
    if ($con) {
        //$stmt = "select * FROM `assigned_divices` WHERE `status`='1' ".$query." ". $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
        $stmt = "
        SELECT `tcp_assign_machine`.`id`,`tcp_assign_machine`.`tcp_machineid` as `machine_id`,`tcp_assign_machine`.`tcp_brand` as `brand_id`,`tcp_assign_machine`.`tcp_store` as `store_id`,`tcp_assign_machine`.`tcp_pri_user` as `user_id`,`tcp_register`.`imei` as `machine`,`tcp_register`.`tcp_machine_type` as `ptype`,`brand_tbl`.`brand_name`,`store`.`store_name`,`store`.`pincode`,`countries`.`name` as `country`,`states`.`name` as `state`,`cities`.`name`as `city`,`users`.`name` as `user name`,`users`.`email` as `email`, `users`.`phone` as `phone`,`tcp_register`.`tcp_machine_type` AS `ptype` FROM `tcp_assign_machine` JOIN `tcp_register` ON `tcp_assign_machine`.`tcp_machineid`=`tcp_register`.`id` JOIN `store` ON `tcp_assign_machine`.`tcp_store`=`store`.`id` JOIN `brand_tbl` ON `brand_tbl`.`id`=`tcp_assign_machine`.`tcp_brand` JOIN `users` ON `users`.`user_id`=`tcp_assign_machine`.`tcp_pri_user` JOIN `countries` ON `countries`.`id`=`store`.`country` JOIN `states` ON `states`.`id`=`store`.`state` JOIN `cities` ON `cities`.`id`=`store`.`city` WHERE `tcp_assign_machine`.`status`='1'" . $query . " " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;

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