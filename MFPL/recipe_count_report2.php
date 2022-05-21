<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "meta.php"; ?>
</head>

<body>

    <?php include "header.php"; ?>
    <!-- ======= Sidebar ======= -->
    <?php include "sidebar.php"; ?>
    <?php require_once "controller/functions.php"; ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Recipe Count Report</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Recipe Count Report</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Base</h5>

                    <!-- Default Tabs -->
                    <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-justified" type="button" role="tab" aria-controls="home" aria-selected="true">Recipe Count</button>
                        </li>
                        <!-- <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile" aria-selected="false">Weekly</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-justified" type="button" role="tab" aria-controls="contact" aria-selected="false">Mothly</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="year-tab" data-bs-toggle="tab" data-bs-target="#year-justified" type="button" role="tab" aria-controls="year" aria-selected="false">Yearly</button>
                        </li> -->
                    </ul>
                    <div class="tab-content pt-2" id="myTabjustifiedContent">
                        <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Search Accourding To</h5>

                                    <!-- Floating Labels Form -->
                                    <form class="row g-3" id="recipecount">


                                        <div class="col-md-3">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="ptype" name="ptype" aria-label="">
                                                    <option value=""></option>
                                                    <?php
                                                    $ptypes = getProductTypes();
                                                    //print_r($ptypes);
                                                    foreach ($ptypes  as $ptype) {
                                                    ?>
                                                        <option value="<?php echo $ptype['id']; ?>"><?php echo $ptype['name']; ?> <?php echo $ptype['version']; ?></option>
                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                                <label for="floatingSelect">Machine Type</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="machine" name="machine" aria-label="">
                                                    <option value=""></option>
                                                    <?php
                                                    // $devices = getAssignedDevices();
                                                    // $i = 0;
                                                    // foreach ($devices as $device) {
                                                    //     $i++;
                                                    //     //print_r($machine);
                                                    //     $machine = getSingleMachine($device['machine_id']);
                                                    ?>
                                                    <option value="<?php //echo  $machine['id']; 
                                                                    ?>"><?php //echo  $machine['name']; 
                                                                        ?></option>
                                                    <?php
                                                    //  }
                                                    ?>
                                                </select>
                                                <label for="floatingSelect">Machines</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3" id="branddiv">
                                                <select class="form-select" id="brand" name="brand" aria-label="" onchange="brandchange(this);">
                                                    <option value=""></option>
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
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3" id="userdiv">
                                                <select class="form-select" id="user" name="user" aria-label="">
                                                    <option value=""></option>
                                                    <?php
                                                    $result = getusers();
                                                    $i = 0;
                                                    //print_r($result);
                                                    foreach ($result as $row) {
                                                        $i++;
                                                    ?>
                                                        <option value="<?php echo $row['user_id']; ?>"><?php echo $row['name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                                <label for="floatingSelect">User Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3" id="storediv">
                                                <select class="form-select" id="store" name="store" aria-label="" onchange="storechange(this);">
                                                    <option value=""></option>
                                                    <?php
                                                    $result = getStores();
                                                    $i = 0;
                                                    //print_r($result);
                                                    foreach ($result as $row) {
                                                        $i++;
                                                    ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['store_name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                                <label for="floatingSelect">Store Name</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3" id="countrydiv">
                                                <select class="form-select" id="country" name="country" aria-label="">
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
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3" id="statediv">
                                                <select class="form-select" id="state" name="state" aria-label="">

                                                </select>
                                                <label for="floatingSelect">States</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3" id="citydiv">
                                                <select class="form-select" id="city" name="city" aria-label="">

                                                </select>
                                                <label for="floatingSelect">City</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="fromdate" name="fromdate" max="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d', strtotime("-30 days", strtotime(date('Y-m-d')))); ?>" placeholder="From Date">
                                                <label for="floatingEmail">From Date</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="todate" name="todate" max="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d'); ?>" placeholder="To Date">
                                                <label for="floatingEmail">To Date</label>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-secondary"><a href="recipe_count_report.php" style="color:white">Reset</a></button>
                                            <input type="button" id="export" class="btn btn-success" value="Export">
                                        </div>
                                    </form><!-- End floating Labels Form -->

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>


            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Chart</h5>

                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                            <li class="nav-item" role="presentation" id="hourly">
                                <button class="nav-link " id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Hourly</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Daily</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Weekly</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="monthly-tab" data-bs-toggle="tab" data-bs-target="#bordered-monthly" type="button" role="tab" aria-controls="monthly" aria-selected="false" onclick="refresh();">monthly</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="borderedTabContent">
                            <div class="tab-pane fade " id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                                <!-- <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                           -->

                                <div id="columnChart"></div>


                                <!-- </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="tab-pane fade show active" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                                <!-- <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body"> -->

                                <div id="columnChartday"></div>

                                <!-- </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="tab-pane fade" id="bordered-contact" role="tabpanel" aria-labelledby="contact-tab">
                                <!-- <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body"> -->

                                <div id="columnChartweekly"></div>

                                <!-- </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="tab-pane fade" id="bordered-monthly" role="tabpanel" aria-labelledby="monthly-tab">
                                <!-- <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body"> -->

                                <div id="columnChartmonthly">

                                </div>

                                <!-- </div>
                                    </div>
                                </div> -->
                            </div>
                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>
            </div>
            <div class="col-lg-12" style="display:none">
                <!-- <div class="col-lg-12"> -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recipe Count</h5>


                        <!-- Table with stripped rows -->
                        <table id="brandlist" class="table datatable display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>

                                    <th scope="col">count</th>
                                    <th scope="col">date</th>


                                </tr>
                            </thead>
                            <tbody id="brandlist1">






                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>


    </main><!-- End #main -->

    <?php include "footer.php"; ?>


    <script>
        $(document).ready(function() {
            $('#ptype').on('change', function() {
                var id = this.value;
                //console.log(country_id);
                $.ajax({
                    url: "model/getPtypeMachines.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: function(result) {
                        //console.log(result);
                        $("#machine").html(result);
                        //  $('#city1').html('<option value="">Select State First</option>');
                    }
                });
            });

        });


        function brandchange(sel) {
            var id = '';
            $.ajax({
                url: "model/getBrandUsers.php",
                type: "POST",
                data: {
                    id: sel.value
                },
                cache: false,
                success: function(result) {
                    //console.log(result);
                    $("#user").html(result);
                    //$('#city').html('<option value="">Select State First</option>');
                }
            });



            var id = '';
            $.ajax({
                url: "model/getBrandStores.php",
                type: "POST",
                data: {
                    id: sel.value
                },
                cache: false,
                success: function(result) {
                    //console.log(result);
                    $("#store").html(result);
                    $('#countrydiv').load(location.href + " #countrydiv");
                    $('#statediv').load(location.href + " #statediv");
                    $('#citydiv').load(location.href + " #citydiv");
                    //$('#city').html('<option value="">Select State First</option>');
                }
            });

        }


        // $(document).ready(function() {
        //     $('#brand').on('change', function() {
        //         var id = this.value;
        //         //console.log(id);
        //         $.ajax({
        //             url: "model/getBrandUsers.php",
        //             type: "POST",
        //             data: {
        //                 id: id
        //             },
        //             cache: false,
        //             success: function(result) {
        //                 //console.log(result);
        //                 $("#user").html(result);
        //                 //$('#city').html('<option value="">Select State First</option>');
        //             }
        //         });
        //     });
        //     $('#brand').on('change', function() {
        //         var id = this.value;
        //         //console.log(id);
        //         $.ajax({
        //             url: "model/getBrandStores.php",
        //             type: "POST",
        //             data: {
        //                 id: id
        //             },
        //             cache: false,
        //             success: function(result) {
        //                 //console.log(result);
        //                 $("#store").html(result);
        //                 //$('#city').html('<option value="">Select State First</option>');
        //             }
        //         });
        //     });
        // });


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

        $(document).ready(function(e) {
            $('#machine').on('change', function() {


                var id = this.value;
                //console.log(id);
                $.ajax({
                    url: "model/getMachineDetails.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        // console.log(obj);
                        if (id == '') {
                            $('#branddiv').load(location.href + " #branddiv");
                            $('#storediv').load(location.href + " #storediv");
                            $('#userdiv').load(location.href + " #userdiv");
                            $('#countrydiv').load(location.href + " #countrydiv");
                            $('#statediv').load(location.href + " #statediv");
                            $('#citydiv').load(location.href + " #citydiv");

                        } else {
                            $('#brand').html('<option value="' + obj.brand_id + '" selected>' + obj.brand + '</option>');
                            $('#store').html('<option value="' + obj.store_id + '" selected>' + obj.store + '</option>');
                            $('#user').html('<option value="' + obj.user_id + '" selected>' + obj.user + '</option>');

                            $('#country').html('<option value="' + obj.country + '" selected>' + obj.countryname + '</option>');
                            $('#state').html('<option value="' + obj.state + '" selected>' + obj.statename + '</option>');
                            $('#city').html('<option value="' + obj.city + '" selected>' + obj.cityname + '</option>');
                        }


                        // $('#pincode1').val(obj.pincode);
                    }
                });

                // var dropdown = $(this);

                //$('#countrydiv').hide();
                //$('#statediv').hide();
                //$('#citydiv').hide();




            });
        });

        $(document).ready(function() {
            $('#user').on('change', function() {
                var id = this.value;
                //console.log(id);
                // $.ajax({
                //     url: "model/getBrandUsers.php",
                //     type: "POST",
                //     data: {
                //         id: id
                //     },
                //     cache: false,
                //     success: function(result) {
                //console.log(result);
                if (id == '') {
                    $('#countrydiv').show();
                    $('#statediv').show();
                    $('#citydiv').show();
                    $('#storediv').show();
                } else {
                    $('#countrydiv').hide();
                    $('#statediv').hide();
                    $('#citydiv').hide();
                    $('#storediv').hide();
                }

                //$('#city').html('<option value="">Select State First</option>');
                // }
            });
            // });

        });

        function storechange(sel) {
            // console.log(sel.value);
            var id = sel.value;
            $.ajax({
                url: "model/getStoreDetails.php",
                type: "POST",
                data: {
                    id: id
                },
                cache: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    // console.log(id);
                    //$("#store").html(obj.);
                    // $('#mname1').val(obj.p_name);
                    // $('#mphone1').val(obj.p_phone);
                    // $('#memail1').val(obj.p_email);
                    if (id == '') {
                        $('#countrydiv').load(location.href + " #countrydiv");
                        $('#statediv').load(location.href + " #statediv");
                        $('#citydiv').load(location.href + " #citydiv");
                    } else {
                        $('#country').html('<option value="' + obj.country + '">' + obj.countryname + '</option>');
                        $('#state').html('<option value="' + obj.state + '">' + obj.statename + '</option>');
                        $('#city').html('<option value="' + obj.city + '">' + obj.cityname + '</option>');
                    }


                    // $('#pincode1').val(obj.pincode);
                }
            });






        };


        $(document).ready(function(e) {
            $("#export").on('click', (function(e) {
                // $("#columnChart").load(location.href + " #columnChart");
               
                var ptype = $("#ptype").val();
                var machine = $("#machine").val();
                var brand = $("#brand").val();
                var user = $("#user").val();
                var country = $("#country").val();
                var state = $("#state").val();
                var city = $("#city").val();
                var fromdate = $("#fromdate").val();
                var todate = $("#todate").val();

                // console.log(ptype+"..."+machine+"..."+brand+"..."+user+"..."+country+"..."+state+"..."+city);  
                // var dataString={ptype:ptype};//+"&machine="+machine+"&brand="+brand+"&user="+user+"&country="+country+"&state="+state+"&city="+city+"&fromdate="+fromdate+"&todate="+todate;
                var data = $('form').serialize();
                $.ajax({

                    type: 'post',
                    url: 'reports/recipecount.php',
                    data: data,
                    success: function(responce) {
                        $("#borderedTab").load(location.href + " #borderedTab");
                        var obj = jQuery.parseJSON(responce);
                        var string1 = obj.error;
                        var output = obj.error_msg;
                        var dates = obj.dates;
                        var hourwiserc = obj.hourlywiserc;
                        var hourly = obj.hourly;
                        if (obj.error == 0 && dates[0] != '') {
                            //swal(output);

                            console.log(output);
                            console.log(dates);
                            var k = 0;
                            $.each(output, function(i, item) {
                                //$('#brandlist').append('<br/>');
                                // $.each(dates, function(i, field) {
                                // if (field != '' && item.data[i] != 0) {
                                k++;
                                $('#brandlist1').append('<tr><th scope="row">' + k + '</th><td>' + item + '</td><td>' + dates[i] + '</td></tr>');
                                //  }
                                // $.each(item.data, function(i, data) {

                                // });
                                // });
                            });

                            $(function() {

                                $("#brandlist").table2excel({
                                    filename: "Table.xls"
                                });

                            });




                        } else if (obj.error == 2) {
                            swal(output);
                        } else {

                            swal("no data found");

                        }
                    },
                    error: function() {}

                });
            }));
        });


        $(document).ready(function(e) {


            $("#recipecount").on('submit', (function(e) {
                e.preventDefault();
                var string1=output=dates=hourwiserc=hourly=0;
                //$('#loader-icon').show();
                //var valid;  
                //valid = validateContact();
                //if(valid) {

                 $("#columnChartmonthly").load(location.href + " #columnChartmonthly");
                // $("#brandlist").load(location.href + " #brandlist");
                // $('html,body').animate({
                //     scrollTop: $('#borderedTab').offset().top
                // }, 0);
                $.ajax({
                    url: "reports/recipecount.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        //$("#borderedTab").load(location.href + " #borderedTab");
                        var obj = jQuery.parseJSON(data);
                        var string1 = obj.error;
                        var output = obj.error_msg;
                        var dates = obj.dates;
                        var hourwiserc = obj.hourlywiserc;
                        var hourly = obj.hourly;
                        //console.log(output[data]); 
                        //console.log(dates);
                        if (obj.error == 0 && dates[0] != '') {



                            var options = {
                                chart: {
                                    // type: "area",
                                    type: "line",
                                    height: 300,
                                    foreColor: "#999",
                                    stacked: true,
                                    dropShadow: {
                                        enabled: true,
                                        enabledSeries: [0],
                                        top: -2,
                                        left: 2,
                                        blur: 5,
                                        opacity: 0.06
                                    }
                                },
                                colors: ['#0090FF', '#00E396'],
                                stroke: {
                                    curve: "smooth",
                                    width: 3
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                series: [{
                                    name: 'Total Counts',
                                    data: generateDayWiseTimeSeries(0, dates.length)
                                }],
                                markers: {
                                    size: 0,
                                    strokeColor: "#fff",
                                    strokeWidth: 3,
                                    strokeOpacity: 1,
                                    fillOpacity: 1,
                                    hover: {
                                        size: 6
                                    }
                                },
                                xaxis: {
                                    type: "datetime",
                                    axisBorder: {
                                        show: false
                                    },
                                    axisTicks: {
                                        show: false
                                    }
                                },
                                yaxis: {
                                    labels: {
                                        offsetX: 14,
                                        offsetY: -5
                                    },
                                    tooltip: {
                                        enabled: true
                                    }
                                },
                                grid: {
                                    padding: {
                                        left: -5,
                                        right: 5
                                    }
                                },
                                tooltip: {
                                    x: {
                                        format: "dd MMM yyyy"
                                    },
                                },
                                legend: {
                                    position: 'top',
                                    horizontalAlign: 'left'
                                },
                                fill: {
                                    type: "solid",
                                    fillOpacity: 0.7
                                }
                            };

                            var chart = new ApexCharts(document.querySelector("#columnChartmonthly"), options);
                            
                            chart.render();

                            function generateDayWiseTimeSeries(s, count) {
                                var values = [
                                    output
                                ];
                                var i = 0;
                                var series = [];
                                var x = new Date(dates[0]).getTime();
                                while (i < count) {
                                    series.push([x, values[s][i]]);
                                    x += 86400000;
                                    i++;
                                }
                                return series;
                            }




                        } else if (obj.error == 2) {
                            swal(output);
                        } else {

                            swal("no data found");

                        }
                    },
                    error: function() {}

                });
                //}
            }));
        });

        $(document).ready(function(e) {
            $("#recipecount").on('submit', (function(e) {
                e.preventDefault();
                var string1=output=dates=productsevendays=sevendays=0;
                //$('#loader-icon').show();
                //var valid;  
                //valid = validateContact();
                //if(valid) {

                 $("#columnChartweekly").load(location.href + " #columnChartweekly");
                // $("#brandlist").load(location.href + " #brandlist");
                // $('html,body').animate({
                //     scrollTop: $('#borderedTab').offset().top
                // }, 0);
                $.ajax({
                    url: "reports/recipecount.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        //$("#columnChartweekly").load(location.href + " #columnChartweekly");
                        var obj = jQuery.parseJSON(data);
                        var string1 = obj.error;
                        var output = obj.error_msg;
                        var dates = obj.dates;
                        var productsevendays = obj.productsevendays;
                        var sevendays = obj.sevendays;
                        //console.log(output[data]); 
                        //console.log(dates);
                        if (obj.error == 0 && dates[0] != '') {




                            var options = {
                                chart: {
                                    // type: "area",
                                    type: "line",
                                    height: 300,
                                    foreColor: "#999",
                                    stacked: true,
                                    dropShadow: {
                                        enabled: true,
                                        enabledSeries: [0],
                                        top: -2,
                                        left: 2,
                                        blur: 5,
                                        opacity: 0.06
                                    }
                                },
                                colors: ['#0090FF', '#00E396'],
                                stroke: {
                                    curve: "smooth",
                                    width: 3
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                series: [{
                                    name: 'Total Counts',
                                    data: generateDayWiseTimeSeries(0, sevendays.length)
                                }],
                                markers: {
                                    size: 0,
                                    strokeColor: "#fff",
                                    strokeWidth: 3,
                                    strokeOpacity: 1,
                                    fillOpacity: 1,
                                    hover: {
                                        size: 6
                                    }
                                },
                                xaxis: {
                                    type: "datetime",
                                    axisBorder: {
                                        show: false
                                    },
                                    axisTicks: {
                                        show: false
                                    }
                                },
                                yaxis: {
                                    labels: {
                                        offsetX: 14,
                                        offsetY: -5
                                    },
                                    tooltip: {
                                        enabled: true
                                    }
                                },
                                grid: {
                                    padding: {
                                        left: -5,
                                        right: 5
                                    }
                                },
                                tooltip: {
                                    x: {
                                        format: "dd MMM yyyy"
                                    },
                                },
                                legend: {
                                    position: 'top',
                                    horizontalAlign: 'left'
                                },
                                fill: {
                                    type: "solid",
                                    fillOpacity: 0.7
                                }
                            };

                            var chart = new ApexCharts(document.querySelector("#columnChartweekly"), options);
                            
                            chart.render();

                            function generateDayWiseTimeSeries(s, count) {
                                var values = [
                                    productsevendays
                                ];
                                var i = 0;
                                var series = [];
                                var x = new Date(sevendays[0]).getTime();
                                while (i < count) {
                                    series.push([x, values[s][i]]);
                                    x += 86400000;
                                    i++;
                                }
                                return series;
                            }




                        } else if (obj.error == 2) {
                            swal(output);
                        } else {

                            swal("no data found");

                        }
                    },
                    error: function() {}

                });
                //}
            }));
        });

        // $(document).ready(function(e) {
        //     $("#recipecount").on('submit', (function(e) {
        //         e.preventDefault();
        //         //$('#loader-icon').show();
        //         //var valid;  
        //         //valid = validateContact();
        //         //if(valid) {
        //         $("#columnChart").load(location.href + " #columnChart");
        //         $("#brandlist").load(location.href + " #brandlist");
        //         $('html,body').animate({
        //             scrollTop: $('#columnChart').offset().top
        //         }, 0);
        //         $.ajax({
        //             url: "reports/recipecount.php",
        //             type: "POST",
        //             data: new FormData(this),
        //             contentType: false,
        //             cache: false,
        //             processData: false,
        //             success: function(data) {
        //                 var obj = jQuery.parseJSON(data);
        //                 var string1 = obj.error;
        //                 var output = obj.error_msg;
        //                 var dates = obj.dates;
        //                 var weekwiserc = obj.weeklywiserc;

        //                 var weekrc = [weekwiserc[0], weekwiserc[1], weekwiserc[2], weekwiserc[3]];
        //                 var week = obj.weekly;
        //                 var weekly = ["week 1", "week 2", "last week", "this week"];
        //                 //var weekly = ["week 1 ("+week[0]+"-"+week[1]+")","week 2 ("+week[1]+"-"+week[2]+")","last week ("+week[2]+"-"+week[3]+")","this week ("+week[3]+"-"+week[4]+")"];
        //                 console.log(weekwiserc);
        //                 console.log(weekly);
        //                 if (obj.error == 0 && dates[0] != '') {


        //                     var options = {
        //                         series: [{
        //                             name: 'Total Counts',
        //                             data: weekrc
        //                         }],
        //                         chart: {


        //                             type: 'bar',
        //                             height: 350
        //                         },
        //                         plotOptions: {
        //                             bar: {
        //                                 horizontal: false,
        //                                 columnWidth: '55%',
        //                                 endingShape: 'rounded'
        //                             },

        //                         },
        //                         dataLabels: {
        //                             enabled: false
        //                         },
        //                         stroke: {
        //                             show: true,
        //                             width: 2,
        //                             colors: ['transparent']
        //                         },
        //                         xaxis: {


        //                             categories: weekly
        //                         },
        //                         yaxis: {
        //                             title: {
        //                                 text: 'Count'
        //                             }
        //                         },
        //                         fill: {
        //                             opacity: 1
        //                         },
        //                         tooltip: {
        //                             y: {
        //                                 formatter: function(val) {
        //                                     return " " + val + " counts"
        //                                 }
        //                             }
        //                         }
        //                     };

        //                     var chart = new ApexCharts(document.querySelector("#columnChartweekly"), options);
        //                     chart.render();



        //                     //hourly graph seperate

        //                     // var options = {
        //                     //     chart: {

        //                     //         type: "area",
        //                     //         height: 300,
        //                     //         foreColor: "#999",
        //                     //         stacked: true,
        //                     //         dropShadow: {
        //                     //             enabled: true,
        //                     //             enabledSeries: [0],
        //                     //             top: -2,
        //                     //             left: 2,
        //                     //             blur: 5,
        //                     //             opacity: 0.06
        //                     //         }
        //                     //     },
        //                     //     colors: ['#00E396', '#00E396'],
        //                     //     stroke: {
        //                     //         curve: "smooth",
        //                     //         width: 3
        //                     //     },
        //                     //     dataLabels: {
        //                     //         enabled: false
        //                     //     },
        //                     //     series: [{
        //                     //         name: 'Total Counts',
        //                     //         data: generateDayWiseTimeSeries(0, week.length)
        //                     //     }],
        //                     //     markers: {
        //                     //         size: 0,
        //                     //         strokeColor: "#fff",
        //                     //         strokeWidth: 3,
        //                     //         strokeOpacity: 1,
        //                     //         fillOpacity: 1,
        //                     //         hover: {
        //                     //             size: 6
        //                     //         }
        //                     //     },
        //                     //     xaxis: {
        //                     //         type: "datetime",
        //                     //         axisBorder: {
        //                     //             show: false
        //                     //         },
        //                     //         axisTicks: {
        //                     //             show: false
        //                     //         }
        //                     //     },
        //                     //     yaxis: {
        //                     //         labels: {
        //                     //             offsetX: 14,
        //                     //             offsetY: -5
        //                     //         },
        //                     //         tooltip: {
        //                     //             enabled: true
        //                     //         }
        //                     //     },
        //                     //     grid: {
        //                     //         padding: {
        //                     //             left: -5,
        //                     //             right: 5
        //                     //         }
        //                     //     },
        //                     //     tooltip: {
        //                     //         x: {
        //                     //             format: "dd MMM yyyy"
        //                     //         },
        //                     //     },
        //                     //     legend: {
        //                     //         position: 'top',
        //                     //         horizontalAlign: 'left'
        //                     //     },
        //                     //     fill: {
        //                     //         type: "solid",
        //                     //         fillOpacity: 0.7
        //                     //     }
        //                     // };

        //                     // var chart = new ApexCharts(document.querySelector("#columnChartweekly"), options);

        //                     // chart.render();

        //                     // function generateDayWiseTimeSeries(s, count) {
        //                     //     var values = [
        //                     //         weekwiserc
        //                     //     ];
        //                     //     var i = 0;
        //                     //     var series = [];
        //                     //     var x = new Date(week[0]).getTime();
        //                     //     while (i < count) {
        //                     //         series.push([x, values[s][i]]);
        //                     //         x += 3600000 * 24 * 7;
        //                     //         i++;
        //                     //     }
        //                     //     return series;
        //                     // }

        //                 } else if (obj.error == 2) {
        //                     swal(output);
        //                 } else {

        //                     swal("no data found");

        //                 }
        //             },
        //             error: function() {}

        //         });
        //         //}
        //     }));
        // });

        // $(document).ready(function(e) {
        //     $("#recipecount").on('submit', (function(e) {
        //         e.preventDefault();
        //         //$('#loader-icon').show();
        //         //var valid;  
        //         //valid = validateContact();
        //         //if(valid) {
        //         $("#columnChart").load(location.href + " #columnChart");
        //         $("#brandlist").load(location.href + " #brandlist");
        //         $('html,body').animate({
        //             scrollTop: $('#columnChart').offset().top
        //         }, 0);
        //         $.ajax({
        //             url: "reports/recipecount.php",
        //             type: "POST",
        //             data: new FormData(this),
        //             contentType: false,
        //             cache: false,
        //             processData: false,
        //             success: function(data) {
        //                 var obj = jQuery.parseJSON(data);
        //                 var string1 = obj.error;
        //                 var output = obj.error_msg;
        //                 var dates = obj.dates;
        //                 var monthwiserc = obj.monthlywiserc;
        //                 var month = obj.monthly;
        //                 //console.log(weekwiserc); 
        //                 //console.log(week);
        //                 if (obj.error == 0 && dates[0] != '') {



        //                     //hourly graph seperate

        //                     var options = {
        //                         chart: {
        //                             // type: "area",
        //                             type: "bar",
        //                             height: 300,
        //                             foreColor: "#999",
        //                             stacked: true,
        //                             dropShadow: {
        //                                 enabled: true,
        //                                 enabledSeries: [0],
        //                                 top: -2,
        //                                 left: 2,
        //                                 blur: 5,
        //                                 opacity: 0.06
        //                             }
        //                         },
        //                         colors: ['#00E396', '#00E396'],
        //                         stroke: {
        //                             curve: "smooth",
        //                             width: 3
        //                         },
        //                         dataLabels: {
        //                             enabled: false
        //                         },
        //                         series: [{
        //                             name: 'Total Counts',
        //                             data: generateDayWiseTimeSeries(0, month.length)
        //                         }],
        //                         markers: {
        //                             size: 0,
        //                             strokeColor: "#fff",
        //                             strokeWidth: 3,
        //                             strokeOpacity: 1,
        //                             fillOpacity: 1,
        //                             hover: {
        //                                 size: 6
        //                             }
        //                         },
        //                         xaxis: {
        //                             type: "datetime",
        //                             axisBorder: {
        //                                 show: false
        //                             },
        //                             axisTicks: {
        //                                 show: false
        //                             }
        //                         },
        //                         yaxis: {
        //                             labels: {
        //                                 offsetX: 14,
        //                                 offsetY: -5
        //                             },
        //                             tooltip: {
        //                                 enabled: true
        //                             }
        //                         },
        //                         grid: {
        //                             padding: {
        //                                 left: -5,
        //                                 right: 5
        //                             }
        //                         },
        //                         tooltip: {
        //                             x: {
        //                                 format: "MMM yyyy"
        //                             },
        //                         },
        //                         legend: {
        //                             position: 'top',
        //                             horizontalAlign: 'left'
        //                         },
        //                         fill: {
        //                             type: "solid",
        //                             fillOpacity: 0.7
        //                         }
        //                     };

        //                     var chart = new ApexCharts(document.querySelector("#columnChart"), options);

        //                     chart.render();

        //                     function generateDayWiseTimeSeries(s, count) {
        //                         var values = [
        //                             monthwiserc
        //                         ];
        //                         var i = 0;
        //                         var series = [];
        //                         var x = new Date(month[0]).getTime();
        //                         while (i < count) {
        //                             series.push([x, values[s][i]]);
        //                             x += 3600000 * 24 * 31;
        //                             i++;
        //                         }
        //                         return series;
        //                     }

        //                 } else if (obj.error == 2) {
        //                     swal(output);
        //                 } else {

        //                     swal("no data found");

        //                 }
        //             },
        //             error: function() {}

        //         });
        //         //}
        //     }));
        // });


        $(document).ready(function(e) {
            $("#recipecount").on('submit', (function(e) {
                e.preventDefault();
                var string1=output=productthreehourly=threehourly=0;
                //$('#loader-icon').show();
                //var valid;  
                //valid = validateContact();
                //if(valid) {
                 $("#columnChartday").load(location.href + " #columnChartday");
                // $("#brandlist").load(location.href + " #brandlist");
                // $('html,body').animate({
                //     scrollTop: $('#borderedTab').offset().top
                // }, 0);
                $.ajax({
                    url: "reports/recipecount.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        //$("#borderedTabContent").load(location.href + " #borderedTabContent");
                        var obj = jQuery.parseJSON(data);
                        var string1 = obj.error;
                        var output = obj.error_msg;

                        var productthreehourly = obj.productthreehourly;
                        var threehourly = obj.threehourly;
                        //console.log(productthreehourly);
                        //console.log(threehourly);
                        if (obj.error == 0 && threehourly[0] != '') {



                            //hourly graph seperate

                            var options = {
                                chart: {
                                    // type: "area",
                                    type: "line",
                                    height: 300,
                                    foreColor: "#999",
                                    stacked: true,
                                    dropShadow: {
                                        enabled: true,
                                        enabledSeries: [0],
                                        top: -2,
                                        left: 2,
                                        blur: 5,
                                        opacity: 0.06
                                    }
                                },
                                colors: ['#0090FF', '#00E396'],
                                stroke: {
                                    curve: "smooth",
                                    width: 3
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                series: [{
                                    name: 'Total Counts',
                                    data: generateDayWiseTimeSeries(0, threehourly.length)
                                }],
                                markers: {
                                    size: 0,
                                    strokeColor: "#fff",
                                    strokeWidth: 3,
                                    strokeOpacity: 1,
                                    fillOpacity: 1,
                                    hover: {
                                        size: 6
                                    }
                                },
                                xaxis: {
                                    type: "datetime",
                                    axisBorder: {
                                        show: false
                                    },
                                    axisTicks: {
                                        show: false
                                    }
                                },
                                yaxis: {
                                    labels: {
                                        offsetX: 14,
                                        offsetY: -5
                                    },
                                    tooltip: {
                                        enabled: true
                                    }
                                },
                                grid: {
                                    padding: {
                                        left: -5,
                                        right: 5
                                    }
                                },
                                tooltip: {
                                    x: {
                                        format: "dd MMM yyyy HH:mm"
                                    },
                                },
                                legend: {
                                    position: 'top',
                                    horizontalAlign: 'left'
                                },
                                fill: {
                                    type: "solid",
                                    fillOpacity: 0.7
                                }
                            };

                            var chart = new ApexCharts(document.querySelector("#columnChartday"), options);
                           
                            chart.render();

                            function generateDayWiseTimeSeries(s, count) {
                                var values = [
                                    productthreehourly
                                ];
                                var i = 0;
                                var series = [];
                                var x = new Date(threehourly[0]).getTime();
                                while (i < count) {
                                    series.push([x, values[s][i]]);
                                    x += 10800000;
                                    i++;
                                }
                                return series;
                            }

                        } else if (obj.error == 2) {
                            swal(output);
                        } else {

                            swal("no data found");

                        }
                    },
                    error: function() {}

                });
                //}
            }));
        });
        $(document).ready(function(e) {
            $("#recipecount").on('submit', (function(e) {
                var hourly=hourwiserc=dates=output=string1=0;
                var fromdate = document.getElementById('fromdate').value;
                var todate = document.getElementById('todate').value;
                var d1 = new Date(fromdate);
                var d2 = new Date(todate);

                var diff = d2.getTime() - d1.getTime();

                var daydiff = diff / (1000 * 60 * 60 * 24);
               // console.log(daydiff);
                if (daydiff > 3) {
                    $('#hourly').hide();
                } else {
                    $('#hourly').show();
                }
                e.preventDefault();
                //$('#loader-icon').show();
                //var valid;  
                //valid = validateContact();
                //if(valid) {
                 $("#columnChart").load(location.href + " #columnChart");
                // $("#brandlist").load(location.href + " #brandlist");
                // $('html,body').animate({
                //     scrollTop: $('#borderedTab').offset().top
                // }, 0);
                $.ajax({
                    url: "reports/recipecount.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                      //  $("#borderedTabContent").load(location.href + " #borderedTabContent");
                        var obj = jQuery.parseJSON(data);
                        var string1 = obj.error;
                        var output = obj.error_msg;
                        var dates = obj.dates;
                        var hourwiserc = obj.hourlywiserc;
                        var hourly = obj.hourly;
                        //console.log(output[data]); 
                        //console.log(dates);
                        window.dispatchEvent(new Event('resize'));
                        if (obj.error == 0 && dates[0] != '') {



                            //hourly graph seperate

                            var options = {
                                chart: {
                                    // type: "area",
                                    redrawOnParentResize: true,
                                    type: "line",
                                    height: 300,
                                    foreColor: "#999",
                                    stacked: true,
                                    dropShadow: {
                                        enabled: true,
                                        enabledSeries: [0],
                                        top: -2,
                                        left: 2,
                                        blur: 5,
                                        opacity: 0.06
                                    }
                                },
                                colors: ['#0090FF', '#00E396'],
                                stroke: {
                                    curve: "smooth",
                                    width: 3
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                series: [{
                                    name: 'Total Counts',
                                    data: generateDayWiseTimeSeries(0, hourly.length)
                                }],
                                markers: {
                                    size: 0,
                                    strokeColor: "#fff",
                                    strokeWidth: 3,
                                    strokeOpacity: 1,
                                    fillOpacity: 1,
                                    hover: {
                                        size: 6
                                    }
                                },
                                xaxis: {
                                    type: "datetime",
                                    axisBorder: {
                                        show: false
                                    },
                                    axisTicks: {
                                        show: false
                                    }
                                },
                                yaxis: {
                                    labels: {
                                        offsetX: 14,
                                        offsetY: -5
                                    },
                                    tooltip: {
                                        enabled: true
                                    }
                                },
                                grid: {
                                    padding: {
                                        left: -5,
                                        right: 5
                                    }
                                },
                                tooltip: {
                                    x: {
                                        format: "dd MMM yyyy HH:mm"
                                    },
                                },
                                legend: {
                                    position: 'top',
                                    horizontalAlign: 'left'
                                },
                                fill: {
                                    type: "solid",
                                    fillOpacity: 0.7
                                }
                            };

                            var chart = new ApexCharts(document.querySelector("#columnChart"), options);
                            
                            chart.render();

                            function generateDayWiseTimeSeries(s, count) {
                                var values = [
                                    hourwiserc
                                ];
                                var i = 0;
                                var series = [];
                                var x = new Date(hourly[0]).getTime();
                                while (i < count) {
                                    series.push([x, values[s][i]]);
                                    x += 3600000;
                                    i++;
                                }
                                return series;
                            }

                        } else if (obj.error == 2) {
                            swal(output);
                        } else {

                            swal("no data found");

                        }
                    },
                    error: function() {}

                });
                //}
            }));
        });
    </script>
    <script>
        function refresh() {
            $("#columnChartmonthly").load(location.href + " #columnChartmonthly");
        }
    </script>
    <script src="assets/js/table2excel.js" type="text/javascript"></script> 
    <script type="text/javascript">

    </script>
</body>

</html>