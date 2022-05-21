<?php
//session_start();
function connectDB()
{

    //$con = mysqli_connect("localhost", "root", "", "disciple");
    $con = mysqli_connect("localhost", "root", "Mukunda@123", "mk_db");

    return $con;
}

function insertraw($slnum, $software_v, $app_v, $recipe_v, $app_name, $app_location, $Serial_number, $heartbeat, $error_count, $recipe_count, $cleaning_counter, $eod_cleaning_counter)
{
    $con = connectDB();
    $user = "";

    if ($con) {
        $stmt = "INSERT INTO `rawdata`(`serial_num`, `soft_v`, `app_v`, `recipe_v`, `app_name`, `app_loc`, `sl_num`, `heartbeat`, `err_count`, `recipe_count`, `cleaning_count`, `eod_c_clount`) 
        VALUES ('$slnum','$software_v','$app_v','$recipe_v','$app_name','$app_location','$Serial_number','$heartbeat','$error_count','$recipe_count','$cleaning_counter','$eod_cleaning_counter')";



        $user = mysqli_query($con, $stmt);
        //print_r($stmt);exit;
        if ($user) {


            $Query = "SELECT * FROM `rawdata` WHERE status=0";




            $Subject = mysqli_query($con, $Query);
            $i = -1;
            $productlist[] = "";
            if ($Subject) {

                while ($row = mysqli_fetch_assoc($Subject)) {
                    $i++;

                    $productlist[$i] = $row;
                    //print_r($row['id']);
                    $r_id = $row['id'];
                    $query = "UPDATE `rawdata` SET `status`=1 WHERE `id`='$r_id'";
                    $done = mysqli_query($con, $query);
                }
                //print_r($productlist);exit;
                foreach ($productlist as $cat) {

                    //print_r($cat);exit;
                    $slno = $cat['serial_num'];
                    $loc = $cat['app_loc'];
                    $rec_count = $cat['recipe_count'];
                    $dateonly = strtotime($cat['updatetime']);
                    //$dateonly=strtotime('2021-11-26 13:04:48');
                    $date = date('Y-m-d', $dateonly);
                    $time = date('H:i:s', $dateonly);
                    //print_r($date);
                    //echo"\n";
                    // print_r($time);exit;

                    $stmt = "SELECT `id` FROM `product` WHERE `slno`='$slno' AND `location`='$loc' AND `date`='$date'";
                    $Subject1 = mysqli_query($con, $stmt);
                    //print_r($stmt);
                    //print_r($Subject1->num_rows);exit;
                    if ($Subject1->num_rows > 0) {

                        $row = mysqli_fetch_assoc($Subject1);
                        // print_r($row['id']);
                        $p_id = $row['id'];
                        $query = "UPDATE `product` SET `rec_count`='$rec_count',`status`=1 WHERE `id`='$p_id'";
                        $done = mysqli_query($con, $query);
                        return true;
                        //echo "hi";
                    } else {

                        //print_r($device_name);
                        // user not existed
                        $query = "INSERT INTO `product`(`slno`, `location`, `rec_count`, `date`,`time`) VALUES ('$slno','$loc','$rec_count','$date','$time')";
                        //print_r($query);
                        $done = mysqli_query($con, $query);
                        return true;
                    }
                }
                return $productlist;
            } else {
                return null;
            }

            //return true;

        } else {
            return false;
        }
    }
    mysqli_close($con);
}

function getdata()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `product`";



        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $i++;

                $products[$i] = $row;
                //print_r($row['id']);





            }
            //print_r($products);
            return $products;
        } else {
            return false;
        }
    }
    mysqli_close($con);
}


function getdatasingle($prod)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `product` WHERE `location`='$prod' ORDER BY `product`.`date` DESC";



        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $i++;

                $products[$i] = $row;
                //print_r($row['id']);





            }
            //print_r($products);
            return $products;
        } else {
            return false;
        }
    }
    mysqli_close($con);
}

function getcity()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `product`";



        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $i++;

                $products[$i] = $row;
                //print_r($row['id']);





            }
            //print_r($products);
            return $products;
        } else {
            return false;
        }
    }
    mysqli_close($con);
}


function getdistinctdate()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT DISTINCT(date) FROM `product` ORDER BY `product`.`date` DESC";



        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $i++;

                $products[$i] = $row;
                //print_r($row['id']);





            }
            //print_r($products);
            return $products;
        } else {
            return false;
        }
    }
    mysqli_close($con);
}


function getCountriesById($country_id)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT `name` FROM `countries` WHERE `id`='$country_id' ";
        $i = 0;


        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        $row = mysqli_fetch_assoc($data);
        if ($row) {

            return $row;
        } else {
            return false;
        }
    }
    mysqli_close($con);
}
function getStatesById($state_id)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT `name` FROM `states` WHERE `id`='$state_id' ";
        $i = 0;


        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        $row = mysqli_fetch_assoc($data);
        if ($row) {

            return $row;
        } else {
            return false;
        }
    }
    mysqli_close($con);
}
function getCityById($city_id)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT `name` FROM `cities` WHERE `id`='$city_id' ";
        $i = 0;


        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        $row = mysqli_fetch_assoc($data);
        if ($row) {

            return $row;
        } else {
            return false;
        }
    }
    mysqli_close($con);
}

function getCountries()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `countries` ORDER BY `id` ASC";
        $i = 0;


        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $i++;

                $products[$i] = $row;
                //print_r($row['id']);





            }
            //print_r($products);
            return $products;
        } else {
            return false;
        }
    }
    mysqli_close($con);
}


function getStates($cid)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `states` WHERE `country_id`='$cid' ORDER BY `name` ASC";
        //print_r($stmt);exit;
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
    mysqli_close($con);
}


function getAllStates()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `states` WHERE 1 ORDER BY `name` ASC";
        //print_r($stmt);exit;
        $i = 0;

        $data = mysqli_query($con, $stmt);
        //print_r($data);exit;
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
    mysqli_close($con);
}

function getCities($sid)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `cities` WHERE `state_id`='$sid' ORDER BY `name` ASC";
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
    }
    mysqli_close($con);
}

function getAllCities()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `cities` WHERE 1 ORDER BY `name` ASC";
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
    }
    mysqli_close($con);
}


function brandname_check($sid)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT `brand_name` FROM `brand_tbl` WHERE `brand_name` = '$sid' AND `status`='1'";
        //print_r($stmt);exit;
        $i = 0;

        $data = mysqli_query($con, $stmt);
        if ($data->num_rows > 0) {

            return true;
        } else {
            return false;
        }
    }
    mysqli_close($con);
}


function addBrand($brandname, $outlets, $address, $pincode, $country, $state, $city, $personname, $designation, $phone, $email)
{
    $con = connectDB();
    $data = "";

    if ($con) {

        $stmt = "SELECT `brand_name` FROM `brand_tbl` WHERE `brand_name`='$brandname' AND `status`='1'";
        //print_r($stmt);exit;
        $i = 0;

        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data->num_rows == 0) {
            $stmt = "INSERT INTO `brand_tbl`(`brand_name`, `outlets`, `address`, `pincode`, `country`, `state`, `city`, `bp_name`, `bp_designation`, `bp_phone`, `bp_email`) 
    VALUES ('$brandname','$outlets','$address','$pincode','$country','$state','$city','$personname','$designation','$phone','$email')";
            $done = mysqli_query($con, $stmt);
            //print_r($stmt);exit;
            if ($done) {

                return 0;
            } else {
                return 1;
            }
        } else {
            return 2;
        }
    }
    mysqli_close($con);
}

function editBrand($id, $brandname, $outlets, $address, $pincode, $country, $state, $city, $personname, $designation, $phone, $email,$reason,$updateby)
{
    $con = connectDB();
    $data = "";

    if ($con) {


        $stmt = "UPDATE `brand_tbl` SET `brand_name`='$brandname',`outlets`='$outlets',`address`='$address',`pincode`='$pincode',`country`='$country',`state`='$state',`city`='$city',`bp_name`='$personname',`bp_designation`='$designation',`bp_phone`='$phone',`bp_email`='$email' WHERE `id`='$id'";
        $done = mysqli_query($con, $stmt);
        //print_r($stmt);exit;
        if ($done) {
            $stmt = "INSERT INTO `brand_record`(`brand_id`, `brand_name`, `outlets`, `address`, `pincode`, `country`, `state`, `city`, `bp_name`, `bp_designation`, `bp_phone`, `bp_email`, `person_name`, `reason`, `record`) VALUES ('$id', '$brandname', '$outlets', '$address', '$pincode', '$country', '$state', '$city', '$personname', '$designation', '$phone', '$email','$updateby','$reason',1)";


            //print_r($stmt);exit;
            $done = mysqli_query($con, $stmt);
            return 0;
        } else {
            return 1;
        }
    }
    mysqli_close($con);
}



function getBrands()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `brand_tbl` WHERE `status`='1' ORDER BY `id` DESC";
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
    }
    mysqli_close($con);
}

function getBrand($id)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `brand_tbl` WHERE `id`='$id' ORDER BY `id` DESC";
        //print_r($stmt);exit;
        $i = 0;

        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;

        $row = mysqli_fetch_assoc($data);
        if ($row) {






            return $row;
        } else {
            return false;
        }
    }
    mysqli_close($con);
}



function deleteBrand($id)
{
    $con = connectDB();
    $data = "";

    if ($con) {

        $checkassigned = getAssignedDeviceBrandWise($id);
        //print_r($checkassigned);exit;
        //$checkassigned=$checkassigned[1];
        $count = sizeof($checkassigned);
        if ($count == 0) {


            $store=getBrandStores($id);
            //print_r($store);exit;
            if(sizeof($store)==0){

                $user=getBrandUsers($id); 
               // print_r($user);exit;
                if(sizeof($user)==0){
                    $stmt = "UPDATE `brand_tbl` SET `status`=0 WHERE `id`='$id'";
                    //print_r($stmt);exit;
                    $i = 0;
        
                    $data = mysqli_query($con, $stmt);
                    // print_r($data);exit;
        
        
                    if ($data) {
                        return 1;
                    } else {
                        return 0;
                    }
                }else{
                    return 4;
                }
               
            }else{
                return 3;
            }
            
        } else {
            return 2;
        }
    }
    mysqli_close($con);
}


function getAssignedDeviceBrandWise($brandid)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `assigned_divices` WHERE `brand_id` = $brandid AND `status` = 1 ORDER BY `id` DESC";
        //print_r($stmt);exit;
        $i = 0;

        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {


                $products[$i] = $row;
                //print_r($row['id']);



                $i++;
            }
            //print_r($products);exit;
            return $products;
        } else {
            return false;
        }
    }
    mysqli_close($con);
}


function addStore($brandname, $storename, $storeperson, $storecontact, $country, $state, $city, $pincode)
{
    $con = connectDB();
    $data = "";

    if ($con) {

        $stmt = "SELECT * FROM `store` WHERE `brand_id`='$brandname' AND `store_name`='$storename' AND `status`='1'";
        //print_r($stmt);exit;
        $i = 0;

        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data->num_rows == 0) {
            $stmt = "INSERT INTO `store`(`brand_id`, `store_name`, `p_name`, `p_phone`, `country`, `state`, `city`, `pincode`) 
            VALUES ('$brandname','$storename','$storeperson','$storecontact','$country','$state','$city','$pincode')";
            $done = mysqli_query($con, $stmt);
            //print_r($stmt);exit;
            if ($done) {

                return 0;
            } else {
                return 1;
            }
        } else {
            return 2;
        }
    }
    mysqli_close($con);
}



function getStores()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `store` WHERE `status`='1' ORDER BY `id` DESC";
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
    }
    mysqli_close($con);
}


function editStore($id, $storebrandid, $storename, $storeperson, $storecontact)
{
    $con = connectDB();
    $data = "";

    if ($con) {


        $stmt = "UPDATE `store` SET `brand_id`='$storebrandid',`store_name`='$storename',`p_name`='$storeperson',`p_phone`='$storecontact' WHERE `id`='$id'";
        $done = mysqli_query($con, $stmt);
        //print_r($stmt);exit;
        if ($done) {

            return 0;
        } else {
            return 1;
        }
    }
    mysqli_close($con);
}


function deleteStore($id)
{
    $con = connectDB();
    $data = "";

    if ($con) {

        $checkassignedStore=getAssignedDeviceStoreWise($id);
        if(sizeof($checkassignedStore)==0){
            $stmt = "UPDATE `store` SET `status`='0' WHERE `id`='$id'";
            //print_r($stmt);exit;
            $i = 0;
    
            $data = mysqli_query($con, $stmt);
            // print_r($data);exit;
    
    
            if ($data) {
    
    
    
    
    
    
                return 1;
            } else {
                return 0;
            }
        }else{
            return 2;
        }
        
    }
    mysqli_close($con);
}

function getAssignedDeviceStoreWise($storeid)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `assigned_divices` WHERE `store_id` = $storeid AND `status` = 1 ORDER BY `id` DESC";
        //print_r($stmt);exit;
        $i = 0;

        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {


                $products[$i] = $row;
                //print_r($row['id']);



                $i++;
            }
            //print_r($products);exit;
            return $products;
        } else {
            return false;
        }
    }
    mysqli_close($con);
}


function addUser($brandid,  $username, $useremail, $userphone)
{
    $con = connectDB();
    $data = "";

    if ($con) {

        $stmt = "SELECT * FROM `users` WHERE `brand`='$brandid' AND `email`='$useremail' AND `status`='1'";
        //print_r($stmt);
        $i = 0;

        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data->num_rows == 0) {
            $stmt = "INSERT INTO `users`(`name`, `email`, `phone`, `brand`) 
            VALUES ('$username','$useremail', '$userphone','$brandid')";
            $done = mysqli_query($con, $stmt);
            //print_r($stmt);
            if ($done) {

                return 0;
            } else {
                return 1;
            }
        } else {
            return 2;
        }
    }
    mysqli_close($con);
}

function getusers()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `users` WHERE `status`='1' ORDER BY `user_id` DESC";
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
    }
    mysqli_close($con);
}

function getSingleuser($id)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `users` WHERE `user_id`='$id' ";
        //print_r($stmt);exit;
        $i = 0;

        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;

        $row = mysqli_fetch_assoc($data);
        if (!empty($row)) {

            //print_r($products);exit;
            return $row;
        } else {
            return false;
        }
    }
    mysqli_close($con);
}



function editUser($id, $brandid, $username, $useremail, $userphone, $reason, $updateby)
{

    $con = connectDB();
    $data = "";

    if ($con) {

        //$user=getSingleuser($id);
        // print_r($user);exit;

        $stmt = "UPDATE `users` SET`name`='$username',`email`='$useremail',`phone`='$userphone',`brand`='$brandid' WHERE `user_id`='$id'";

        //print_r($stmt);exit;
        $done = mysqli_query($con, $stmt);
        // $stmt = "UPDATE `users_` SET`name`='$username',`email`='$useremail',`phone`='$userphone',`brand`='$brandid' WHERE `user_id`='$id'";

        //print_r($stmt);exit;
        //  $done = mysqli_query($con, $stmt);
        //print_r($done);exit;
        if ($done) {
            $stmt = "INSERT INTO `user_record`(`user_id`, `user`, `email`, `phone`, `brand`, `person_by`,`reason`, `value`) VALUES ('$id','$username','$useremail','$userphone','$brandid','$updateby','$reason','1')";


            //print_r($stmt);exit;
            $done = mysqli_query($con, $stmt);

            return 0;
        } else {
            return 1;
        }
    }
    mysqli_close($con);
}

function deleteUser($id, $reason, $updateby)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "UPDATE `users` SET `status`='0' WHERE `user_id`='$id'";
        //print_r($stmt);exit;
        $i = 0;

        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        $user = getSingleuser($id);
        //print_r($user);exit;
        $id = $user['user_id'];
        $username = $user['name'];
        $useremail = $user['email'];
        $userphone = $user['phone'];
        $brandid = $user['brand'];

        if ($data) {

            $stmt = "INSERT INTO `user_record`(`user_id`, `user`, `email`, `phone`, `brand`, `person_by`,`reason`, `value`) VALUES ('$id','$username','$useremail','$userphone','$brandid','$updateby','$reason','2')";


            //print_r($stmt);exit;
            $done = mysqli_query($con, $stmt);




            return 1;
        } else {
            return 0;
        }
    }
    mysqli_close($con);
}



function addProductType($name, $revision)
{
    $con = connectDB();
    $data = "";

    if ($con) {

        $stmt = "SELECT * FROM `product_type` WHERE `name`='$name' AND `version`='$revision'";
        // print_r($stmt);
        $i = 0;

        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data->num_rows == 0) {
            $stmt = "INSERT INTO `product_type`(`name`, `version`) VALUES ('$name','$revision')";
            $done = mysqli_query($con, $stmt);
            //print_r($stmt);
            if ($done) {

                return 0;
            } else {
                return 1;
            }
        } else {
            return 2;
        }
    }
    mysqli_close($con);
}

function getProductTypes()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `product_type` WHERE 1 ORDER BY `id` DESC";
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
    }
    mysqli_close($con);
}


function getptype($mid)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `product_type` WHERE `id`='$mid'";
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
    mysqli_close($con);
}


function getptypebybrand($mid)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT DISTINCT(product_type.id),product_type.name,product_type.version FROM `assigned_divices` JOIN machines ON machines.id=assigned_divices.machine_id AND assigned_divices.status=1 AND machines.status=1 JOIN brand_tbl ON brand_tbl.id=assigned_divices.brand_id JOIN product_type ON product_type.id=machines.ptype_id AND product_type.sts=1 WHERE assigned_divices.brand_id=$mid";
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
    mysqli_close($con);
}


function getPtypeByBrandAndUser($mid,$uid)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT DISTINCT(product_type.id),product_type.name,product_type.version FROM `assigned_divices` JOIN machines ON machines.id=assigned_divices.machine_id AND assigned_divices.status=1 AND machines.status=1 JOIN brand_tbl ON brand_tbl.id=assigned_divices.brand_id JOIN product_type ON product_type.id=machines.ptype_id AND product_type.sts=1 WHERE assigned_divices.brand_id=$mid AND assigned_divices.user_id=$uid";
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
    mysqli_close($con);
}


function addMachine($name, $ptypeid, $macid, $sr, $mainboard, $manufacturedate, $dipatchedate, $instaldate)
{
    $con = connectDB();
    $data = "";

    if ($con) {

        $stmt = "SELECT * FROM `machines` WHERE `name`='$name' AND `status`='1'";
        // print_r($stmt);
        $i = 0;

        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data->num_rows == 0) {
            $stmt = "INSERT INTO `machines`(`name`, `ptype_id`, `mac_id`, `sr`, `mainboard`, `manufacturedate`, `dipatchedate`, `instaldate`) 
            VALUES ('$name','$ptypeid','$macid','$sr','$mainboard','$manufacturedate','$dipatchedate','$instaldate')";
            $done = mysqli_query($con, $stmt);
            //print_r($stmt);
            if ($done) {

                return 0;
            } else {
                return 1;
            }
        } else {
            return 2;
        }
    }
    mysqli_close($con);
}

function editMachine($id, $name, $ptypeid, $macid, $sr, $mainboard, $manufacturedate, $dipatchedate, $instaldate)
{
    $con = connectDB();

    if ($con) {

        //UPDATE `machines` SET `id`='[value-1]',`name`='[value-2]',`ptype_id`='[value-3]',`mac_id`='[value-4]',`sr`='[value-5]',`mainboard`='[value-6]',`manufacturedate`='[value-7]',`dipatchedate`='[value-8]',`instaldate`='[value-9]' WHERE `id`='$id'
        $stmt = "UPDATE `machines` SET `name`='$name',`ptype_id`='$ptypeid',`mac_id`='$macid',`sr`='$sr',`mainboard`='$mainboard',`manufacturedate`='$manufacturedate',`dipatchedate`='$dipatchedate',`instaldate`='$instaldate' WHERE `id`='$id'";
        $done = mysqli_query($con, $stmt);
        //print_r($stmt);exit;
        if ($done) {

            return 0;
        } else {
            return 1;
        }
    }
    mysqli_close($con);
}



function getMachines()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `machines` WHERE `status`='1' ORDER BY `id` DESC";
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
    }
    mysqli_close($con);
}

function getUnAssignedMachines()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `machines` WHERE `assign_status`='0' AND `status`='1' AND `dipatchedate` != '' AND `instaldate` != '' ORDER BY `id` DESC";
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
    }
    mysqli_close($con);
}

function getSingleMachine($id)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `machines` WHERE `id`='$id'";
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
    mysqli_close($con);
}


function deleteMachine($id, $reason, $person)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "UPDATE `machines` SET `status`='0' WHERE `id`='$id'";
        //print_r($stmt);exit;


        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;


        if ($data) {


            $stmt = "INSERT INTO `machine_record`(`machine_id`, `reason`, `person`) VALUES ('$id','$reason','$person')";
            //print_r($stmt);exit;


            $data = mysqli_query($con, $stmt);



            return 1;
        } else {
            return 0;
        }
    }
    mysqli_close($con);
}



function getBrandUsers($id)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `users` WHERE `brand`='$id' AND `status`='1'";
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
    mysqli_close($con);
}


function getBrandStores($id)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `store` WHERE `brand_id`='$id' AND `status`='1'";
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
    mysqli_close($con);
}

function getSingleStore($id)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `store` WHERE `id`='$id'";
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
    mysqli_close($con);
}

function assignDevice($machineid, $brand, $user, $store)
{
    $con = connectDB();
    $data = "";

    if ($con) {

        $stmt = "SELECT * FROM `assigned_divices` WHERE `machine_id`='$machineid' AND `brand_id`='$brand' AND `user_id`='$user' AND `store_id`='$store'";
        // print_r($stmt);
        $i = 0;

        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;
        if ($data->num_rows == 0) {
            $stmt = "INSERT INTO `assigned_divices`( `machine_id`, `brand_id`, `user_id`, `store_id`) 
            VALUES ('$machineid','$brand','$user','$store')";
            $done = mysqli_query($con, $stmt);
            //print_r($stmt);
            if ($done) {

                $stmt = "UPDATE `machines` SET `assign_status`='1' WHERE `id`='$machineid'";
                $done = mysqli_query($con, $stmt);

                return 0;
            } else {
                return 1;
            }
        } else {
            return 2;
        }
    }
    mysqli_close($con);
}


function getAssignedDevices()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `assigned_divices` WHERE `status`='1' ORDER BY `id` DESC";
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
    mysqli_close($con);
}

function getAssignedStoppedDevice()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT DISTINCT `machine_id`,`id` FROM `assigned_divices` WHERE `status`='1' AND `active`=0";
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
    mysqli_close($con);
}

function getAssignedStartedDevice()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `assigned_divices` WHERE `status`='1' AND `active`=1 ORDER BY `id` DESC";
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
    mysqli_close($con);
}


function getSingleAssignedDevice($id)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `assigned_divices` WHERE `id`='$id' ";
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
    mysqli_close($con);
}


function updateDevice($id, $brand, $user, $store, $reason, $updateby)
{
    $con = connectDB();
    $data = "";

    if ($con) {

        $stmt = "UPDATE `assigned_divices` SET `brand_id`='$brand',`user_id`='$user',`store_id`='$store' WHERE `id`='$id'";
        // print_r($stmt);
        $i = 0;

        $data = mysqli_query($con, $stmt);

        if ($data) {

            $stmt = "SELECT * FROM `assigned_divices` WHERE `id`='$id'";
            // print_r($stmt);


            $data1 = mysqli_query($con, $stmt);
            $row = mysqli_fetch_assoc($data1);
            if (!empty($row)) {
                $machineid = $row['machine_id'];
                $brand = $row['brand_id'];
                $user = $row['user_id'];
                $store = $row['store_id'];
                $stmt = "INSERT INTO `update_record`( `machine_id`, `brand_id`, `user_id`, `store_id`, `reason`, `person_by`, `record value`) 
                VALUES ('$machineid','$brand','$user','$store','$reason','$updateby','1')";
                // print_r($stmt);


                $data2 = mysqli_query($con, $stmt);
                if (!empty($data2)) {
                    return 0;
                } else {
                    return 1;
                }
            } else {
                return 1;
            }
        } else {
            return 1;
        }
    }
    mysqli_close($con);
}

function getUpdatesOfDevices()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `update_record` WHERE 1 ORDER BY `id` DESC";
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
    mysqli_close($con);
}



function getAssignedDevice($id)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `assigned_divices` WHERE `machine_id`='$id' AND `status`='1'";
        // print_r($stmt);exit;

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
    mysqli_close($con);
}



function removeDevice($Deviceid, $machine, $brand, $user, $store, $reason, $updateby)
{
    $con = connectDB();
    $data = "";

    if ($con) {

        $stmt = "UPDATE `assigned_divices` SET `status`='0' WHERE `id`='$Deviceid'";
        //print_r($stmt);exit;


        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;


        if ($data) {
            $stmt = "INSERT INTO `update_record`( `machine_id`, `brand_id`, `user_id`, `store_id`, `reason`, `person_by`, `record value`) 
            VALUES ('$machine','$brand','$user','$store','$reason','$updateby','2')";
            //print_r($stmt);exit;

            $data2 = mysqli_query($con, $stmt);

            $stmt = "SELECT `machine_id` FROM `assigned_divices` WHERE `id`='$Deviceid'";
            //print_r($stmt);exit;


            $data = mysqli_query($con, $stmt);
            $row = mysqli_fetch_assoc($data);
            //print_r($row[machine_id]);exit;
            $stmt = "SELECT `machine_id` FROM `assigned_divices` WHERE `status`='1' AND `machine_id`='$row[machine_id]'";
            $data = mysqli_query($con, $stmt);
            // print_r($data->num_rows);exit;
            // $row = mysqli_fetch_assoc($data);

            if ($data->num_rows == 0) {
                $stmt = "UPDATE `machines` SET `assign_status`='0' WHERE  `id`='$row[machine_id]'";
                //print_r($stmt);exit;


                $data = mysqli_query($con, $stmt);
                //$row = mysqli_fetch_assoc($data);
            }





            return 0;
        } else {
            return 1;
        }
    }
    mysqli_close($con);
}


function startDevice($Deviceid, $machine, $brand, $user, $store, $reason, $updateby)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "INSERT INTO `update_record`( `machine_id`, `brand_id`, `user_id`, `store_id`, `reason`, `person_by`, `record value`) 
        VALUES ('$machine','$brand','$user','$store','$reason','$updateby','3')";
        //print_r($stmt);exit;


        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;

        $stmt = "UPDATE `assigned_divices` SET `active`=1 WHERE `id`='$Deviceid'";
        //print_r($stmt);exit;


        $data = mysqli_query($con, $stmt);


        if ($data) {





            return 0;
        } else {
            return 1;
        }
    }
    mysqli_close($con);
}

function stopDevice($Deviceid, $machine, $brand, $user, $store, $reason, $updateby)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "INSERT INTO `update_record`( `machine_id`, `brand_id`, `user_id`, `store_id`, `reason`, `person_by`, `record value`) 
        VALUES ('$machine','$brand','$user','$store','$reason','$updateby','4')";
        //print_r($stmt);exit;


        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;

        $stmt = "UPDATE `assigned_divices` SET `active`=0 WHERE `id`='$Deviceid'";
        //print_r($stmt);exit;


        $data = mysqli_query($con, $stmt);

        if ($data) {





            return 0;
        } else {
            return 1;
        }
    }
    mysqli_close($con);
}


function getPtypeMachines($id)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `machines` WHERE `ptype_id`='$id' AND `status`='1'";
        //print_r($stmt);exit;

        $i = 0;

        $data = mysqli_query($con, $stmt);
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {


                // $products[$i] = $row['id'];
                //print_r($row['id']."hi");
                $machineid = $row['id'];


                $stmt = "SELECT * FROM `assigned_divices` WHERE `machine_id`='$machineid' AND `status`='1'";
                //print_r($stmt);exit;


                $data1 = mysqli_query($con, $stmt);
                // print_r($data1);exit;


                if ($data1->num_rows > 0) {

                    $i++;



                    $products[$i] = $machineid;
                }
            }
            // print_r($products);
            //exit;
            if (empty($products[1])) {
                return 1;
            } else {
                return $products;
            }
        } else {
            return 1;
        }
    }
    mysqli_close($con);
}



function getRecipeByMachineId($m_name, $fromdate, $todate)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `recepe_count_sln` WHERE `SLN` LIKE '$m_name' AND `date` BETWEEN '$fromdate' AND '$todate'";
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
    mysqli_close($con);
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


function getUniqueRecepeType()
{
    $conn = connectDB();
    $user = "";
    $i = -1;
    $products[] = "";
    if ($conn) {
        $sql = "SELECT DISTINCT `rcptype` FROM `unique_recepe`";
        $Subject = mysqli_query($conn, $sql);
        if ($Subject->num_rows > 0) {

            //print_r($user);exit;

            while ($row = mysqli_fetch_assoc($Subject)) {
                $i++;

                $products[$i] = $row;
            }
            //print_r($products);exit;
            return $products;
        } else {
            return false;
        }
    }
    mysqli_close($conn);
}


function getMachinesByPtype($ptype)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `machines` WHERE `status`='1' AND `ptype_id`='$ptype' AND `assign_status`='1' ORDER BY `id` DESC";
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
    }
    mysqli_close($con);
}



function getProductsByName($name)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `products_daily_rc` WHERE `SLN`='$name' ORDER BY `date` DESC";
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
    }
    mysqli_close($con);
}



function getMachinesBybranduserstore($brand, $user, $store)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `assigned_divices` WHERE `brand_id`='$brand' AND `user_id`='$user' AND `store_id`='$store' AND `status`='1' ";
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
    }
    mysqli_close($con);
}

function recipeCountByTypeDate($date, $unirecipe, $mname)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT SUM(`rc`) as rc,`rectype` FROM (`recepe_count_sln` INNER JOIN `machines` ON `machines`.`name`=`recepe_count_sln`.`SLN` AND `machines`.`assign_status`=1 AND `recepe_count_sln`.`SLN`='$mname' AND `recepe_count_sln`.`rectype`='$unirecipe' AND `recepe_count_sln`.`date`='$date')";
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
    }
    mysqli_close($con);
}


function getUniqueDates($fromdate, $todate)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT DISTINCT `date` FROM `recepe_count_sln` WHERE `date` BETWEEN '$fromdate' AND '$todate' ORDER BY `date` DESC;";
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
    }
    mysqli_close($con);
}


function getrcByDate($date, $ptype)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT SUM(`rc`) as rc,`date` FROM (`recepe_count_sln` INNER JOIN `machines` ON `machines`.`name`=`recepe_count_sln`.`SLN` AND `recepe_count_sln`.`rectype`='$ptype' AND `recepe_count_sln`.`date`='$date' AND `machines`.`assign_status`=1)";
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
    }
    mysqli_close($con);
}

//SELECT SUM(`rc`),`rectype` FROM (`recepe_count_sln` INNER JOIN `machines` ON `machines`.`name`=`recepe_count_sln`.`SLN` AND `machines`.`assign_status`=1 AND `recepe_count_sln`.`SLN`='MFNV-900001-002-A-028' AND `recepe_count_sln`.`rectype`='MFPL Recipes' AND `recepe_count_sln`.`date`='2022-01-03');
function getLivemachines($value)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT `rawdata`.`SLN`,MAX(`rawdata`.`timestamp`) AS `timestamp` FROM `rawdata` JOIN `machines` ON `machines`.`name`=`rawdata`.`SLN` JOIN `product_type` ON `machines`.`ptype_id`=`product_type`.`id` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` $value GROUP BY `rawdata`.`SLN` ";
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
    }
    mysqli_close($con);
}


function getCountReport($query)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT COUNT(`rcpdata`.`rc`) AS `count`,`rcpdata`.`rcptype` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` $query GROUP BY `rcpdata`.`rcptype` ORDER BY `rcpdata`.`rcptype` ASC;";
        // print_r($stmt);exit;
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
    }
    mysqli_close($con);
}


function getUpdatesUser()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `user_record` ORDER BY ID ASC;";
        // print_r($stmt);exit;
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
    }
    mysqli_close($con);
}


function getRecipeCountReport($query, $date)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT COUNT(`rcpdata`.`rc`) AS `count` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` $query AND `rcpdata`.`timestamp` LIKE '%$date%' ORDER BY `rcpdata`.`timestamp`,`rcpdata`.`SLN`;";
        //print_r($stmt);
        //exit;
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
    }
    mysqli_close($con);
}



function getRecipeCountReportWeekly($query, $date)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT COUNT(`rcpdata`.`rc`) AS `count` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` $query $date ORDER BY `rcpdata`.`timestamp`,`rcpdata`.`SLN`";
        // print_r($stmt);
        //exit;
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
    }
    mysqli_close($con);
}

//SELECT COUNT(`rcpdata`.`rc`) AS `count`,`brand_tbl`.`brand_name` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` GROUP BY `brand_tbl`.`brand_name`;

function getRecipeCountBrandWise($query, $date)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT COUNT(`rcpdata`.`rc`) AS `count`,`brand_tbl`.`brand_name` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` $query $date GROUP BY `brand_tbl`.`brand_name`";
        //print_r($stmt);
        //exit;
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
    }
    mysqli_close($con);
}

function getErrorCountBrandWise($query, $ec, $date)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT COUNT(`rcpdata`.`rcpercd`) AS COUNT,`rcpdata`.`rcpercd`, `brand_tbl`.`brand_name` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` AND `rcpdata`.`rcpercd`!='NA'  $query $ec $date  Group BY `rcpdata`.`rcpercd`, `brand_tbl`.`brand_name` ORDER BY `brand_tbl`.`brand_name`;";

        //print_r($stmt);
        //exit;
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
    }
    mysqli_close($con);
}


function getUniqueCodes()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT DISTINCT(`rcpercd`) FROM `rcpdata` WHERE `rcpercd`!='NA' ORDER BY `rcpercd`";
        //print_r($stmt);
        //exit;
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
    }
    mysqli_close($con);
}

//SELECT`rawdata`.`eodcc` AS `ecc`,`rawdata`.`SLN`,`brand_tbl`.`brand_name`,`rawdata`.`timestamp` FROM `rawdata` JOIN `machines` ON `machines`.`name`=`rawdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` AND `rawdata`.`eodcc`!='0' AND `rawdata`.`timestamp` LIKE '%2022-01-21%' ORDER BY `rawdata`.`timestamp` DESC LIMIT 1;
function getEndCleaningCounter($query, $date)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT`rawdata`.`eodcc` AS `ecc`,`rawdata`.`SLN`,`brand_tbl`.`brand_name`,`rawdata`.`timestamp` FROM `rawdata` JOIN `machines` ON `machines`.`name`=`rawdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` AND `rawdata`.`eodcc`!='0' $query AND `rawdata`.`timestamp` LIKE '%$date%' ORDER BY `rawdata`.`timestamp` DESC LIMIT 1";
        //print_r($stmt);
        //exit;
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
    }
    mysqli_close($con);
}

function getUniqueBrands()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT DISTINCT `brand_name` FROM `brand_tbl`";
        //print_r($stmt);
        //exit;
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
    }
    mysqli_close($con);
}


function getFailureCounts($query)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT COUNT(`rcpdata`.`finalop`) AS count, `brand_tbl`.`brand_name` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` WHERE `rcpdata`.`finalop` LIKE 'Failure' $query Group BY `brand_tbl`.`brand_name` ORDER BY `brand_tbl`.`brand_name`";
        //print_r($stmt);
        //exit;
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
    }
    mysqli_close($con);
}

function getSingleMachineByName($query)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `machines` WHERE `name`='$query' AND `assign_status`='1' AND `status`='1'";
        // print_r($stmt);
        //exit;
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
    }
    mysqli_close($con);
}


function getMostSellingCountReport($query)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT COUNT(`rcpdata`.`rc`) AS `count`,`rcpdata`.`rcpname`,`rcpdata`.`rcptype` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` $query GROUP BY `rcpdata`.`rcpname`,`rcpdata`.`rcptype` ORDER BY `rcpdata`.`rcptype` ASC";
        // print_r($stmt);exit;
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
    }
    mysqli_close($con);
}
function getDistinctRecepeTyp()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT DISTINCT(`rcptype`) FROM `rcpdata` ORDER BY `rcptype` DESC;";
        // print_r($stmt);exit;
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
    }
    mysqli_close($con);
}

function getDistinctRecepeTypebyBrand($brandid)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT DISTINCT(`rcpdata`.`rcptype`) FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` AND `brand_tbl`.`id`=$brandid JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` ORDER BY `rcpdata`.`rcptype`;";
        // print_r($stmt);exit;
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
    }
    mysqli_close($con);
}

function getRecipeProcess($query, $date)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT `time`,`SLN`,`ptype`,`cookingtype`,`macid`,`rcptype`,`rcpname`,`rcpstarttime`,`rcpendtime`,`rcpercd`,`finalop`,`appname`,`timestamp` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 $query $date";
        //print_r($stmt);
        //  exit;
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
    }
    mysqli_close($con);
}


function getBrandAndUserStores($id,$user)
{
    $con = connectDB();
    $data = "";

    if ($con) {

        $stmt = "SELECT DISTINCT(store.id),store.store_name FROM `assigned_divices` JOIN machines ON machines.id=assigned_divices.machine_id AND assigned_divices.status=1 AND machines.status=1 JOIN store ON assigned_divices.store_id=store.id JOIN brand_tbl ON brand_tbl.id=assigned_divices.brand_id JOIN product_type ON product_type.id=machines.ptype_id AND product_type.sts=1 WHERE assigned_divices.brand_id=$id AND assigned_divices.user_id=$user";
        //$stmt = "SELECT * FROM `store` WHERE `brand_id`='$id' AND `status`='1'";
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
    mysqli_close($con);
}


function getDistinctRecepeTypebyBrandAndUser($brandid,$uid)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT DISTINCT(`rcpdata`.`rcptype`) FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` AND `brand_tbl`.`id`=$brandid JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` AND `assigned_divices`.`user_id`=$uid ORDER BY `rcpdata`.`rcptype`";
        // print_r($stmt);exit;
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
    }
    mysqli_close($con);
}


function getPtypeAndUserMachines($id,$uid)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT `machines`.`id` FROM `machines`JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 AND `machines`.`ptype_id`=$id JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` AND `assigned_divices`.`user_id`=$uid";
        //print_r($stmt);exit;

        $i = 0;

        $data = mysqli_query($con, $stmt);
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {


                // $products[$i] = $row['id'];
                //print_r($row['id']."hi");
                $machineid = $row['id'];


                // $stmt = "SELECT * FROM `assigned_divices` WHERE `machine_id`='$machineid' AND `status`='1'";
                // //print_r($stmt);exit;


                // $data1 = mysqli_query($con, $stmt);
                // // print_r($data1);exit;


                // if ($data1->num_rows > 0) {

                    $i++;



                    $products[$i] = $machineid;
               // }
            }
            // print_r($products);
            //exit;
            if (empty($products[1])) {
                return 1;
            } else {
                return $products;
            }
        } else {
            return 1;
        }
    }
    mysqli_close($con);
}

function getusertcpimei($user)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt="SELECT `tcp_register`.`imei`from `tcp_register` JOIN `tcp_assign_machine` ON `tcp_register`.`id`=`tcp_assign_machine`.`tcp_machineid` JOIN `brand_tbl` ON `brand_tbl`.`id`=`tcp_assign_machine`.`tcp_brand` JOIN `store` ON `store`.`id`=`tcp_assign_machine`.`tcp_store` JOIN `users` ON `users`.`user_id`=`tcp_assign_machine`.`tcp_pri_user` WHERE `tcp_assign_machine`.`tcp_pri_user`='$user'  and `tcp_assign_machine`.`status`=1 ";
        // print_r($stmt);
        //exit;
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
    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getRecipeCountFromMachinePacketReport($query, $date)
{
    $con = connectDB();
    $data = "";
    $products = 0;
    $row = [];
   // print_r($query);
  //  print_r($date);

    if ($con) {
        $stmt = "SELECT `rawdata`.`rc` FROM `rawdata` JOIN `machines` ON `machines`.`name`=`rawdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` $query AND `rawdata`.`timestamp` LIKE '%$date%' ORDER BY `rawdata`.`id` DESC LIMIT 1;";
        
        // print_r($stmt);
        // exit;
        //$i = 0;
        $data = mysqli_query($con, $stmt);
        //$row = mysqli_fetch_assoc($data);
         //print_r($data);
        if ($data->num_rows>0) {


            $row = mysqli_fetch_assoc($data);
            //print_r($row);exit;
            // if(empty($row)){
            //     $row['rc']==0;
            // }
            $products = $row['rc'];


            //print_r($row['rc']);


            return $products;
        } else {
            // $row['rc']==0;
            // $products = $row['rc'];
            return $products;
        }
    } else {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getRecipeCountFromMachinePacketMaxRcReport($query, $date)
{
    $con = connectDB();
    $data = "";
    $products = [];
    if ($con) {
        $stmt = "SELECT max(`rawdata`.`rc`) as `rc`,`rawdata`.`SLN` FROM `rawdata` JOIN `machines` ON `machines`.`name`=`rawdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` $query AND `rawdata`.`timestamp` LIKE '%$date%' GROUP BY `rawdata`.`SLN`;";
        //print_r($stmt);
        // exit;
        $i = 0;

        $data = mysqli_query($con, $stmt);
        //$row = mysqli_fetch_assoc($data);
        //  print_r($row);
        // print_r($row);exit;
        if ($data->num_rows>0) {
            while ($row = mysqli_fetch_assoc($data)) {
                $i++;

                $products[$i] = $row;
                // print_r($row);

            }
            //print_r($products);exit;
            return $products;
        } else {
            return $products;
        }
    } else {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function test(){
    
}
