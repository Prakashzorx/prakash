<?php
require_once 'controller/functions.php';
require_once 'controller/recipe_update_functions.php';

//Start the session.
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "meta.php"; ?>

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }


        #pageloader {
            background: rgba(255, 255, 255, 50%);
            display: none;
            height: 100%;
            position: fixed;
            width: 100%;
            z-index: 9999;
        }

        #pageloader img {
            left: 40%;
            margin-left: -90px;
            margin-top: -32px;
            position: absolute;
            top: 30%;
            height: 450px;
        }

        @media screen and (max-width: 600px) {
            #pageloader img {
                left: 40%;
                margin-left: -90px;
                margin-top: -32px;
                position: absolute;
                top: 30%;
                height: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="col-lg-12" id="pageloader">
        <img src="assets/load3.gif"></img>
    </div>

    <!-- <img src="assets/load4.gif" style="height:50%;width:50%"alt="processing..." /> -->
    <!-- </div> -->
    <?php include "header.php"; ?>
    <!-- ======= Sidebar ======= -->
    <?php include "sidebar.php"; ?>
    <?php include "functions.php"; ?>

    <main id="main" class="main">

        <?php
        //print_r($_GET);exit;
        if (!empty($_REQUEST['page'])) {

            $page = $_REQUEST['page'];
            if ($page == 6) {

                $status6 = 'active';
                $area6 = 'true';
            } else
            if ($page == 5) {

                $status5 = 'active';
                $area5 = 'true';
            } else if ($page == 4) {

                $status4 = 'active';
                $area4 = 'true';
            } else if ($page == 3) {

                $status3 = 'active';
                $area3 = 'true';
            } else if ($page == 2) {

                $status2 = 'active';
                $area2 = 'true';
            } else if ($page == 1) {

                $status1 = 'active';
                $area1 = 'true';
            } else {
                $status1 = 'active';
                $status2 = $status3 = $status4 = $status5 = $status6 = '';
                $area1 = 'true';
                $area2 = $area3 = $area4 = $area5 = $area6 = 'false';
            }
        } else {
            $status1 = 'active';
            $area1 = 'true';
        }
        ?>
        <div class="pagetitle">
            <h1>Device Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Device Management</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Device Console</h5>

                    <!-- Pills Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $status1; ?>" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="<?php echo $area1; ?>">Assign Device</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $status2; ?>" id="pills-update-tab" data-bs-toggle="pill" data-bs-target="#pills-update" type="button" role="tab" aria-controls="pills-update" aria-selected="<?php echo $area2; ?>">Update Device List</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $status3; ?>" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="<?php echo $area3; ?>">Remove Device List</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $status4; ?>" id="pills-start-tab" data-bs-toggle="pill" data-bs-target="#pills-start" type="button" role="tab" aria-controls="pills-start" aria-selected="<?php echo $area4; ?>">Start Device</button>
                            <script>
                                $("#startDevice").load(location.href + " #startDevice");
                            </script>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $status5; ?>" id="pills-stop-tab" data-bs-toggle="pill" data-bs-target="#pills-stop" type="button" role="tab" aria-controls="pills-stop" aria-selected="<?php echo $area5; ?>">Stop Device</button>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $status6; ?>" id="pills-recipeversion-tab" data-bs-toggle="pill" data-bs-target="#pills-recipeversion" type="button" role="tab" aria-controls="pills-recipeversion" aria-selected="<?php echo $area6; ?>">Recipe Version</button>
                        </li> -->
                    </ul>
                    <div class="tab-content pt-2" id="myTabContent">
                        <div class="tab-pane fade show <?php echo $status1; ?>" id="pills-home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Assign Device</h5>

                                    <!-- Floating Labels Form -->
                                    <form class="row g-3" id="assigndevice">

                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="machineid" name="machineid" aria-label="State" onchange="getval(this);">
                                                    <option value="" selected></option>
                                                    <?php
                                                    $machines = getUnAssignedMachines();
                                                    //print_r($machines);
                                                    foreach ($machines as $machine) {


                                                    ?>
                                                        <option value="<?php echo  $machine['id']; ?>"><?php echo  $machine['name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingSelect">Machine</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="machinetype" name="machinetype" placeholder="machinetype" readonly>
                                                <label for="floatingSelect">Machine Type</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="brand" name="brand" aria-label="brand">
                                                    <option value="" selected></option>
                                                    <?php
                                                    $result = getBrands();
                                                    $i = 0;
                                                    //print_r($result);
                                                    foreach ($result as $row) {
                                                        $i++;
                                                    ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['brand_name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingSelect">Brand</label>
                                            </div>
                                        </div>

                                        <!-- <label class="col-md-2 col-form-label">Select Users</label> -->
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="user" name="user" onchange="changeuseropt1(this)">

                                                </select>
                                                <label for="floatingSelect">Primary User Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3" id="opt1">
                                                <select class="form-select" id="useropt1" name="useropt1">

                                                </select>
                                                <label for="floatingSelect">User Name (opt)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="useropt2" name="useropt2">

                                                </select>
                                                <label for="floatingSelect">User Name (opt)</label>
                                            </div>
                                        </div>

                                        <!-- <label class="col-md-2 col-form-label"></label> -->
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="store" name="store" aria-label="store">


                                                </select>
                                                <label for="floatingSelect">Store Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">

                                                <select class="form-select" id="country" name="country" aria-label="country" readonly>

                                                </select>
                                                <label for="floatingSelect">Country</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">

                                                <select class="form-select" id="state" name="state" aria-label="state" readonly>

                                                </select>
                                                <label for="state">State</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">

                                                <select class="form-select" id="city" name="city" aria-label="city" readonly>

                                                </select>
                                                <label for="city">City</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="pincode" name="pincode" placeholder="pincode" readonly>
                                                <label for="floatingSelect">PINCODE</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="mname" name="mname" placeholder="Your Name" readonly>
                                                <label for="floatingName">User Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="mphone" name="mphone" placeholder="Mac Id" readonly>
                                                <label for="floatingEmail">User Number</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="memail" name="memail" placeholder="Store Name" readonly>
                                                <label for="floatingCity">User Email</label>
                                            </div>

                                        </div>
                                        <div class="col-md-4">

                                            <div class="form-floating">
                                                <select class="form-select" id="recipeversion" name="recipeversion" onchange="changeuseropt1(this)">
                                                    <option selected> </option>
                                                    <?php
                                                    $ptypes =  versionTypes();
                                                    foreach ($ptypes as $ptype) {
                                                        //print_r($ptype['name']);
                                                    ?>
                                                        <option value="<?php echo $ptype['id']; ?>"><?php echo $ptype['recipe_version']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>


                                                <label for="floatingSelect">Recipe Version</label>
                                            </div>

                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                        </div>
                                    </form><!-- End floating Labels Form -->

                                </div>
                            </div>
                            <div class="col-lg-12" id="asmclist">

                                <div class="card">
                                    <div class="card-body" style="overflow-x:auto;">
                                        <h5 class="card-title">Assign Machine List</h5>



                                        <table id="devicelist" class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Action</th>
                                                    <th scope="col">Machine Number</th>
                                                    <th scope="col">Machine type</th>
                                                    <th scope="col">Brand</th>
                                                    <th scope="col">User</th>
                                                    <th scope="col">Store</th>
                                                    <th scope="col">Recipe Version</th>
                                                    <th scope="col">Country</th>
                                                    <th scope="col">State</th>
                                                    <th scope="col">City</th>
                                                    <th scope="col">Pincode</th>
                                                    <!-- <th scope="col">BM. Name</th> -->
                                                    <th scope="col">User Number</th>
                                                    <th scope="col">User Email</th>

                                                    <!-- <th scope="col">Reason</th>
                                                    <th scope="col">Who Is</th> -->

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $devices = getAssignedDevices();
                                                // print_r($devices);
                                                $i = 0;
                                                foreach ($devices as $device) {
                                                    $i++;
                                                    $machine = getSingleMachine($device['machine_id']);
                                                    //$machine = getSingleMachine($id);

                                                    $rv = $device['versionid'];
                                                    $version = select_version_ID($rv);
                                                    //print_r($version['recipe_version']);exit;
                                                    $vname = $version['recipe_version'];
                                                    $mid = $machine['ptype_id'];
                                                    $ptype = getptype($mid);



                                                    $type = $ptype['name'] . " " . $ptype['version'];

                                                    $brand = getBrand($device['brand_id']);
                                                    $user = getSingleuser($device['user_id']);
                                                    $store = getSingleStore($device['store_id']);
                                                    $countryname = getCountriesById($store['country']);
                                                    $statename = getStatesById($store['state']);
                                                    $cityname = getCityById($store['city']);
                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $i; ?></th>
                                                        <td><button type="submit" class="btn btn-success" onclick="viewmodel(<?php echo $machine['id']; ?>)"><i class="far fa-edit"></i></button></td>
                                                        <td><?php echo $machine['name']; ?></td>
                                                        <td><?php echo $type; ?></td>
                                                        <td><?php echo $brand['brand_name']; ?> </td>
                                                        <td><?php echo $user['name']; ?></td>
                                                        <td><?php echo $store['store_name']; ?></td>
                                                        <td><?php echo $vname; ?></td>
                                                        <td><?php echo $countryname['name']; ?></td>
                                                        <td><?php echo $statename['name']; ?></td>
                                                        <td><?php echo $cityname['name']; ?></td>
                                                        <td><?php echo $store['pincode']; ?></td>

                                                        <td><?php echo $user['phone']; ?></td>
                                                        <td><?php echo $user['email']; ?></td>
                                                        <td style="display:none"><?php echo $device['id']; ?></td>
                                                        <td style="display:none"><?php echo $device['brand_id']; ?></td>
                                                        <td style="display:none"><?php echo $device['user_id']; ?></td>
                                                        <td style="display:none"><?php echo $store['id']; ?></td>
                                                        <td style="display:none"><?php echo $store['country']; ?></td>
                                                        <td style="display:none"><?php echo $store['state']; ?></td>
                                                        <td style="display:none"><?php echo $store['city']; ?></td>


                                                    </tr>
                                                <?php
                                                }
                                                ?>



                                            </tbody>
                                        </table>


                                        <div class="modal fade" id="verticalycentered1" tabindex="-1">
                                            <div class="modal-dialog  modal-lg">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Assigned Device Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">



                                                        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link active" id="storehome-tab" data-bs-toggle="tab" data-bs-target="#bordered-storehome" type="button" role="tab" aria-controls="storehome" aria-selected="true">View</button>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="storeedit-tab" data-bs-toggle="tab" data-bs-target="#bordered-storeedit" type="button" role="tab" aria-controls="storeedit" aria-selected="false">Edit</button>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="storedelete-tab" data-bs-toggle="tab" data-bs-target="#bordered-storedelete" type="button" role="tab" aria-controls="storedelete" aria-selected="false">Delete</button>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content pt-2" id="borderedTabContent">
                                                            <div class="tab-pane fade show active" id="bordered-storehome" role="tabpanel" aria-labelledby="storehome-tab">
                                                                <form class="row g-3" id="viewassigndevice">

                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control" id="machineidview" name="machineid" aria-label="State" readonly />

                                                                            <label for="floatingSelect">Machine</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control" id="machinetypeview" name="machinetype" placeholder="machinetype" readonly>
                                                                            <label for="floatingSelect">Machine Type</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control" id="brandview" name="brand" aria-label="brand" readonly />

                                                                            <label for="floatingSelect">Brand</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control" id="userview" name="user" aria-label="user" readonly />


                                                                            <label for="floatingSelect">User Name</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control" id="storeview" name="store" aria-label="store" readonly />



                                                                            <label for="floatingSelect">Store Name</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">

                                                                            <input type="text" class="form-control" id="countryview" name="country" aria-label="country" readonly />





                                                                            <label for="floatingSelect">Country</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">

                                                                            <input type="text" class="form-control" id="stateview" name="state" aria-label="state" readonly />

                                                                            <label for="state">State</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">

                                                                            <input type="text" class="form-control" id="cityview" name="city" aria-label="city" readonly />


                                                                            <label for="city">City</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control" id="pincodeview" name="pincode" placeholder="pincode" readonly>
                                                                            <label for="floatingSelect">PINCODE</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-floating">
                                                                            <input type="text" class="form-control" id="mphoneview" name="mphone" placeholder="Mac Id" readonly>
                                                                            <label for="floatingEmail">User Number</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">

                                                                        <div class="form-floating">
                                                                            <input type="email" class="form-control" id="memailview" name="memail" placeholder="Store Name" readonly>
                                                                            <label for="floatingCity">User Email</label>
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-md-4">

                                                                        <div class="form-floating">
                                                                            <input type="email" class="form-control" id="recipeversionview" name="recipeversionview" placeholder="Store Name" readonly>
                                                                            <label for="floatingCity">Recipe Version</label>
                                                                        </div>

                                                                    </div>

                                                                    <div class="text-center">
                                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">CLOSE</button>

                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="tab-pane fade" id="bordered-storeedit" role="tabpanel" aria-labelledby="storeedit-tab">
                                                                <form class="row g-3" id="updateDevice">

                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                            <select class="form-select" id="machineidedit" name="machineid" aria-label="State">
                                                                                <option value="" selected></option>
                                                                                <?php
                                                                                $devices = getAssignedDevices();
                                                                                $i = 0;
                                                                                foreach ($devices as $device) {
                                                                                    $i++;

                                                                                    $machine = getSingleMachine($device['machine_id']);
                                                                                ?>
                                                                                    <option value="<?php echo  $device['id']; ?>"><?php echo  $machine['name']; ?></option>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <label for="floatingSelect">Machine</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control" id="machinetypeedit" name="machinetype" placeholder="machinetype" readonly>
                                                                            <label for="floatingSelect">Machine Type</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                            <select class="form-select" id="brandedit" name="brand" aria-label="brand">
                                                                                <option value="" selected></option>
                                                                                <?php
                                                                                $result = getBrands();
                                                                                $i = 0;

                                                                                foreach ($result as $row) {
                                                                                    $i++;
                                                                                ?>
                                                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['brand_name']; ?></option>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <label for="floatingSelect">Brand</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                            <select class="form-select" id="useredit" name="user" aria-label="user">

                                                                            </select>
                                                                            <label for="floatingSelect">User Name</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                            <select class="form-select" id="storeedit" name="store" aria-label="store">


                                                                            </select>
                                                                            <label for="floatingSelect">Store Name</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">

                                                                            <select class="form-select" id="countryedit" name="country" aria-label="country" readonly>





                                                                                <?php

                                                                                $result = getCountries();
                                                                                foreach ($result as $rowsingle) {
                                                                                    //print_r($result);
                                                                                ?>
                                                                                    <option value="<?php echo $rowsingle['id']; ?>"><?php echo $rowsingle["name"]; ?></option>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            </select>
                                                                            <label for="floatingSelect">Country</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">

                                                                            <select class="form-select" id="stateedit" name="state" aria-label="state" readonly>

                                                                            </select>
                                                                            <label for="state">State</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">

                                                                            <select class="form-select" id="cityedit" name="city" aria-label="city" readonly>

                                                                            </select>
                                                                            <label for="city">City</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control" id="pincodeedit" name="pincode" placeholder="pincode" readonly>
                                                                            <label for="floatingSelect">PINCODE</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-floating">
                                                                            <input type="text" class="form-control" id="mphoneedit" name="mphone" placeholder="Mac Id" readonly>
                                                                            <label for="floatingEmail">User Number</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">

                                                                        <div class="form-floating">
                                                                            <input type="email" class="form-control" id="memailedit" name="memail" placeholder="Store Name" readonly>
                                                                            <label for="floatingCity">User Email</label>
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                            <select class="form-select" id="recipeversionedit" name="recipeversionedit" aria-label="user">
                                                                                <?php
                                                                                $ptypes =  versionTypes();
                                                                                foreach ($ptypes as $ptype) {
                                                                                    //print_r($ptype['name']);
                                                                                ?>
                                                                                    <option value="<?php echo $ptype['id']; ?>"><?php echo $ptype['recipe_version']; ?></option>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <label for="floatingSelect">Recipe Version</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-floating">
                                                                            <input type="text" class="form-control" id="reason" name="reason" placeholder="Mac Id">
                                                                            <label for="floatingEmail">Reason to update</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-floating">
                                                                            <input type="text" class="form-control" id="updateby" name="updateby" placeholder="Mac Id">
                                                                            <label for="floatingEmail">Updating by</label>
                                                                        </div>
                                                                    </div>


                                                                    <div class="text-center">
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                                                    </div>
                                                                </form>


                                                            </div>
                                                            <div class="tab-pane fade" id="bordered-storedelete" role="tabpanel" aria-labelledby="storedelete-tab">

                                                                <form class="row g-3" id="removeDevice">
                                                                    <input type="hidden" class="form-control" id="machineiddelete" name="machineid" aria-label="" />
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control" id="machineidnamedelete" name="machineidname" aria-label="State" readonly />

                                                                            <label for="floatingSelect">Machine</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control" id="machinetypedelete" name="machinetype" placeholder="machinetype" readonly>
                                                                            <label for="floatingSelect">Machine Type</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control" id="branddelete" name="brand" aria-label="brand" readonly />

                                                                            <label for="floatingSelect">Brand</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control" id="userdelete" name="user" aria-label="user" readonly />


                                                                            <label for="floatingSelect">User Name</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control" id="storedelete" name="store" aria-label="store" readonly />



                                                                            <label for="floatingSelect">Store Name</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">

                                                                            <input type="text" class="form-control" id="countrydelete" name="country" aria-label="country" readonly />





                                                                            <label for="floatingSelect">Country</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">

                                                                            <input type="text" class="form-control" id="statedelete" name="state" aria-label="state" readonly />

                                                                            <label for="state">State</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">

                                                                            <input type="text" class="form-control" id="citydelete" name="city" aria-label="city" readonly />


                                                                            <label for="city">City</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control" id="pincodedelete" name="pincode" placeholder="pincode" readonly>
                                                                            <label for="floatingSelect">PINCODE</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-floating">
                                                                            <input type="text" class="form-control" id="mphonedelete" name="mphone" placeholder="Mac Id" readonly>
                                                                            <label for="floatingEmail">User Number</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">

                                                                        <div class="form-floating">
                                                                            <input type="email" class="form-control" id="memaildelete" name="memail" placeholder="Store Name" readonly>
                                                                            <label for="floatingCity">User Email</label>
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-md-4">

                                                                        <div class="form-floating">
                                                                            <input type="text" class="form-control" id="recipeversionremove" name="recipeversion" placeholder="Store Name" readonly>
                                                                            <label for="floatingCity">Recipe Version</label>
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-floating">
                                                                            <input type="text" class="form-control" id="reason2" name="reason" placeholder="Mac Id">
                                                                            <label for="floatingEmail">Reason to Remove</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-floating">
                                                                            <input type="text" class="form-control" id="personby2" name="person" placeholder="Mac Id">
                                                                            <label for="floatingEmail">Removing By</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-center">
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>



                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade show <?php echo $status2; ?>" id="pills-update" role="tabpanel" aria-labelledby="update-tab">
                            <!-- <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Update Device</h5>

                                    
                                    <form class="row g-3" id="updateDevice1">

                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="machineid1" name="machineid" aria-label="State" onchange="getval1(this);">

                                                    <?php
                                                    $devices = getAssignedDevices();
                                                    $i = 0;
                                                    foreach ($devices as $device) {
                                                        $i++;
                                                        //print_r($machine);
                                                        $machine = getSingleMachine($device['machine_id']);
                                                    ?>
                                                        <option value="<?php echo  $device['id']; ?>"><?php echo  $machine['name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                                <label for="floatingSelect">Machine</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="machinetype1" name="machinetype" placeholder="machinetype" readonly>
                                                <label for="floatingSelect">Machine Type</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="brand1" name="brand" aria-label="brand">
                                                    <option value="" selected></option>
                                                    <?php
                                                    $result = getBrands();
                                                    $i = 0;
                                                    //print_r($result);
                                                    foreach ($result as $row) {
                                                        $i++;
                                                    ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['brand_name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingSelect">Brand</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="user1" name="user" aria-label="user">

                                                </select>
                                                <label for="floatingSelect">User Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="store1" name="store" aria-label="store">


                                                </select>
                                                <label for="floatingSelect">Store Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">

                                                <select class="form-select" id="country1" name="country" aria-label="country" readonly>

                                                </select>
                                                <label for="floatingSelect">Country</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">

                                                <select class="form-select" id="state1" name="state" aria-label="state" readonly>

                                                </select>
                                                <label for="state">State</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">

                                                <select class="form-select" id="city1" name="city" aria-label="city" readonly>

                                                </select>
                                                <label for="city">City</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="pincode1" name="pincode" placeholder="pincode" readonly>
                                                <label for="floatingSelect">PINCODE</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="mname1" name="mname" placeholder="Your Name" readonly>
                                                <label for="floatingName">User Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="mphone1" name="mphone" placeholder="Mac Id" readonly>
                                                <label for="floatingEmail">User Number</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="memail1" name="memail" placeholder="Store Name" readonly>
                                                <label for="floatingCity">User Email</label>
                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="reason" name="reason" placeholder="Mac Id">
                                                <label for="floatingEmail">Reason to update</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="updateby" name="updateby" placeholder="Mac Id">
                                                <label for="floatingEmail">Updating by</label>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                        </div>
                                    </form>
                                    


                                </div>
                            </div> -->
                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-body" style="overflow-x:auto;">
                                        <h5 class="card-title">Update Machine List</h5>

                                        <script>
                                            // $(document).ready(function() {
                                            //     $('#example2').DataTable({
                                            //         "scrollX": true
                                            //     });
                                            // });
                                        </script>
                                        <!-- Table with stripped rows -->
                                        <table id="updateDeviceList" class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Machine Number</th>
                                                    <th scope="col">Brand</th>
                                                    <th scope="col">User</th>
                                                    <th scope="col">Store</th>
                                                    <th scope="col">Recipe Version</th>
                                                    <!-- <th scope="col">Status</th> -->
                                                    <th scope="col">Country</th>
                                                    <th scope="col">State</th>

                                                    <th scope="col">City</th>
                                                    <th scope="col">Pincode</th>
                                                    <th scope="col">User Name</th>
                                                    <th scope="col">User Number</th>
                                                    <th scope="col">User Email</th>
                                                    <th scope="col">Reason</th>
                                                    <th scope="col">Updated By</th>
                                                    <th scope="col">Time</th>
                                                    <!-- <th scope="col">BM. Name</th>
                                                    <th scope="col">Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $devices = getUpdatesOfDevices();
                                                //print_r($devices);
                                                $i = 0;
                                                foreach ($devices as $device) {



                                                    $machine = getSingleMachine($device['machine_id']);
                                                    $brand = getBrand($device['brand_id']);
                                                    $user = getSingleuser($device['user_id']);
                                                    $store = getSingleStore($device['store_id']);
                                                    $countryname = getCountriesById($store['country']);
                                                    $statename = getStatesById($store['state']);
                                                    $cityname = getCityById($store['city']);
                                                    $rv = $device['versionid'];
                                                    $version = select_version_ID($rv);
                                                    //print_r($version['recipe_version']);exit;
                                                    $vname = $version['recipe_version'];
                                                    //print_r($machine);
                                                    // print_r($brand);
                                                    // print_r($user);
                                                    //print_r($store);
                                                    $timezone = new DateTimeZone('Asia/Kolkata');

                                                    $date = new DateTime($device['timestamp']);
                                                    $date->setTimeZone($timezone);
                                                    $time = $date->format('D d M Y g:i:s A') . "\n";
                                                    if ($device['record value'] == 1) {
                                                        $i++;
                                                ?>
                                                        <tr>
                                                            <th scope="row"><?php echo $i; ?></th>
                                                            <td><?php echo $machine['name']; ?></td>
                                                            <td><?php echo $brand['brand_name']; ?> </td>

                                                            <td><?php echo $user['name']; ?></td>
                                                            <td><?php echo $store['store_name']; ?></td>
                                                            <td><?php echo $vname; ?></td>
                                                            <td><?php echo $countryname['name']; ?></td>
                                                            <td><?php echo $statename['name']; ?></td>
                                                            <td><?php echo $cityname['name']; ?></td>
                                                            <td><?php echo $store['pincode']; ?></td>
                                                            <td><?php echo $store['p_name']; ?></td>
                                                            <td><?php echo $store['p_phone']; ?></td>
                                                            <td><?php echo $store['p_email']; ?></td>
                                                            <td><?php echo $device['reason']; ?></td>
                                                            <td><?php echo $device['person_by']; ?></td>
                                                            <td><?php echo $time; ?></td>


                                                        </tr>

                                                <?php
                                                    }
                                                }
                                                ?>


                                            </tbody>
                                        </table>
                                        <!-- End Table with stripped rows -->

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade show <?php echo $status3; ?>" id="pills-profile" role="tabpanel" aria-labelledby="profile-tab">
                            <!-- <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Remove Device</h5>

                                  
                                    <form class="row g-3" id="removeDevice">

                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="machineid2" name="machineid" aria-label="State" onchange="getval2(this);">

                                                    <option value=""></option>
                                                    <?php
                                                    $devices = getAssignedDevices();
                                                    $i = 0;
                                                    foreach ($devices as $device) {
                                                        $i++;
                                                        //print_r($machine);
                                                        $machine = getSingleMachine($device['machine_id']);
                                                    ?>
                                                        <option value="<?php echo  $device['id']; ?>"><?php echo  $machine['name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>


                                                </select>
                                                <label for="floatingSelect">Machine</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="machinetype2" name="machinetype" placeholder="machinetype" readonly>
                                                <label for="floatingSelect">Machine Type</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="brand2" name="brand" placeholder="" readonly>

                                                <label for="floatingSelect">Brand</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="store2" name="store" placeholder="" readonly>
                                                <label for="floatingSelect">Store Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">

                                                <input type="text" class="form-control" id="country2" name="country" placeholder="" readonly>
                                                <label for="floatingSelect">Country</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">

                                                <input type="text" class="form-control" id="state2" name="state" placeholder="" readonly>
                                                <label for="state">State</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">

                                                <input type="text" class="form-control" id="city2" name="city" placeholder="" readonly>
                                                <label for="city">City</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="mname2" name="mname" placeholder="Your Name" readonly>
                                                <label for="floatingName">User Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="mphone2" name="mphone" placeholder="Mac Id" readonly>
                                                <label for="floatingEmail">User Number</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="memail2" name="memail" placeholder="Store Name" readonly>
                                                <label for="floatingCity">User Email</label>
                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="reason2" name="reason" placeholder="Mac Id">
                                                <label for="floatingEmail">Reason to Remove</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="personby2" name="person" placeholder="Mac Id">
                                                <label for="floatingEmail">Removing By</label>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                        </div>

                                    </form>

                                </div>
                            </div> -->
                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-body" style="overflow-x:auto;">
                                        <h5 class="card-title">Removed Machine List</h5>


                                        <!-- Table with stripped rows -->
                                        <table id="removeDeviceList" class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Machine Number</th>
                                                    <th scope="col">Brand</th>
                                                    <th scope="col">User</th>
                                                    <th scope="col">Store</th>
                                                    <th scope="col">Recipe Version</th>
                                                    <!-- <th scope="col">Status</th> -->
                                                    <th scope="col" style="display:none">Country</th>
                                                    <th scope="col" style="display:none">State</th>
                                                    <th scope="col" style="display:none">City</th>
                                                    <th scope="col" style="display:none">Pincode</th>
                                                    <th scope="col" style="display:none">User Name</th>
                                                    <th scope="col" style="display:none">User Number</th>
                                                    <th scope="col" style="display:none">User Email</th>
                                                    <th scope="col">Reason</th>
                                                    <th scope="col">Removed By</th>
                                                    <th scope="col">Time</th>
                                                    <!-- <th scope="col">BM. Name</th>
                                                    <th scope="col">Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $devices = getUpdatesOfDevices();
                                                // print_r($devices);
                                                $i = 0;
                                                foreach ($devices as $device) {



                                                    $machine = getSingleMachine($device['machine_id']);
                                                    $brand = getBrand($device['brand_id']);
                                                    $user = getSingleuser($device['user_id']);
                                                    $store = getSingleStore($device['store_id']);
                                                    $rv = $device['versionid'];
                                                    $version = select_version_ID($rv);
                                                    //print_r($version['recipe_version']);exit;
                                                    $vname = $version['recipe_version'];
                                                    $countryname = getCountriesById($store['country']);
                                                    $statename = getStatesById($store['state']);
                                                    $cityname = getCityById($store['city']);

                                                    //print_r($machine);
                                                    // print_r($brand);
                                                    // print_r($user);
                                                    //print_r($store);
                                                    $timezone = new DateTimeZone('Asia/Kolkata');

                                                    $date = new DateTime($device['timestamp']);
                                                    $date->setTimeZone($timezone);
                                                    $time = $date->format('D d M Y g:i:s A') . "\n";
                                                    if ($device['record value'] == 2) {
                                                        $i++;
                                                ?>
                                                        <tr>
                                                            <th scope="row"><?php echo $i; ?></th>
                                                            <td><?php echo $machine['name']; ?></td>
                                                            <td><?php echo $brand['brand_name']; ?> </td>

                                                            <td><?php echo $user['name']; ?></td>
                                                            <td><?php echo $store['store_name']; ?></td>
                                                            <td><?php echo $vname; ?></td>
                                                            <td style="display:none"><?php echo $countryname['name']; ?></td>
                                                            <td style="display:none"><?php echo $statename['name']; ?></td>
                                                            <td style="display:none"><?php echo $cityname['name']; ?></td>
                                                            <td style="display:none"><?php echo $store['pincode']; ?></td>
                                                            <td style="display:none"><?php echo $store['p_name']; ?></td>
                                                            <td style="display:none"><?php echo $store['p_phone']; ?></td>
                                                            <td style="display:none"><?php echo $store['p_email']; ?></td>
                                                            <td><?php echo $device['reason']; ?></td>
                                                            <td><?php echo $device['person_by']; ?></td>
                                                            <td><?php echo $time; ?></td>


                                                        </tr>

                                                <?php
                                                    }
                                                }
                                                ?>



                                            </tbody>
                                        </table>
                                        <!-- End Table with stripped rows -->

                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="tab-pane fade show <?php echo $status4; ?>" id="pills-start" role="tabpanel" aria-labelledby="start-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Start Device</h5>

                                    <!-- Floating Labels Form -->
                                    <form class="row g-3" id="startDevice">



                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="id3" name="id" aria-label="" onchange="getval14(this);">

                                                    <option value=""></option>
                                                    <?php
                                                    $devices = getAssignedStoppedDevice();
                                                    //print_r($devices);exit;
                                                    $i = 0;
                                                    foreach ($devices as $device) {
                                                        $i++;

                                                        $machine = getSingleMachine($device['machine_id']);
                                                    ?>
                                                        <option value="<?php echo  $machine['id']; ?>"><?php echo  $machine['name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingSelect">Machine</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="machinetype4" name="machinetype" placeholder="machinetype" readonly>
                                                <label for="floatingSelect">Machine Type</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="brand4" name="brand" placeholder="" readonly>

                                                <label for="floatingSelect">Brand</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="store4" name="store" placeholder="" readonly>
                                                <label for="floatingSelect">Store Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">

                                                <input type="text" class="form-control" id="country4" name="country" placeholder="" readonly>
                                                <label for="floatingSelect">Country</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">

                                                <input type="text" class="form-control" id="state4" name="state" placeholder="" readonly>
                                                <label for="state">State</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">

                                                <input type="text" class="form-control" id="city4" name="city" placeholder="" readonly>
                                                <label for="city">City</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="mname4" name="mname" placeholder="Your Name" readonly>
                                                <label for="floatingName">User Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="mphone4" name="mphone" placeholder="Mac Id" readonly>
                                                <label for="floatingEmail">User Number</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="memail4" name="memail" placeholder="Store Name" readonly>
                                                <label for="floatingCity">User Email</label>
                                            </div>

                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="reason4" name="reason" placeholder="Mac Id">
                                                <label for="floatingEmail">Reason to Start the Machine</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="person4" name="person" placeholder="Mac Id">
                                                <label for="floatingEmail">Starting By</label>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                        </div>

                                    </form><!-- End floating Labels Form -->

                                </div>
                            </div>
                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-body" style="overflow-x:auto;">
                                        <h5 class="card-title">Start Machine List</h5>


                                        <table id="startDeviceList" class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Machine Number</th>
                                                    <th scope="col">Brand</th>
                                                    <th scope="col">User</th>
                                                    <th scope="col">Store</th>
                                                    <!-- <th scope="col">Status</th> -->
                                                    <th scope="col" style="display:none">Country</th>
                                                    <th scope="col" style="display:none">State</th>
                                                    <th scope="col" style="display:none">City</th>
                                                    <th scope="col" style="display:none">Pincode</th>
                                                    <th scope="col" style="display:none">User Name</th>
                                                    <th scope="col" style="display:none">User Number</th>
                                                    <th scope="col" style="display:none">User Email</th>
                                                    <th scope="col">Reason</th>
                                                    <th scope="col">Started By</th>
                                                    <th scope="col">Time</th>
                                                    <!-- <th scope="col">BM. Name</th>
                                                    <th scope="col">Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $devices = getUpdatesOfDevices();
                                                //print_r($devices);
                                                $i = 0;
                                                foreach ($devices as $device) {



                                                    $machine = getSingleMachine($device['machine_id']);
                                                    $brand = getBrand($device['brand_id']);
                                                    $user = getSingleuser($device['user_id']);
                                                    $store = getSingleStore($device['store_id']);
                                                    $countryname = getCountriesById($store['country']);
                                                    $statename = getStatesById($store['state']);
                                                    $cityname = getCityById($store['city']);

                                                    //print_r($machine);
                                                    // print_r($brand);
                                                    // print_r($user);
                                                    //print_r($store);
                                                    $timezone = new DateTimeZone('Asia/Kolkata');

                                                    $date = new DateTime($device['timestamp']);
                                                    $date->setTimeZone($timezone);
                                                    $time = $date->format('D d M Y g:i:s A') . "\n";
                                                    if ($device['record value'] == 3) {
                                                        $i++;
                                                ?>
                                                        <tr>
                                                            <th scope="row"><?php echo $i; ?></th>
                                                            <td><?php echo $machine['name']; ?></td>
                                                            <td><?php echo $brand['brand_name']; ?> </td>

                                                            <td><?php echo $user['name']; ?></td>
                                                            <td><?php echo $store['store_name']; ?></td>
                                                            <td style="display:none"><?php echo $countryname['name']; ?></td>
                                                            <td style="display:none"><?php echo $statename['name']; ?></td>
                                                            <td style="display:none"><?php echo $cityname['name']; ?></td>
                                                            <td style="display:none"><?php echo $store['pincode']; ?></td>
                                                            <td style="display:none"><?php echo $store['p_name']; ?></td>
                                                            <td style="display:none"><?php echo $store['p_phone']; ?></td>
                                                            <td style="display:none"><?php echo $store['p_email']; ?></td>
                                                            <td><?php echo $device['reason']; ?></td>
                                                            <td><?php echo $device['person_by']; ?></td>
                                                            <td><?php echo $time; ?></td>


                                                        </tr>

                                                <?php
                                                    }
                                                }
                                                ?>



                                            </tbody>
                                        </table>
                                        <!-- End Table with stripped rows -->

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade show <?php echo $status5; ?>" id="pills-stop" role="tabpanel" aria-labelledby="stop-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Stop Device</h5>

                                    <!-- Floating Labels Form -->
                                    <form class="row g-3" id="stopDevice">



                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="id4" name="id" aria-label="State" onchange="getval15(this);">

                                                    <option value=""></option>
                                                    <?php
                                                    $devices = getAssignedStartedDevice();
                                                    $i = 0;
                                                    foreach ($devices as $device) {
                                                        $i++;
                                                        //print_r($machine);
                                                        $machine = getSingleMachine($device['machine_id']);
                                                    ?>
                                                        <option value="<?php echo  $machine['id']; ?>"><?php echo  $machine['name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingSelect">Machine</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="machinetype5" name="machinetype" placeholder="machinetype" readonly>
                                                <label for="floatingSelect">Machine Type</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="brand5" name="brand" placeholder="" readonly>

                                                <label for="floatingSelect">Brand</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="store5" name="store" placeholder="" readonly>
                                                <label for="floatingSelect">Store Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">

                                                <input type="text" class="form-control" id="country5" name="country" placeholder="" readonly>
                                                <label for="floatingSelect">Country</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">

                                                <input type="text" class="form-control" id="state5" name="state" placeholder="" readonly>
                                                <label for="state">State</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">

                                                <input type="text" class="form-control" id="city5" name="city" placeholder="" readonly>
                                                <label for="city">City</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="mname5" name="mname" placeholder="Your Name" readonly>
                                                <label for="floatingName">User Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="mphone5" name="mphone" placeholder="Mac Id" readonly>
                                                <label for="floatingEmail">User Number</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="memail5" name="memail" placeholder="Store Name" readonly>
                                                <label for="floatingCity">User Email</label>
                                            </div>

                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="reason5" name="reason" placeholder="Mac Id">
                                                <label for="floatingEmail">Reason to Stop the Machine</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="person5" name="person" placeholder="Mac Id">
                                                <label for="floatingEmail">Stopping By</label>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                        </div>

                                    </form><!-- End floating Labels Form -->

                                </div>
                            </div>
                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-body" style="overflow-x:auto;">
                                        <h5 class="card-title">Stop Machine List</h5>


                                        <table id="stopDeviceList" class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Machine Number</th>
                                                    <th scope="col">Brand</th>
                                                    <th scope="col">User</th>
                                                    <th scope="col">Store</th>
                                                    <!-- <th scope="col">Status</th> -->
                                                    <th scope="col" style="display:none">Country</th>
                                                    <th scope="col" style="display:none">State</th>
                                                    <th scope="col" style="display:none">City</th>
                                                    <th scope="col" style="display:none">Pincode</th>
                                                    <th scope="col" style="display:none">User Name</th>
                                                    <th scope="col" style="display:none">User Number</th>
                                                    <th scope="col" style="display:none">User Email</th>
                                                    <th scope="col">Reason</th>
                                                    <th scope="col">Stopped By</th>
                                                    <th scope="col">Time</th>
                                                    <!-- <th scope="col">BM. Name</th>
                                                    <th scope="col">Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $devices = getUpdatesOfDevices();
                                                //print_r($devices);
                                                $i = 0;
                                                foreach ($devices as $device) {



                                                    $machine = getSingleMachine($device['machine_id']);
                                                    $brand = getBrand($device['brand_id']);
                                                    $user = getSingleuser($device['user_id']);
                                                    $store = getSingleStore($device['store_id']);
                                                    $countryname = getCountriesById($store['country']);
                                                    $statename = getStatesById($store['state']);
                                                    $cityname = getCityById($store['city']);

                                                    //print_r($machine);
                                                    // print_r($brand);
                                                    // print_r($user);
                                                    //print_r($store);
                                                    $timezone = new DateTimeZone('Asia/Kolkata');

                                                    $date = new DateTime($device['timestamp']);
                                                    $date->setTimeZone($timezone);
                                                    $time = $date->format('D d M Y g:i:s A') . "\n";
                                                    if ($device['record value'] == 4) {
                                                        $i++;
                                                ?>
                                                        <tr>
                                                            <th scope="row"><?php echo $i; ?></th>
                                                            <td><?php echo $machine['name']; ?></td>
                                                            <td><?php echo $brand['brand_name']; ?> </td>

                                                            <td><?php echo $user['name']; ?></td>
                                                            <td><?php echo $store['store_name']; ?></td>
                                                            <td style="display:none"><?php echo $countryname['name']; ?></td>
                                                            <td style="display:none"><?php echo $statename['name']; ?></td>
                                                            <td style="display:none"><?php echo $cityname['name']; ?></td>
                                                            <td style="display:none"><?php echo $store['pincode']; ?></td>
                                                            <td style="display:none"><?php echo $store['p_name']; ?></td>
                                                            <td style="display:none"><?php echo $store['p_phone']; ?></td>
                                                            <td style="display:none"><?php echo $store['p_email']; ?></td>
                                                            <td><?php echo $device['reason']; ?></td>
                                                            <td><?php echo $device['person_by']; ?></td>
                                                            <td><?php echo $time; ?></td>


                                                        </tr>

                                                <?php
                                                    }
                                                }
                                                ?>



                                            </tbody>
                                        </table>
                                        <!-- End Table with stripped rows -->

                                    </div>
                                </div>

                            </div>
                        </div>
                       
                    </div><!-- End Pills Tabs -->

                </div>
            </div>

        </section>
        <!--     
              <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div> -->



    </main><!-- End #main -->

    <?php include "footer.php"; ?>
    <script type="text/javascript" src="assets/js/jquery.serializejson.js"></script>
    <script>
        /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("floatingSelect").classList.toggle("show");
        }

        function filterFunction() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            div = document.getElementById("floatingSelect");
            a = div.getElementsByTagName("a");
            for (i = 0; i < a.length; i++) {
                txtValue = a[i].textContent || a[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    a[i].style.display = "";
                } else {
                    a[i].style.display = "none";
                }
            }
        }


        $(document).ready(function() {
            $('#country').on('change', function() {
                var country_id = this.value;
                //console.log(country_id);
                $.ajax({
                    url: "contry_state_city/states-by-country.php",
                    type: "POST",
                    data: {
                        country_id: country_id
                    },
                    cache: false,
                    success: function(result) {
                        //console.log(result);
                        $("#state").html(result);
                        $('#city').html('<option value="">Select State First</option>');
                    }
                });
            });
            $('#state').on('change', function() {
                var state_id = this.value;
                // console.log(state_id);
                $.ajax({
                    url: "contry_state_city/cities-by-state.php",
                    type: "POST",
                    data: {
                        state_id: state_id
                    },
                    cache: false,
                    success: function(result) {
                        $("#city").html(result);
                    }
                });
            });
        });



        $(document).ready(function() {
            $('#brand').on('change', function() {
                var id = this.value;
                //console.log(id);
                $.ajax({
                    url: "model/getBrandUsers.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: function(result) {
                        //console.log(result);
                        $("#user").html(result);
                        $("#useropt1").html('<option value=""></option>');
                        $("#useropt2").html('<option value=""></option>');
                        //$('#city').html('<option value="">Select State First</option>');
                        $('#mname').val('');
                        $('#mphone').val('');
                        $('#memail').val('');
                    }
                });
            });

            $('#brand').on('change', function() {
                var id = this.value;
                //console.log(id);
                $.ajax({
                    url: "model/getBrandStores.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: function(result) {
                        //console.log(result);
                        $("#store").html(result);
                        //$('#city').html('<option value="">Select State First</option>');
                        $('#country').html('<option value=""></option>');
                        $('#state').html('<option value=""></option>');
                        $('#city').html('<option value=""></option>');

                        $('#pincode').val('');
                    }
                });
            });

            $('#user').on('change', function() {
                var id = this.value;

                $.ajax({
                    url: "model/getUserDetails.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        //console.log(obj);
                        //$("#store").html(obj.);
                        $('#mname').val(obj.p_name);
                        $('#mphone').val(obj.p_phone);
                        $('#memail').val(obj.p_email);



                    }
                });
                var brand = document.getElementById('brand');
                var strUser = brand.value;
                //console.log(strUser);
                var id = strUser;
                var userid = this.value;
                //console.log(id);
                //
                $("#useropt1").html('<option value=""></option>');
                $.ajax({
                    url: "model/getBrandUsersMultiple.php",
                    type: "POST",
                    data: {
                        id: id,
                        userid: userid

                    },
                    cache: false,
                    success: function(result) {
                        //$('#useropt1').html('<option value=' + item + '>' + obj.name[index] + '</option>');
                        var obj = jQuery.parseJSON(result);
                        if (obj.id == null) {

                        } else {

                            var ids = obj.id;
                            ids.forEach(myFunction);

                            function myFunction(item, index) {
                                $('#useropt1').append('<option value=' + item + '>' + obj.name[index] + '</option>');
                            }
                        }


                        //$("#useropt2").html(result);
                        //$('#city').html('<option value="">Select State First</option>');
                    }
                });

            });
            $('#useropt1').on('change', function() {

                var brand = document.getElementById('brand');
                var strUser = brand.value;
                console.log(strUser);
                var id = strUser;
                var useropt = this.value;
                console.log(useropt);
                var user = document.getElementById('user');
                var userid = user.value;
                console.log(userid);
                $("#useropt2").html('<option value=""></option>');
                $.ajax({
                    url: "model/getBrandUsersMultiple.php",
                    type: "POST",
                    data: {
                        id: id,
                        userid: userid,
                        useropt1: useropt

                    },
                    cache: false,
                    success: function(result) {
                        //$('#useropt1').html('<option value=' + item + '>' + obj.name[index] + '</option>');
                        var obj = jQuery.parseJSON(result);
                        console.log(obj);
                        if (obj.id == null) {

                        } else {

                            var ids = obj.id;
                            ids.forEach(myFunction);

                            function myFunction(item, index) {
                                $('#useropt2').append('<option value=' + item + '>' + obj.name[index] + '</option>');
                            }
                        }


                        //$("#useropt2").html(result);
                        //$('#city').html('<option value="">Select State First</option>');
                    }
                });

            });


            $('#store').on('change', function() {
                var id = this.value;
                //console.log(id);
                $.ajax({
                    url: "model/getStoreDetails.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        //console.log(obj);
                        //$("#store").html(obj.);
                        // $('#mname').val(obj.p_name);
                        // $('#mphone').val(obj.p_phone);
                        // $('#memail').val(obj.p_email);
                        $('#country').html('<option value="' + obj.country + '">' + obj.countryname + '</option>');
                        $('#state').html('<option value="' + obj.state + '">' + obj.statename + '</option>');
                        $('#city').html('<option value="' + obj.city + '">' + obj.cityname + '</option>');

                        $('#pincode').val(obj.pincode);
                    }
                });
            });

        });

        function changeuseropt1(sel) {
            // var brand = document.getElementById('brand');
            // var strUser = brand.value;
            // //console.log(strUser);
            // var id = strUser;
            // var userid = sel.id;
            // //console.log(id);
            // $("#opt1").load(location.href + " #opt1");
            // $.ajax({
            //     url: "model/getBrandUsers.php",
            //     type: "POST",
            //     data: {
            //         id: id,
            //         userid: userid

            //     },
            //     cache: false,
            //     success: function(result) {
            //         $('#useropt1').html('<option value='+item+' style="display:none">'+obj.name[index]+'</option>');
            //         // var obj = jQuery.parseJSON(result);
            //         // var ids=obj.id;
            //         // ids.forEach(myFunction);

            //         // function myFunction(item, index) {
            //         //     $('#useropt1').append('<option value='+item+'>'+obj.name[index]+'</option>');
            //         // }

            //         //$("#useropt2").html(result);
            //         //$('#city').html('<option value="">Select State First</option>');
            //     }
            // });

        }
        $(document).ready(function() {
            $('#brandedit').on('change', function() {
                var id = this.value;
                //console.log(id);
                $.ajax({
                    url: "model/getBrandUsers.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: function(result) {
                        //console.log(result);
                        $("#useredit").html(result);
                        // $("#user1").html(result);
                        // $("#user2").html(result);
                        //$('#city').html('<option value="">Select State First</option>');
                    }
                });
            });
            $('#brandedit').on('change', function() {
                var id = this.value;
                //console.log(id);
                $.ajax({
                    url: "model/getBrandStores.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: function(result) {
                        //console.log(result);
                        $("#storeedit").html(result);
                        //$('#city').html('<option value="">Select State First</option>');
                    }
                });
            });
            $('#useredit').on('change', function() {
                var id = this.value;
                //console.log(id);
                $.ajax({
                    url: "model/getUserDetails.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        //console.log(obj);
                        //$("#store").html(obj.);
                        $('#mnameedit').val(obj.p_name);
                        $('#mphoneedit').val(obj.p_phone);
                        $('#memailedit').val(obj.p_email);



                    }
                });
            });
            $('#storeedit').on('change', function() {
                var id = this.value;
                //console.log(id);
                $.ajax({
                    url: "model/getStoreDetails.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        //console.log(obj);
                        //$("#store").html(obj.);
                        // $('#mname').val(obj.p_name);
                        // $('#mphone').val(obj.p_phone);
                        // $('#memail').val(obj.p_email);
                        $('#countryedit').html('<option value="' + obj.country + '">' + obj.countryname + '</option>');
                        $('#stateedit').html('<option value="' + obj.state + '">' + obj.statename + '</option>');
                        $('#cityedit').html('<option value="' + obj.city + '">' + obj.cityname + '</option>');

                        $('#pincodeedit').val(obj.pincode);
                    }
                });
            });

        });


        function getval(sel) {


            $.ajax({
                url: "model/getProductType.php",
                type: "POST",
                data: {
                    id: sel.value
                },
                cache: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    var string1 = obj.error;
                    var output = obj.error_msg;

                    if (obj.error == 0) {



                        $("#machinetype").val(output);



                    } else {

                        Swal.fire({
                            icon: 'error',
                            text: output,
                            timer: 1500

                        })

                    }
                }
            });
        }

        function getval1(sel) {

            $.ajax({
                url: "model/getAssignedDevice.php",
                type: "POST",
                data: {
                    id: sel.value
                },
                cache: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    //console.log(obj);
                    //$("#store").html(obj.);
                    $('#machinetype1').val(obj.ptype);
                    //$('#brand1').val(obj.brand_id);
                    //$('#user1').val(obj.user_id);

                    //$('#store1').val(obj.store_id);
                }
            });
        }
        $('#brand1').on('change', function() {
            var id = this.value;
            //console.log(id);
            $.ajax({
                url: "model/getBrandUsers.php",
                type: "POST",
                data: {
                    id: id
                },
                cache: false,
                success: function(result) {
                    //console.log(result);
                    $("#user1").html(result);
                    //$('#city').html('<option value="">Select State First</option>');
                }
            });
        });
        $('#brand1').on('change', function() {
            var id = this.value;
            //console.log(id);
            $.ajax({
                url: "model/getBrandStores.php",
                type: "POST",
                data: {
                    id: id
                },
                cache: false,
                success: function(result) {
                    //console.log(result);
                    $("#store1").html(result);
                    //$('#city').html('<option value="">Select State First</option>');
                }
            });
        });
        $('#user1').on('change', function() {
            var id = this.value;
            //console.log(id);
            $.ajax({
                url: "model/getUserDetails.php",
                type: "POST",
                data: {
                    id: id
                },
                cache: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    //console.log(obj);
                    //$("#store").html(obj.);
                    $('#mname1').val(obj.p_name);
                    $('#mphone1').val(obj.p_phone);
                    $('#memail1').val(obj.p_email);



                }
            });
        });
        $('#store1').on('change', function() {
            var id = this.value;
            //console.log(id);
            $.ajax({
                url: "model/getStoreDetails.php",
                type: "POST",
                data: {
                    id: id
                },
                cache: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    //console.log(obj);
                    //$("#store").html(obj.);
                    // $('#mname1').val(obj.p_name);
                    // $('#mphone1').val(obj.p_phone);
                    // $('#memail1').val(obj.p_email);
                    $('#country1').html('<option value="' + obj.country + '">' + obj.countryname + '</option>');
                    $('#state1').html('<option value="' + obj.state + '">' + obj.statename + '</option>');
                    $('#city1').html('<option value="' + obj.city + '">' + obj.cityname + '</option>');

                    $('#pincode1').val(obj.pincode);
                }
            });
        });




        $(document).ready(function(e) {
            $("#assigndevice").on('submit', (function(e) {
                e.preventDefault();

                $.ajax({
                    url: "model/assign_device.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        var string1 = obj.error;
                        var output = obj.error_msg;

                        if (obj.error == 0) {
                            Swal.fire({
                                icon: 'success',
                                text: output,
                                timer: 1500

                            })

                            setTimeout(function() {
                                window.location.href = 'device_management.php?page=1';
                            }, 2000);


                        } else {

                            Swal.fire({
                                icon: 'error',
                                text: output,
                                timer: 1500

                            })

                        }
                    },
                    error: function() {}

                });
                //}
            }));
        });

        $(document).ready(function(e) {
            $("#updateDevice").on('submit', (function(e) {
                e.preventDefault();

                $.ajax({
                    url: "model/update_device.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        var string1 = obj.error;
                        var output = obj.error_msg;

                        if (obj.error == 0) {
                            Swal.fire({
                                icon: 'success',
                                text: output,
                                timer: 1500

                            })

                            setTimeout(function() {
                                window.location.href = 'device_management.php?page=2';
                            }, 2000);


                        } else {

                            Swal.fire({
                                icon: 'error',
                                text: output,
                                timer: 1500

                            })

                        }
                    },
                    error: function() {}

                });
                //}
            }));
        });


        $(document).ready(function(e) {
            $("#removeDevice").on('submit', (function(e) {
                e.preventDefault();

                $.ajax({
                    url: "model/remove_device.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        var string1 = obj.error;
                        var output = obj.error_msg;

                        if (obj.error == 0) {
                            Swal.fire({
                                icon: 'success',
                                text: output,
                                timer: 1500

                            })

                            setTimeout(function() {
                                //window.location.href = 'device_management.php?page=3';
                                $("#verticalycentered1").modal("hide");
                                $("#asmclist").load(location.href + " #asmclist");
                            }, 2000);


                        } else {

                            Swal.fire({
                                icon: 'error',
                                text: output,
                                timer: 1500

                            })

                        }
                    },
                    error: function() {}

                });
                //}
            }));
        });

        $(document).ready(function(e) {
            $("#startDevice").on('submit', (function(e) {
                $("#pageloader").fadeIn();
                e.preventDefault();
                var comment = $('#id3').val();
                //let rating= $('#rating').val()
                var data = new FormData(this);
                // console.log(comment);
                $.ajax({
                    url: "model/getMachineDetails.php",
                    async: false,
                    type: "POST",
                    data: {
                        "id": comment
                    },
                    success: function(result) {

                        var obj = jQuery.parseJSON(result);
                        // console.log(obj);
                        //alert(obj.machinename);
                        var machine = obj.machinename;
                        //alert(machine);
                        var idvalue = {
                            id: machine
                        }
                        $.ajax({
                            url: "http://www.mykitchenos.com:3000/startDevice",
                            //async: false,
                            type: "POST",
                            dataType: 'json',
                            contentType: 'application/json',
                            data: JSON.stringify(idvalue),
                            success: function(result) {

                                //var obj = jQuery.parseJSON(result);
                                // Swal.fire({
                                //                 icon: 'success',
                                //                 text: result,
                                //                 timer: 1500

                                //             })
                                if (result == 1) {
                                    $.ajax({
                                        url: "model/start_device.php",
                                        type: "POST",
                                        data: data,
                                        contentType: false,
                                        cache: false,
                                        processData: false,
                                        success: function(data) {
                                            var obj = jQuery.parseJSON(data);
                                            var string1 = obj.error;
                                            var output = obj.error_msg;
                                            $("#pageloader").fadeOut();
                                            if (obj.error == 0) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    text: output,
                                                    timer: 1500

                                                })
                                                setTimeout(function() {
                                                    window.location.href = 'device_management.php?page=4';
                                                    //     // $("#pills-start-tab").load(window.location.href + " #pills-start-tab").attr(aria-selected,true).addClass('active');
                                                }, 3000);


                                            } else {

                                                Swal.fire({
                                                    icon: 'error',
                                                    text: output,
                                                    timer: 1500

                                                })

                                            }
                                        },
                                        error: function() {}

                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        text: 'machine not responding',
                                        timer: 1500

                                    })
                                }


                            }
                        });
                        // $.ajax({
                        //     url: "http://www.mykitchenos.com:3000/startDeviceResponce",
                        //     //async: false,
                        //     type: "POST",
                        //     dataType: 'json',
                        //     contentType: 'application/json',
                        //     data: JSON.stringify(idvalue),
                        //     success: function(result) {

                        //         var obj = jQuery.parseJSON(data);
                        //         console.log(obj.msg);


                        //     }
                        // });
                    }
                });



                // console.log(formDataVar); //exit;
                // $.ajax({
                //     url: "http://www.mykitchenos.com:3000/process_post",
                //     type: 'POST',
                //     data: formDataVar,
                //     dataType: 'json',
                //     contentType: false,
                //     cache: false,
                //     processData: false,
                //     success: function(data) {
                //         var obj = jQuery.parseJSON(data);
                //         var string1 = obj.error;
                //         var output = obj.error_msg;

                //         if (obj.error == 0) {
                //             Swal.fire({
                //                 icon: 'success',
                //                 text: output,
                //                 timer: 1500

                //             })
                //             // setTimeout(function() {
                //             //window.location.href = 'device_management.php?page=4';
                //             // $("#pills-start-tab").load(window.location.href + " #pills-start-tab").attr(aria-selected,true).addClass('active');
                //             //  }, 2000);


                //         } else {

                //             Swal.fire({
                //                 icon: 'error',
                //                 text: output,
                //                 timer: 1500

                //             })

                //         }
                //     },
                //     error: function() {}

                // });


                //}
            }));
        });

        $(document).ready(function(e) {
            $("#stopDevice").on('submit', (function(e) {
                $("#pageloader").fadeIn();
                e.preventDefault();
                var comment = $('#id4').val();
                //let rating= $('#rating').val()
                var data = new FormData(this);
                console.log(comment);
                $.ajax({
                    url: "model/getMachineDetails.php",
                    async: false,
                    type: "POST",
                    data: {
                        "id": comment
                    },
                    success: function(result) {
                        var obj = jQuery.parseJSON(result);
                        //alert(obj.machinename);
                        var machine = obj.machinename;
                        //alert(machine);
                        var idvalue = {
                            id: machine
                        }
                        $.ajax({
                            url: "http://www.mykitchenos.com:3000/stopDevice",
                            //async: false,
                            type: "POST",
                            dataType: 'json',
                            contentType: 'application/json',
                            data: JSON.stringify(idvalue),
                            success: function(result) {
                                console.log(result);
                                if (result == 1) {

                                    $.ajax({
                                        url: "model/stop_device.php",
                                        type: "POST",
                                        data: data,
                                        contentType: false,
                                        cache: false,
                                        processData: false,
                                        success: function(data) {
                                            var obj = jQuery.parseJSON(data);
                                            var string1 = obj.error;
                                            var output = obj.error_msg;
                                            $("#pageloader").fadeOut();
                                            if (obj.error == 0) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    text: output,
                                                    timer: 3000

                                                })

                                                setTimeout(function() {
                                                    window.location.href = 'device_management.php?page=5';
                                                    // $("#stopDeviceList").load(window.location.href + " brand_registration.php#stopDeviceList");
                                                }, 1000);


                                            } else {

                                                Swal.fire({
                                                    icon: 'error',
                                                    text: output,
                                                    timer: 3000

                                                })

                                            }
                                        },
                                        error: function() {}

                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        text: 'machine not responding',
                                        timer: 3000

                                    })
                                }

                            }
                        });

                    }
                });

                //}
            }));
        });



        function getval2(sel) {
            // console.log(sel);
            $.ajax({
                url: "model/removeAssignedDevice.php",
                type: "POST",
                data: {
                    id: sel.value
                },
                cache: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    //console.log(obj); 

                    $('#machinetype2').val(obj.ptype);
                    $('#brand2').val(obj.brand);
                    $('#mname2').val(obj.user);
                    $('#memail2').val(obj.useremail);
                    $('#mphone2').val(obj.userphone);
                    $('#country2').val(obj.country);
                    $('#state2').val(obj.state);
                    $('#city2').val(obj.city);
                    $("#store2").val(obj.store);

                }
            });

        }

        function getval14(sel) {
            // console.log(sel);
            $.ajax({
                url: "model/getMachineDetails.php",
                type: "POST",
                data: {
                    id: sel.value
                },
                cache: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    //console.log(obj); 

                    $('#machinetype4').val(obj.ptype);
                    $('#brand4').val(obj.brand);
                    $('#mname4').val(obj.user);
                    $('#memail4').val(obj.email);
                    $('#mphone4').val(obj.phone);
                    $('#country4').val(obj.countryname);
                    $('#state4').val(obj.statename);
                    $('#city4').val(obj.cityname)
                    $("#store4").val(obj.store);

                }
            });

        }

        function getval4(sel) {
            // console.log(sel);
            $.ajax({
                url: "model/removeAssignedDevice.php",
                type: "POST",
                data: {
                    id: sel.value
                },
                cache: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    //console.log(obj); 

                    $('#machinetype4').val(obj.ptype);
                    $('#brand4').val(obj.brand);
                    $('#mname4').val(obj.user);
                    $('#memail4').val(obj.useremail);
                    $('#mphone4').val(obj.userphone);
                    $('#country4').val(obj.country);
                    $('#state4').val(obj.state);
                    $('#city4').val(obj.city);
                    $("#store4").val(obj.store);

                }
            });

        }


        function getval15(sel) {
            // console.log(sel);
            $.ajax({
                url: "model/getMachineDetails.php",
                type: "POST",
                data: {
                    id: sel.value
                },
                cache: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    console.log(obj);

                    $('#machinetype5').val(obj.ptype);
                    $('#brand5').val(obj.brand);
                    $('#mname5').val(obj.user);
                    $('#memail5').val(obj.email);
                    $('#mphone5').val(obj.phone);
                    $('#country5').val(obj.countryname);
                    $('#state5').val(obj.statename);
                    $('#city5').val(obj.cityname)
                    $("#store5").val(obj.store);


                }
            });

        }

        function getval5(sel) {
            // console.log(sel);
            $.ajax({
                url: "model/removeAssignedDevice.php",
                type: "POST",
                data: {
                    id: sel.value
                },
                cache: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    //console.log(obj); 

                    $('#machinetype5').val(obj.ptype);
                    $('#brand5').val(obj.brand);
                    $('#mname5').val(obj.user);
                    $('#memail5').val(obj.useremail);
                    $('#mphone5').val(obj.userphone);
                    $('#country5').val(obj.country);
                    $('#state5').val(obj.state);
                    $('#city5').val(obj.city);
                    $("#store5").val(obj.store);

                }
            });

        }

        function getvalrecipe(sel) {
            // console.log(sel);
            $.ajax({
                url: "model/getMachineVersionRecipes.php",
                type: "POST",
                data: {
                    id: sel.value
                },
                cache: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    console.log(obj);

                    $('#machinetype5').val(obj.ptype);
                    $('#brand5').val(obj.brand);
                    $('#mname5').val(obj.user);
                    $('#memail5').val(obj.email);
                    $('#mphone5').val(obj.phone);
                    $('#country5').val(obj.countryname);
                    $('#state5').val(obj.statename);
                    $('#city5').val(obj.cityname)
                    $("#store5").val(obj.store);


                }
            });

        }
        // $(' #devicelist tr  td').on('click', function() {

        //     $("#machineidedit").val($(this).closest('tr').children()[12].textContent);
        //     $("#machinetypeedit").val($(this).closest('tr').children()[2].textContent);
        //     $("#brandedit").val($(this).closest('tr').children()[13].textContent);
        //     var brand_id = $(this).closest('tr').children()[13].textContent;
        //     var userid = $(this).closest('tr').children()[14].textContent;
        //     var storeid = $(this).closest('tr').children()[15].textContent;

        //     //console.log(id);
        //     $.ajax({
        //         url: "model/getBrandUsers.php",
        //         type: "POST",
        //         data: {
        //             id: brand_id
        //         },
        //         cache: false,
        //         success: function(result) {
        //             //console.log(result);
        //             $("#useredit").html(result);
        //             $("#useredit").val(userid);
        //             //$('#city').html('<option value="">Select State First</option>');
        //         }
        //     });


        //     $.ajax({
        //         url: "model/getBrandStores.php",
        //         type: "POST",
        //         data: {
        //             id: brand_id
        //         },
        //         cache: false,
        //         success: function(result) {
        //             //console.log(result);
        //             $("#storeedit").html(result);
        //             $("#storeedit").val(storeid);
        //             //$('#city').html('<option value="">Select State First</option>');
        //         }
        //     });



        //     //$("#cityedit").val($(this).closest('tr').children()[18].textContent);
        //     //$("#stateedit").val($(this).closest('tr').children()[17].textContent);
        //     //$("#countryedit").val($(this).closest('tr').children()[16].textContent);
        //     $("#memailedit").val($(this).closest('tr').children()[11].textContent);
        //     $("#mphoneedit").val($(this).closest('tr').children()[10].textContent);
        //     $("#pincodeedit").val($(this).closest('tr').children()[9].textContent);
        //     var country_id = $(this).closest('tr').children()[16].textContent;
        //     var state_id = $(this).closest('tr').children()[17].textContent;
        //     var city_id = $(this).closest('tr').children()[18].textContent;
        //     var country_name = $(this).closest('tr').children()[6].textContent;
        //     var state_name = $(this).closest('tr').children()[7].textContent;
        //     var city_name = $(this).closest('tr').children()[8].textContent;
        //     $("#countryedit").html('<option value="' + country_id + '" selected>' + country_name + '</option>');


        //     $.ajax({
        //         url: "contry_state_city/states-by-country.php",
        //         type: "POST",
        //         data: {
        //             country_id: country_id
        //         },
        //         cache: false,
        //         success: function(result) {
        //             //console.log(result);
        //             // $("#stateedit").html(result);
        //             $("#stateedit").html('<option value="' + state_id + '" selected>' + state_name + '</option>');


        //         }
        //     });


        //     $.ajax({
        //         url: "contry_state_city/cities-by-state.php",
        //         type: "POST",
        //         data: {
        //             state_id: state_id
        //         },
        //         cache: false,
        //         success: function(result) {
        //             // $("#cityedit").html(result);
        //             $("#cityedit").html('<option value="' + city_id + '" selected>' + city_name + '</option>');
        //         }
        //     });





        //     // $("#machineidview").val($(this).closest('tr').children()[1].textContent);
        //     // $("#machinetypeview").val($(this).closest('tr').children()[2].textContent);
        //     // $("#brandview").val($(this).closest('tr').children()[3].textContent);
        //     // $("#storeview").val($(this).closest('tr').children()[5].textContent);
        //     // $("#userview").val($(this).closest('tr').children()[4].textContent);
        //     // $("#cityview").val($(this).closest('tr').children()[8].textContent);
        //     // $("#stateview").val($(this).closest('tr').children()[7].textContent);
        //     // $("#countryview").val($(this).closest('tr').children()[6].textContent);
        //     // $("#memailview").val($(this).closest('tr').children()[11].textContent);
        //     // $("#mphoneview").val($(this).closest('tr').children()[10].textContent);
        //     // $("#pincodeview").val($(this).closest('tr').children()[9].textContent);

        //     // $("#machineiddelete").val($(this).closest('tr').children()[12].textContent);
        //     // $("#machineidnamedelete").val($(this).closest('tr').children()[1].textContent);
        //     // $("#machinetypedelete").val($(this).closest('tr').children()[2].textContent);
        //     // $("#branddelete").val($(this).closest('tr').children()[3].textContent);
        //     // $("#storedelete").val($(this).closest('tr').children()[5].textContent);
        //     // $("#userdelete").val($(this).closest('tr').children()[4].textContent);
        //     // $("#citydelete").val($(this).closest('tr').children()[8].textContent);
        //     // $("#statedelete").val($(this).closest('tr').children()[7].textContent);
        //     // $("#countrydelete").val($(this).closest('tr').children()[6].textContent);
        //     // $("#memaildelete").val($(this).closest('tr').children()[11].textContent);
        //     // $("#mphonedelete").val($(this).closest('tr').children()[10].textContent);
        //     // $("#pincodedelete").val($(this).closest('tr').children()[9].textContent);



        //     $("#verticalycentered1").modal("show");


        // });

        function viewmodel(mid) {


            ///console.log(mid);
            $.ajax({
                url: "model/getMachineDetails.php",
                type: "POST",
                data: {
                    id: mid
                },
                cache: false,
                success: function(result) {

                    var obj = jQuery.parseJSON(result);
                    //console.log(obj);
                    $("#verticalycentered1").modal("show");
                    //console.log(obj['Assign_id']);


                    $("#machineidedit").val(obj['Assign_id']);
                    $("#machinetypeedit").val(obj['ptype']);
                    $("#brandedit").val(obj['brand_id']);
                    var brand_id = obj['brand_id'];
                    var userid = obj['user_id'];
                    var storeid = obj['store_id'];
                    var vid = obj['versionid'];
                    var vname = obj['vname'];
                    $("#recipeversionview").val(vname);
                    $("#recipeversionedit").val(vid);
                    $("#recipeversionremove").val(vname);
                    //console.log(id);
                    $.ajax({
                        url: "model/getBrandUsers.php",
                        type: "POST",
                        data: {
                            id: brand_id
                        },
                        cache: false,
                        success: function(result) {
                            //console.log(result);
                            $("#useredit").html(result);
                            $("#useredit").val(userid);
                            //$('#city').html('<option value="">Select State First</option>');
                        }
                    });


                    $.ajax({
                        url: "model/getBrandStores.php",
                        type: "POST",
                        data: {
                            id: brand_id
                        },
                        cache: false,
                        success: function(result) {
                            //console.log(result);
                            $("#storeedit").html(result);
                            $("#storeedit").val(storeid);
                            //$('#city').html('<option value="">Select State First</option>');
                        }
                    });



                    //$("#cityedit").val($(this).closest('tr').children()[18].textContent);
                    //$("#stateedit").val($(this).closest('tr').children()[17].textContent);
                    //$("#countryedit").val($(this).closest('tr').children()[16].textContent);
                    $("#memailedit").val(obj['email']);
                    $("#mphoneedit").val(obj['phone']);
                    $("#pincodeedit").val(obj['pincode']);
                    var country_id = obj['country'];
                    var state_id = obj['state'];
                    var city_id = obj['city'];
                    var country_name = obj['countryname'];
                    var state_name = obj['statename'];
                    var city_name = obj['cityname'];
                    $("#countryedit").html('<option value="' + country_id + '" selected>' + country_name + '</option>');


                    $.ajax({
                        url: "contry_state_city/states-by-country.php",
                        type: "POST",
                        data: {
                            country_id: country_id
                        },
                        cache: false,
                        success: function(result) {
                            //console.log(result);
                            // $("#stateedit").html(result);
                            $("#stateedit").html('<option value="' + state_id + '" selected>' + state_name + '</option>');


                        }
                    });


                    $.ajax({
                        url: "contry_state_city/cities-by-state.php",
                        type: "POST",
                        data: {
                            state_id: state_id
                        },
                        cache: false,
                        success: function(result) {
                            // $("#cityedit").html(result);
                            $("#cityedit").html('<option value="' + city_id + '" selected>' + city_name + '</option>');
                        }
                    });




                    $("#machineidview").val(obj['machinename']);
                    $("#machinetypeview").val(obj['ptype']);
                    $("#brandview").val(obj['brand']);
                    $("#storeview").val(obj['store']);
                    $("#userview").val(obj['user']);
                    $("#cityview").val(obj['cityname']);
                    $("#stateview").val(obj['statename']);
                    $("#countryview").val(obj['countryname']);
                    $("#memailview").val(obj['email']);
                    $("#mphoneview").val(obj['phone']);
                    $("#pincodeview").val(obj['pincode']);

                    $("#machineiddelete").val(obj['Assign_id']);
                    $("#machineidnamedelete").val(obj['machinename']);
                    $("#machinetypedelete").val(obj['ptype']);
                    $("#branddelete").val(obj['brand']);
                    $("#storedelete").val(obj['store']);

                    $("#userdelete").val(obj['user']);
                    $("#citydelete").val(obj['cityname']);
                    $("#statedelete").val(obj['statename']);
                    $("#countrydelete").val(obj['countryname']);
                    $("#memaildelete").val(obj['email']);
                    $("#mphonedelete").val(obj['phone']);
                    $("#pincodedelete").val(obj['pincode']);



                }
            });













        }
        $(document).ready(function(e) {
            $('#id5').on('change', function() {
                var mid = this.value;

                $.ajax({
                    url: "model/getMachineVersionRecipes.php",
                    type: "POST",
                    data: {
                        id: mid
                    },
                    cache: false,
                    success: function(result) {

                        var obj = jQuery.parseJSON(result);

                        //console.log(obj);

                        var vid = obj['id'];
                        var vname = obj['version_name'];
                        $("#recipeversion1").html('<option value="' + vid + '" selected>' + vname + '</option>');
                        $("#vvrversion").val(obj['version_name']);
                        $("#vheatingtemp").val(obj['pre_heating_temp']);
                        $("#vvtemp1").val(obj['sleep_time_temp']);
                        $("#vvsleeptime").val(obj['sleep_time']);
                        $("#vvdeepsleep").val(obj['deep_sleep_time']);
                        var htmloption = '<option value=""></option>';
                        $.each(obj['rcpids'], function(index, value) {
                            // console.log(value);
                            htmloption = htmloption + '<option value="' + value + '">' + value + '</option>';
                        });
                        // console.log(htmloption);
                        $("#recipeidview").html(htmloption);
                        $("#version_name").val(obj['version_name']);

                        $("#version_id").val(obj['id']);
                    }
                });


            });
        });
        $(document).ready(function() {
            $('#recipeidview').on('change', function() {
                var recipe_id = this.value;
                // var recipe_id = document.getElementById('recipeid');
                var vid = $("#version_id").val();
                //     console.log(recipe_id);
                //    console.log(vid);
                $.ajax({
                    url: "reports1/getportions.php",
                    type: "POST",
                    data: {
                        recipe_id: recipe_id,
                        vid: vid
                    },
                    cache: false,
                    success: function(result1) {

                        var obj = jQuery.parseJSON(result1);
                        //console.log(obj);
                        // $("#verticalycentered1").modal("show");
                        // var version_name = obj['version_name'];
                        $("#recipe_nameview").val(obj['recipe_name']);

                        //Portion 1
                        $("#rct_1v").val(obj['rct_1']);

                        $("#T1Min_1v").val(obj['T1Min_P1']);
                        $("#T1Sec_1v").val(obj['T1Sec_P1']);


                        $("#htMin_1v").val(obj['HTMin_P1']);
                        $("#htSec_1v").val(obj['HTSec_P1']);

                        $("#T2Min_1v").val(obj['T2Min_P1']);
                        $("#T2Sec_1v").val(obj['T2Sec_P1']);



                        //Potion 2
                        $("#rct_2v").val(obj['rct_2']);

                        $("#T1Min_2v").val(obj['T1Min_P2']);
                        $("#T1Sec_2v").val(obj['T1Sec_P2']);


                        $("#htMin_2v").val(obj['HTMin_P2']);
                        $("#htSec_2v").val(obj['HTSec_P2']);

                        $("#T2Min_2v").val(obj['T2Min_P2']);
                        $("#T2Sec_2v").val(obj['T2Sec_P2']);


                        // Portion 3
                        $("#rct_3v").val(obj['rct_3']);

                        $("#T1Min_3v").val(obj['T1Min_P3']);
                        $("#T1Sec_3v").val(obj['T1Sec_P3']);


                        $("#htMin_3v").val(obj['HTMin_P3']);
                        $("#htSec_3v").val(obj['HTSec_P3']);

                        $("#T2Min_3v").val(obj['T2Min_P3']);
                        $("#T2Sec_3v").val(obj['T2Sec_P3']);

                        // Portion 4
                        $("#rct_4v").val(obj['rct_4']);

                        $("#T1Min_4v").val(obj['T1Min_P4']);
                        $("#T1Sec_4v").val(obj['T1Sec_P4']);


                        $("#htMin_4v").val(obj['HTMin_P4']);
                        $("#htSec_4v").val(obj['HTSec_P4']);

                        $("#T2Min_4v").val(obj['T2Min_P4']);
                        $("#T2Sec_4v").val(obj['T2Sec_P4']);


                        //Portion 5
                        $("#rct_5v").val(obj['rct_5']);

                        $("#T1Min_5v").val(obj['T1Min_P5']);
                        $("#T1Sec_5v").val(obj['T1Sec_P5']);


                        $("#htMin_5v").val(obj['HTMin_P5']);
                        $("#htSec_5v").val(obj['HTSec_P5']);

                        $("#T2Min_5v").val(obj['T2Min_P5']);
                        $("#T2Sec_5v").val(obj['T2Sec_P5']);











                        // $("#useremail3").val(obj['p_email']);
                        // $("#userphone3").val(obj['p_phone']);
                        // $("#userpassword3").val(obj['password']);




                    }

                });
            });

        });


        
        $(document).ready(function(e) {
            $("#recipeversionform").on('submit', (function(e) {
                $("#pageloader").fadeIn();
                e.preventDefault();
                var comment = $('#id5').val();
                //let rating= $('#rating').val()
                var data = $("#recipeversionform").serializeJSON();
          // console.log(JSON.stringify(data));
                $.ajax({
                    url: "model/getMachineDetails.php",
                    async: false,
                    type: "POST",
                    data: {
                        "id": comment
                    },
                    success: function(result) {
                        var obj = jQuery.parseJSON(result);
                        //alert(obj.machinename);
                        var machine = obj.machinename;
                        //alert(machine);
                        var idvalue = {
                            id: machine,
                            version:data
                        }
                        $.ajax({
                            url: "http://www.mykitchenos.com:3001/sendversion",
                            //async: false,
                            type: "POST",
                            dataType: 'json',
                            contentType: 'application/json',
                            data: JSON.stringify(idvalue),
                            success: function(result) {
                                console.log(result);
                                $("#pageloader").fadeOut();
                                // if (result == 1) {

                                //     $.ajax({
                                //         url: "model/recipeversionmqttresponse.php",
                                //         type: "POST",
                                //         data: idvalue,
                                //         contentType: false,
                                //         cache: false,
                                //         processData: false,
                                //         success: function(data) {
                                //             var obj = jQuery.parseJSON(data);
                                //             var string1 = obj.error;
                                //             var output = obj.error_msg;
                                //             $("#pageloader").fadeOut();
                                //             if (obj.error == 0) {
                                //                 Swal.fire({
                                //                     icon: 'success',
                                //                     text: output,
                                //                     timer: 3000

                                //                 })

                                //                 setTimeout(function() {
                                //                     window.location.href = 'device_management.php?page=5';
                                //                     // $("#stopDeviceList").load(window.location.href + " brand_registration.php#stopDeviceList");
                                //                 }, 1000);


                                //             } else {

                                //                 Swal.fire({
                                //                     icon: 'error',
                                //                     text: output,
                                //                     timer: 3000

                                //                 })

                                //             }
                                //         },
                                //         error: function() {}

                                //     });
                                // } else {
                                //     Swal.fire({
                                //         icon: 'error',
                                //         text: 'machine not responding',
                                //         timer: 3000

                                //     })
                                // }

                            }
                        });

                    }
                });

                //}
             }));
        });

        $(document).ready(function(e) {
            $("#recipesbyid").on('submit', (function(e) {
                $("#pageloader").fadeIn();
                e.preventDefault();
                var comment = $('#id5').val();
                //let rating= $('#rating').val()
                var data = $("#recipesbyid").serializeJSON();
          // console.log(JSON.stringify(data));
                $.ajax({
                    url: "model/getMachineDetails.php",
                    async: false,
                    type: "POST",
                    data: {
                        "id": comment
                    },
                    success: function(result) {
                        var obj = jQuery.parseJSON(result);
                        //alert(obj.machinename);
                        var machine = obj.machinename;
                        //alert(machine);
                        var idvalue = {
                            id: machine,
                            version:data
                        }
                        $.ajax({
                            url: "http://www.mykitchenos.com:3001/sendrecipe",
                            //async: false,
                            type: "POST",
                            dataType: 'json',
                            contentType: 'application/json',
                            data: JSON.stringify(idvalue),
                            success: function(result) {
                                console.log(result);
                                $("#pageloader").fadeOut();
                                // if (result == 1) {

                                //     $.ajax({
                                //         url: "model/recipeversionmqttresponse.php",
                                //         type: "POST",
                                //         data: idvalue,
                                //         contentType: false,
                                //         cache: false,
                                //         processData: false,
                                //         success: function(data) {
                                //             var obj = jQuery.parseJSON(data);
                                //             var string1 = obj.error;
                                //             var output = obj.error_msg;
                                //             $("#pageloader").fadeOut();
                                //             if (obj.error == 0) {
                                //                 Swal.fire({
                                //                     icon: 'success',
                                //                     text: output,
                                //                     timer: 3000

                                //                 })

                                //                 setTimeout(function() {
                                //                     window.location.href = 'device_management.php?page=5';
                                //                     // $("#stopDeviceList").load(window.location.href + " brand_registration.php#stopDeviceList");
                                //                 }, 1000);


                                //             } else {

                                //                 Swal.fire({
                                //                     icon: 'error',
                                //                     text: output,
                                //                     timer: 3000

                                //                 })

                                //             }
                                //         },
                                //         error: function() {}

                                //     });
                                // } else {
                                //     Swal.fire({
                                //         icon: 'error',
                                //         text: 'machine not responding',
                                //         timer: 3000

                                //     })
                                // }

                            }
                        });

                    }
                });

                //}
             }));
        });

    $('#pills-home-tab').on('click', function(e){
         
                   // clearForm($("#stopDevice"));
                   // clearForm($("#startDevice")); 
        
                   $("#stopDevice").find(':input').val(''); 
                   $("#startDevice").find(':input').val(''); 
                 

                });
     $('#pills-update-tab').on('click', function(e){
          
         $("#assigndevice").find(':input').val('');
         $("#stopDevice").find(':input').val(''); 
         $("#startDevice").find(':input').val(''); 
       

      });
      $('#pills-profile-tab').on('click', function(e){
         
         $("#assigndevice").find(':input').val('');
         $("#stopDevice").find(':input').val(''); 
         $("#startDevice").find(':input').val(''); 
       

      });
      $('#pills-start-tab').on('click', function(e){

         $("#stopDevice").find(':input').val(''); 
         $("#assigndevice").find(':input').val(''); 
       
      });
      $('#pills-stop-tab').on('click', function(e){

         $("#assigndevice").find(':input').val('');
         $("#startDevice").find(':input').val(''); 
       

      });

    </script>
</body>

</html>