<?php

function connectRecipe()
{

    //$con = mysqli_connect("localhost", "root", "", "disciple");
    $con = mysqli_connect("localhost", "root", "Mukunda@123", "mk_db");


    return $con;
}




function recipe_update_query($recipe_version, $pre_heating_temp, $sleep_time_Temp, $sleep_time, $deep_sleep_time)
{
     // print_r($recipe_version);exit;
    $con = connectRecipe();
    // print_r($con);exit;
   
    if ($con) {


        $check_version = "select * from recipe_update_table where recipe_version='$recipe_version'";
        $done1 = mysqli_query($con, $check_version);
       // print_r($done1);exit;
        if ($done1->num_rows > 0) {
            return 3;
        } else {

            $stmt1 = "insert into `recipe_update_table` (`recipe_version`,`pre_heating_temp`,`sleep_time_temp`,`sleep_time`,`deep_sleep_time`)values('$recipe_version','$pre_heating_temp','$sleep_time_Temp','$sleep_time','$deep_sleep_time')";
           // print_r($stmt1);exit;

            $done = mysqli_query($con, $stmt1);
           
            if ($done) {

                return 0;
            } else {
                return 2;
            }
        }
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con); 
}



function  versionTypes()
{
    $con = connectRecipe();
    $data = "";

    if ($con) {
        $stmt = "SELECT id, recipe_version FROM `recipe_update_table` WHERE 1 ORDER BY `id` DESC";
        //print_r($stmt);exit;
        $i = 0;

        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $i++;

                $products[$i] = $row;
                //print_r($row['id']);





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



function addVersion($selectversion, $recipeid, $recipe_name, $rct_1, $total_T1_1, $total_HT_1, $total_T2_1, $rct_2, $total_T1_2, $total_HT_2, $total_T2_2, $rct_3, $total_T1_3, $total_HT_3, $total_T2_3, $rct_4, $total_T1_4, $total_HT_4, $total_T2_4, $rct_5, $total_T1_5, $total_HT_5, $total_T2_5)
{

    $con = connectRecipe();

    if ($con) {

        $vid = "insert into add_version(selectversion, recipeid, recipe_name,rct_1, total_T1_1, total_HT_1, total_T2_1,rct_2, total_T1_2, total_HT_2, total_T2_2,rct_3, total_T1_3, total_HT_3, total_T2_3,rct_4, total_T1_4, total_HT_4, total_T2_4,rct_5, total_T1_5, total_HT_5, total_T2_5) values('$selectversion', '$recipeid', '$recipe_name','$rct_1', '$total_T1_1', '$total_HT_1', '$total_T2_1','$rct_2', '$total_T1_2', '$total_HT_2', '$total_T2_2','$rct_3', '$total_T1_3', '$total_HT_3', '$total_T2_3','$rct_4', '$total_T1_4', '$total_HT_4', '$total_T2_4','$rct_5', '$total_T1_5', '$total_HT_5', '$total_T2_5')";
        // print_r($vid);exit;

        $succes = mysqli_query($con, $vid);
        // print_r($succes);exit;

        if ($succes) {
            return 0;
        } else {
            return 2;
        }
    } 
    if (!$con){
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getUpdatedRecipes()
{
    $con = connectRecipe();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `recipe_update_table` WHERE 1 ORDER BY `id` DESC";
        //print_r($stmt);exit;

        $i = 0;

        $data = mysqli_query($con, $stmt);
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $i++;

                $products[$i] = $row;
                //print_r($row['id']);





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




function getrecpid($vid)
{
    $con = connectRecipe();
    $data = "";

    if ($con) {
        $stmt = "SELECT DISTINCT(`recipeid`) as `rcpid` FROM `add_version` WHERE `selectversion`='$vid' ORDER BY `recipeid` ";
        // print_r($stmt);exit;
        $i = 0;

        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {

                //print_r($row);exit;
                $i++;

                $products[$i] = $row;
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


function  recipe_table()
{ 
        $con = connectRecipe();
        $data = "";

        if ($con) {
            $stmt = "SELECT * FROM `recipe_update_table` WHERE 1 ORDER BY `id` DESC";
            // print_r($stmt);exit;

            $i = 0;

            $data = mysqli_query($con, $stmt);
            if ($data) {
                while ($row = mysqli_fetch_assoc($data)) {
                    $i++;

                    $products[$i] = $row;
                    // print_r($row['id']);


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



function  select_version_ID($id)
{ 
        $con = connectRecipe();
        $data = "";
        $products = [];
        if ($con) {
            $stmt = "SELECT * FROM `recipe_update_table` where `id`=$id  ORDER BY `recipe_update_table`.`recipe_version`  DESC";
            // print_r($stmt);exit;

            $i = 0;

            $data = mysqli_query($con, $stmt);
            $row = mysqli_fetch_assoc($data);

            return $row;
        } 
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        mysqli_close($con);
    
}



function select_portions($recipe_id, $vid)
{ 
        $con = connectRecipe();
        $data = "";
        $products = [];
        if ($con) {
            $stmt = "SELECT * FROM `add_version` where `selectversion`=$vid AND `recipeid`=$recipe_id;";
            // print_r($stmt);exit;

            $i = 0;

            $data = mysqli_query($con, $stmt);
            $row = mysqli_fetch_assoc($data);
            // print_r($row);exit;

            return $row;
        }   if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        mysqli_close($con);
    
}



function Update_recipe_versions($heatingtempediting, $vtemp1editing, $vsleeptimeediting, $deepsleepediting, $id_for_update)
{ 
        $con = connectRecipe();
        $data = "";
        $products = [];
        if ($con) {
            $stmt = "UPDATE `recipe_update_table` SET`pre_heating_temp`='$heatingtempediting',`sleep_time_temp`='$vtemp1editing',`sleep_time`='$vsleeptimeediting',`deep_sleep_time`='$deepsleepediting' where `id`=$id_for_update ";

            // print_r($stmt);exit;



            $data = mysqli_query($con, $stmt);
            // print_r($data);exit;
            // $row = mysqli_fetch_assoc($data);
            // print_r($row);exit;
            if ($data) {
                return 1;
            } else {
                return 0;
            }
        }   if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        mysqli_close($con);
    
}




function update_recipe_portions(
    $version_id,
    $recipeid,
    $update_rct_P1,
    $Update_total_T1_P1,
    $Update_total_HT_P1,
    $Update_total_T2_P1,
    $update_rct_P2,
    $Update_total_T1_P2,
    $Update_total_HT_P2,
    $Update_total_T2_P2,
    $update_rct_P3,
    $Update_total_T1_P3,
    $Update_total_HT_P3,
    $Update_total_T2_P3,
    $update_rct_P4,
    $Update_total_T1_P4,
    $Update_total_HT_P4,
    $Update_total_T2_P4,
    $update_rct_P5,
    $Update_total_T1_P5,
    $Update_total_HT_P5,
    $Update_total_T2_P5
) { 
        $con = connectRecipe();
        $data = "";
        $products = [];
        if ($con) {
            $stmt = "UPDATE `add_version` SET	`rct_1`='$update_rct_P1',`total_T1_1`='$Update_total_T1_P1',`total_HT_1`='$Update_total_HT_P1',`total_T2_1`='$Update_total_T2_P1',
                                                        `rct_2`='$update_rct_P2',`total_T1_2`='$Update_total_T1_P2',`total_HT_2`='$Update_total_HT_P2',`total_T2_2`='$Update_total_T2_P2',
                                                        `rct_3`='$update_rct_P3',`total_T1_3`='$Update_total_T1_P3',`total_HT_3`='$Update_total_HT_P3',`total_T2_3`='$Update_total_T2_P3',
                                                        `rct_4`='$update_rct_P4',`total_T1_4`='$Update_total_T1_P4',`total_HT_4`='$Update_total_HT_P4',`total_T2_4`='$Update_total_T2_P4',
                                                        `rct_5`='$update_rct_P5',`total_T1_5`='$Update_total_T1_P5',`total_HT_5`='$Update_total_HT_P5',`total_T2_5`='$Update_total_T2_P5'
                                                        where `selectversion`=$version_id AND `recipeid`=$recipeid";
            // print_r($stmt);exit;



            $data = mysqli_query($con, $stmt);
            // print_r($data);exit;
            // $row = mysqli_fetch_assoc($data)4
            // print_r($row);exit;
            if ($data) {
                return 1;
            } else {
                return 0;
            }
        } 
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        mysqli_close($con);
    
}

function selectMachineVersionPortion($mid)
{ 
        $con = connectRecipe();
        $data = "";
        $products = [];
        if ($con) {
            $stmt = "SELECT * FROM `assigned_divices` as `a` JOIN `recipe_update_table` as `v` ON `a`.`versionid`=`v`.`id` JOIN `add_version` as `r` ON `r`.`selectversion`=`v`.`id` WHERE `a`.`machine_id`=$mid AND `a`.`status`=1;";
            // print_r($stmt);exit;

            $i = 0;

            $data = mysqli_query($con, $stmt);
            $row = mysqli_fetch_assoc($data);
            // print_r($row);exit;

            return $row;
        }   if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        mysqli_close($con);
    
}






function getTCP_EMIE()
{
    $con = connectRecipe();
    $data = "";

    if ($con) {
        $stmt = "SELECT `id`,`imei` FROM `tcp_register`";
        //print_r($stmt);exit;
        $i = 0;

        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $i++;

                $products[$i] = $row;
                //print_r($row['id']);





            }
            //print_r($products);exit;
            return $products;
        } else {
            return false;
        }
   }if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}



function  tcp_table()
{ {
        $con = connectRecipe();
        $data = "";

        if ($con) {
            $stmt = "SELECT * FROM `tcp_register` WHERE `status`='0' ORDER BY `id` ASC";
          //   print_r($stmt);exit;

            $i = 0;

            $data = mysqli_query($con, $stmt);
            if ($data) {
                while ($row = mysqli_fetch_assoc($data)) {
                    $i++;

                    $products[$i] = $row;
                    // print_r($row['id']);


                }
                //print_r($products);exit;
                return $products;
            } else {
                return false;
            }
        } else {
            die("Connection failed: " . mysqli_connect_error());
        }
        mysqli_close($con);
    }
}



function getTCP_Machine_type()
{
    $con = connectRecipe();
    $data = "";

    if ($con) {
        $stmt = "SELECT `tcp_machine_type` FROM `tcp_register`";
        //print_r($stmt);exit;
        $i = 0;

        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $i++;

                $products[$i] = $row;
                //print_r($row['id']);





            }
            //print_r($products);exit;
            return $products;
        } else {
            return false;
        }
   }if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getTCP_machines($id)
{
    $con = connectRecipe();

    if ($con) {
        $machine_query = "SELECT * FROM `tcp_register` where `id`=$id";
        $success_q = mysqli_query($con, $machine_query);
        $row = mysqli_fetch_assoc($success_q);
        if ($row) {
            return $row;
        } else {
            return 0;
        }
   }if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function select_Tcps($id)
{
    $con = connectRecipe();
    if ($con) {
        $qry = "SELECT * FROM `tcp_register` where `id`=$id";
        $result = mysqli_query($con, $qry);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
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


function edit_tcp($id,$imei_E, $tcp_machine_type_E, $tcp_sr_E, $tcp_instaltablbe_E,$tcp_low_threshold,$tcp_high_threshold)
{
    $con = connectRecipe();
    if ($con) {
        $querry = "UPDATE `tcp_register` SET tcp_machine_type='$tcp_machine_type_E',tcp_sr='$tcp_sr_E',tcp_instaldate='$tcp_instaltablbe_E',tcp_low_threshold='$tcp_low_threshold', tcp_high_threshold='$tcp_high_threshold' WHERE id='$id'";
        // print_r($querry);exit; 
        $result = mysqli_query($con, $querry);
        // print_r($result);

        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function delete_tcp($id,$imei_D, $tcp_machine_type_D, $tcp_sr_D, $tcp_instaltablbe_D,$tcp_low_threshold,$tcp_high_threshold)
    {
        $con = connectRecipe();
        if ($con) {
            $stmt = "SELECT * FROM `tcp_assign_machine` WHERE `tcp_machineid`='$id' AND `status`='1'";
            //   print_r($stmt);exit;
                $i = 0;
                $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
                if ($data->num_rows == 0) {
            $querry = "UPDATE `tcp_register` SET `status`='1' WHERE id='$id'";
             //print_r($querry);exit; 
            $result = mysqli_query($con, $querry);
            // print_r($result);
    
            if ($result) {
                return 1;
            } else {
                return 0;
            }
        }
        
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        mysqli_close($con);
    }
}

function gettcpoptions()
{
    $con = connectRecipe();
    //$data = "";
    $i = 0;
    $products = [];
    if ($con) {
        $stmt = "SELECT * FROM `tcp_register` WHERE `status`='0' AND `active`='0'  ";



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



function assignTCPDevice($tcp_machineid, $tcp_brand, $user, $tcp_store)
{
    //  print_r($recipe_version);exit;
    $con = connectRecipe();
    // print_r($con);exit;

    if ($con) {


        $stmt = "SELECT * FROM `tcp_assign_machine` WHERE `tcp_machineid`='$tcp_machineid' AND `tcp_brand`='$tcp_brand' AND `tcp_pri_user`='$user' AND `tcp_store`='$tcp_store' AND `status`='1'";
        $i = 0;
        $data = mysqli_query($con, $stmt);

        if ($data->num_rows == 0) {

            $stmt = "INSERT INTO `tcp_assign_machine`( `tcp_machineid`,`tcp_brand`,`tcp_pri_user`,`tcp_store`) 
        VALUES ('$tcp_machineid','$tcp_brand','$user','$tcp_store')";
            //  print_r($stmt);    
            $done = mysqli_query($con, $stmt);
            if ($done) {
                $stmt = "UPDATE `tcp_register` SET `active`='1' WHERE `id`='$tcp_machineid'";
                    //   print_r($stmt);   
                    $done = mysqli_query($con, $stmt);
                return 0;
            } else {
                return 2;
            }
        }
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function select_tcp_machines()
{
    $con = connectRecipe();
    $i = 0;
    $machines = [];
    if ($con) {
        $machine_query = "SELECT * FROM `tcp_assign_machine` WHERE `status`=1";
        $success_q = mysqli_query($con, $machine_query);


        //  print_r($row);exit;
        if ($success_q) {

            while ($row = mysqli_fetch_assoc($success_q)) {

                $i++;
                $machines[$i] = $row;
            }
            return $machines;
        } else {
            return 0;
        }
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function select_tcp_assignedmachines($imei)
{
    $con = connectRecipe();
    $i = 0;
    $machines = [];
    if ($con) {
        $machine_query = "SELECT `tcp_assign_machine`.`id`,`tcp_assign_machine`.`tcp_machineid` as `machine_id`,`tcp_assign_machine`.`tcp_brand` as `brand_id`,`tcp_assign_machine`.`tcp_store` as `store_id`,`tcp_assign_machine`.`tcp_pri_user` as `user_id`,`tcp_register`.`imei` as `machine`,`tcp_register`.`tcp_machine_type` as `ptype`,`brand_tbl`.`brand_name`,`store`.`store_name`,`store`.`pincode`,`countries`.`name` as `country`,`states`.`name` as `state`,`cities`.`name`as `city`,`countries`.`id` as `countryid`,`states`.`id` as `stateid`,`cities`.`id`as `cityid`,`users`.`name` as `user name`,`users`.`email` as `email`, `users`.`phone` as `phone`,`tcp_register`.`tcp_machine_type` AS `ptype` FROM `tcp_assign_machine` JOIN `tcp_register` ON `tcp_assign_machine`.`tcp_machineid`=`tcp_register`.`id` JOIN `store` ON `tcp_assign_machine`.`tcp_store`=`store`.`id` JOIN `brand_tbl` ON `brand_tbl`.`id`=`tcp_assign_machine`.`tcp_brand` JOIN `users` ON `users`.`user_id`=`tcp_assign_machine`.`tcp_pri_user` JOIN `countries` ON `countries`.`id`=`store`.`country` JOIN `states` ON `states`.`id`=`store`.`state` JOIN `cities` ON `cities`.`id`=`store`.`city`  WHERE `tcp_assign_machine`.`status`='1' AND `tcp_register`.`imei`='$imei' ";
      // print_r($machine_query);exit;
        $success_q = mysqli_query($con, $machine_query);


         
        if ($success_q) {

            while ($row = mysqli_fetch_assoc($success_q)) {

                $i++;
                $machines[$i] = $row;
            }
            return $machines;
        } else {
            return 0;
        }
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function  uniqueAssignedUsers(){
    $con = connectRecipe();
    $i = 0;
    $machines = [];
    if ($con) {
        $machine_query = "SELECT DISTINCT(`tcp_register`.`imei`) FROM `tcp_assign_machine` JOIN `tcp_register` ON `tcp_assign_machine`.`tcp_machineid`=`tcp_register`.`id` JOIN `store` ON `tcp_assign_machine`.`tcp_store`=`store`.`id` JOIN `brand_tbl` ON `brand_tbl`.`id`=`tcp_assign_machine`.`tcp_brand` JOIN `users` ON `users`.`user_id`=`tcp_assign_machine`.`tcp_pri_user` JOIN `countries` ON `countries`.`id`=`store`.`country` JOIN `states` ON `states`.`id`=`store`.`state` JOIN `cities` ON `cities`.`id`=`store`.`city` WHERE `tcp_assign_machine`.`status`='1'";
       // print_r($machine_query);exit;
        $success_q = mysqli_query($con, $machine_query);


         
        if ($success_q) {

            while ($row = mysqli_fetch_assoc($success_q)) {

                $i++;
                $machines[$i] = $row;
            }
            return $machines;
        } else {
            return 0;
        }
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function tcp_register_function($imei,$machine_type,$tcp_sr,$tcp_instaldate,$tcp_low_threshold,$tcp_high_threshold)
{
    //  print_r($recipe_version);exit;
    $con = connectRecipe();
// print_r($con);exit;

    if ($con) {

        $check_imei = "select * from `tcp_register` where imei='$imei'";
        $doneimei = mysqli_query($con, $check_imei);

        if($doneimei->num_rows>0)
        {
        $check_tcp = "select * from `tcp_register` where imei='$imei' AND `status`='1'";
        $done1 = mysqli_query($con, $check_tcp);

        if($done1->num_rows==0){
            return 3;
        }else{

            $stmt = "insert into tcp_register(imei, tcp_machine_type, tcp_sr,tcp_instaldate,tcp_low_threshold,tcp_high_threshold)values('$imei','$machine_type','$tcp_sr','$tcp_instaldate','$tcp_low_threshold','$tcp_high_threshold')";
            // print_r($stmt);exit;
    
                $done = mysqli_query($con, $stmt);
            // print_r($done);exit;
                if ($done) {
    
                    return 0;
                } 
                else  {
                    return 2;
                }
        
            }
        }
        else{

            $stmt1 = "insert into tcp_register(imei, tcp_machine_type, tcp_sr,tcp_instaldate,tcp_low_threshold,tcp_high_threshold)values('$imei','$machine_type','$tcp_sr','$tcp_instaldate','$tcp_low_threshold','$tcp_high_threshold')";
            // print_r($stmt);exit;
    
                $done2 = mysqli_query($con, $stmt1);
            // print_r($done);exit;
                if ($done2) {
    
                    return 0;
                } 
                else  {
                    return 2;
                }
        
            }

    }
            if (!$con){
                die("Connection failed: " . mysqli_connect_error());
            }
            mysqli_close($con);
    
}


function getSingleAssignedDevice_TCP($id)
{
    $con = connectRecipe();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `tcp_assign_machine` WHERE `id`='$id' ";
        //print_r($stmt);exit;

        $i = 0;

        $data = mysqli_query($con, $stmt);

        $row = mysqli_fetch_assoc($data);
        if (!empty($row)) {
            return $row;
        } else {
            return false;
        }
    }   
    
    if (!$con){
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function removeDevice_TCP($id, $machine, $brand, $user, $store, $reason, $updateby)
{
    $con = connectRecipe();
    $data = "";

    if ($con) {
        $stmt = "UPDATE `tcp_assign_machine` SET `tcp_machineid`='$machine', `tcp_brand`='$brand', `tcp_pri_user`='$user', `tcp_store`='$store', `status`='0'
        WHERE `id`='$id'";
        // print_r($stmt);
        $data2 = mysqli_query($con, $stmt);
        if ($data2) {
            $stmt2 = "UPDATE `tcp_register` SET `active`='0' WHERE `id`='$machine'";
            // print_r($stmt);exit;


            $data = mysqli_query($con, $stmt2);
            // print_r($data);exit;


            if ($data2) {
                $stmt3 = "INSERT INTO `tcp_update_info`( `tcp_machine`, `tcp_brand`, `tcp_user`, `tcp_store`, `reason`, `person`, `status`) 
                 VALUES ('$machine','$brand','$user','$store','$reason','$updateby','2')";
                // print_r($stmt3); exit;

                $data2 = mysqli_query($con, $stmt3);




                if ($data2) {

                    //$row = mysqli_fetch_assoc($data2);
                    //print_r($row[machine_id]);exit;
                    // $stmt = "SELECT `tcp_machineid` FROM `tcp_assign_machine` WHERE `status`='1' AND `tcp_machineid`='$row[tcp_machineid]'";
                    // $data = mysqli_query($con, $stmt);
                    // // print_r($data->num_rows);exit;
                    // // $row = mysqli_fetch_assoc($data);

                    // if ($data->num_rows == 0) {
                    //     $stmt = "UPDATE `machines` SET `assign_status`='0' WHERE  `id`='$row[tcp_machineid]'";
                    //     //print_r($stmt);exit;


                    //     $data = mysqli_query($con, $stmt);
                    //     //$row = mysqli_fetch_assoc($data);
                    // }

                    return 0;
                }
            } else {
                return 1;
            }
        }
    } 
    if (!$con){

        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

