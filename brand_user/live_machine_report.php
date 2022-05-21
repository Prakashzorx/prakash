<?php
$query = "";

if (isset($_POST)) {




    if ($_POST["city"]) {
        $city = $_POST["city"];
        $query .= "AND `store`.`city`='$city'";
    } else {
        $query .= "";
    }

    if ($_POST["state"]) {
        $state = $_POST["state"];
        $query .= "AND `store`.`state`='$state'";
    } else {
        $query .= "";
    }

    if ($_POST["country"]) {
        $country = $_POST["country"];
        $query .= "AND `store`.`country`='$country'";
    } else {
        $query .= "";
    }

    // if ($_POST["store"]) {
    //     $store = $_POST["store"];
    // }
    // if ($_POST["user"]) {
    //     $user = $_POST["user"];
    // }
    if ($_POST["brand"]) {
        $brand = $_POST["brand"];
        $query .= "AND `brand_tbl`.`id`='$brand'";
    } else {
        $query .= "";
    }
    // if ($_POST["machine"]) {
    //     $machine = $_POST["machine"];
    // }
    if ($_POST["ptype"]) {
        $ptype = $_POST["ptype"];
        $query .= "AND `machines`.`ptype_id`='$ptype'";
    } else {
        $query .= "";
    }
}
?>
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
            <h1>Live Machines Report</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Live Machines Report</li>
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
                            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-justified" type="button" role="tab" aria-controls="home" aria-selected="true">Live Machines</button>
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
                                    <form class="row g-3" id="" action="live_machine_report.php" method="POST">

                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="brand" name="brand" aria-label="State">

                                                    <!-- <option value="" selected>All</option> -->
                                                    <?php
                                                    // $result = getBrands();
                                                    // $i = 0;
                                                    // //print_r($result);
                                                    // foreach ($result as $row) {
                                                    //     $i++;
                                                    ?>
                                                    <option value="<?php echo $brand; ?>" selected><?php echo $brandname['brand_name']; ?></option>
                                                    <?php
                                                    // }
                                                    ?>
                                                    <?php
                                                    if ($_POST["brand"]) {
                                                    ?>
                                                        <script>
                                                            $("#brand").val(<?php echo $_POST["brand"]; ?>);
                                                        </script>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingSelect">Brand</label>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="ptype" name="ptype" aria-label="">
                                                    <option value="">All</option>
                                                    <?php
                                                    $ptypes = getPtypeByBrandAndUser($_SESSION['brand'], $_SESSION['uid_user']);
                                                    //print_r($ptypes);
                                                    foreach ($ptypes  as $ptype) {
                                                    ?>
                                                        <option value="<?php echo $ptype['id']; ?>"><?php echo $ptype['name']; ?> <?php echo $ptype['version']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($_POST["ptype"]) {
                                                    ?>
                                                        <script>
                                                            $("#ptype").val(<?php echo $_POST["ptype"]; ?>);
                                                        </script>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingSelect">Product Type</label>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="country" name="country" aria-label="State">
                                                    <option value="" selected></option>
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
                                                    <?php
                                                    if ($_POST["country"]) {
                                                    ?>
                                                        <script>
                                                            $("#country").val(<?php echo $_POST["country"]; ?>);
                                                        </script>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingSelect">Country</label>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="state" name="state" aria-label="State">
                                                    <option value="" selected></option>
                                                    <?php

                                                    $result = getStates($_POST["country"]);
                                                    foreach ($result as $row) {
                                                        //print_r($result);
                                                    ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row["name"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($_POST["state"]) {
                                                    ?>
                                                        <script>
                                                            $("#state").val(<?php echo $_POST["state"]; ?>);
                                                        </script>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                                <label for="floatingSelect">States</label>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="city" name="city" aria-label="State">
                                                    <option value="" selected></option>
                                                    <?php

                                                    $result = getCities($_POST["state"]);
                                                    foreach ($result as $row) {
                                                        //print_r($result);
                                                    ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row["name"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($_POST["city"]) {
                                                    ?>
                                                        <script>
                                                            $("#city").val(<?php echo $_POST["city"]; ?>);
                                                        </script>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingSelect">City</label>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-3">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="floatingSelect" aria-label="State">
                                                    <option selected>..</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                </select>
                                                <label for="floatingSelect">Streets</label>
                                            </div>
                                        </div> -->

                                        <!-- <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="floatingSelect" aria-label="State">
                                                    <option selected>..</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                </select>
                                                <label for="floatingSelect">Machines</label>
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-md-3">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="floatingSelect" aria-label="State">
                                                    <option selected>..</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                </select>
                                                <label for="floatingSelect">Recipe Name</label>
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="floatingEmail" placeholder="From Date">
                                                <label for="floatingEmail">From Date</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="floatingEmail" placeholder="To Date">
                                                <label for="floatingEmail">To Date</label>
                                            </div>
                                        </div> -->

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                            <input type="button" class="btn btn-success" id="btnExport" value="export">
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
                        <h5 class="card-title">Column Chart</h5>


                        <div id="chart"></div>


                        <?php
                        //   $query = "";

                        ?>
                        <script>
                            // $(function() {
                            //     $('html, body').animate({
                            //         scrollTop: $("#tablelist").offset().top
                            //     }, 2000);
                            // });
                        </script>
                        <?php

                        // if ($_POST["city"]) {
                        //     $city = $_POST["city"];
                        //     $query .= "AND `cities`.`id`='$city'";
                        // } else {
                        //     $query .= "";
                        // }

                        // if ($_POST["state"]) {
                        //     $state = $_POST["state"];
                        //     $query .= "AND `states`.`id`='$state'";
                        // } else {
                        //     $query .= "";
                        // }

                        // if ($_POST["country"]) {
                        //     $country = $_POST["country"];
                        //     $query .= "AND `countries`.`id`='$country'";
                        // } else {
                        //     $query .= "";
                        // }

                        // // if ($_POST["store"]) {
                        // //     $store = $_POST["store"];
                        // // }
                        // // if ($_POST["user"]) {
                        // //     $user = $_POST["user"];
                        // // }
                        // if ($_POST["brand"]) {
                        //     $brand = $_POST["brand"];
                        //     $query .= "AND `brand_tbl`.`id`='$brand'";
                        // } else {
                        //     $query .= "";
                        // }
                        // // if ($_POST["machine"]) {
                        // //     $machine = $_POST["machine"];
                        // // }
                        // if ($_POST["ptype"]) {
                        //     $ptype = $_POST["ptype"];
                        //     $query .= "AND `machines`.`ptype_id`='$ptype'";
                        // } else {
                        //     $query .= "";
                        // }
                        $brand = $_SESSION['brand'];
                        $uid = $_SESSION['uid_user'];
                        //print_r($_SESSION['brand']);//exit;
                        $query .= "AND `brand_tbl`.`id`='$brand' AND `users`.`user_id`='$uid'";
                        $data[0] = 0;
                        $data[1] = 0;
                        //print_r($query);exit;
                        $result = getLivemachines($query);
                        //$result = getLivemachines();
                        $i = 0;
                        $k = 0;
                        // print_r($result);
                        // exit;
                        foreach ($result as $row) {
                            $i++;
                            $machines = getSingleMachineByName($row['SLN']);
                            $machines = $machines[1];
                            //print_r($machines);
                            $device = getAssignedDevice($machines['id']);
                            //print_r($device);//exit;
                            $device = $device[1];
                            $brand = getBrand($device['brand_id']);

                            //print_r($brand);
                            $user = getSingleuser($device['user_id']);
                            $store = getSingleStore($device['store_id']);
                            $ptype = $machines['ptype_id'];
                            $ptype_name = getptype($ptype);
                            //print_r($ptype_name);
                            $countryname = getCountriesById($store['country']);
                            $statename = getStatesById($store['state']);
                            $cityname = getCityById($store['city']);
                            //print_r($countryname['name']);
                            $time = strtotime($row['timestamp']);
                            //print_r($time . " ");
                            //exit;
                            date_default_timezone_set("Asia/Kolkata");

                            $local = date("Y-m-d H:i:s", $time);
                            // print_r($local);
                            //exit;

                            $datetime1 = new DateTime();
                            //print_r($datetime1);
                            $datetime2 = new DateTime($local);
                            //print_r($datetime2);
                            $interval = $datetime1->diff($datetime2);
                            //print_r($interval);//exit;
                            $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
                            //echo $elapsed;exit;
                            // if($interval->y!=0){
                            //     $daysvalue=$interval->y;
                            // }else if($interval->m!=0){
                            //     $daysvalue=$interval->m;
                            // }
                            // else if($interval->m!=0){
                            //     $daysvalue=$interval->m;
                            // }
                            $name = ['live', 'Offline'];
                            if ($interval->days > 3) {

                                $data[1] += 1;
                            } else {
                                $data[0] += 1;
                            }
                        }
                        //print_r($data);exit;

                        if (!empty($result)) {


                        ?>

                            <script>
                                //console.log(data);

                                document.addEventListener("DOMContentLoaded", () => {
                                    var data = <?php echo json_encode($data); ?>;
                                    var name = <?php echo json_encode($name); ?>;
                                    var options = {
                                        series: data,
                                        labels: name,
                                        chart: {
                                            width: 380,
                                            type: 'donut',
                                        },
                                        dataLabels: {
                                            enabled: false
                                        },
                                        responsive: [{
                                            breakpoint: 480,
                                            options: {
                                                chart: {
                                                    width: 200
                                                },
                                                legend: {
                                                    show: false
                                                }
                                            }
                                        }],
                                        legend: {
                                            position: 'right',
                                            offsetY: 0,
                                            height: 230,
                                        }
                                    };

                                    var chart = new ApexCharts(document.querySelector("#chart"), options);
                                    chart.render();


                                });
                            </script>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>


            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Live Machines List</h5>


                        <!-- Table with stripped rows -->
                        <table id="brandlist" class="table datatable display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Machine Number</th>
                                    <!-- <th scope="col">Days</th> -->
                                    <th scope="col">Brand</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">State</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Product Type</th>
                                    <!-- <th scope="col">Person Name</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th> -->

                                    <!-- <th style="display:none"></th> -->
                                </tr>
                            </thead>
                            <tbody id="brandlist1">


                                <script>
                                    $(function() {
                                        // $('html, body').animate({
                                        //     scrollTop: $("#tablelist").offset().top
                                        // }, 2000);
                                    });
                                </script>
                                <?php
                                $brand = $_SESSION['brand'];
                                $uid = $_SESSION['uid_user'];
                                //print_r($_SESSION['brand']);//exit;
                                $query .= "AND `brand_tbl`.`id`='$brand' AND `users`.`user_id`='$uid'";
                                $result = getLivemachines($query);
                                //$result = getLivemachines();
                                $i = 0;
                                $k = 0;
                                //print_r($result);
                                //exit;
                                foreach ($result as $row) {
                                    $i++;
                                    $machines = getSingleMachineByName($row['SLN']);
                                    $machines = $machines[1];
                                    //print_r($machines);
                                    $device = getAssignedDevice($machines['id']);
                                    //print_r($device);//exit;
                                    $device = $device[1];
                                    $brand = getBrand($device['brand_id']);

                                    //print_r($brand);
                                    $user = getSingleuser($device['user_id']);
                                    $store = getSingleStore($device['store_id']);
                                    $ptype = $machines['ptype_id'];
                                    $ptype_name = getptype($ptype);
                                    //print_r($ptype_name);
                                    $countryname = getCountriesById($store['country']);
                                    $statename = getStatesById($store['state']);
                                    $cityname = getCityById($store['city']);
                                    //print_r($countryname['name']);
                                    $time = strtotime($row['timestamp']);
                                    //print_r($time . " ");
                                    //exit;
                                    date_default_timezone_set("Asia/Kolkata");

                                    $local = date("Y-m-d H:i:s", $time);
                                    // print_r($local);
                                    //exit;

                                    $datetime1 = new DateTime();
                                    //print_r($datetime1);
                                    $datetime2 = new DateTime($local);
                                    //print_r($datetime2);
                                    $interval = $datetime1->diff($datetime2);
                                    //print_r($interval);//exit;
                                    $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
                                    //echo $elapsed;exit;
                                    // if($interval->y!=0){
                                    //     $daysvalue=$interval->y;
                                    // }else if($interval->m!=0){
                                    //     $daysvalue=$interval->m;
                                    // }
                                    // else if($interval->m!=0){
                                    //     $daysvalue=$interval->m;
                                    // }
                                    if ($interval->days <= 3) {
                                        $k++;
                                ?>

                                        <tr data-bs-toggle="modal" data-bs-target="#verticalycentered1">
                                            <th scope="row"><?php echo $k; ?></th>
                                            <td><?php echo $row['SLN']; ?></td>
                                            <!-- <td><?php echo $interval->days  . " days"; ?></td> -->
                                            <td><?php echo $brand['brand_name']; ?></td>


                                            <td><?php echo $countryname['name']; ?></td>
                                            <td><?php echo $statename['name']; ?></td>
                                            <td><?php echo $cityname['name']; ?></td>
                                            <td><?php echo $ptype_name['name'] . ' ' . $ptype_name['version']; ?></td>
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
        </section>

    </main><!-- End #main -->

    <?php include "footer.php"; ?>


    <script>
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
                        $('#city').html('<option value=""></option>');
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
            $("#livemachines").on('submit', (function(e) {
                e.preventDefault();
                // $('#loader-icon').show();
                //var valid;  
                //valid = validateContact();
                //if(valid) {
                $.ajax({
                    url: "reports/livemachines.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        var string1 = obj.error;
                        var output = obj.error_msg;
                        var dates = obj.dates;
                        if (obj.error == 0) {
                            //swal(output);
                            // console.log(output);
                            // console.log(dates);
                            // $.each(output, myFunction);



                            // function myFunction(index, item) {
                            //     console.log(item.SLN);
                            //     var response = item;

                            // }

                            var options = {
                                series: output,
                                chart: {
                                    type: 'bar',
                                    height: 350
                                },
                                plotOptions: {
                                    bar: {
                                        horizontal: false,
                                        columnWidth: '55%',
                                        endingShape: 'rounded'
                                    },
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                stroke: {
                                    show: true,
                                    width: 2,
                                    colors: ['transparent']
                                },
                                xaxis: {
                                    categories: dates,
                                },
                                yaxis: {
                                    title: {
                                        text: 'Count'
                                    }
                                },
                                fill: {
                                    opacity: 1
                                },
                                tooltip: {
                                    y: {
                                        formatter: function(val) {
                                            return " " + val + " counts"
                                        }
                                    }
                                }
                            };

                            var chart = new ApexCharts(document.querySelector("#columnChart"), options);
                            chart.render();


                            // $.getJSON('http://my-json-server.typicode.com/apexcharts/apexcharts.js/yearly', function(response) {
                            //     chart.updateSeries([{
                            //         name: 'Sales',
                            //         data: response
                            //     },{
                            //         name: 'Hike',
                            //         data: response
                            //     }])
                            // });



                        } else {

                            swal(output);

                        }
                    },
                    error: function() {}

                });
                //}
            }));
        });
    </script>
    <script src="assets/js/table2excel.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $("#btnExport").click(function() {
                $("#brandlist").table2excel({
                    filename: "Table.xls"
                });
            });
        });
    </script>
</body>

</html>