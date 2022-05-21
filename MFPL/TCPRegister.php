<?php
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

        .cssh5 {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-weight: 40px;
        }

        .boxstyle {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>

</head>

<body>

    <?php include "header.php"; ?>
    <!-- ======= Sidebar ======= -->
    <?php include "sidebar.php"; ?>


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
            <h1>TCP</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item ">TCP </li>
                    <li class="breadcrumb-item active">TCP Register </li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">

            <div class="card">
                <div class="card-body">


                    <!-- Bordered Tabs Justified -->
                    <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home" aria-selected="true">Register</button>
                        </li>
                        <!-- <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Store</button>
                        </li> -->
                        <!--<li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Store</button>
                        </li> -->
                    </ul>
                    <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                        <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">

                            <div class="col-lg-12">

                                <div class="card">

                                    <div class="card-body">
                                        <!-- Vertically centered Modal -->
                                        <div class="row">

                                        </div>
                                        <!-- </div>
                                </div>
                            </div>
                            <div class="col-lg-12">

                                <div class="card">

                                    <div class="card-body"> -->
                                        <div class="col-lg-12">
                                            <h5 class="card-title"></h5>
                                            <form class="row g-3" id="registerTCP">


                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="imei" name="imei" autocomplete="off" placeholder="Your Name" required>
                                                        <label for="floatingName">IMEI <span style="color:red">*</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <select class="form-select" id="tcp_machine_type" aria-label="State" name="tcp_machine_type" placeholder="Machine Type" required>
                                                            <option> </option>
                                                            <option> TCP </option>

                                                        </select>
                                                        <label for="floatingSelect">Machine Type <span style="color:red">*</span></label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="tcp_sr" name="tcp_sr" autocomplete="off" placeholder="Software Revision" maxlength="20" required>
                                                        <label for="floatingName">Software Revision <span style="color:red">*</span></label>
                                                    </div>
                                                </div>
									<div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="number" class="form-control" id="tcp_low_threshold" name="tcp_low_threshold" autocomplete="off" placeholder="Low Threshold " maxlength="20" required>
                                                        <label for="floatingName">Low Threshold Temperature <span style="color:red">*</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="number" class="form-control" id="tcp_high_threshold" name="tcp_high_threshold" autocomplete="off" placeholder="High Threshold" maxlength="20" required>
                                                        <label for="floatingName">High Threshold Temperature <span style="color:red">*</span></label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" id="tcp_istaldate" name="tcp_instaldate" autocomplete="off" max="<?= date('Y-m-d'); ?>" placeholder="PINCODE">
                                                        <label for="floatingName">Installation Date</label>
                                                    </div>
                                                </div>



                                                <div class="text-center">
                                                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Register</button>
                                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div><!-- End Bordered Tabs Justified -->
                </div>
            </div>
            <div class="tab-pane fade show <?php echo $status2; ?>" id="pills-update" role="tabpanel" aria-labelledby="update-tab">

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body" style="overflow-x:auto;">
                            <h5 class="card-title">TCP Register List</h5>


                            <table id="updateDeviceList" class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">IMEI</th>
                                        <th scope="col">Machine Type</th>
                                        <th scope="col">Software Version</th>
                                        <th scope="col">Date</th>
                                        <!-- <th scope="col">Status</th> -->

                                        <!-- <th scope="col">BM. Name</th>
                        <th scope="col">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $devices = tcp_table();
                                    // print_r($devices);
                                    $i = 0;
                                    foreach ($devices as $device) {

                                        // print_r($device);exit;

                                        $id = $device['id'];
                                        $imei = $device['imei'];
                                        // print_r($recipe_version);exit;

                                        $tcp_machine_type = $device['tcp_machine_type'];
                                        $tcp_sr = $device['tcp_sr'];
                                        $tcp_instaldate = $device['tcp_instaldate'];


                                        //print_r($machine);
                                        // print_r($brand);
                                        // print_r($user);
                                        //print_r($store);
                                        {
                                            $i++;
                                    ?>
                                            <tr>
                                                <th scope="row"><?php echo $i; ?></th>
                                                <td><button type="submit" class="btn btn-success" onclick="viewmodel(<?php echo $id;
                                                                                                                        ?>)"><i class="far fa-edit"></i></button></td>

                                                <td><?php echo $imei ?></td>
                                                <td><?php echo $tcp_machine_type ?> </td>
                                                <td><?php echo $tcp_sr ?></td>
                                                <td><?php echo $tcp_instaldate ?></td>




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







                    <!-- VIEW - EDIT - DELETE -->
                    <div class="modal fade" id="tcp_register_action" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">


                                <div class="card-body">


                                    <!-- Bordered Tabs Justified -->
                                    <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">

                                        <!-- <li class="nav-item flex-fill" role="presentation">
                                                                        <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Store</button>
                                                                    </li> -->
                                        <!--<li class="nav-item flex-fill" role="presentation">
                                                                    <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Store</button>
                                                                </li> -->
                                    </ul>
                                    <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                                        <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">

                                            <div class="col-lg-12">

                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Edit TCP</h5>

                                                        <!-- Default Tabs -->
                                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">View</button>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Edit</button>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Delete</button>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content pt-2" id="myTabContent">



                                                            <!-- TCP Edit - VIEW Tab -->
                                                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                        </div>

                                                                        <div class="col-lg-12">
                                                                            <h5 class="card-title"></h5>
                                                                            <form class="row g-3" id="registerTCPView">


                                                                                <div class="col-md-6">
                                                                                    <div class="form-floating">
                                                                                        <input type="text" class="form-control" id="imeiv" name="imei" autocomplete="off" placeholder="Your Name" required="" readonly>
                                                                                        <label for="floatingName">IMEI</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-floating mb-3">
                                                                                        <input type="text" class="form-control" id="tcp_machine_typev" name="tcp_sr" autocomplete="off" placeholder="Software Revision" maxlength="20" required="" readonly>
                                                                                        <!-- <select class="form-select" id="tcp_machine_typev" aria-label="State" name="tcp_machine_type" placeholder="Machine Type" required="" readonly> -->

                                                                                        <label for="floatingSelect">Machine Type </label>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <div class="form-floating">
                                                                                        <input type="text" class="form-control" id="tcp_srv" name="tcp_sr" autocomplete="off" placeholder="Software Revision" maxlength="20" required="" readonly>
                                                                                        <label for="floatingName">Software Revision </label>
                                                                                    </div>
                                                                                </div>
													<div class="col-md-6">
                                                                                    <div class="form-floating">
                                                                                        <input type="number" class="form-control" id="tcp_low_thresholdv" name="tcp_low_threshold" autocomplete="off" placeholder="Low Threshold " maxlength="20" readonly>
                                                                                        <label for="floatingName">Low Threshold Temperature </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-floating">
                                                                                        <input type="number" class="form-control" id="tcp_high_thresholdv" name="tcp_high_threshold" autocomplete="off" placeholder="High Threshold" maxlength="20" readonly>
                                                                                        <label for="floatingName">High Threshold Temperature </label>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="col-md-6">
                                                                                    <div class="form-floating">
                                                                                        <input type="date" class="form-control" id="tcp_istaldatev" name="tcp_instaldate" autocomplete="off" max="<?= date('Y-m-d'); ?>" placeholder="PINCODE" readonly>
                                                                                        <label for="floatingName">Installation Date</label>
                                                                                    </div>
                                                                                </div>

                                                                            </form>






                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>




                                                            <!-- TCP Edit - EDIT Tab -->
                                                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                                <div class="tab-content pt-2" id="myTabContent">
                                                                    <div class="tab-pane fade show active" id="Edit" role="tabpanel" aria-labelledby="home-tab">

                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title"></h5>

                                                                                <form class="row g-3" id="edit_tcp">

                                                                                <input type="hidden" class="form-control" id="editid" name="editid" autocomplete="off" placeholder="Your Name" required="" readonly>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-floating">
                                                                                            <input type="text" class="form-control" id="imeiedit" name="imeiedit" autocomplete="off" placeholder="Your Name" required="" readonly>
                                                                                            <label for="floatingName">IMEI</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-floating mb-3">
                                                                                            <input type="text" class="form-control" id="tcp_machine_typeedit" name="tcp_machine_typeedit" autocomplete="off" placeholder="Software Revision" maxlength="20" required="" >
                                                                                            <!-- <select class="form-select" id="tcp_machine_typev" aria-label="State" name="tcp_machine_type" placeholder="Machine Type" required="" readonly> -->

                                                                                            <label for="floatingSelect">Machine Type </label>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-floating">
                                                                                            <input type="text" class="form-control" id="tcp_sredit" name="tcp_sredit" autocomplete="off" placeholder="Software Revision" maxlength="20" required="" >
                                                                                            <label for="floatingName">Software Revision </label>
                                                                                        </div>
                                                                                    </div>
														<div class="col-md-6">
                                                                                        <div class="form-floating">
                                                                                            <input type="number" class="form-control" id="tcp_low_thresholdedit" name="tcp_low_thresholdedit" autocomplete="off" placeholder="Low Threshold " maxlength="20" required="">
                                                                                            <label for="floatingName">Low Threshold Temperature </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-floating">
                                                                                            <input type="number" class="form-control" id="tcp_high_thresholdedit" name="tcp_high_thresholdedit" autocomplete="off" placeholder="High Threshold" maxlength="20" required="">
                                                                                            <label for="floatingName">High Threshold Temperature </label>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-floating">
                                                                                            <input type="date" class="form-control" id="tcp_istaldateedit" name="tcp_instaldateedit" autocomplete="off" max="<?= date('Y-m-d'); ?>" placeholder="PINCODE" >
                                                                                            <label for="floatingName">Installation Date</label>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="text-center">
                                                                                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Update</button>
                                                                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                                                                    </div>

                                                                                </form>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>



                                                            <!-- TCP Edit - DELETE Tab -->
                                                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                                                <!-- DELETE from the TCP Register -->
                                                                <div class="tab-content pt-2" id="myTabContent">
                                                                    <div class="tab-pane fade show active" id="Delete" role="tabpanel" aria-labelledby="home-tab">

                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title"></h5>

                                                                                <form class="row g-3" id="delete_tcp">
                                                                                        <input type="hidden" class="form-control" id="deleteid" name="deleteid" autocomplete="off" placeholder="Your Name" required="" readonly>

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-floating">
                                                                                            <input type="text" class="form-control" id="imeivDelete" name="imeivDelete" autocomplete="off" placeholder="Your Name" required="" readonly>
                                                                                            <label for="floatingName">IMEI</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-floating mb-3">
                                                                                            <input type="text" class="form-control" id="tcp_machine_typevDelete" name="tcp_machine_typevDelete" autocomplete="off" placeholder="Software Revision" maxlength="20" required="" >
                                                                                            <!-- <select class="form-select" id="tcp_machine_typev" aria-label="State" name="tcp_machine_type" placeholder="Machine Type" required="" readonly> -->

                                                                                            <label for="floatingSelect">Machine Type </label>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-floating">
                                                                                            <input type="text" class="form-control" id="tcp_srvDelete" name="tcp_srvDelete" autocomplete="off" placeholder="Software Revision" maxlength="20" required="" >
                                                                                            <label for="floatingName">Software Revision </label>
                                                                                        </div>
                                                                                    </div>
														<div class="col-md-6">
                                                                                        <div class="form-floating">
                                                                                            <input type="number" class="form-control" id="tcp_low_thresholdDelete" name="tcp_low_thresholdDelete" autocomplete="off" placeholder="Low Threshold " maxlength="20" readonly>
                                                                                            <label for="floatingName">Low Threshold Temperature</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-floating">
                                                                                            <input type="number" class="form-control" id="tcp_high_thresholdDelete" name="tcp_high_thresholdDelete" autocomplete="off" placeholder="High Threshold" maxlength="20" readonly>
                                                                                            <label for="floatingName">High Threshold Temperature</label>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-floating">
                                                                                            <input type="date" class="form-control" id="tcp_istaldatevDelete" name="tcp_istaldatevDelete" autocomplete="off" max="<?= date('Y-m-d'); ?>" placeholder="PINCODE" >
                                                                                            <label for="floatingName">Installation Date</label>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="text-center">
                                                                                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Delete</button>
                                                                                    </div>

                                                                                </form>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>





                                                        </div><!-- End Default Tabs -->

                                                    </div>
                                                </div>




                                                
                                            </div>


                                        </div>



                                    </div>


                                    <!-- End Bordered Tabs Justified -->
                                    <!-- <div class="tab-content pt-2" id="borderedTabJustifiedContent"> -->



































                                </div>

                            </div>

                        </div>
                    </div>

        </section>
    </main>
    <?php include "footer.php"; ?>
    <script>
        $(document).ready(function(e) {
            $("#registerTCP").on('submit', (function(e) {
                e.preventDefault();
                // $('#loader-icon').show();
                //var valid;  
                //valid = validateContact();
                //if(valid) {
                // console.log("Heloo");
                $.ajax({
                    url: "tcpmodel/TCP_register_process.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(res) {
                        var obj = jQuery.parseJSON(res);
                        var string1 = obj.error;
                        var output = obj.error_msg;
                        console.log(output);
                        if (obj.error == 0) {

                            Swal.fire({
                                icon: 'success',
                                text: output,
                                timer: 3500

                            })
                            //alert(obj.error_msg);

                            //$("#brandlist1").load(" #brandlist1 > *");
                           
                            setTimeout(function() {
                                $("#updateDeviceList").load(window.location.href + " #updateDeviceList");
                                 //window.location.href = 'TCPRegister.php';
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



        function viewmodel(mid) {
            // console.log(mid);
            $.ajax({
                url: "reports1/getTcpID.php",
                type: "POST",
                data: {
                    id: mid
                },
                cache: false,
                success: function(result) {

                    var obj = jQuery.parseJSON(result);
                    // console.log(obj);
                    $("#tcp_register_action").modal("show");
                    // var version_name = obj['version_name'];

                    $("#imeiv").val(obj['imei']);
                    // console.log(obj['imei']);
                    $("#tcp_machine_typev").val(obj['tcp_machine_type']);
                    // console.log(obj['tcp_machine_type']);

                    $("#tcp_srv").val(obj['tcp_sr']);
                    $("#tcp_istaldatev").val(obj['tcp_instaltable']);
                    // $("#vvdeepsleep").val(obj['deep_sleep_time']);
			  $("#tcp_low_thresholdv").val(obj['tcp_low_threshold']);
                    $("#tcp_high_thresholdv").val(obj['tcp_high_threshold']);



                    // Passing same values to inputs of Edit Form 
                    $("#editid").val(mid);
                    $("#imeiedit").val(obj['imei']);
                    $("#tcp_machine_typeedit").val(obj['tcp_machine_type']);
                    $("#tcp_sredit").val(obj['tcp_sr']);
                    $("#tcp_istaldateedit").val(obj['tcp_instaltable']);

			  $("#tcp_low_thresholdedit").val(obj['tcp_low_threshold']);
                    $("#tcp_high_thresholdedit").val(obj['tcp_high_threshold']);




                     // Passing same values to inputs of Delete Form 
                     $("#deleteid").val(mid);
                     $("#imeivDelete").val(obj['imei']);
                    $("#tcp_machine_typevDelete").val(obj['tcp_machine_type']);
                    $("#tcp_srvDelete").val(obj['tcp_sr']);
                    $("#tcp_istaldatevDelete").val(obj['tcp_instaltable']);

			  $("#tcp_low_thresholdDelete").val(obj['tcp_low_threshold']);
                    $("#tcp_high_thresholdDelete").val(obj['tcp_high_threshold']);


                }
            });
        }

        $(document).ready(function(e) {
            $("#edit_tcp").on('submit', (function(e) {
                e.preventDefault();
       
                $.ajax({
                    type: "POST",
                    url: "reports1/edit_Tcp_register.php",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        console.log(obj);
                        var string1 = obj.error;
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
                                window.location.href = 'TCPRegister.php?page=1';
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
                })
            }))
        })
    



        $(document).ready(function(e) {
            $("#delete_tcp").on('submit', (function(e) {
                e.preventDefault();
       
                $.ajax({
                    type: "POST",
                    url: "reports1/delete_Tcp_register.php",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        console.log(obj);
                        var string1 = obj.error;
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
                                window.location.href = 'TCPRegister.php?page=1';
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
                })
            }))
        })
    
       
    </script>
</body>