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


    <main id="main" class="main">

        <?php
        //print_r($_GET);exit;
        if (!empty($_REQUEST['page'])) {

            $page = $_REQUEST['page'];

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
                $status2 = $status3 = $status4 = $status5 = '';
                $area1 = 'true';
                $area2 = $area3 = $area4 = $area5 = 'false';
            }
        } else {
            $status1 = 'active';
            $area1 = 'true';
        }
        ?>
        <div class="pagetitle">
            <h1>TCP Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item ">TCP</li>
                    <li class="breadcrumb-item active">TCP Management</li>

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
                            <button class="nav-link <?php echo $status1; ?>" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="<?php echo $area1; ?>">Assign TCP Device</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $status2; ?>" id="pills-update-tab" data-bs-toggle="pill" data-bs-target="#pills-update" type="button" role="tab" aria-controls="pills-update" aria-selected="<?php echo $area2; ?>">Update TCP Device List</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $status3; ?>" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="<?php echo $area3; ?>">Remove TCP Device List</button>
                        </li>

                        <!-- <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $status4; ?>" id="pills-start-tab" data-bs-toggle="pill" data-bs-target="#pills-start" type="button" role="tab" aria-controls="pills-start" aria-selected="<?php echo $area4; ?>">Start Device</button>
                            <script>
                                $("#startDevice").load(location.href + " #startDevice");
                            </script>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $status5; ?>" id="pills-stop-tab" data-bs-toggle="pill" data-bs-target="#pills-stop" type="button" role="tab" aria-controls="pills-stop" aria-selected="<?php echo $area5; ?>">Stop Device</button>
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
                                                <select class="form-select" id="tcp_machineid" name="tcp_machineid" aria-label="State">
                                                    <option value=""></option>
                                                    <?php
                                                    $imei =  gettcpoptions();

                                                    //print_r($imei);exit;
                                                    foreach ($imei as $machine) {
                                                    ?>
                                                        <option value="<?php echo  $machine['id']; ?>"><?php echo  $machine['imei']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingSelect">TCP Machine</label>
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


                                        <table id="devicelist_TCP" class='display dataTable' style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Action</th>
                                                    <th scope="col">Machine Number</th>
                                                    <th scope="col">Machine type</th>
                                                    <th scope="col">Brand</th>
                                                    <th scope="col">User</th>
                                                    <th scope="col">Store</th>
                                                    <th scope="col">Country</th>
                                                    <th scope="col">State</th>
                                                    <th scope="col">City</th>
                                                    <th scope="col">Pincode</th>

                                                    <th scope="col">User Number</th>
                                                    <th scope="col">User Email</th>



                                                </tr>
                                            </thead>
                                            <tbody>




                                            </tbody>
                                        </table>



                                    </div>
                                </div>

                            </div>


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
                                                                <input type="text" class="form-control" id="userview" name="userview" aria-label="user" readonly />


                                                                <label for="floatingSelect">User Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" id="storeview" name="storeview" aria-label="store" readonly />



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

                                                        <div class="text-center">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">CLOSE</button>

                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="tab-pane fade" id="bordered-storeedit" role="tabpanel" aria-labelledby="storeedit-tab">
                                                    <form class="row g-3" id="updateDevice_TCP">

                                                        <div class="col-md-4">
                                                            <div class="form-floating mb-3">
                                                                <select class="form-select" id="machineidedit" name="machineid" aria-label="State">

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

                                                    <form class="row g-3" id="removeDevice_TCP">
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
                                                                <input type="text" class="form-control" id="branddelete" name="brandedit" aria-label="brand" readonly />

                                                                <label for="floatingSelect">Brand</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" id="userdelete" name="userdelete" aria-label="user" readonly />


                                                                <label for="floatingSelect">User Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" id="storedelete" name="storedelete" aria-label="store" readonly />



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
                        <div class="tab-pane fade show <?php echo $status2; ?>" id="pills-update" role="tabpanel" aria-labelledby="update-tab">

                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-body" style="overflow-x:auto;">
                                        <h5 class="card-title">Update Machine List</h5>


                                        <table id="updateDeviceList">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Machine Number</th>
                                                    <th scope="col">Brand</th>
                                                    <th scope="col">User</th>
                                                    <th scope="col">Store</th>
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



                                            </tbody>
                                        </table>
                                        <!-- End Table with stripped rows -->

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade show <?php echo $status3; ?>" id="pills-profile" role="tabpanel" aria-labelledby="profile-tab">

                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-body" style="overflow-x:auto;">
                                        <h5 class="card-title">Remove  Machine List</h5>


                                        <table id="removeDeviceList">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Machine Number</th>
                                                    <th scope="col">Brand</th>
                                                    <th scope="col">User</th>
                                                    <th scope="col">Store</th>
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



                                            </tbody>
                                        </table>
                                        <!-- End Table with stripped rows -->

                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
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
    <script>
        $(document).ready(function() {
            $('#tcp_machineid').on('change', function() {


                $.ajax({
                    url: "tcpmodel/get_tcpmachines.php",
                    type: "POST",
                    data: {
                        id: this.value
                    },
                    cache: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        var string1 = obj.error;
                        var output = obj.error_msg;

                        if (obj.error == 0) {

                            // console.log(output['tcp_machine_type']);

                            $("#machinetype").val(output['tcp_machine_type']);



                        } else {

                            Swal.fire({
                                icon: 'error',
                                text: output,
                                timer: 1500

                            })

                        }
                    }
                });
            });
        });




        $(document).ready(function(e) {
            $("#assigndevice").on('submit', (function(e) {
                e.preventDefault();
                // $('#loader-icon').show();
                //var valid;  
                //valid = validateContact();
                //if(valid) {
                console.log("Heloo");
                $.ajax({
                    url: "tcpmodel/assign_tcp_device.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(res) {
                        var obj = jQuery.parseJSON(res);
                        //console.log(obj);
                        var output = obj.error_msg;

                        if (obj.error == 0) {

                            Swal.fire({
                                icon: 'success',
                                text: output,
                                timer: 3500

                            })
                            //alert(obj.error_msg);

                            //$("#brandlist1").load(" #brandlist1 > *");
                            //$("#brandlist1").load(window.location.href + " #brandlist1");
                            setTimeout(function() {
                                window.location.href = 'TCPManagement.php';
                                //$('#borderedTabJustified a[href=#bordered-justified-contact]').tab('show');


                            }, 2000);


                            // $("#storelist").load(" #storelist > *");
                            //$("#bordered-justified-contact").load(window.location.href + " #bordered-justified-contact");

                        } else if (obj.error == 3) {
                            Swal.fire({
                                icon: 'error',
                                text: output,
                                timer: 3500,
                                //    loadlink();
                            })






                        } else {
                            //$(".content").html(popup());
                            //alert(obj.error_msg);
                            // window.location.href = '../admin/add_product.php';
                            //$('#login_for_review').html(output).modal('show');
                            //BootstrapDialog.alert(output);
                            Swal.fire({
                                icon: 'error',
                                text: output,
                                timer: 1500

                            })
                            //$("#brandlist1").load(window.location.href + " #brandlist1");
                            //$("#brandlist1").load(" #brandlist1 > *");
                        }

                    },
                    error: function() {}

                });
                //}
            }));
        });

        $(document).ready(function() {
            $('#devicelist_TCP').DataTable({
                'processing': true,
                'serverSide': true,
                'destroy': true,
                'searching': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': 'tables/DeviceList_tcp.php',

                },
                'columns': [

                    {
                        data: 'slno'
                    },
                    {
                        data: 'action'
                    },
                    {
                        data: 'machinenumber'
                    },
                    {
                        data: 'machinetype'
                    },
                    {
                        data: 'brand'
                    },
                    {
                        data: 'user'
                    },
                    {
                        data: 'store'
                    },
                    {
                        data: 'country'
                    },
                    {
                        data: 'state'
                    },
                    {
                        data: 'city'
                    },
                    {
                        data: 'pincode'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'email'
                    },
                ],


            });

        });



        $(document).ready(function() {
            $('#updateDeviceList').DataTable({
                'processing': true,
                'serverSide': true,
                'destroy': true,
                'searching': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': 'tables/updateDeviceList_TCP.php',

                },
                'columns': [

                    {
                        data: 'slno'
                    },

                    {
                        data: 'machinenumber'
                    },
                    {
                        data: 'machinetype'
                    },
                    {
                        data: 'brand'
                    },
                    {
                        data: 'user'
                    },
                    {
                        data: 'store'
                    },
                    {
                        data: 'country'
                    },
                    {
                        data: 'state'
                    },
                    {
                        data: 'city'
                    },
                    {
                        data: 'pincode'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'reason'
                    },
                    {
                        data: 'person'
                    },
                    {
                        data: 'time'
                    },
                ],


            });

        });

        $(document).ready(function() {
            $('#removeDeviceList').DataTable({
                'processing': true,
                'serverSide': true,
                'destroy': true,
                'searching': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': 'tables/removeDeviceList_TCP.php',

                },
                'columns': [

                    {
                        data: 'slno'
                    },

                    {
                        data: 'machinenumber'
                    },
                    {
                        data: 'machinetype'
                    },
                    {
                        data: 'brand'
                    },
                    {
                        data: 'user'
                    },
                    {
                        data: 'store'
                    },
                    {
                        data: 'country'
                    },
                    {
                        data: 'state'
                    },
                    {
                        data: 'city'
                    },
                    {
                        data: 'pincode'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'reason'
                    },
                    {
                        data: 'person'
                    },
                    {
                        data: 'time'
                    },
                ],


            });

        });

        function viewmodel(mid) {


            ///console.log(mid);
            $.ajax({
                url: "model/getAssignedDevicesNew_tcp.php",
                type: "POST",
                data: {
                    id: mid
                },
                cache: false,
                success: function(result) {

                    var obj = jQuery.parseJSON(result);
                    console.log(obj);
                    $("#verticalycentered1").modal("show");
                    //console.log(obj['Assign_id']);

                    $('#machineidedit').html('<option value="' + obj['id'] + '" selected>' + obj['machineid'] + '</option>');
                    //$("#machineidedit").val(obj['id']);
                    $("#machinetypeedit").val(obj['type']);
                    $("#brandedit").val(obj['bid']);
                    var brand_id = obj['bid'];
                    var userid = obj['uid'];
                    var storeid = obj['sid'];

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
                    var country_id = obj['countryid'];
                    var state_id = obj['stateid'];
                    var city_id = obj['cityid'];
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


                    $("#machineidview").val(obj['machineid']);
                    $("#machinetypeview").val(obj['type']);
                    $("#brandview").val(obj['brand']);
                    $("#storeview").val(obj['store']);
                    $("#userview").val(obj['user']);
                    $("#cityview").val(obj['cityname']);
                    $("#stateview").val(obj['statename']);
                    $("#countryview").val(obj['countryname']);
                    $("#memailview").val(obj['email']);
                    $("#mphoneview").val(obj['phone']);
                    $("#pincodeview").val(obj['pincode']);

                    $("#machineiddelete").val(obj['id']);
                    $("#machineidnamedelete").val(obj['machineid']);
                    $("#machinetypedelete").val(obj['type']);
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


        $(document).ready(function() {
            $('#machineid').on('change', function() {


                $.ajax({
                    url: "model/getProductType.php",
                    type: "POST",
                    data: {
                        id: this.value
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
            });
        });

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




        // $(document).ready(function(e) {
        //     $("#assigndevice").on('submit', (function(e) {
        //         e.preventDefault();

        //         $.ajax({
        //             url: "tcpmodel/assign_tcp_device.php",
        //             type: "POST",
        //             data: new FormData(this),
        //             contentType: false,
        //             cache: false,
        //             processData: false,
        //             success: function(data) {
        //                 var obj = jQuery.parseJSON(data);
        //                 var string1 = obj.error;
        //                 var output = obj.error_msg;

        //                 if (obj.error == 0) {
        //                     Swal.fire({
        //                         icon: 'success',
        //                         text: output,
        //                         timer: 1500

        //                     })

        //                     setTimeout(function() {
        //                         window.location.href = 'device_management.php?page=1';
        //                     }, 2000);


        //                 } else {

        //                     Swal.fire({
        //                         icon: 'error',
        //                         text: output,
        //                         timer: 1500

        //                     })

        //                 }
        //             },
        //             error: function() {}

        //         });
        //         //}
        //     }));
        // });

        $(document).ready(function(e) {
            $("#updateDevice_TCP").on('submit', (function(e) {
                e.preventDefault();

                $.ajax({
                    url: "model/update_device_TCP.php",
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
                                window.location.href = 'TCPManagement.php?page=2';
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
            $("#removeDevice_TCP").on('submit', (function(e) {
                e.preventDefault();

                $.ajax({
                    url: "model/remove_device_TCP.php",
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
                                // window.location.href = 'TCPManagement.php?page=2';
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

                    }
                });



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
    </script>

</body>

</html>