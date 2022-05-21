<?php
require_once 'controller/functions.php';
//Start the session.
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "meta.php"; ?>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <style>
        input {
            /* for Firefox */
            -moz-appearance: none;
            /* for Safari, Chrome, Opera */
            -webkit-appearance: none;
        }
    </style>
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

    <main id="main" class="main">

        <!-- <br /> -->
        <div id='result'></div>
        <div class="pagetitle">
            <h1>User Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">User Management</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>

                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Users List</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Update List</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Removed List</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="borderedTabContent">
                            <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="col-lg-12">

                                    <div class="card" style="overflow-x:auto;">
                                        <div class="card-body">
                                            <br>
                                            <!-- Vertically centered Modal -->
                                            <button style="float:right" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                                                Add User
                                            </button>
                                            <div class="modal fade" id="verticalycentered" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Add User Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <!-- Floating Labels Form -->
                                                            <form class="row g-3 needs-validation" autocomplete="off" id="adduser" action="" novalidate>

                                                                <div class="col-md-12">
                                                                    <div class="form-floating mb-3" id="myDropdown">
                                                                        <!-- <input class="form-select" list="myInput" name="brandname" id="brandname"> -->

                                                                        <select class="form-select" aria-label="State" name="brandname" id="brandname" required>
                                                                            <option value=""></option>
                                                                            <?php
                                                                            $result = getBrands();
                                                                            $i = 0;
                                                                            //print_r($result);
                                                                            foreach ($result as $row) {
                                                                                $i++;
                                                                                //print_r($row);
                                                                                // $countryname = getCountriesById($row['country']);
                                                                                // $statename = getStatesById($row['state']);
                                                                                // $cityname = getCityById($row['city']);
                                                                                //print_r($countryname['name']);
                                                                            ?>
                                                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['brand_name']; ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                        <label for="myInput">Brand</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-floating">
                                                                        <input type="text" class="form-control" id="username" name="username" placeholder="User Name" required>
                                                                        <label for="floatingName">Name</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-floating">
                                                                        <input type="email" class="form-control" id="useremail" name="useremail" placeholder="User Email" required>
                                                                        <label for="floatingEmail">Email</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-floating">
                                                                        <input type="text" class="form-control" id="password" name="password" placeholder="User Password" minlength="6" required>
                                                                        <label for="floatingEmail">Password</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-floating">
                                                                        <input type="number" class="form-control" id="userphone" name="userrphone" min="6000000000" max="9999999999" placeholder="Phone" required>
                                                                        <label for="floatingEmail">Phone</label>
                                                                    </div>
                                                                </div>


                                                                <div class="text-center">
                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                                                </div>
                                                            </form><!-- End floating Labels Form -->



                                                        </div>


                                                    </div>
                                                </div>
                                            </div><!-- End Vertically centered Modal-->



                                            <h5 class="card-title">All Users list</h5>




                                            <table id="userlist" class=" table datatable" >
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Action</th>
                                                        <th scope="col">Brand Name</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Status</th>
                                                        <th style="display:none" scope="col">Country</th>
                                                        <th style="display:none" scope="col">State</th>
                                                        <th style="display:none" scope="col">City</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
									  <th scope="col">Created_Timestamp</th>
                                                        <th style="display:none"></th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $users = getUsers();
                                                    $i = 0;
                                                    foreach ($users as $row) {
                                                        $i++;


									  $timezone = new DateTimeZone('Asia/Kolkata');

                                                        $date = new DateTime($row['timestamp']);
                                                        $date->setTimeZone($timezone);
                                                        $time = $date->format('D d M Y g:i:s A') . "\n";

                                                        //print_r($users);exit;
                                                        $brandname = getBrand($row['brand']);
                                                        //print_r($brandname);
                                                        //$countryname = getCountriesById($row['country']);
                                                        //$statename = getStatesById($row['state']);
                                                        // $cityname = getCityById($row['city']);
                                                    ?>
                                                        <tr>
                                                            <th scope="row"><?php echo $i; ?></th>
                                                            <td><button type="submit" class="btn btn-success" onclick="viewmodel(<?php echo $row['user_id'];
                                                                                                                                    ?>)"><i class="far fa-edit"></i></button></td>

                                                            <td><?php echo $brandname['brand_name']; ?></td>

                                                            <td><?php echo $row['name']; ?></td>



                                                            <td><?php if ($row['sts'] == 0) {
                                                                    echo "active";
                                                                } else {
                                                                    echo "Inactive";
                                                                };
                                                                ?></td>
                                                            <td style="display:none"><?php //echo $countryname['name']; 
                                                                                        ?></td>
                                                            <td style="display:none"><?php //echo $statename['name']; 
                                                                                        ?></td>
                                                            <td style="display:none"><?php //echo $cityname['name']; 
                                                                                        ?></td>
                                                            <td><?php echo $row['email']; ?></td>
                                                            <td><?php echo $row['phone']; ?></td>
										<td><?php echo $time; ?></td>


                                                            <td style="display:none"><?php echo $row['brand']; ?></td>
                                                            <td style="display:none"><?php echo $row['user_id']; ?></td>
                                                            <td style="display:none"><?php echo $row['country']; ?></td>
                                                            <td style="display:none"><?php echo $row['state']; ?></td>
                                                            <td style="display:none"><?php echo $row['city']; ?></td>

                                                        </tr>
                                                    <?php
                                                    }

                                                    ?>


                                                </tbody>
                                            </table>

                                            <div class="modal fade" id="verticalycentered1" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title">User Details</h5>
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
                                                                    <form class="row g-3" id="viewuser" action="">
                                                                        <input type="hidden" class="form-control" id="userid2" name="userid" placeholder="User Name" readonly>
                                                                        <div class="col-md-12">
                                                                            <div class="form-floating mb-3" id="myDropdown">

                                                                                <select class="form-select" id="brandname2" name="brandname2" aria-label="brand">

                                                                                </select>

                                                                                <label for="myInput">Brand</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-floating">
                                                                                <input type="text" class="form-control" id="username2" name="username" placeholder="User Name" readonly>
                                                                                <label for="username1">User Name</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-floating">
                                                                                <input type="email" class="form-control" id="useremail2" name="useremail" placeholder="User Email" readonly>
                                                                                <label for="floatingEmail">User Email</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-floating">
                                                                                <input type="text" class="form-control" id="userphone2" name="userrphone" placeholder="Phone" readonly>
                                                                                <label for="floatingEmail">Phone</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-floating">
                                                                                <input type="text" class="form-control" id="userpassword2" name="userpassword" placeholder="Phone" readonly>
                                                                                <label for="floatingEmail">Password</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="text-center">
                                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">CLOSE</button>

                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="tab-pane fade" id="bordered-storeedit" role="tabpanel" aria-labelledby="storeedit-tab">


                                                                    <form class="row g-3" id="edituser" action="">
                                                                        <input type="hidden" class="form-control" id="userid1" name="userid" placeholder="User Name" required>
                                                                        <div class="col-md-12">
                                                                            <div class="form-floating mb-3" id="myDropdown">

                                                                                <select class="form-select" id="brandname1" name="brandid" aria-label="brand">
                                                                                    <option value="" selected></option>
                                                                                    <?php
                                                                                  //  $result = getBrands();
                                                                                  //  $i = 0;

                                                                                    //foreach ($result as $row) {
                                                                                       // $i++;
                                                                                    ?>
                                                                                     <!--   <option value="<?php // echo $row['id']; ?>"><?php // echo $row['brand_name']; ?></option>
                                                                                    <?php
                                                                                    //}
                                                                                    ?> -->
                                                                                </select>
                                                                                <label for="myInput">Brand</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-floating">
                                                                                <input type="text" class="form-control" id="username1" name="username" placeholder="User Name" required>
                                                                                <label for="username1">User Name</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-floating">
                                                                                <input type="email" class="form-control" id="useremail1" name="useremail" placeholder="User Email" required>
                                                                                <label for="floatingEmail">User Email</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-floating">
                                                                                <input type="text" class="form-control" id="userphone1" name="userrphone" placeholder="Phone" required>
                                                                                <label for="floatingEmail">Phone</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-floating">
                                                                                <input type="text" class="form-control" id="userpassword1" name="userpassword" placeholder="Phone" required>
                                                                                <label for="floatingEmail">Password</label>
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
                                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                                            <!-- <button type="reset" class="btn btn-secondary">Reset</button> -->
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="tab-pane fade" id="bordered-storedelete" role="tabpanel" aria-labelledby="storedelete-tab">

                                                                    <form class="row g-3" id="deleteuser" action="">
                                                                        <input type="hidden" class="form-control" id="userid3" name="userid" placeholder="User Name" readonly>
                                                                        <div class="col-md-12">
                                                                            <div class="form-floating mb-3" id="myDropdown">

                                                                                <select class="form-select" id="brandname3" name="brandid" aria-label="brand">

                                                                                </select>

                                                                                <label for="myInput">Brand</label>
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-12">
                                                                            <div class="form-floating">
                                                                                <input type="text" class="form-control" id="username3" name="username" placeholder="User Name" readonly>
                                                                                <label for="username1">User Name</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-floating">
                                                                                <input type="text" class="form-control" id="reason3" name="reason" placeholder="">
                                                                                <label for="floatingEmail">Reason to Remove</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-floating">
                                                                                <input type="text" class="form-control" id="personby3" name="person" placeholder="">
                                                                                <label for="floatingEmail">Removing By</label>
                                                                            </div>
                                                                        </div>


                                                                        <div class="text-center">
                                                                            <button type="submit" class="btn btn-primary">Submit</button>

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
                            <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="col-lg-12">

                                    <div class="card" style="overflow-x:auto;">
                                        <div class="card-body">

                                            <h5 class="card-title">Users Update Details</h5>
                                            <table id="userupdatelist2" class=" table datatable display nowrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Brand Name</th>
                                                        <th scope="col">Name</th>
                                                        <!-- <th scope="col">Status</th> -->

                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Password</th>
                                                        <th>Updated_By</th>
                                                        <th>Reason</th>
                                                        <th>Updated_Timestamp</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $users = getUpdatesUser();
                                                    //print_r($users);exit;
                                                    $i = 0;
                                                    foreach ($users as $row) {
                                                        

                                                        $brandname = getBrand($row['brand']);
                                                        //print_r($brandname['brand_name']);
                                                        //$countryname = getCountriesById($row['country']);
                                                        //$statename = getStatesById($row['state']);
                                                        // $cityname = getCityById($row['city']);
                                                        $timezone = new DateTimeZone('Asia/Kolkata');

                                                        $date = new DateTime($row['timestamp']);
                                                        $date->setTimeZone($timezone);
                                                        $time = $date->format('D d M Y g:i:s A') . "\n";
                                                        if ($row['value'] == 1) {
                                                            $i++;
                                                    ?>
                                                            <tr>
                                                                <th scope="row"><?php echo $i; ?></th>
                                                                <td><?php echo $brandname['brand_name']; ?></td>

                                                                <td><?php echo $row['user']; ?></td>




                                                                <td><?php echo $row['email']; ?></td>
                                                                <td><?php echo $row['phone']; ?></td>
                                                                <td><?php echo $row['password']; ?></td>

                                                                <td><?php echo $row['person_by']; ?></td>
                                                                <td><?php echo $row['reason']; ?></td>
                                                                <td><?php echo $time; ?></td>

                                                        <?php
                                                        }
                                                    }

                                                        ?>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bordered-contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="col-lg-12">

                                    <div class="card" style="overflow-x:auto;">
                                        <div class="card-body">

                                            <h5 class="card-title">Users Removed Details</h5>
                                            <table id="userupdatelist2" class=" table datatable display nowrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Brand Name</th>
                                                        <th scope="col">Name</th>
                                                        <!-- <th scope="col">Status</th> -->

                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Removed_By</th>
                                                        <th>Reason</th>
                                                        <th>Updated_Timestamp</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $users = getUpdatesUser();
                                                    //print_r($users);exit;
                                                    $i = 0;
                                                    foreach ($users as $row) {
                                                       

                                                        $brandname = getBrand($row['brand']);
                                                        //print_r($brandname['brand_name']);
                                                        //$countryname = getCountriesById($row['country']);
                                                        //$statename = getStatesById($row['state']);
                                                        // $cityname = getCityById($row['city']);
                                                        $timezone = new DateTimeZone('Asia/Kolkata');

                                                        $date = new DateTime($row['timestamp']);
                                                        $date->setTimeZone($timezone);
                                                        $time = $date->format('D d M Y g:i:s A') . "\n";
                                                        if ($row['value'] == 2) {
                                                            $i++;

                                                    ?>
                                                            <tr>
                                                                <th scope="row"><?php echo $i; ?></th>
                                                                <td><?php echo $brandname['brand_name']; ?></td>

                                                                <td><?php echo $row['user']; ?></td>



                                                                <td><?php echo $row['email']; ?></td>
                                                                <td><?php echo $row['phone']; ?></td>

                                                                <td><?php echo $row['person_by']; ?></td>
                                                                <td><?php echo $row['reason']; ?></td>
                                                                <td><?php echo $time; ?></td>

                                                        <?php
                                                        }
                                                    }


                                                        ?>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>








            </div>
        </section>
    </main>

    <?php include "footer.php"; ?>


    <script>
        // $(document).ready(function() {

        //     // Initialize select2
        //     $("#selUser").select2();

        //     // Read selected option
        //     $('#but_read').click(function() {
        //         var username = $('#selUser option:selected').text();
        //         var userid = $('#selUser').val();

        //         $('#result').html("id : " + userid + ", name : " + username);

        //     });
        // });


        $(document).ready(function(e) {
            $("#adduser").on('submit', (function(e) {
                e.preventDefault();
                // $('#loader-icon').show();
                //var valid;  
                //valid = validateContact();
                //if(valid) {
                $.ajax({
                    url: "model/add_user.php",
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

                            })
                            //alert(obj.error_msg);
                            //window.location.href = '../admin/add_product.php?display=1';

                            //$("#userlist").load(window.location.href + " #userlist");

                            setTimeout(function() {
                                window.location.href = 'user_management.php';
                                $("#userlist").load(window.location.href + " #userlist");
                            }, 2000);

                        } else {

                            if (obj.error == 3) {
                                //$("#display_error").html("<p style='color:red'>"+output+"</p>");
                                Swal.fire({
                                    icon: 'error',
                                    text: output,

                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    text: output,

                                })
                            }

                            //alert(obj.error_msg);
                            // window.location.href = '../admin/add_product.php';
                            //$('#login_for_review').html(output).modal('show');
                            //BootstrapDialog.alert(output);
                            //swal(output);
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
            $("#edituser").on('submit', (function(e) {
                e.preventDefault();
                // $('#loader-icon').show();
                //var valid;  
                //valid = validateContact();
                //if(valid) {
                $.ajax({
                    url: "model/edit_user.php",
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

                            })
                            //alert(obj.error_msg);
                            //window.location.href = '../admin/add_product.php?display=1';
                            setTimeout(function() {
                                window.location.href = 'user_management.php';
                                $("#userlist").load(window.location.href + " #userlist");
                            }, 2000);


                        } else {

                            if (obj.error == 3) {
                                //$("#display_error").html("<p style='color:red'>"+output+"</p>");
                                Swal.fire({
                                    icon: 'error',
                                    text: output,

                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    text: output,

                                })
                            }

                            //alert(obj.error_msg);
                            // window.location.href = '../admin/add_product.php';
                            //$('#login_for_review').html(output).modal('show');
                            //BootstrapDialog.alert(output);
                            //swal(output);
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
            $("#deleteuser").on('submit', (function(e) {
                e.preventDefault();
                // $('#loader-icon').show();
                //var valid;  
                //valid = validateContact();
                //if(valid) {
                $.ajax({
                    url: "model/delete_user.php",
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

                            })
                            //alert(obj.error_msg);
                            //window.location.href = '../admin/add_product.php?display=1';

                            setTimeout(function() {
                                window.location.href = 'user_management.php';
                                $("#userlist").load(window.location.href + " #userlist");
                            }, 2000);



                        } else {

                            if (obj.error == 3) {
                                Swal.fire({
                                    icon: 'error',
                                    text: output,

                                })
                                //$("#display_error").html("<p style='color:red'>"+output+"</p>");
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    text: output,

                                })
                            }

                            //alert(obj.error_msg);
                            // window.location.href = '../admin/add_product.php';
                            //$('#login_for_review').html(output).modal('show');
                            //BootstrapDialog.alert(output);
                            //swal(output);
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
                        //$('#city1').html('<option value="">Select State First</option>');
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

        // function viewmodel(uid) {
        //     ///console.log(mid);
        //     $.ajax({
        //         url: "model/getUserDetails.php",
        //         type: "POST",
        //         data: {
        //             id: mid
        //         },
        //         cache: false,
        //         success: function(result) {

        //             var obj = jQuery.parseJSON(result);
        //         }
        //     });
        // }


        // $(' #userlist tr  td').on('click', function() {

        //     $("#brandname1").val($(this).closest('tr').children()[1].textContent);
        //     $("#username1").val($(this).closest('tr').children()[2].textContent);
        //     //$("#user_id").val($(this).closest('tr').children()[3].textContent);
        //     $("#country1").val($(this).closest('tr').children()[11].textContent);
        //     $("#state1").val($(this).closest('tr').children()[12].textContent);
        //     $("#city1").val($(this).closest('tr').children()[13].textContent);
        //     $("#useremail1").val($(this).closest('tr').children()[7].textContent);
        //     $("#userphone1").val($(this).closest('tr').children()[8].textContent);
        //     $("#brandid1").val($(this).closest('tr').children()[9].textContent);
        //     $("#userid1").val($(this).closest('tr').children()[10].textContent);

        //     $("#verticalycentered1").modal("show");

        //     $("#brandname2").val($(this).closest('tr').children()[1].textContent);
        //     $("#username2").val($(this).closest('tr').children()[2].textContent);
        //     //$("#user_id").val($(this).closest('tr').children()[3].textContent);
        //     $("#country2").val($(this).closest('tr').children()[4].textContent);
        //     $("#state2").val($(this).closest('tr').children()[5].textContent);
        //     $("#city2").val($(this).closest('tr').children()[6].textContent);
        //     $("#useremail2").val($(this).closest('tr').children()[7].textContent);
        //     $("#userphone2").val($(this).closest('tr').children()[8].textContent);
        //     $("#brandid2").val($(this).closest('tr').children()[9].textContent);
        //     $("#userid2").val($(this).closest('tr').children()[10].textContent);




        //     $("#brandname3").val($(this).closest('tr').children()[1].textContent);
        //     $("#username3").val($(this).closest('tr').children()[2].textContent);
        //     //$("#user_id").val($(this).closest('tr').children()[3].textContent);
        //     //$("#country2").val($(this).closest('tr').children()[4].textContent);
        //     //$("#state2").val($(this).closest('tr').children()[5].textContent);
        //     //$("#city2").val($(this).closest('tr').children()[6].textContent);
        //     // $("#useremail2").val($(this).closest('tr').children()[7].textContent);
        //     // $("#userphone2").val($(this).closest('tr').children()[8].textContent);
        //     // $("#brandid2").val($(this).closest('tr').children()[9].textContent);
        //     $("#userid3").val($(this).closest('tr').children()[10].textContent);

        // });

        $("#userphone").keydown(function(event) {
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

        $("#userphone1").keydown(function(event) {
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


        function viewmodel(mid) {

            $.ajax({
                url: "model/getUserDetails.php",
                type: "POST",
                data: {
                    id: mid
                },
                cache: false,
                success: function(result) {

                    var obj = jQuery.parseJSON(result);
                    //console.log(obj);
                    $("#verticalycentered1").modal("show");
                    var brand = obj['brand'];
                    $.ajax({
                        url: "model/getBrandDetails.php",
                        type: "POST",
                        data: {
                            id: brand
                        },
                        cache: false,
                        success: function(result) {
                            var obj1 = jQuery.parseJSON(result);
                            $("#brandname2").html('<option value="' + obj1['brand'] + '" selected>' + obj1['brandname'] + '</option>');
                            $("#brandname1").html('<option value="' + obj1['brand'] + '" selected>' + obj1['brandname'] + '</option>');
                            $("#brandname3").html('<option value="' + obj1['brand'] + '" selected>' + obj1['brandname'] + '</option>');
                        }


                    });

                    $("#username2").val(obj['p_name']);

                    $("#useremail2").val(obj['p_email']);
                    $("#userphone2").val(obj['p_phone']);
                    $("#userpassword2").val(obj['password']);
                    $("#userid2").val(obj['p_id']);


                    $("#username1").val(obj['p_name']);

                    $("#useremail1").val(obj['p_email']);
                    $("#userphone1").val(obj['p_phone']);
                    $("#userpassword1").val(obj['password']);
                    $("#userid1").val(obj['p_id']);



                    $("#username3").val(obj['p_name']);

                    // $("#useremail3").val(obj['p_email']);
                    // $("#userphone3").val(obj['p_phone']);
                    // $("#userpassword3").val(obj['password']);
                    $("#userid3").val(obj['p_id']);



                  
                }

            });

        }
    </script>

</body>

</html>