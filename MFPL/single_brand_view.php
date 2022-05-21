<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "meta.php"; ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

        <!-- Vertically centered Modal -->
        <a style="color:blue;" data-bs-toggle="modal" data-bs-target="#verticalycentered1">
            <?php echo $row['brand_name'];
            $id = $row['id']; ?>
        </a>

        <div class="modal fade" id="verticalycentered1" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Brand Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <!-- <div class="card">
                                                                                <div class="card-body">
                                                                                    <h5 class="card-title">Bordered Tabs</h5> -->

                        <!-- Bordered Tabs -->
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
                                $single_brand = getBrand($id);
                                //print_r($single_brand);
                                ?>

                                <form class="row g-3 needs-validation" autocomplete="off" novalidate>

                                    <div class="col-md-6">
                                        <div class="form-floating autocomplete">

                                            <input id="brandname" class="form-control" type="text" name="brandname" placeholder="Brand" value="<?php echo $single_brand['brand_name']; ?>" readonly />
                                            <span id="brandname_check"></span>
                                            <!-- <input type="text" class="form-control" id="myInput"  name="myCountry" placeholder="Your Name"> -->
                                            <label for="floatingName">Brand</label>
                                            <div class="invalid-feedback">
                                                Please provide a Brand Name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="outlets" name="outlets" placeholder="Your Name" value="<?php echo $single_brand['outlets']; ?>" autocomplete="off" readonly />
                                            <label for="floatingName">No. of outlests</label>
                                        </div>
                                    </div>
                                    <h6>your Head Office Details</h6>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Your Name" value="<?php echo $single_brand['address']; ?>" autocomplete="off" readonly />
                                            <label for="floatingName">Address</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="pincode" name="pincode" placeholder="PINCODE" value="<?php echo $single_brand['pincode']; ?>" readonly>
                                            <label for="floatingName">PINCODE</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">

                                            <input type="text" class="form-control" id="country" name="country" placeholder="Your Name" value="<?php $countryname = getCountriesById($row['country']);
                                                                                                                                                echo $countryname['name']; ?>" autocomplete="off" readonly />
                                            <label for="floatingSelect">Country</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">

                                            <input type="text" class="form-control" id="state" name="state" placeholder="Your Name" value="<?php $statename = getStatesById($row['state']);
                                                                                                                                            echo $statename['name']; ?>" autocomplete="off" readonly />
                                            <label for="state">State</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">

                                            <input type="text" class="form-control" id="city" name="city" placeholder="Your Name" value="<?php $cityname = getCityById($row['city']);
                                                                                                                                            echo $cityname['name']; ?>" autocomplete="off" readonly />
                                            <label for="city">City</label>
                                        </div>
                                    </div>
                                    <h6> your Head Office Person Details</h6>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="personname" name="personname" placeholder="Your Name" value="<?php echo $single_brand['bp_name']; ?>" readonly>
                                            <label for="personname">Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="designation" name="designation" placeholder="PINCODE" value="<?php echo $single_brand['bp_designation']; ?>" readonly>
                                            <label for="designation">Designation</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="phone" name="phone" placeholder="phone" value="<?php echo $single_brand['bp_phone']; ?>" readonly>
                                            <label for="phone">Contact Number</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="PINCODE" value="<?php echo $single_brand['bp_email']; ?>" readonly>
                                            <label for="email">Email Id</label>
                                        </div>
                                    </div>



                                    <div class="text-center">
                                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Close</button>


                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                                <?php
                                $single_brand = getBrand($row['id']);
                                //print_r($single_brand);
                                ?>

                                <form class="row g-3 needs-validation" autocomplete="off" id="brandedit" action="" novalidate>
                                    <input id="id" class="form-control" type="hidden" name="id" value="<?php echo $single_brand['id']; ?>" required />
                                    <div class="col-md-6">
                                        <div class="form-floating autocomplete">

                                            <input id="brandname" class="form-control" type="text" name="brandname" placeholder="Brand" value="<?php echo $single_brand['brand_name']; ?>" required />
                                            <span id="brandname_check"></span>
                                            <!-- <input type="text" class="form-control" id="myInput"  name="myCountry" placeholder="Your Name"> -->
                                            <label for="floatingName">Brand</label>
                                            <div class="invalid-feedback">
                                                Please provide a Brand Name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <!-- <input type="text" class="form-control" id="outlets" name="outlets" placeholder="Your Name" value="<?php echo $single_brand['outlets']; ?>" autocomplete="off" required /> -->
                                            <select class="form-select" name="outlets" aria-label="State" id="outlets" required>
                                                <option value="<?php echo $single_brand['outlets']; ?>" selected><?php echo $single_brand['outlets']; ?></option>
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
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Your Name" value="<?php echo $single_brand['address']; ?>" autocomplete="off" required />
                                            <label for="floatingName">Address</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="pincode" name="pincode" placeholder="PINCODE" value="<?php echo $single_brand['pincode']; ?>" required>
                                            <label for="floatingName">PINCODE</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">

                                            <select class="form-select" id="country1" name="country" aria-label="country1" required>
                                                <!-- <input type="text" class="form-control" id="country" name="country" placeholder="Your Name" value="<?php //$countryname = getCountriesById($row['country']);
                                                                                                                                                        //echo $countryname['name']; 
                                                                                                                                                        ?>" autocomplete="off" readonly /> -->
                                                <option value="<?php echo $row['country']; ?>" selected><?php $countryname = getCountriesById($row['country']);
                                                                                                        echo $countryname['name']; ?></option>

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

                                            <select class="form-select" id="state1" name="state" aria-label="State" required>
                                                <option value="<?php echo $row['state']; ?>" selected><?php $statename = getStatesById($row['state']);
                                                                                                        echo $statename['name']; ?></option>
                                            </select>
                                            <label for="state">State</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">

                                            <select class="form-select" id="city1" name="city" aria-label="city" required>

                                                <option value="<?php echo $row['city']; ?>" selected><?php $cityname = getCityById($row['city']);
                                                                                                        echo $cityname['name']; ?></option>
                                            </select>
                                            <label for="city">City</label>
                                        </div>
                                    </div>
                                    <h6> your Head Office Person Details</h6>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="personname" name="personname" placeholder="Your Name" value="<?php echo $single_brand['bp_name']; ?>" required>
                                            <label for="personname">Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="designation" name="designation" placeholder="PINCODE" value="<?php echo $single_brand['bp_designation']; ?>" required>
                                            <label for="designation">Designation</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="phone" name="phone" placeholder="phone" min="6000000000" max="9999999999" value="<?php echo $single_brand['bp_phone']; ?>" required>
                                            <label for="phone">Contact Number</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="PINCODE" value="<?php echo $single_brand['bp_email']; ?>" required>
                                            <label for="email">Email Id</label>
                                        </div>
                                    </div>



                                    <div class="text-center">
                                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>


                                    </div>
                                </form>

                            </div>
                            <div class="tab-pane fade" id="bordered-contact" role="tabpanel" aria-labelledby="contact-tab">
                                <?php
                                $single_brand = getBrand($row['id']);
                                //print_r($single_brand);
                                ?>
                            </div>
                        </div><!-- End Bordered Tabs -->

                        <!-- </div>
                                                                            </div> -->




                    </div>

                </div>
            </div>
        </div><!-- End Vertically centered Modal-->

    </main><!-- End #main -->

    <?php include "footer.php"; ?>


    <script type="text/javascript">
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
                        console.log(obj.error);
                        if (obj.error == 0) {
                            swal(output);
                            //alert(obj.error_msg);
                            // window.location.href = '../admin/add_product.php?display=1';

                            $("#brandlist1").load(window.location.href + " #brandlist1");



                        } else {

                            if (obj.error == 3) {
                                //$("#display_error").html("<p style='color:red'>"+output+"</p>");
                            } else {
                                swal(output);
                            }

                            //alert(obj.error_msg);
                            // window.location.href = '../admin/add_product.php';
                            //$('#login_for_review').html(output).modal('show');
                            //BootstrapDialog.alert(output);
                            //swal(output);
                            //$("#brandlist1").load(window.location.href + " #brandlist1");
                            $("#brandlist1").load(" #brandlist1 > *");
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
                            swal(output);
                            //alert(obj.error_msg);
                            //window.location.href = 'brand_registration.php';
                            //$("#brandlist1").load(" #brandlist1 > *");
                            //$("#brandlist1").load(window.location.href + " #brandlist1");
                            //window.location.href = 'brand_registration.php';


                        } else {
                            //$(".content").html(popup());
                            //alert(obj.error_msg);
                            // window.location.href = '../admin/add_product.php';
                            //$('#login_for_review').html(output).modal('show');
                            //BootstrapDialog.alert(output);
                            swal(output);
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
                        $('#city1').html('<option value="">Select State First</option>');
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


        $('#brandname').on('keydown, keyup', function() {
            //get a reference to the text input value
            var texInputValue = $('#brandname').val();

            //show the text input value in the UI
            $('#message p span').html(texInputValue);
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
    </script>
    <script>
        $(document).ready(function() {
            $('#brandlist').DataTable({
                "scrollX": true
            });
        });
    </script>
</body>

</html>