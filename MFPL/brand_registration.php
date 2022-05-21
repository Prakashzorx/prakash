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
    </style>
</head>

<body>

    <?php include "header.php"; ?>
    <!-- ======= Sidebar ======= -->
    <?php include "sidebar.php"; ?>
    <?php require_once "controller/functions.php"; ?>

    <main id="main" class="main">
        <?php
        //print_r($_GET);exit;
        if (!empty($_REQUEST['page'])) {

            $page = $_REQUEST['page'];

            // if ($page == 5) {

            //     $status5 = 'active';
            //     $area5 = 'true';
            // } else if ($page == 4) {

            //     $status4 = 'active';
            //     $area4 = 'true';
            // } else if ($page == 3) {

            //     $status3 = 'active';
            //     $area3 = 'true';
            // } else 
            if ($page == 2) {

                $status2 = 'active';
                $area2 = 'true';
            } else if ($page == 1) {

                $status1 = 'active';
                $area1 = 'true';
            } else {
                $status1 = 'active';
                $status2 = '';
                $area1 == 'true';
                $area2 = 'false';
            }
        } else {
            $status1 = 'active';
            $area1 = 'true';
        }
        ?>
        <div class="pagetitle">
            <h1>Brand Registration</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Brand Registration</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"></h5>

                    <!-- Bordered Tabs Justified -->
                    <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 <?php echo $status1; ?>" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home" aria-selected="<?php echo $area1; ?>">Brand</button>
                        </li>
                        <!-- <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Contact Person</button>
                        </li> -->
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 <?php echo $status2; ?>" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="<?php echo $area2; ?>">Store</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                        <div class="tab-pane fade show <?php echo $status1; ?>" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Add Brand</h5>

                                        <form class="row g-3 " autocomplete="off" id="brand" action="">

                                            <div class="col-md-6">
                                                <div class="form-floating autocomplete">

                                                    <input id="brandname" class="form-control" type="text" name="brandname" placeholder="Brand" required />

                                                    <!-- <input type="text" class="form-control" id="myInput"  name="myCountry" placeholder="Your Name"> -->
                                                    <label for="floatingName">Brand</label>
                                                    <!-- <div class="invalid-feedback">
                                                        Please provide a Brand Name
                                                    </div> -->

                                                </div>
                                                <span id="brandname_check"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" name="outlets" aria-label="State" id="outlets" required>
                                                        <option selected></option>
                                                        <option value="1 - 5">1 - 5</option>
                                                        <option value="6 - 15">6 - 15</option>
                                                        <option value="16 - 50">16 - 50</option>
                                                        <option value="50 - 100">50 - 100</option>
                                                        <option value="100 above">100 above</option>
                                                    </select>
                                                    <label for="floatingName">No. of outlests</label>
                                                </div>

                                            </div>
                                            <h6>Head Office Details</h6>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="address" name="address" placeholder="Your Name" autocomplete="off" required />
                                                    <label for="floatingName">Address</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" id="pincode" name="pincode" placeholder="PINCODE" required>
                                                    <label for="floatingName">PINCODE</label>
                                                    <span id="message"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3">

                                                    <select class="form-select" id="country" name="country" aria-label="country" required>
                                                        <option></option>
                                                        <option value="101">India</option>
                                                        <?php

                                                        $result = getCountries();
                                                        foreach ($result as $row) {
                                                            //print_r($result);
                                                        ?>
                                                            <option value="<?php echo $row['id']; ?>"><?php echo $row["name"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="floatingSelect">Country</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3">

                                                    <select class="form-select" id="state" name="state" aria-label="State" required>

                                                    </select>
                                                    <label for="state">State</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3">

                                                    <select class="form-select" id="city" name="city" aria-label="city" required>


                                                    </select>
                                                    <label for="city">City</label>
                                                </div>
                                            </div>
                                            <h6>Contact Details</h6>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="personname" name="personname" placeholder="Your Name" required>
                                                    <label for="personname">Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="designation" name="designation" placeholder="PINCODE" required>
                                                    <label for="designation">Designation</label>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-2">
                                                <div class="form-floating mb-3">

                                                    <select class="form-select" id="phonecode" name="phonecode" aria-label="" required>
                                                            

                                                    </select>
                                                    <label for="city">Conutry Code</label>
                                                </div>
                                            </div> -->
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" id="phone" name="phone" maxlength="10" pattern="[6-9]{1}[0-9]{9}" placeholder="phone" required>
                                                    <label for="phone">Contact Number</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="PINCODE" required>
                                                    <label for="email">Email Id</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="password" name="password" placeholder="password" required>
                                                    <label for="password">Password</label>
                                                </div>
                                            </div>

                                            <div id="display_error"></div>

                                            <div class="text-center">
                                                <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-secondary"><a href="brand_registration.php" style="color:white">Reset</a></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Brands List</h5>

                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="brand-tab" data-bs-toggle="tab" data-bs-target="#bordered-brand" type="button" role="tab" aria-controls="brandtab" aria-selected="true">Brands</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="update-tab" data-bs-toggle="tab" data-bs-target="#bordered-update" type="button" role="tab" aria-controls="updatetab" aria-selected="false">Updates</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="delete-tab" data-bs-toggle="tab" data-bs-target="#bordered-delete" type="button" role="tab" aria-controls="deletetab" aria-selected="false">Delete</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content pt-2" id="borderedTabContent">
                                        <div class="tab-pane fade show active" id="bordered-brand" role="tabpanel" aria-labelledby="brand-tab">
                                            <div class="col-lg-12">

                                                <div class="card">
                                                    <div class="card-body" style="overflow-x:auto;">
                                                        <h5 class="card-title"></h5>


                                                        <!-- Table with stripped rows -->
                                                        <table id="brandlist" class="table datatable display nowrap" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Action</th>
                                                                    <th scope="col">Brand Name</th>
                                                                    <th scope="col">No. of outlets</th>
                                                                    <th scope="col">Address</th>
                                                                    <th scope="col">City</th>
                                                                    <th scope="col">State</th>
                                                                    <th scope="col">Country</th>
                                                                    <th scope="col">Pincode</th>
                                                                    <th scope="col">Person Name</th>
                                                                    <th scope="col">Designation</th>
                                                                    <th scope="col">Phone</th>
                                                                    <th scope="col">Email</th>
											  <th scope="col">Created_Timestamp</th>

                                                                    <th style="display:none"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="brandlist1">
                                                                <?php
                                                                $result = getBrands();
                                                                $i = 0;
                                                                //print_r($result);
                                                                foreach ($result as $row) {
                                                                    $i++;
                                                                    // print_r($row);

											  $timezone = new DateTimeZone('Asia/Kolkata');

                                                                    $date = new DateTime($row['timestamp']);
                                                                    $date->setTimeZone($timezone);
                                                                    $time = $date->format('D d M Y g:i:s A') . "\n";


                                                                    $countryname = getCountriesById($row['country']);
                                                                    $statename = getStatesById($row['state']);
                                                                    $cityname = getCityById($row['city']);
                                                                    //print_r($countryname['name']);
                                                                ?>

                                                                    <tr data-bs-toggle="modal" data-bs-target="#verticalycentered1">
                                                                        <th scope="row"><?php echo $i; ?></th>
                                                                        <td><button type="submit" class="btn btn-success" onclick="viewmodel(<?php echo $row['id'];
                                                                                                                                                ?>)"><i class="far fa-edit"></i></button></td>
                                                                        <td><?php echo $row['brand_name']; ?></td>
                                                                        <td><?php echo $row['outlets']; ?></td>

                                                                        <td><?php echo $row['address']; ?></td>
                                                                        <td><?php echo $cityname['name']; ?></td>
                                                                        <td><?php echo $statename['name']; ?></td>
                                                                        <td><?php echo $countryname['name']; ?></td>
                                                                        <td><?php echo $row['pincode']; ?></td>
                                                                        <td><?php echo $row['bp_name']; ?></td>

                                                                        <td><?php echo $row['bp_designation']; ?></td>
                                                                        <td><?php echo $row['bp_phone']; ?></td>
                                                                        <td><?php echo $row['bp_email']; ?></td>
												<td><?php echo $time; ?></td>

                                                                        <td style="display:none"><?php echo $row['id']; ?></td>
                                                                        <td style="display:none"><?php echo $row['country']; ?></td>
                                                                        <td style="display:none"><?php echo $row['state']; ?></td>
                                                                        <td style="display:none"><?php echo $row['city']; ?></td>



                                                                    </tr>



                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                        <!-- End Table with stripped rows -->

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="bordered-update" role="tabpanel" aria-labelledby="update-tab">
                                            <div class="col-lg-12">

                                                <div class="card" style="overflow-x:auto;">
                                                    <div class="card-body" style="overflow-x:auto;">
                                                        <h5 class="card-title"></h5>


                                                        <!-- Table with stripped rows -->
                                                        <table id="brandlist" class="table datatable display nowrap" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Brand Name</th>
                                                                    <th scope="col">No. of outlets</th>
                                                                    <th scope="col">Address</th>
                                                                    <th scope="col">City</th>
                                                                    <th scope="col">State</th>
                                                                    <th scope="col">Country</th>
                                                                    <th scope="col">Pincode</th>
                                                                    <th scope="col">Person Name</th>
                                                                    <th scope="col">Designation</th>
                                                                    <th scope="col">Phone</th>
                                                                    <th scope="col">Email</th>
                                                                    <th scope="col">Reason</th>
                                                                    <th scope="col">Update by</th>
											  <th scope="col">Updated_Timestamp</th>

                                                                    <th style="display:none"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="brandlist1">
                                                                <?php
                                                                $result = getBrandUpdates();
                                                                $i = 0;
                                                                //print_r($result);
                                                                foreach ($result as $row) {
                                                                    if ($row['record'] == 1) {
                                                                        $i++;
												$timezone = new DateTimeZone('Asia/Kolkata');

                                                                        $date = new DateTime($row['timestamp']);
                                                                        $date->setTimeZone($timezone);
                                                                        $time = $date->format('D d M Y g:i:s A') . "\n";

                                                                        // print_r($row);
                                                                        $countryname = getCountriesById($row['country']);
                                                                        $statename = getStatesById($row['state']);
                                                                        $cityname = getCityById($row['city']);
                                                                        //print_r($countryname['name']);
                                                                ?>

                                                                        <tr data-bs-toggle="modal" data-bs-target="#verticalycentered1">
                                                                            <th scope="row"><?php echo $i; ?></th>
                                                                            <td><?php echo $row['brand_name']; ?></td>
                                                                            <td><?php echo $row['outlets']; ?></td>

                                                                            <td><?php echo $row['address']; ?></td>
                                                                            <td><?php echo $cityname['name']; ?></td>
                                                                            <td><?php echo $statename['name']; ?></td>
                                                                            <td><?php echo $countryname['name']; ?></td>
                                                                            <td><?php echo $row['pincode']; ?></td>
                                                                            <td><?php echo $row['bp_name']; ?></td>

                                                                            <td><?php echo $row['bp_designation']; ?></td>
                                                                            <td><?php echo $row['bp_phone']; ?></td>
                                                                            <td><?php echo $row['bp_email']; ?></td>
                                                                            <td><?php echo $row['reason']; ?></td>
                                                                            <td><?php echo $row['updateby']; ?></td>
												    <td><?php echo $time; ?></td>

                                                                            <td style="display:none"><?php echo $row['id']; ?></td>
                                                                            <td style="display:none"><?php echo $row['country']; ?></td>
                                                                            <td style="display:none"><?php echo $row['state']; ?></td>
                                                                            <td style="display:none"><?php echo $row['city']; ?></td>



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
                                        <div class="tab-pane fade" id="bordered-delete" role="tabpanel" aria-labelledby="delete-tab">
                                            <div class="col-lg-12">

                                                <div class="card" style="overflow-x:auto;">
                                                    <div class="card-body" style="overflow-x:auto;">
                                                        <h5 class="card-title"></h5>


                                                        <!-- Table with stripped rows -->
                                                        <table id="brandlist" class="table datatable display nowrap" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Brand Name</th>
                                                                    <th scope="col">No. of outlets</th>
                                                                    <th scope="col">Address</th>
                                                                    <th scope="col">City</th>
                                                                    <th scope="col">State</th>
                                                                    <th scope="col">Country</th>
                                                                    <th scope="col">Pincode</th>
                                                                    <th scope="col">Person Name</th>
                                                                    <th scope="col">Designation</th>
                                                                    <th scope="col">Phone</th>
                                                                    <th scope="col">Email</th>
                                                                    <th scope="col">Reason</th>
                                                                    <th scope="col">Removed by</th>
 											  <th scope="col">Removed_Timestamp</th>

                                                                    <th style="display:none"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="brandlist1">
                                                                <?php
                                                                $result = getBrandUpdates();
                                                                $i = 0;
                                                                //print_r($result);
                                                                foreach ($result as $row) {
                                                                    if ($row['record'] == 2) {
                                                                        $i++;
											 	$timezone = new DateTimeZone('Asia/Kolkata');

                                                                        $date = new DateTime($row['timestamp']);
                                                                        $date->setTimeZone($timezone);
                                                                        $time = $date->format('D d M Y g:i:s A') . "\n";



                                                                        // print_r($row);
                                                                        $countryname = getCountriesById($row['country']);
                                                                        $statename = getStatesById($row['state']);
                                                                        $cityname = getCityById($row['city']);
                                                                        //print_r($countryname['name']);
                                                                ?>

                                                                        <tr data-bs-toggle="modal" data-bs-target="#verticalycentered1">
                                                                            <th scope="row"><?php echo $i; ?></th>
                                                                            <td><?php echo $row['brand_name']; ?></td>
                                                                            <td><?php echo $row['outlets']; ?></td>

                                                                            <td><?php echo $row['address']; ?></td>
                                                                            <td><?php echo $cityname['name']; ?></td>
                                                                            <td><?php echo $statename['name']; ?></td>
                                                                            <td><?php echo $countryname['name']; ?></td>
                                                                            <td><?php echo $row['pincode']; ?></td>
                                                                            <td><?php echo $row['bp_name']; ?></td>

                                                                            <td><?php echo $row['bp_designation']; ?></td>
                                                                            <td><?php echo $row['bp_phone']; ?></td>
                                                                            <td><?php echo $row['bp_email']; ?></td>
                                                                            <td><?php echo $row['reason']; ?></td>
                                                                            <td><?php echo $row['updateby']; ?></td>
												    <td><?php echo $time; ?></td>

                                                                            <td style="display:none"><?php echo $row['id']; ?></td>
                                                                            <td style="display:none"><?php echo $row['country']; ?></td>
                                                                            <td style="display:none"><?php echo $row['state']; ?></td>
                                                                            <td style="display:none"><?php echo $row['city']; ?></td>



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
                                    </div><!-- End Bordered Tabs -->

                                </div>
                            </div>

                        </div>
                        <!-- Vertically centered Modal -->
                        <!-- <a style="color:blue;" data-bs-toggle="modal" data-bs-target="#verticalycentered1">
                            <?php //echo $row['brand_name']; 
                            ?>
                        </a> -->

                        <div class="modal hide fade" id="verticalycentered1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Brand Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">


                                        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">View</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Edit</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Delete</button>
                                            </li>
                                        </ul>
                                        <div class="tab-content pt-2" id="borderedTabContent">
                                            <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                                                <?php
                                                //$single_brand = getBrand($id);
                                                //print_r($single_brand);
                                                ?>

                                                <form class="row g-3 needs-validation" autocomplete="off" novalidate>

                                                    <div class="col-md-6">
                                                        <div class="form-floating autocomplete">

                                                            <input id="brandname1" class="form-control" type="text" name="brandname" placeholder="Brand" readonly />

                                                            <label for="floatingName">Brand</label>
                                                            <div class="invalid-feedback">
                                                                Please provide a Brand Name
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" id="outlets1" name="outlets" placeholder="Your Name" autocomplete="off" readonly />
                                                            <label for="floatingName">No. of outlests</label>
                                                        </div>
                                                    </div>
                                                    <h6>Head Office Details</h6>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="address1" name="address" placeholder="Your Name" autocomplete="off" readonly />
                                                            <label for="floatingName">Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control" id="pincode1" name="pincode" placeholder="PINCODE" maxlength="6" min="100000" max="999999" readonly>
                                                            <label for="floatingName">PINCODE</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating mb-3">

                                                            <select class="form-select" id="country1" name="country" aria-label="country" required>

                                                            </select>
                                                            <label for="floatingSelect">Country</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating mb-3">

                                                            <select class="form-select" id="state1" name="state" aria-label="State" required>

                                                            </select>
                                                            <label for="state">State</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating mb-3">

                                                            <select class="form-select" id="city1" name="city" aria-label="city" required>


                                                            </select>
                                                            <label for="city">City</label>
                                                        </div>
                                                    </div>
                                                    <h6> Contact Details</h6>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="personname1" name="personname" placeholder="" readonly>
                                                            <label for="personname">Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="designation1" name="designation" placeholder="" readonly>
                                                            <label for="designation">Designation</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control" id="phone1" name="phone" placeholder="phone" readonly>
                                                            <label for="phone">Contact Number</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="email" class="form-control" id="email1" name="email" placeholder="" readonly>
                                                            <label for="email">Email Id</label>
                                                        </div>
                                                    </div>
									<div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="password1" name="password" placeholder="password" readonly>
                                                            <label for="password">Password</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="hidden" class="form-control" id="id1" name="id" placeholder="id" readonly>
                                                            <!-- <label for="email">Email Id</label> -->
                                                        </div>
                                                    </div>



                                                    <div class="text-center">
                                                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Close</button>


                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                                                <?php
                                                //$single_brand = getBrand($row['id']);
                                                //print_r($single_brand);
                                                ?>

                                                <form class="row g-3 needs-validation" autocomplete="off" id="brandedit" action="" novalidate>
                                                    <input id="id2" class="form-control" type="hidden" name="id" required />
                                                    <div class="col-md-6">
                                                        <div class="form-floating autocomplete">

                                                            <input id="brandname2" class="form-control" type="text" name="brandname" placeholder="Brand" required />

                                                            <!-- <input type="text" class="form-control" id="myInput"  name="myCountry" placeholder="Your Name"> -->
                                                            <label for="floatingName">Brand</label>
                                                            <div class="invalid-feedback">
                                                                Please provide a Brand Name
                                                            </div>
                                                            <span id="brandname_check"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3">
                                                            <!-- <input type="text" class="form-control" id="outlets" name="outlets" placeholder="Your Name" value="<?php echo $single_brand['outlets']; ?>" autocomplete="off" required /> -->
                                                            <select class="form-select" name="outlets" aria-label="State" id="outlets2" required>
                                                                <option value="" selected></option>
                                                                <option value="1 - 5">1 - 5</option>
                                                                <option value="6 - 15">6 - 15</option>
                                                                <option value="16 - 50">16 - 50</option>
                                                                <option value="50 - 100">50 - 100</option>
                                                                <option value="100 above">100 above</option>
                                                            </select>
                                                            <label for="floatingName">No. of outlests</label>
                                                        </div>
                                                    </div>
                                                    <h6>your Head Office Details</h6>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="address2" name="address" placeholder="Your Name" autocomplete="off" required />
                                                            <label for="floatingName">Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control" id="pincode2" name="pincode" placeholder="PINCODE" required>
                                                            <label for="floatingName">PINCODE</label>
                                                            <span id="message2"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating mb-3">

                                                            <select class="form-select" id="country2" name="country" aria-label="country" required>



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
                                                            <label for="floatingSelect">Country</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-floating mb-3">

                                                            <select class="form-select" id="state2" name="state" aria-label="State" required>

                                                            </select>
                                                            <label for="state">State</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating mb-3">

                                                            <select class="form-select" id="city2" name="city" aria-label="city" required>


                                                            </select>
                                                            <label for="city">City</label>
                                                        </div>
                                                    </div>
                                                    <h6> your Head Office Person Details</h6>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="personname2" name="personname" placeholder="Your Name" required>
                                                            <label for="personname">Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="designation2" name="designation" placeholder="PINCODE" required>
                                                            <label for="designation">Designation</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control" id="phone2" name="phone" placeholder="phone" maxlength="10" min="6000000000" max="9999999999" required>
                                                            <label for="phone">Contact Number</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="email" class="form-control" id="email2" name="email" placeholder="PINCODE" required>
                                                            <label for="email">Email Id</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="password2" name="password" placeholder="password" required>
                                                            <label for="password">Password</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="reason1" name="reason" placeholder="Mac Id">
                                                            <label for="floatingEmail">Reason to update</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="updateby1" name="updateby" placeholder="Mac Id">
                                                            <label for="floatingEmail">Updating by</label>
                                                        </div>
                                                    </div>



                                                    <div class="text-center">
                                                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>


                                                    </div>
                                                </form>

                                            </div>
                                            <div class="tab-pane fade" id="bordered-contact" role="tabpanel" aria-labelledby="contact-tab">

                                                <form class="row g-3 needs-validation" autocomplete="off" id="branddelete" action="" novalidate>
                                                    <input id="id3" class="form-control" type="hidden" name="id" required />
                                                    <div class="col-md-6">
                                                        <div class="form-floating autocomplete">

                                                            <input id="brandname3" class="form-control" type="text" name="brandname" placeholder="Brand" readonly />

                                                            <!-- <input type="text" class="form-control" id="myInput"  name="myCountry" placeholder="Your Name"> -->
                                                            <label for="floatingName">Brand</label>

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
                                                            <input type="text" class="form-control" id="removeby" name="removeby" placeholder="Mac Id">
                                                            <label for="floatingEmail">Removing by</label>
                                                        </div>
                                                    </div>




                                                    <div class="text-center">
                                                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Delete</button>


                                                    </div>
                                                </form>

                                            </div>
                                        </div><!-- End Bordered Tabs -->

                                        <!-- </div>
                                                                            </div> -->




                                    </div>

                                </div>
                            </div>
                        </div><!-- End Vertically centered Modal-->

                        <div class="tab-pane fade show <?php echo $status2; ?>" id="bordered-justified-contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Add Store</h5>
                                        <form class="row g-3 " autocomplete="off" id="store" action="" novalidate>

                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" id="storebrandid" name="storebrandid" aria-label="State">
                                                        <option value="" selected></option>
                                                        <?php
                                                        $brands = getBrands();
                                                        $i = 0;
                                                        //print_r($result);
                                                        foreach ($brands as $row) {
                                                            $i++;

                                                            // print_r($row);
                                                        ?>
                                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['brand_name']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="floatingSelect">Brand</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" id="storename" name="storename" class="form-control" autocomplete="off" placeholder="" required>
                                                    <label for="floatingName">Store Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" id="storeperson" name="storeperson" class="form-control" placeholder="Your Name" required>
                                                    <label for="floatingName">Person Name</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" id="storecontact" name="storecontact" placeholder="Your Name" required>
                                                    <label for="floatingName">Contact Number</label>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating mb-3">

                                                    <select class="form-select" id="storecountry" name="country" aria-label="country" required>

                                                        <option value=""></option>

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
                                                    <label for="floatingSelect">Country</label>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-floating mb-3">

                                                    <select class="form-select" id="storestate" name="state" aria-label="State" required>

                                                    </select>
                                                    <label for="state">State</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating mb-3">

                                                    <select class="form-select" id="storecity" name="city" aria-label="city" required>


                                                    </select>
                                                    <label for="city">City</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" id="storepincode" name="pincode" placeholder="PINCODE" required>
                                                    <label for="floatingName">PINCODE</label>
                                                    <span id="storemessage"></span>
                                                </div>
                                            </div>



                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary" id="storesubmit">Submit</button>
                                                <button type="reset" class="btn btn-secondary">Reset</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Stores List</h5>

                                        <!-- Bordered Tabs -->
                                        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="storebrand-tab" data-bs-toggle="tab" data-bs-target="#bordered-storebrand" type="button" role="tab" aria-controls="storebrandtab" aria-selected="true">Stores List</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="storeupdate-tab" data-bs-toggle="tab" data-bs-target="#bordered-storeupdate" type="button" role="tab" aria-controls="storeupdatetab" aria-selected="false">Updates List</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="storedelete-tab" data-bs-toggle="tab" data-bs-target="#bordered-storedelete" type="button" role="tab" aria-controls="storedeletetab" aria-selected="false">Delete List</button>
                                            </li>
                                        </ul>
                                        <div class="tab-content pt-2" id="borderedTabContent">
                                            <div class="tab-pane fade show active" id="bordered-storebrand" role="tabpanel" aria-labelledby="storebrand-tab">
                                                <div class="col-lg-12">

                                                    <div class="card">
                                                        <div class="card-body" style="overflow-x:auto;">
                                                            <h5 class="card-title"></h5>


                                                            <!-- Table with stripped rows -->
                                                            <table class="table datatable" id="storelist">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">#</th>
                                                                        <th scope="col">Action</th>
                                                                        <th scope="col">Brand Name</th>
                                                                        <th scope="col">Store Name</th>
                                                                        <th scope="col">Person Name</th>

                                                                        <th scope="col">Phone</th>
                                                                        <th style="display:none"></th>
                                                                        <th style="display:none"></th>
                                                                        <th scope="col">Country</th>
                                                                        <th scope="col">state</th>
                                                                        <th scope="col">city</th>
  												<th scope="col">Created_Timestamp</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $stores = getStores();
                                                                    //print_r($stores);
                                                                    $y = 0;
                                                                    foreach ($stores as $store) {
                                                                        $y++;
 												$timezone = new DateTimeZone('Asia/Kolkata');

                                                                        $date = new DateTime($store['timestamp']);
                                                                        $date->setTimeZone($timezone);
                                                                        $time = $date->format('D d M Y g:i:s A') . "\n";

                                                                        $countryname = getCountriesById($store['country']);
                                                                        $statename = getStatesById($store['state']);
                                                                        $cityname = getCityById($store['city']);
                                                                    ?>
                                                                        <tr>
                                                                            <th scope="row"><?php echo $y; ?></th>
                                                                            <td><button type="submit" class="btn btn-success" onclick="viewstore(<?php echo $store['id'];
                                                                                                                                                    ?>)"><i class="far fa-edit"></i></button></td>
                                                                            <td><?php $brandname = getBrand($store['brand_id']);
                                                                                echo $brandname['brand_name']; ?></td>
                                                                            <td><?php echo $store['store_name']; ?></td>
                                                                            <td><?php echo $store['p_name']; ?></td>

                                                                            <!-- <td>Manager</td> -->
                                                                            <td><?php echo $store['p_phone']; ?></td>
                                                                            <td style="display:none"><?php echo $store['brand_id']; ?></td>
                                                                            <td style="display:none"><?php echo $store['id']; ?></td>
                                                                            <td style="display:none"><?php echo $store['country']; ?></td>
                                                                            <td style="display:none"><?php echo $store['state']; ?></td>
                                                                            <td style="display:none"><?php echo $store['city']; ?></td>
                                                                            <td style="display:none"><?php echo $store['pincode']; ?></td>
                                                                            <td><?php echo $countryname['name']; ?></td>
                                                                            <td><?php echo $statename['name']; ?></td>
                                                                            <td><?php echo $cityname['name']; ?></td>
 												    <td><?php echo $time; ?></td>

                                                                            <!-- <td>bapukhatavi@gmail.com</td> -->
                                                                            <!-- <td><i class="bi bi-pencil"></i></td>
                                                        <td><i class="bi bi-trash"></i></td> -->

                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                    ?>



                                                                </tbody>
                                                            </table>
                                                            <!-- End Table with stripped rows -->

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="bordered-storeupdate" role="tabpanel" aria-labelledby="storeupdate-tab">
                                                <div class="col-lg-12">

                                                    <div class="card">
                                                        <div class="card-body" style="overflow-x:auto;">
                                                            <h5 class="card-title">Store List</h5>


                                                            <!-- Table with stripped rows -->
                                                            <table class="table datatable" id="storelist">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">#</th>
                                                                        <th scope="col">Brand Name</th>
                                                                        <th scope="col">Store Name</th>
                                                                        <th scope="col">Person Name</th>

                                                                        <th scope="col">Phone</th>

                                                                        <th scope="col">Country</th>
                                                                        <th scope="col">state</th>
                                                                        <th scope="col">city</th>
                                                                        <th scope="col">pincode</th>
                                                                        <th scope="col">reason</th>
                                                                        <th scope="col">Updated by</th>
												<th scope="col">Updated_Timestamp</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $stores = getStoresUpdates();
                                                                    //print_r($stores);
                                                                    $y = 0;
                                                                    foreach ($stores as $store) {
                                                                        if ($store['record'] == 1) {


                                                                            $y++;
												    $timezone = new DateTimeZone('Asia/Kolkata');

                                                                            $date = new DateTime($store['timestamp']);
                                                                            $date->setTimeZone($timezone);
                                                                            $time = $date->format('D d M Y g:i:s A') . "\n";


                                                                            $countryname = getCountriesById($store['country']);
                                                                            $statename = getStatesById($store['state']);
                                                                            $cityname = getCityById($store['city']);
                                                                    ?>
                                                                            <tr>
                                                                                <th scope="row"><?php echo $y; ?></th>
                                                                                <td><?php $brandname = getBrand($store['brand_id']);
                                                                                    echo $brandname['brand_name']; ?></td>
                                                                                <td><?php echo $store['store_name']; ?></td>
                                                                                <td><?php echo $store['p_name']; ?></td>

                                                                                <!-- <td>Manager</td> -->
                                                                                <td><?php echo $store['p_phone']; ?></td>




                                                                                <td><?php echo $countryname['name']; ?></td>
                                                                                <td><?php echo $statename['name']; ?></td>
                                                                                <td><?php echo $cityname['name']; ?></td>
                                                                                <td><?php echo $store['pincode']; ?></td>
                                                                                <td><?php echo $store['reason']; ?></td>
                                                                                <td><?php echo $store['updateby']; ?></td>
 													  <td><?php echo $time; ?></td>
                                                                                <!-- <td>bapukhatavi@gmail.com</td> -->
                                                                                <!-- <td><i class="bi bi-pencil"></i></td>
                                                        <td><i class="bi bi-trash"></i></td> -->

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
                                            <div class="tab-pane fade" id="bordered-storedelete" role="tabpanel" aria-labelledby="storedelete-tab">
                                                <div class="col-lg-12">

                                                    <div class="card">
                                                        <div class="card-body" style="overflow-x:auto;">
                                                            <h5 class="card-title">Delete List</h5>


                                                            <!-- Table with stripped rows -->
                                                            <table class="table datatable" id="storelist">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">#</th>
                                                                        <th scope="col">Brand Name</th>
                                                                        <th scope="col">Store Name</th>
                                                                        <th scope="col">Person Name</th>

                                                                        <th scope="col">Phone</th>

                                                                        <th scope="col">Country</th>
                                                                        <th scope="col">state</th>
                                                                        <th scope="col">city</th>
                                                                        <th scope="col">pincode</th>
                                                                        <th scope="col">reason</th>
                                                                        <th scope="col">Removed by</th>
                                                                        <th scope="col">Removed_Timestamp</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $stores = getStoresUpdates();
                                                                    //print_r($stores);
                                                                    $y = 0;
                                                                    foreach ($stores as $store) {
                                                                        if ($store['record'] == 2) {


                                                                            $y++;

												    $timezone = new DateTimeZone('Asia/Kolkata');

                                                                            $date = new DateTime($store['timestamp']);
                                                                            $date->setTimeZone($timezone);
                                                                            $time = $date->format('D d M Y g:i:s A') . "\n";



                                                                            $countryname = getCountriesById($store['country']);
                                                                            $statename = getStatesById($store['state']);
                                                                            $cityname = getCityById($store['city']);
                                                                    ?>
                                                                            <tr>
                                                                                <th scope="row"><?php echo $y; ?></th>
                                                                                <td><?php $brandname = getBrand($store['brand_id']);
                                                                                    echo $brandname['brand_name']; ?></td>
                                                                                <td><?php echo $store['store_name']; ?></td>
                                                                                <td><?php echo $store['p_name']; ?></td>

                                                                                <!-- <td>Manager</td> -->
                                                                                <td><?php echo $store['p_phone']; ?></td>




                                                                                <td><?php echo $countryname['name']; ?></td>
                                                                                <td><?php echo $statename['name']; ?></td>
                                                                                <td><?php echo $cityname['name']; ?></td>
                                                                                <td><?php echo $store['pincode']; ?></td>
                                                                                <td><?php echo $store['reason']; ?></td>
                                                                                <td><?php echo $store['updateby']; ?></td>
 													  <td><?php echo $time; ?></td>
                                                                                <!-- <td>bapukhatavi@gmail.com</td> -->
                                                                                <!-- <td><i class="bi bi-pencil"></i></td>
    <td><i class="bi bi-trash"></i></td> -->

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
                                        </div><!-- End Bordered Tabs -->

                                    </div>
                                </div>


                            </div>

                            <div class="modal hide fade" id="verticalycentered2" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Store Details</h5>
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
                                                    <button class="nav-link" id="storedelete1-tab" data-bs-toggle="tab" data-bs-target="#bordered-storedelete1" type="button" role="tab" aria-controls="storedelete1" aria-selected="false">Delete</button>
                                                </li>
                                            </ul>
                                            <div class="tab-content pt-2" id="borderedTabContent">
                                                <div class="tab-pane fade show active" id="bordered-storehome" role="tabpanel" aria-labelledby="storehome-tab">
                                                    <?php
                                                    //$single_brand = getBrand($id);
                                                    //print_r($single_brand);
                                                    ?>

                                                    <form class="row g-3 needs-validation" autocomplete="off" novalidate>
                                                        <input id="id1" class="form-control" type="hidden" name="id" required />
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3">
                                                                <select class="form-select" id="storebrandid1" name="storebrandid" aria-label="State">

                                                                </select>
                                                                <label for="floatingSelect">Brand</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating">
                                                                <input type="text" id="storename1" name="storename" class="form-control" autocomplete="off" placeholder="PINCODE" readonly>
                                                                <label for="floatingName">Store Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating">
                                                                <input type="text" id="storeperson1" name="storeperson" class="form-control" placeholder="Your Name" readonly>
                                                                <label for="floatingName">Person Name</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control" id="storecontact1" name="storecontact" placeholder="Your Name" readonly>
                                                                <label for="floatingName">Contact Number</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb-3">

                                                                <select class="form-select" id="storecountry1" name="country" aria-label="country">

                                                                </select>
                                                                <label for="floatingSelect">Country</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb-3">

                                                                <select class="form-select" id="storestate1" name="state" aria-label="State">

                                                                </select>
                                                                <label for="state">State</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb-3">

                                                                <select class="form-select" id="storecity1" name="city" aria-label="city">

                                                                </select>
                                                                <label for="city">City</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control" id="storepincode1" name="pincode" placeholder="PINCODE" maxlength="6" min="100000" max="999999" readonly>
                                                                <label for="floatingName">PINCODE</label>
                                                            </div>
                                                        </div>




                                                        <div class="text-center">
                                                            <button type="submit" id="submit" name="submit" class="btn btn-primary">Close</button>


                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="tab-pane fade" id="bordered-storeedit" role="tabpanel" aria-labelledby="storeedit-tab">
                                                    <?php
                                                    //$single_brand = getBrand($row['id']);
                                                    //print_r($single_brand);
                                                    ?>

                                                    <form class="row g-3 needs-validation" autocomplete="off" id="storeedit" action="" novalidate>
                                                        <input id="idstore" class="form-control" type="hidden" name="id" required />
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3">
                                                                <select class="form-select" id="storebrandid2" name="storebrandid" aria-label="State" required>
                                                                    <?php
                                                                    $brands = getBrands();
                                                                    $i = 0;
                                                                    //print_r($result);
                                                                    foreach ($brands as $row) {
                                                                        $i++;

                                                                        //print_r($row);
                                                                    ?>
                                                                        <option value="<?php echo $row['id']; ?>" selected><?php echo $row['brand_name']; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <label for="floatingSelect">Brand</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating">
                                                                <input type="text" id="storename2" name="storename" class="form-control" autocomplete="off" placeholder="PINCODE" required>
                                                                <label for="floatingName">Store Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating">
                                                                <input type="text" id="storeperson2" name="storeperson" class="form-control" placeholder="Your Name" required>
                                                                <label for="floatingName">Person Name</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" id="storecontact2" name="storecontact" placeholder="Your Name" required>
                                                                <label for="floatingName">Contact Number</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-floating mb-3">

                                                                <select class="form-select" id="storecountry2" name="country" aria-label="country" required>

                                                                    <option value=""></option>

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
                                                                <label for="floatingSelect">Country</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-floating mb-3">

                                                                <select class="form-select" id="storestate2" name="state" aria-label="State" required>
                                                                    <option value=""></option>


                                                                </select>
                                                                <label for="state">State</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-floating mb-3">

                                                                <select class="form-select" id="storecity2" name="city" aria-label="city" required>


                                                                </select>
                                                                <label for="city">City</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control" id="storepincode2" name="pincode" placeholder="PINCODE" maxlength="6" min="100000" max="999999" required>
                                                                <label for="floatingName">PINCODE</label>
                                                                <span id="storemessage2"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" id="storereason2" name="reason" placeholder="Mac Id">
                                                                <label for="floatingEmail">Reason to Update</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" id="storeupdateby2" name="updateby" placeholder="Mac Id">
                                                                <label for="floatingEmail">Updating by</label>
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                            <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>


                                                        </div>
                                                    </form>

                                                </div>
                                                <div class="tab-pane fade" id="bordered-storedelete1" role="tabpanel" aria-labelledby="storedelete1-tab">

                                                    <form class="row g-3 needs-validation" autocomplete="off" id="storedelete" action="" novalidate>
                                                        <input id="idstoredelete" class="form-control" type="hidden" name="id" required />
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3">
                                                                <select class="form-select" id="storebrandid3" name="storebrandid" aria-label="city" required>


                                                                </select>
                                                                <label for="floatingSelect">Brand</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating">
                                                                <input type="text" id="storename3" name="storename" class="form-control" autocomplete="off" placeholder="PINCODE" readonly>
                                                                <label for="floatingName">Store Name</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" id="storereason" name="reason" placeholder="Mac Id">
                                                                <label for="floatingEmail">Reason to Remove</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" id="storeremoveby" name="removeby" placeholder="Mac Id">
                                                                <label for="floatingEmail">Romoving by</label>
                                                            </div>
                                                        </div>





                                                        <div class="text-center">
                                                            <button type="submit" id="submit" name="submit" class="btn btn-primary">Delete</button>


                                                        </div>
                                                    </form>

                                                </div>
                                            </div><!-- End Bordered Tabs -->

                                            <!-- </div>
                                                                            </div> -->




                                        </div>

                                    </div>
                                </div>
                            </div><!-- End Vertically centered Modal-->
                        </div>
                    </div><!-- End Bordered Tabs Justified -->

                </div>
            </div>



        </section>

    </main><!-- End #main -->

    <?php include "footer.php"; ?>


    <script type="text/javascript">


$(document).ready(function (){
    //$('#submit').attr('disabled', true);
    validate1();
    $('#brandname, #outlets, #address,#pincode,#country,#state,#city,#personname,#designation,#phone,#email,#password').change(validate1);

});

function validate1(){
    if ($('#brandname').val().length   >   0   &&
        $('#outlets').val().length  >   0   &&
        $('#address').val().length  >   0   &&
        $('#pincode').val().length  >=   5   &&
        $('#country').val().length  >   0   &&
        $('#state').val().length  >   0   &&
        $('#city').val().length  >   0   &&
        $('#personname').val().length  >   0   &&
        $('#designation').val().length  >   0   &&
        $('#phone').val().length  >   9   &&
        $('#email').val().length  >   0   &&
        $('#password').val().length    >   5) {
        $("#submit").prop("disabled", false);
    }
    else {
        $("#submit").prop("disabled", true);
    }
}

$(document).ready(function (){
    //$('#submit').attr('disabled', true);
    validatestore();
    $('#storebrandid, #storename, #storeperson,#storecontact,#storecountry,#storestate,#storecity,#storepincode').change(validatestore);
});

function validatestore(){
    if ($('#storebrandid').val().length   >   0   &&
        $('#storename').val().length  >   0   &&
        $('#storeperson').val().length  >   0   &&
        $('#storecontact').val().length  >   9   &&
        $('#storecountry').val().length  >   0   &&
        $('#storestate').val().length  >   0   &&
        $('#storecity').val().length  >   0   &&
        $('#storepincode').val().length    >=   5) {
        $("#storesubmit").prop("disabled", false);
    }
    else {
        $("#storesubmit").prop("disabled", true);
    }
}

        $(document).ready(function(e) {
            $("#brand").on('submit', (function(e) {
                e.preventDefault();
                // $('#loader-icon').show();
                //var valid;  
                //valid = validateContact();
                //if(valid) {
                $.ajax({
                    url: "model/add_brand.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        var string1 = obj.error;
                        var output = obj.error_msg;
                        //console.log(obj.error);
                        if (obj.error == 0) {
                            Swal.fire({
                                icon: 'success',
                                text: output,
                                timer: 1500

                            })
                            //alert(obj.error_msg);
                            // window.location.href = '../admin/add_product.php?display=1';
                            setTimeout(function() {
                                window.location.href = 'brand_registration.php?page=1';
                            }, 1000);




                        } else {

                            if (obj.error == 3) {
                                //$("#display_error").html("<p style='color:red'>"+output+"</p>");
                                Swal.fire({
                                    icon: 'error',
                                    text: output,
                                    timer: 1500

                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    text: output,
                                    timer: 1500

                                })
                            }

                            //alert(obj.error_msg);
                            // window.location.href = '../admin/add_product.php';
                            //$('#login_for_review').html(output).modal('show');
                            //BootstrapDialog.alert(output);
                            //swal(output);
                            //$("#brandlist1").load(window.location.href + " #brandlist1");
                            // setTimeout(function() {
                            //     window.location.href = 'brand_registration.php';
                            // }, 2000);

                        }
                    },
                    error: function() {}

                });
                //}
            }));
        });

        $(document).ready(function(e) {
            $("#brandedit").on('submit', (function(e) {
                e.preventDefault();
                // $('#loader-icon').show();
                //var valid;  
                //valid = validateContact();
                //if(valid) {
                $.ajax({
                    url: "model/edit_brand.php",
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
                            //alert(obj.error_msg);
                            //window.location.href = 'brand_registration.php';
                            //$("#brandlist1").load(" #brandlist1 > *");
                            //$("#brandlist1").load(window.location.href + " #brandlist1");
                            setTimeout(function() {
                                window.location.href = 'brand_registration.php?page=1';
                            }, 2000);



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



        $(document).ready(function(e) {
            $("#branddelete").on('submit', (function(e) {
                e.preventDefault();
                // $('#loader-icon').show();
                //var valid;  
                //valid = validateContact();
                //if(valid) {
                $.ajax({
                    url: "model/delete_brand.php",
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
                                timer: 2500

                            })

                            setTimeout(function() {
                                window.location.href = 'brand_registration.php?page=1';
                            }, 2000);


                        } else {

                            Swal.fire({
                                icon: 'error',
                                text: output,
                                timer: 2500

                            })

                        }
                    },
                    error: function() {}

                });
                //}
            }));
        });

        $(document).ready(function(e) {
            $("#store").on('submit', (function(e) {
                e.preventDefault();
                // $('#loader-icon').show();
                //var valid;  
                //valid = validateContact();
                //if(valid) {
                $.ajax({
                    url: "model/add_store.php",
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
                                window.location.href = 'brand_registration.php?page=2';
                                //$("#storelist").load(window.location.href + " #storelist");
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
            $("#storeedit").on('submit', (function(e) {
                e.preventDefault();
                // $('#loader-icon').show();
                //var valid;  
                //valid = validateContact();
                //if(valid) {
                $.ajax({
                    url: "model/edit_store.php",
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
                            //alert(obj.error_msg);

                            //$("#brandlist1").load(" #brandlist1 > *");
                            //$("#brandlist1").load(window.location.href + " #brandlist1");
                            setTimeout(function() {
                                window.location.href = 'brand_registration.php?page=2';
                                //$('#borderedTabJustified a[href=#bordered-justified-contact]').tab('show');


                            }, 2000);


                            // $("#storelist").load(" #storelist > *");
                            //$("#bordered-justified-contact").load(window.location.href + " #bordered-justified-contact");




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



        $(document).ready(function(e) {
            $("#storedelete").on('submit', (function(e) {
                e.preventDefault();
                // $('#loader-icon').show();
                //var valid;  
                //valid = validateContact();
                //if(valid) {
                $.ajax({
                    url: "model/delete_store.php",
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
                                timer: 2500

                            })

                            setTimeout(function() {
                                window.location.href = 'brand_registration.php?page=2';
                                //$("#storelist").load(window.location.href + " #storelist");
                                //$(window).scrollTop($('#storelist').offset().top);
                                // gototab(reload) {
                                //window.location.reload(true);
                                //window.location.hash = '#contact-tab';
                                //window.location.reload(true);
                                //$('home-tab').removeClass('active').attr(area-selected,false);;

                                // $('#contact-tab').addClass('active').attr(area-selected,true);
                                //
                                // }
                            }, 2000);


                        } else {

                            Swal.fire({
                                icon: 'error',
                                text: output,
                                timer: 2500

                            })
                        }
                    },
                    error: function() {}

                });
                //}
            }));
        });



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
                        //$('#city').html('<option value="">Select State First</option>');
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
            $('#country1').on('change', function() {
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
                        $("#state1").html(result);
                        //  $('#city1').html('<option value="">Select State First</option>');
                    }
                });
            });
            $('#state1').on('change', function() {
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
                        $("#city1").html(result);
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#country2').on('change', function() {
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
                        $("#state2").html(result);
                        // $('#city2').html('<option value="">Select State First</option>');
                    }
                });
            });
            $('#state2').on('change', function() {
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
                        $("#city2").html(result);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#storecountry').on('change', function() {
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
                        $("#storestate").html(result);
                        $('#storecity').html('<option value=""></option>');
                    }
                });
            });
            $('#storestate').on('change', function() {
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
                        $("#storecity").html(result);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#storecountry2').on('change', function() {
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
                        $("#storestate2").html(result);
                        $('#storecity2').html('<option value=""></option>');
                    }
                });
            });
            $('#storestate2').on('change', function() {
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
                        $("#storecity2").html(result);
                    }
                });
            });
        });



        $('#brandname').on('keydown, keyup', function() {
            //get a reference to the text input value
            var texInputValue = $('#brandname').val();

            //show the text input value in the UI
            // $('#message p span').html(texInputValue);
            $.ajax({
                url: "brandname_check.php",
                type: "POST",
                data: {
                    brandname: texInputValue
                },
                cache: false,
                success: function(result) {
                    //console.log(result);
                    if (result == 1) {
                        $("#brandname_check").html('<p style="color:red">Brand Name exists</p>');
                    } else {

                        $("#brandname_check").html('<p style="color:green"></p>');
                    }


                }
            });
        });

        $("#pincode").keydown(function(event) {
            k = event.which;
            var mobile = document.getElementById('pincode');


            var message = document.getElementById('message');

            var goodColor = "#0C6";
            var badColor = "#FF9B37";
            var gc = "#FFFFFF";
            if (mobile.value != 0) {
                if (mobile.value.length != 6) {

                    mobile.style.backgroundColor = gc;
                    message.style.color = badColor;
                    message.innerHTML = "  ";

                } else {


                    mobile.style.backgroundColor = gc;
                    message.style.color = goodColor;
                    message.innerHTML = "    ";

                    if (k == 8) {
                        return true;
                    } else {

                        event.preventDefault();
                        return false;

                    }
                }
            } else {
                mobile.style.backgroundColor = gc;
                message.style.color = badColor;
                message.innerHTML = " Enter Correct PINCODE  ";

            }


        });

        $("#phone").keydown(function(event) {
            k = event.which;
            // console.log(k);

            if ($(this).val().length == 10) {
                if (k == 8) {
                    return true;
                } else {
                    event.preventDefault();
                    return false;

                }
            }


        });
        $("#pincode2").keydown(function(event) {
            k = event.which;
            var mobile = document.getElementById('pincode2');


            var message = document.getElementById('message2');

            var goodColor = "#0C6";
            var badColor = "#FF9B37";
            var gc = "#FFFFFF";
            if (mobile.value != 0) {
                if (mobile.value.length != 6) {

                    mobile.style.backgroundColor = gc;
                    message.style.color = badColor;
                    message.innerHTML = "  ";

                } else {


                    mobile.style.backgroundColor = gc;
                    message.style.color = goodColor;
                    message.innerHTML = "    ";

                    if (k == 8) {
                        return true;
                    } else {

                        event.preventDefault();
                        return false;

                    }
                }
            } else {
                mobile.style.backgroundColor = gc;
                message.style.color = badColor;
                message.innerHTML = " Enter Correct PINCODE  ";

            }


        });

        $("#phone2").keydown(function(event) {
            k = event.which;
            // console.log(k);

            if ($(this).val().length == 10) {
                if (k == 8) {
                    return true;
                } else {
                    event.preventDefault();
                    return false;

                }
            }


        });

        $("#storepincode").keydown(function(event) {
            k = event.which;
            var mobile = document.getElementById('storepincode');


            var message = document.getElementById('storemessage');

            var goodColor = "#0C6";
            var badColor = "#FF9B37";
            var gc = "#FFFFFF";
            if (mobile.value != 0) {
                if (mobile.value.length != 6) {

                    mobile.style.backgroundColor = gc;
                    message.style.color = badColor;
                    message.innerHTML = "  ";

                } else {


                    mobile.style.backgroundColor = gc;
                    message.style.color = goodColor;
                    message.innerHTML = "    ";

                    if (k == 8) {
                        return true;
                    } else {

                        event.preventDefault();
                        return false;

                    }
                }
            } else {
                mobile.style.backgroundColor = gc;
                message.style.color = badColor;
                message.innerHTML = " Enter Correct PINCODE  ";

            }


        });

        $("#storecontact").keydown(function(event) {
            k = event.which;
            // console.log(k);

            if ($(this).val().length == 10) {
                if (k == 8) {
                    return true;
                } else {
                    event.preventDefault();
                    return false;

                }
            }


        });

        $("#storepincode2").keydown(function(event) {
            k = event.which;
            var mobile = document.getElementById('storepincode2');


            var message = document.getElementById('storemessage2');

            var goodColor = "#0C6";
            var badColor = "#FF9B37";
            var gc = "#FFFFFF";
            if (mobile.value != 0) {
                if (mobile.value.length != 6) {

                    mobile.style.backgroundColor = gc;
                    message.style.color = badColor;
                    message.innerHTML = "  ";

                } else {


                    mobile.style.backgroundColor = gc;
                    message.style.color = goodColor;
                    message.innerHTML = "    ";

                    if (k == 8) {
                        return true;
                    } else {

                        event.preventDefault();
                        return false;

                    }
                }
            } else {
                mobile.style.backgroundColor = gc;
                message.style.color = badColor;
                message.innerHTML = " Enter Correct PINCODE  ";

            }


        });

        $("#storecontact2").keydown(function(event) {
            k = event.which;
            // console.log(k);

            if ($(this).val().length == 10) {
                if (k == 8) {
                    return true;
                } else {
                    event.preventDefault();
                    return false;

                }
            }


        });
    </script>

    <script>
        // $(' #storelist tr  td').on('click', function() {
        //     $("#verticalycentered2").modal("show");
        //     $("#storebrandname1").val($(this).closest('tr').children()[1].textContent);
        //     $("#storename1").val($(this).closest('tr').children()[2].textContent);
        //     $("#storeperson1").val($(this).closest('tr').children()[3].textContent);

        //     $("#storecontact1").val($(this).closest('tr').children()[4].textContent);

        //     $("#storebrandid1").val($(this).closest('tr').children()[5].textContent);
        //     $("#storecountry1").val($(this).closest('tr').children()[11].textContent);
        //     $("#storestate1").val($(this).closest('tr').children()[12].textContent);
        //     $("#storecity1").val($(this).closest('tr').children()[13].textContent);
        //     $("#storepincode1").val($(this).closest('tr').children()[10].textContent);


        //     $("#storebrandid2").val($(this).closest('tr').children()[1].textContent);
        //     $("#storename2").val($(this).closest('tr').children()[2].textContent);
        //     $("#storeperson2").val($(this).closest('tr').children()[3].textContent);

        //     $("#storecontact2").val($(this).closest('tr').children()[4].textContent);

        //     $("#storebrandid2").val($(this).closest('tr').children()[5].textContent);
        //     $("#idstore").val($(this).closest('tr').children()[6].textContent);
        //     var country_id = $(this).closest('tr').children()[7].textContent;
        //     var state_id = $(this).closest('tr').children()[8].textContent;
        //     var city_id = $(this).closest('tr').children()[9].textContent;
        //     $("#storecountry2").val(country_id);

        //     //$("#storecountry2").html("<option value="+country_id+" slected>"+$(this).closest('tr').children()[11].textContent+"</option>");
        //     //$("#storestate2").html("<option value="+state_id+" selected>"+$(this).closest('tr').children()[12].textContent+"</option>");
        //     //$("#storecity2").html("<option value="+city_id+" selected>"+$(this).closest('tr').children()[13].textContent+"</option>");
        //     $.ajax({
        //         url: "contry_state_city/states-by-country.php",
        //         type: "POST",
        //         data: {
        //             country_id: country_id
        //         },
        //         cache: false,
        //         success: function(result) {
        //             //console.log(result);
        //             $("#storestate2").html(result);
        //             $("#storestate2").val(state_id);


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
        //             $("#storecity2").html(result);
        //             $("#storecity2").val(city_id);
        //         }
        //     });



        //     $("#storepincode2").val($(this).closest('tr').children()[10].textContent);


        //     $("#storebrandname3").val($(this).closest('tr').children()[1].textContent);
        //     $("#storename3").val($(this).closest('tr').children()[2].textContent);
        //     $("#storebrandid3").val($(this).closest('tr').children()[5].textContent);
        //     $("#idstoredelete").val($(this).closest('tr').children()[6].textContent);
        //     //document.getElementById("country2").value = $(this).closest('tr').children()[6].textContent;
        // });


        $(document).ready(function() {
            $('#storebrandid').on('change', function() {
                $(this).closest('form').find('input[type=text], textarea,input[type=number]').val('');
                $('#storecountry').val('');
                $('#storestate').html('<option val=""></option>');
                $('#storecity').html('<option val=""></option>');

                //$('#store')[1].reset();
            });

        });

        function viewmodel(mid) {

            $.ajax({
                url: "model/getBrandDetails.php",
                type: "POST",
                data: {
                    id: mid
                },
                cache: false,
                success: function(result) {

                    var obj = jQuery.parseJSON(result);
                    //console.log(obj);
                    $("#verticalycentered1").modal("show");

                    $("#brandname1").val(obj['brandname']);
                    $("#outlets1").val(obj['outlets']);
                    $("#address1").val(obj['address']);
                    $("#country1").html('<option value="' + obj['country'] + '">' + obj['countryname'] + '</option>');
                    $("#state1").html('<option value="' + obj['state'] + '">' + obj['statename'] + '</option>');
                    $("#city1").html('<option value="' + obj['city'] + '">' + obj['cityname'] + '</option>');
                    $("#pincode1").val(obj['pincode']);
                    $("#personname1").val(obj['bp_name']);
                    $("#designation1").val(obj['bp_designation']);
                    $("#phone1").val(obj['bp_phone']);
                    $("#email1").val(obj['bp_email']);
                    $("#password1").val(obj['password']);
                    $("#id1").val(obj['id']);



                    $("#brandname2").val(obj['brandname']);
                    $("#outlets2").val(obj['outlets']);
                    $("#address2").val(obj['address']);
                    $("#country2").val(obj['country']);

                    var country_id = obj['country'];
                    var state_id = obj['state'];
                    var city_id = obj['city'];
                    $.ajax({
                        url: "contry_state_city/states-by-country.php",
                        type: "POST",
                        data: {
                            country_id: country_id
                        },
                        cache: false,
                        success: function(result) {
                            console.log(result);
                            $("#state2").html(result);
                            $("#state2").val(state_id);


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
                            $("#city2").html(result);
                            $("#city2").val(city_id);
                        }
                    });
                    $("#pincode2").val(obj['pincode']);
                    $("#personname2").val(obj['bp_name']);
                    $("#designation2").val(obj['bp_designation']);
                    $("#phone2").val(obj['bp_phone']);
                    $("#email2").val(obj['bp_email']);
                    $("#password2").val(obj['password']);
                    $("#id2").val(obj['id']);


                    $("#brandname3").val(obj['brandname']);
                    $("#id3").val(obj['id']);








                }

            });

        }

        function viewstore(mid) {

            $.ajax({
                url: "model/getStoreDetails.php",
                type: "POST",
                data: {
                    id: mid
                },
                cache: false,
                success: function(result) {

                    var obj = jQuery.parseJSON(result);
                    console.log(obj);
                    $("#verticalycentered2").modal("show");
                    var brand = obj['brandid'];
                    $.ajax({
                        url: "model/getBrandDetails.php",
                        type: "POST",
                        data: {
                            id: brand
                        },
                        cache: false,
                        success: function(result) {

                            var obj1 = jQuery.parseJSON(result);
                            //console.log(obj1);
                            $("#storebrandid1").html('<option value="' + obj['brandid'] + '">' + obj1['brandname'] + '</option>');
                            $("#storebrandid2").html('<option value="' + obj['brandid'] + '">' + obj1['brandname'] + '</option>');
                            $("#storebrandid3").html('<option value="' + obj['brandid'] + '">' + obj1['brandname'] + '</option>');
                        }
                    });

                    $("#storename1").val(obj['storename']);
                    $("#storeperson1").val(obj['p_name']);
                    $("#storecontact1").val(obj['p_phone']);
                    $("#storecountry1").html('<option value="' + obj['country'] + '">' + obj['countryname'] + '</option>');
                    $("#storestate1").html('<option value="' + obj['state'] + '">' + obj['statename'] + '</option>');
                    $("#storecity1").html('<option value="' + obj['city'] + '">' + obj['cityname'] + '</option>');
                    $("#storepincode1").val(obj['pincode']);


                    $("#idstore").val(obj['id']);
                    $("#storename2").val(obj['storename']);
                    $("#storeperson2").val(obj['p_name']);
                    $("#storecontact2").val(obj['p_phone']);
                    $("#storepincode2").val(obj['pincode']);
                    var country_id = obj['country'];
                    var state_id = obj['state'];
                    var city_id = obj['city'];
                    $("#storecountry2").val(country_id);
                    $.ajax({
                        url: "contry_state_city/states-by-country.php",
                        type: "POST",
                        data: {
                            country_id: country_id
                        },
                        cache: false,
                        success: function(result) {
                            //console.log(result);
                            $("#storestate2").html(result);
                            $("#storestate2").val(state_id);
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
                            $("#storecity2").html(result);
                            $("#storecity2").val(city_id);
                        }
                    });




                    $("#storename3").val(obj['storename']);

                    $("#idstoredelete").val(obj['id']);






                }

            });

        }
    </script>
</body>

</html>