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
    if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function getdata()
{
    $con = connectDB();
    $data = "";
$i=0;
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getdatasingle($prod)
{
    $con = connectDB();
    $data = "";
    $i=0;
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function getcity()
{
    $con = connectDB();
    $data = "";
    $i=0;
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getdistinctdate()
{
    $con = connectDB();
    $data = "";
    $i=0;
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function addBrand($brandname, $outlets, $address, $pincode, $country, $state, $city, $personname, $designation, $phone, $email, $password)
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
            $stmt = "INSERT INTO `brand_tbl`(`brand_name`, `outlets`, `address`, `pincode`, `country`, `state`, `city`, `bp_name`, `bp_designation`, `bp_phone`, `bp_email`,`password`) 
    VALUES ('$brandname','$outlets','$address','$pincode','$country','$state','$city','$personname','$designation','$phone','$email','$password')";
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function editBrand($id, $brandname, $outlets, $address, $pincode, $country, $state, $city, $personname, $designation, $phone, $email, $password, $reason, $updateby)
{
    $con = connectDB();
    $data = "";

    if ($con) {


        $stmt = "UPDATE `brand_tbl` SET `brand_name`='$brandname',`outlets`='$outlets',`address`='$address',`pincode`='$pincode',`country`='$country',`state`='$state',`city`='$city',`bp_name`='$personname',`bp_designation`='$designation',`bp_phone`='$phone',`bp_email`='$email' WHERE `id`='$id'";
        $done = mysqli_query($con, $stmt);
        //print_r($stmt);exit;
        if ($done) {
            $stmt = "INSERT INTO `brand_record`(`brand_id`, `brand_name`, `outlets`, `address`, `pincode`, `country`, `state`, `city`, `bp_name`, `bp_designation`, `bp_phone`, `bp_email`,`password`, `updateby`,`reason`, `record`) VALUES ('$id', '$brandname', '$outlets', '$address', '$pincode', '$country', '$state', '$city', '$personname', '$designation', '$phone', '$email','$password','$updateby','$reason',1)";


            //print_r($stmt);exit;
            $done = mysqli_query($con, $stmt);
            return 0;
        } else {
            return 1;
        }
    }
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function getBrand($id)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT *,brand_tbl.id as id,cities.name as cityname,states.name as statename, countries.name as countryname,cities.id as cityid,states.id as stateid, countries.id as countryid FROM `brand_tbl` JOIN `countries` ON `brand_tbl`.`country`=`countries`.`id` JOIN states ON states.id=brand_tbl.state JOIN cities ON cities.id=brand_tbl.city WHERE brand_tbl.`id`='$id' ORDER BY brand_tbl.`id` DESC;";
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}



function deleteBrand($id, $reason, $removeby)
{
    $con = connectDB();
    $data = "";

    if ($con) {

        $checkassigned = getAssignedDeviceBrandWise($id);
        //print_r($checkassigned);exit;
        //$checkassigned=$checkassigned[1];
        $count = sizeof($checkassigned);
        if ($count == 0) {


            $store = getBrandStores($id);
            //print_r($store);exit;
            if (sizeof($store) == 0) {

                $user = getBrandUsers($id);
                // print_r($user);exit;
                if (sizeof($user) == 0) {
                    $stmt = "UPDATE `brand_tbl` SET `status`=0 WHERE `id`='$id'";
                    //print_r($stmt);exit;
                    $i = 0;

                    $data = mysqli_query($con, $stmt);
                    // print_r($data);exit;


                    if ($data) {
                        $brandname = getBrand($id);
                        // print_r($brandname);

                        $brand = $brandname['brand_name'];
                        $id = $brandname['id'];
                        $outlets = $brandname['outlets'];
                        $address = $brandname['address'];
                        $pincode = $brandname['pincode'];
                        $outlets = $brandname['outlets'];
                        $country = $brandname['country'];
                        $state = $brandname['state'];
                        $city = $brandname['city'];
                        $personname = $brandname['bp_name'];
                        $designation = $brandname['bp_designation'];
                        $phone = $brandname['bp_phone'];
                        $email = $brandname['bp_email'];
                        $password = $brandname['password'];
                        // $response["countryname"] = $brandname ['countryname'];
                        //$response["statename"] = $brandname ['statename']; 
                        //$response["cityname"] = $brandname ['cityname'];
                        $stmt = "INSERT INTO `brand_record`(`brand_id`, `brand_name`, `outlets`, `address`, `pincode`, `country`, `state`, `city`, `bp_name`, `bp_designation`, `bp_phone`, `bp_email`,`password`,`updateby`,`reason`, `record`) VALUES ('$id', '$brand', '$outlets', '$address', '$pincode', '$country', '$state', '$city', '$personname', '$designation', '$phone', '$email','$password','$removeby','$reason',2)";


                        //print_r($stmt);exit;
                        $done = mysqli_query($con, $stmt);

                        //exit;


                        return 1;
                    } else {
                        return 0;
                    }
                } else {
                    return 4;
                }
            } else {
                return 3;
            }
        } else {
            return 2;
        }
    }
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function editStore($id, $storebrandid, $storename, $storeperson, $storecontact, $country, $state, $city, $pincode, $reason, $updateby)
{
    $con = connectDB();
    $data = "";

    if ($con) {


        $stmt = "UPDATE `store` SET `brand_id`='$storebrandid',`store_name`='$storename',`p_name`='$storeperson',`p_phone`='$storecontact' WHERE `id`='$id'";
        $done = mysqli_query($con, $stmt);
        //print_r($stmt);exit;
        if ($done) {
            $stmt = "INSERT INTO `store_record`(`storeid`, `brand_id`, `store_name`, `p_name`, `p_phone`, `country`, `state`, `city`, `pincode`, `updateby`, `reason`, `record`) VALUES ('$id','$storebrandid','$storename','$storeperson','$storecontact','$country','$state','$city','$pincode','$reason','$updateby',1)";
            // print_r($stmt);exit;
            $done = mysqli_query($con, $stmt);

            return 0;
        } else {
            return 1;
        }
    }
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function deleteStore($id, $reason, $updateby)
{
    $con = connectDB();
    $data = "";

    if ($con) {

        $checkassignedStore = getAssignedDeviceStoreWise($id);
        if (sizeof($checkassignedStore) == 0) {
            $stmt = "UPDATE `store` SET `status`='0' WHERE `id`='$id'";
            //print_r($stmt);exit;
            $i = 0;

            $data = mysqli_query($con, $stmt);
            // print_r($data);exit;


            if ($data) {
                $store = getSingleStore($id);
                // print_r($store);
                // Array
                // (
                //     [id] => 51
                //     [brand_id] => 60
                //     [store_name] => Apple Valley
                //     [p_name] => Sergey Brin
                //     [p_phone] => 9898989898
                //     [country] => 231
                //     [state] => 3924
                //     [city] => 42816
                //     [pincode] => 923070
                //     [status] => 0
                //     [active] => 1
                // )

                $id = $store['id'];
                $storebrandid = $store['brand_id'];
                $storename = $store['store_name'];
                $storeperson = $store['p_name'];
                $storecontact = $store['p_phone'];
                $country = $store['country'];
                $state = $store['state'];
                $city = $store['city'];
                $pincode = $store['pincode'];
                // $reason=$store[''];
                // $updateby=$store[''];

                $stmt = "INSERT INTO `store_record`(`storeid`, `brand_id`, `store_name`, `p_name`, `p_phone`, `country`, `state`, `city`, `pincode`, `updateby`, `reason`, `record`) VALUES ('$id','$storebrandid','$storename','$storeperson','$storecontact','$country','$state','$city','$pincode','$reason','$updateby',2)";
                //print_r($stmt);exit;
                $done = mysqli_query($con, $stmt);

                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }
    }
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function addUser($brandid,  $username, $useremail, $userphone, $password)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt1 = "SELECT * FROM `brand_tbl` WHERE `bp_email`='$useremail' AND `status`='1'";
        $data1= mysqli_query($con, $stmt1);
        if($data1->num_rows == 0)
        {
            $stmt = "SELECT * FROM `users` WHERE `email`='$useremail' AND `status`='1'";
            //print_r($stmt);
            $i = 0;
    
            $data = mysqli_query($con, $stmt);
            // print_r($data);exit;
            if ($data->num_rows == 0) {
                $stmt = "INSERT INTO `users`(`name`, `email`, `phone`, `brand`,`password`) 
                VALUES ('$username','$useremail', '$userphone','$brandid','$password')";
                $done = mysqli_query($con, $stmt);
                //print_r($stmt);
                if ($done) {
    
                    return 0;
                } else {
                    return 1;
                }
            }
        }
        else {
            return 2;
        }
    }
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function checkMob($brandid, $userphone)
{
    $con = connectDB();
    $data = "";

    if ($con) {

        $stmt = "SELECT * FROM `users` WHERE `phone`='$userphone' AND `status`='1'";
        //print_r($stmt);
        $i = 0;

        $data = mysqli_query($con, $stmt);
        if ($data->num_rows == 0) {
            return 0;
        } else {
            $stmt = "SELECT * FROM `users` WHERE `brand`='$brandid' AND `phone`='$userphone' AND `status`='1'";
            //print_r($stmt);
            $i = 0;

            $data = mysqli_query($con, $stmt);
            // print_r($data);exit;
            if ($data->num_rows == 0) {

                return 1;
            } else {
                return 0;
            }
        }
    }
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}



function editUser($id, $brandid, $username, $useremail, $userphone, $reason, $updateby, $password)
{

    $con = connectDB();
    $data = "";

    if ($con) {

        //$user=getSingleuser($id);
        // print_r($user);exit;

        $stmt = "UPDATE `users` SET`name`='$username',`email`='$useremail',`phone`='$userphone',`brand`='$brandid',`password`='$password' WHERE `user_id`='$id'";

        //print_r($stmt);exit;
        $done = mysqli_query($con, $stmt);
        // $stmt = "UPDATE `users_` SET`name`='$username',`email`='$useremail',`phone`='$userphone',`brand`='$brandid' WHERE `user_id`='$id'";

        //print_r($stmt);exit;
        //  $done = mysqli_query($con, $stmt);
        //print_r($done);exit;
        if ($done) {
            $stmt = "INSERT INTO `user_record`(`user_id`, `user`, `email`, `phone`, `brand`,`password`, `person_by`,`reason`, `value`) VALUES ('$id','$username','$useremail','$userphone','$brandid','$password','$updateby','$reason','1')";


            //print_r($stmt);exit;
            $done = mysqli_query($con, $stmt);

            return 0;
        } else {
            return 1;
        }
    }
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function editMachine($id, $name, $ptypeid, $macid, $sr, $mainboard, $manufacturedate, $dipatchedate, $instaldate, $reason, $updateby)
{
    $con = connectDB();

    if ($con) {

        //UPDATE `machines` SET `id`='[value-1]',`name`='[value-2]',`ptype_id`='[value-3]',`mac_id`='[value-4]',`sr`='[value-5]',`mainboard`='[value-6]',`manufacturedate`='[value-7]',`dipatchedate`='[value-8]',`instaldate`='[value-9]' WHERE `id`='$id'
        $stmt = "UPDATE `machines` SET `name`='$name',`ptype_id`='$ptypeid',`mac_id`='$macid',`sr`='$sr',`mainboard`='$mainboard',`manufacturedate`='$manufacturedate',`dipatchedate`='$dipatchedate',`instaldate`='$instaldate' WHERE `id`='$id'";
        $done = mysqli_query($con, $stmt);
        //print_r($stmt);exit;
        if ($done) {

            $stmt = "INSERT INTO `machine_record`(`machine_id`, `name`, `ptype_id`, `mac_id`, `sr`, `mainboard`, `manufacturedate`, `dipatchedate`, `instaldate`, `reason`, `person`,`record`) VALUES ('$id', '$name','$ptypeid', '$macid', '$sr', '$mainboard', '$manufacturedate', '$dipatchedate', '$instaldate','$reason','$updateby',1)";
            //print_r($stmt);exit;
            $done = mysqli_query($con, $stmt);
            return 0;
        } else {
            return 1;
        }
    }
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function deleteMachine($id, $reason, $person)
{
    $con = connectDB();
    $data = "";
    $checkassigned = getAssignedDeviceMachineWise($id);
    //print_r($checkassigned);exit;
    //$checkassigned=$checkassigned[1];
    $count = sizeof($checkassigned);
    if ($count == 0) {


        if ($con) {
            $stmt = "UPDATE `machines` SET `status`='0' WHERE `id`='$id'";
            //print_r($stmt);exit;


            $data = mysqli_query($con, $stmt);
            // print_r($data);exit;


            if ($data) {

                $machinedetails = getSingleMachine($id);
                //print_r($machinedetails);
                $ptypeid = $machinedetails['ptype_id'];
                $machinename = $machinedetails['name'];
                $manufacturedate = $machinedetails['manufacturedate'];
                $dipatchedate = $machinedetails['dipatchedate'];
                $instaldate = $machinedetails['instaldate'];
                $sr = $machinedetails['sr'];
                $mac_id = $machinedetails['mac_id'];
                $mainboard = $machinedetails['mainboard'];
                $stmt = "INSERT INTO `machine_record`(`machine_id`, `name`, `ptype_id`, `mac_id`, `sr`, `mainboard`, `manufacturedate`, `dipatchedate`, `instaldate`, `reason`, `person`,`record`) VALUES ('$id', '$machinename','$ptypeid', '$mac_id', '$sr', '$mainboard', '$manufacturedate', '$dipatchedate', '$instaldate','$reason','$person',2)";
                //print_r($stmt);exit;


                $data = mysqli_query($con, $stmt);



                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }
    } else {
        return 2;
    }
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function getAssignedDeviceMachineWise($id)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `assigned_divices` WHERE `machine_id` = $id AND `status` = 1 ORDER BY `id` DESC";
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function assignDevice($machineid, $brand, $user, $store,$recipeversion)
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
            $stmt = "INSERT INTO `assigned_divices`( `machine_id`, `brand_id`, `user_id`, `store_id`,`versionid`) 
            VALUES ('$machineid','$brand','$user','$store','$recipeversion')";
            $done = mysqli_query($con, $stmt);
            // print_r($stmt);
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getAssignedDevices()
{
    $con = connectDB();
    $data = "";

    if ($con) {
         $stmt = "SELECT * FROM `assigned_divices` WHERE `status`='1' AND `versionid`!='0' ORDER BY `machine_id` DESC";

        // print_r($stmt);

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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function getAssignedStoppedDevice()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        //$stmt = "SELECT DISTINCT `machine_id`,`id` FROM `assigned_divices` WHERE `status`='1' AND `active`=0";
        $stmt = "SELECT DISTINCT `machine_id` FROM `assigned_divices` WHERE `status`='1' AND `active`=0";
        //print_r($stmt);exit;

        $i = 0;

        $data = mysqli_query($con, $stmt);
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $i++;

                $products[$i] = $row;
                //print_r($row['id']);





            }
            print_r($products);
            return $products;
        } else {
            return false;
        }
    }
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function getAssignedStartedDevice()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT DISTINCT `machine_id` FROM `assigned_divices` WHERE `status`='1' AND `active`=1 ORDER BY machine_id DESC ";
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function updateDevice($id, $brand, $user, $store, $reason, $updateby,$recipeversion)
{
    $con = connectDB();
    $data = "";

    if ($con) {

        $stmt = "UPDATE `assigned_divices` SET `brand_id`='$brand',`user_id`='$user',`store_id`='$store',`versionid`='$recipeversion' WHERE `id`='$id'";
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
                $stmt = "INSERT INTO `update_record`( `machine_id`, `brand_id`, `user_id`, `store_id`,`versionid`, `reason`, `person_by`, `record value`) 
                VALUES ('$machineid','$brand','$user','$store','$recipeversion','$reason','$updateby','1')";
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}



function removeDevice($Deviceid, $machine, $brand, $user, $store,$version, $reason, $updateby)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        
        $timestamp=date("Y-m-d H:i:s");
        $stmt = "UPDATE `assigned_divices` SET `status`='0',`timestamp`='$timestamp' WHERE `id`='$Deviceid'";
        //print_r($stmt);exit;


        $data = mysqli_query($con, $stmt);
        // print_r($data);exit;


        if ($data) {
            $stmt = "INSERT INTO `update_record`( `machine_id`, `brand_id`, `user_id`, `store_id`,`versionid`,`reason`, `person_by`, `record value`) 
            VALUES ('$machine','$brand','$user','$store','$version','$reason','$updateby','2')";
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function startDevice($Deviceid, $reason, $updateby)
{
    $con = connectDB();
    $data = "";



    if ($con) {
        foreach ($Deviceid as $dev) {
            $device = getSingleAssignedDevice($dev);
            //print_r($device);exit;

            $machine = $device['machine_id'];

            $brand = $device['brand_id'];
            $user = $device['user_id'];
            $store = $device['store_id'];

            $stmt = "INSERT INTO `update_record`( `machine_id`, `brand_id`, `user_id`, `store_id`, `reason`, `person_by`, `record value`) 
        VALUES ('$machine','$brand','$user','$store','$reason','$updateby','3')";
            //print_r($stmt);exit;


            $data = mysqli_query($con, $stmt);
            // print_r($data);exit;

            $stmt = "UPDATE `assigned_divices` SET `active`=1 WHERE `id`='$dev'";
            //print_r($stmt);exit;


            $data = mysqli_query($con, $stmt);
        }

        if ($data) {
            return 0;
        } else {
            return 1;
        }
    }
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function stopDevice($Deviceid, $reason, $updateby)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        foreach ($Deviceid as $dev) {
            $device = getSingleAssignedDevice($dev);
            //print_r($device);exit;

            $machine = $device['machine_id'];

            $brand = $device['brand_id'];
            $user = $device['user_id'];
            $store = $device['store_id'];
            $stmt = "INSERT INTO `update_record`( `machine_id`, `brand_id`, `user_id`, `store_id`, `reason`, `person_by`, `record value`) 
        VALUES ('$machine','$brand','$user','$store','$reason','$updateby','4')";
            //print_r($stmt);exit;


            $data = mysqli_query($con, $stmt);
            // print_r($data);exit;

            $stmt = "UPDATE `assigned_divices` SET `active`=0 WHERE `id`='$dev'";
            //print_r($stmt);exit;


            $data = mysqli_query($con, $stmt);
        }
        if ($data) {





            return 0;
        } else {
            return 1;
        }
    }
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getCountReport($query)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT COUNT(`rcpdata`.`rc`) AS `count`,`rcpdata`.`rcptype` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` AND `rcpdata`.`finalop` LIKE 'Success' $query GROUP BY `rcpdata`.`rcptype` ORDER BY `rcpdata`.`rcptype` ASC;";
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getUpdatesUser()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `user_record` ORDER BY ID DESC";
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getRecipeCountReport($query, $date)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT COUNT(`rcpdata`.`rc`) AS `count` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` $query AND `rcpdata`.`finalop` LIKE 'Success' AND `rcpdata`.`timestamp` LIKE '%$date%' ORDER BY `rcpdata`.`timestamp`,`rcpdata`.`SLN`;";
        // print_r($stmt);
        // exit;
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}



function getRecipeCountReportWeekly($query, $date)
{
    $con = connectDB();
    $data = "";
    $i = 0;
    if ($con) {
        $stmt = "SELECT COUNT(`rcpdata`.`rc`) AS `count` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` AND `rcpdata`.`finalop` LIKE 'Success' $query $date ORDER BY `rcpdata`.`timestamp`,`rcpdata`.`SLN`";
    //     print_r($stmt);
    //    exit;
       

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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

//SELECT COUNT(`rcpdata`.`rc`) AS `count`,`brand_tbl`.`brand_name` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` GROUP BY `brand_tbl`.`brand_name`;

function getRecipeCountBrandWise($query, $date)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT COUNT(`rcpdata`.`rc`) AS `count`,`brand_tbl`.`brand_name` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` AND `rcpdata`.`finalop` LIKE 'Success'  $query $date GROUP BY `brand_tbl`.`brand_name`";
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function getErrorCountBrandWise($query, $ec, $date)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT COUNT(`rcpdata`.`rcpercd`) AS COUNT,`rcpdata`.`rcpercd`, `brand_tbl`.`brand_name` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` AND `rcpdata`.`rcpercd`!='NA'AND `rcpdata`.`rcpercd`!=' '  AND `rcpdata`.`finalop` NOT LIKE 'Success'  $query $ec $date  Group BY `rcpdata`.`rcpercd`, `brand_tbl`.`brand_name` ORDER BY `brand_tbl`.`brand_name`;";

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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getFailureCounts($query)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT COUNT(`rcpdata`.`finalop`) AS count, `brand_tbl`.`brand_name` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` AND `rcpdata`.`rcpercd`!='NA' AND `rcpdata`.`rcpercd`!='' WHERE `rcpdata`.`finalop` NOT LIKE 'Success' $query Group BY `brand_tbl`.`brand_name` ORDER BY `brand_tbl`.`brand_name`";
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getMostSellingCountReport($query)
{
    $con = connectDB();
    $data = "";

    if ($con) {
      //  $stmt = "SELECT COUNT(`rcpdata`.`rc`) AS `count`,`rcpdata`.`rcpname`,`rcpdata`.`rcptype` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` $query GROUP BY `rcpdata`.`rcpname`,`rcpdata`.`rcptype` ORDER BY `rcpdata`.`rcptype` ASC";
        $stmt = "SELECT COUNT(`rcpdata`.`rc`) AS `count`,`rcpdata`.`rcpname`,`rcpdata`.`rcptype` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` WHERE `rcpdata`.`finalop` LIKE 'Success' $query GROUP BY `rcpdata`.`rcpname`,`rcpdata`.`rcptype` ORDER BY `rcpdata`.`rcptype` ASC";
       //  print_r($stmt);exit;
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function getDistinctRecepeType()
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function getRecipeProcess($query, $date)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT `time`,`SLN`,`ptype`,`cookingtype`,`macid`,`rcptype`,`rcpname`,`rcpstarttime`,`rcpendtime`,`rcpercd`,`finalop`,`appname`,`rcpdata`.`timestamp`,`currrtemp` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 $query $date";
        //$stmt = "SELECT `time`,`SLN`,`ptype`,`cookingtype`,`macid`,`rcptype`,`rcpname`,`rcpstarttime`,`rcpendtime`,`rcpercd`,`finalop`,`appname`,`timestamp` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 $query $date";
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function getBrandUpdates()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `brand_record` ORDER BY id DESC";
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function getStoresUpdates()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `store_record` ORDER BY id DESC";
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function getMachinesupdate()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT * FROM `machine_record` ORDER BY id DESC";
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getPtypeDistinctRctype($id)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT DISTINCT(`rcpdata`.`rcptype`) FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` WHERE `machines`.`ptype_id`=$id ORDER BY `rcpdata`.`rcptype`;";
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}



function getMachineDistinctRctype($id)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT DISTINCT(`rcpdata`.`rcptype`) FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` WHERE `machines`.`id`=$id ORDER BY `rcpdata`.`rcptype`;";
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getPtypeBrands($id)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT DISTINCT(`brand_tbl`.`id`),`brand_tbl`.`brand_name` FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` WHERE `machines`.`ptype_id`=$id;";
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getBrandRctypes($id)
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT DISTINCT(`rcpdata`.`rcptype`) FROM `rcpdata` JOIN `machines` ON `machines`.`name`=`rcpdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` WHERE `brand_tbl`.`id`=$id ORDER BY `rcpdata`.`rcptype`";
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}



function getRecipeCountFromMachinePacketReport($query, $date)
{
    $con = connectDB();
    $data = "";
    $products=[];
    if ($con) {
        $stmt = "SELECT `rawdata`.`rc` FROM `rawdata` JOIN `machines` ON `machines`.`name`=`rawdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` $query AND `rawdata`.`timestamp` LIKE '%$date%' ORDER BY `rawdata`.`id` DESC LIMIT 1;";
        // print_r($stmt); 
        // exit;
        $i = 0;

        $data = mysqli_query($con, $stmt);
        //$row = mysqli_fetch_assoc($data);
       //  print_r($row);
        if ($data) {
          

                $row = mysqli_fetch_assoc($data);
                
                    $products=$row['rc'];
                
                
                //print_r($row['rc']);

            
            return $products;
        } else {
            return false;
        }
    }
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


function getRecipeCountFromMachinePacketMaxRcReport($query, $date)
{
    $con = connectDB();
    $data = "";
    $products=[];
    if ($con) {
        $stmt = "SELECT max(`rawdata`.`rc`) as `rc`,`rawdata`.`SLN` FROM `rawdata` JOIN `machines` ON `machines`.`name`=`rawdata`.`SLN` JOIN `assigned_divices` ON `assigned_divices`.`machine_id`=`machines`.`id` AND `machines`.`assign_status`=1 AND `machines`.`status`=1 AND `assigned_divices`.`status`=1 JOIN `brand_tbl` ON `brand_tbl`.`id`=`assigned_divices`.`brand_id` JOIN `store` ON `store`.`id`=`assigned_divices`.`store_id` JOIN `users` ON `users`.`user_id`=`assigned_divices`.`user_id` $query AND `rawdata`.`timestamp` LIKE '%$date%' GROUP BY `rawdata`.`SLN`;";
       //print_r($stmt);
       // exit;
        $i = 0;

        $data = mysqli_query($con, $stmt); 
        //$row = mysqli_fetch_assoc($data);
       //  print_r($row);
     // print_r($row);exit;
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}

function updateDevice_TCP($id, $brand, $user, $store, $reason, $updateby)
{
    $con = connectDB();
    $data = "";

    if ($con) {

        $stmt = "UPDATE `tcp_assign_machine` SET `tcp_brand`='$brand',`tcp_pri_user`='$user',`tcp_store`='$store' WHERE `id`='$id'";
        // print_r($stmt);exit;
        $i = 0;

        $data = mysqli_query($con, $stmt);

        if ($data) {

            $stmt = "SELECT * FROM `tcp_assign_machine` WHERE `id`='$id'";
            // print_r($stmt);


            $data1 = mysqli_query($con, $stmt);
            $row = mysqli_fetch_assoc($data1);
            if (!empty($row)) {
                $machineid = $row['tcp_machineid'];
                $brand = $row['tcp_brand'];
                $user = $row['tcp_pri_user'];
                $store = $row['tcp_store'];
                $stmt = "INSERT INTO `tcp_update_info`( `tcp_machine`, `tcp_brand`, `tcp_user`, `tcp_store`, `reason`, `person`, `status`) 
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
    if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}


// Uploaded on 11 May 2022 
function rcpUpdate_details($id,$versionn,$Heat_temp,$V_Temp,$Sleep_time, $Deep_sleep,$Ver_Id)
{
    $con = connectDB();

    if($con){

        $vid = "INSERT into `recipe_update_details`(recipeid, recipe_version,Heat_temp, V_Temp, Sleep_Time, Deep_sleep,Ver_ID) values( '$id', '$versionn','$Heat_temp', '$V_Temp', '$Sleep_time', '$Deep_sleep','$Ver_Id')";
            // print_r($vid);exit;
       
        $succes = mysqli_query($con,$vid);
             // print_r($succes);exit;

        if($succes){
            return 0;
        }
        else{
            return 2;
        }
    }  else{
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);

}

function fetchRcpData($id)
{
    $con = connectDB();
    $data = "";
    $products = [];
    $i = 0;
    if ($con) {
        $query = "SELECT * FROM `add_version` WHERE `selectversion`='$id'";
        // print_r($query);
        // exit;
        $result = mysqli_query($con, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {

                $products[$i] = $row;
                $i++;

                //print_r($row['id']);
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
// Uploaded on 11 May 2022 



function getLivemachinestcpdata( $imei)
 {

     $con = connectDB();
     $data = "";

     if ($con) {
        // $stmt = "SELECT `tcpdata`.`imei`,MAX(`tcpdata`.`timestamp`) AS `timestamp` FROM `tcpdata` JOIN `tcp_register` ON `tcp_register`.`imei`=`tcpdata`.`imei` JOIN `tcp_assign_machine` ON `tcp_register`.`id`=`tcp_assign_machine`.`tcp_machineid` JOIN `brand_tbl` ON `brand_tbl`.`id`=`tcp_assign_machine`.`tcp_brand` JOIN `store` ON `store`.`id`=`tcp_assign_machine`.`tcp_store` JOIN `users` ON `users`.`user_id`=`tcp_assign_machine`.`tcp_pri_user` GROUP BY `tcpdata`.`imei` ";
         $stmt = "SELECT `tcp_register`.`imei`,`tcp_register`.`id` from `tcp_register` JOIN `tcp_assign_machine` ON `tcp_register`.`id`=`tcp_assign_machine`.`tcp_machineid` JOIN `brand_tbl` ON `brand_tbl`.`id`=`tcp_assign_machine`.`tcp_brand` JOIN `store` ON `store`.`id`=`tcp_assign_machine`.`tcp_store` JOIN `users` ON `users`.`user_id`=`tcp_assign_machine`.`tcp_pri_user` WHERE `tcp_register`.`imei`=$imei ";
        // print_r($stmt);exit;
         $i = 0;
         $products = [];
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
     } else {
         die("Connection failed: " . mysqli_connect_error());
     }
     mysqli_close($con);
 }



function gettcpthresholds($imei)
{
    $con = connectDB();
    $data = "";
    $products=[];
    if ($con) {
        $stmt ="SELECT `tcp_low_threshold`,`tcp_high_threshold` FROM `tcp_register` WHERE `imei`=$imei";    
       //print_r($stmt);
       // exit;
        $i = 0;

        $data = mysqli_query($con, $stmt); 
        //$row = mysqli_fetch_assoc($data);
       //  print_r($row);
     // print_r($row);exit;
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
     if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($con);
}



function getDistinctAssignedDevices()
{
    $con = connectDB();
    $data = "";

    if ($con) {
        $stmt = "SELECT DISTINCT `machine_id` FROM `assigned_divices` WHERE `status`='1' AND `versionid`!='0' ORDER BY `machine_id` DESC";
        // print_r($stmt);

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