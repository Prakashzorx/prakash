<?php
require_once "controller/tcp_function.php";
require_once   "controller/device_datatables.php";
//Start the session.
session_start();
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
    <?php
    //  require_once "controller/functions.php"; 
    //require_once "controller/tcp_function.php"; 
    ?>
    <!-- Datatable CSS -->
    <link href='//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>


    <!-- jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Datatable JS -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>TCP Data Report</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item ">TCP </li>
                    <li class="breadcrumb-item active">TCP Data Report</li>

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
                            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-justified" type="button" role="tab" aria-controls="home" aria-selected="true">TCP Data</button>
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
                                    <form class="row g-3" id="tcp_report">


                                        <div class="col-md-3">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="imei" name="imei" aria-label="">
                                                    <option value=""></option>
                                                    <?php
                                                    $ptypes = [];
                                                    $ptypes = gettcpdata();
                                                    foreach ($ptypes  as $ptype) {

                                                    ?>
                                                        <option value="<?php echo $ptype['imei']; ?>"><?php echo $ptype['imei']; ?></option>
                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                                <label for="floatingSelect">IMEI</label>
                                            </div>
                                        </div>

                                        <br>


                                        <div class="col-md-3">
                                            <div class="form-floating mb-3" id="statediv">
                                                <select class="form-select" id="alarm" name="alarm" aria-label="">
                                                    <option value="">All </option>
                                                    <option value="aa">Interval data</option>
                                                    <option value="10">Low Battery alarm</option>
                                                    <option value="a0">Temprature over threshold</option>
                                                    <option value="a1">Temprature sensor ubnormal</option>
                                                    <option value="61"> External power disconnect</option>

                                                </select>
                                                <label for="floatingSelect">Alarm type</label>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="fromdate" name="fromdate" max="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d', strtotime("-0 days", strtotime(date('Y-m-d')))); ?>" placeholder="From Date">
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
                                            <button type="button" id="submit" class="btn btn-primary">Submit</button>
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
                        <h5 class="card-title">TCP GRAPH</h5>
                        <!-- Bordered Tabs -->
                        <!-- <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                            <li class="nav-item" role="presentation" id="hourly">
                                <button class="nav-link " id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true" >Hourly</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2" id="borderedTabContent">
                            <div class="tab-pane fade " id="bordered-home" role="tabpanel" aria-labelledby="home-tab"> -->
                        <!-- <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                           -->
                        <h5 class="card-title"></h5>
                        <div id="columnChart"></div>


                        <!-- </div>
                                    </div>
                                </div> -->
                        <!-- </div>

                        </div> -->
                    </div>
                </div>
            </div>

            <div class="col-lg-12" id="tcp_table">
                <!-- <div class="col-lg-12"> -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">TCP DATA</h5>


                        <!-- Table with stripped rows -->
                        <table id="brandlist" class='display dataTable' style="width:100%">
                            <thead>
                                <tr>
                                    <!-- <th scope="col">#</th> -->

                                    <th scope="col">date</th>
                                    <th scope="col">imei</th>
                                    <th scope="col">alarm type</th>
                                    <th scope="col">wifi</th>
                                    <th scope="col">status</th>
                                    <th scope="col">temprature</th>
                                    <th scope="col">battery voltage</th>

                                </tr>
                            </thead>
                            <tbody id="brandlist1">






                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
            <div class="col-lg-12" id="tcp_table1" style="display:none">
                <!-- <div class="col-lg-12"> -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">TCP DATA</h5>


                        <!-- Table with stripped rows -->
                        <table id="tcplist" class='display dataTable' style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>

                                    <th scope="col">date</th>
                                    <th scope="col">imei</th>
                                    <th scope="col">alarm type</th>
                                    <th scope="col">wifi</th>
                                    <th scope="col">status</th>
                                    <th scope="col">temprature</th>
                                    <th scope="col">battery voltage</th>

                                </tr>
                            </thead>
                            <tbody id="tcpl">






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

            $("#submit").on('click', (function(e) {

                var data = $('form').serialize();
                var imei = $("#imei").val();
                var alarm = $("#alarm").val();
                var fromdate = $("#fromdate").val();
                var todate = $("#todate").val();
                //$("#brandlist").load(location.href + " #brandlist");
                $('#brandlist').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'destroy': true,
                    'searching': true,
                    'serverMethod': 'post',
                    'ajax': {
                        'url': 'reports/tcp_process.php',
                        'data': [{
                                imei: imei
                            },
                            {
                                alarm: alarm
                            },
                            {
                                fromdate: fromdate
                            },
                            {
                                todate: todate
                            }
                        ]


                    },
                    'columns': [{
                            data: 'rct_timestamp'
                        },
                        {
                            data: 'imei'
                        },
                        {
                            data: 'alarm_type'
                        },
                        {
                            data: 'wifi'
                        },
                        {
                            data: 'status'
                        },
                        {
                            data: 'temp'
                        },
                        {
                            data: 'bv'
                        },
                    ],





                });

                $.ajax({

                    type: 'post',
                    url: 'reports/tcp_chart.php',
                    data: data,
                    success: function(responce) {

                        var obj = jQuery.parseJSON(responce);
                        //console.log(obj);
                        var imei = obj.imei;
                        var temp = [];
                        var timestamp = [];
                        var low_threshold = '';
                        var high_threshold = '';
                        var stringval = [];
                        var iqw = 0;
                        imei.forEach(element => {
                            // console.log(element);
                            // console.log(obj[element]);
                            if (obj[element] != null) {
                                temp = obj[element].temp;
                                timestamp = obj[element].dateInLocal;
                                //console.log(temp);  
                                //temp.foreach(element1 => {
                                stringval.push({
                                    name: element,
                                    data: generateDayWiseTimeSeries(timestamp, temp)
                                });
                                //iqw++
                                //})
                                low_threshold = obj.tcp_low_threshold;
                                high_threshold = obj.tcp_high_threshold;
                            }

                        });

                        if (temp == '') {
                            //console.log(stringval);
                            var options = {
                                chart: {
                                    type: "line",
                                    height: 300,
                                    //foreColor: "#999",
                                    // stacked: true,
                                    // dropShadow: {
                                    //     enabled: true,
                                    //     enabledSeries: [0],
                                    //     top: -2,
                                    //     left: 2,
                                    //     blur: 5,
                                    //     opacity: 0.06
                                    // }
                                },
                                // colors: ['red','black','blue'],
                                stroke: {
                                    curve: "smooth",
                                    width: 3
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                series: stringval,
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
                                },
                                // annotations: {
                                //     yaxis: [{
                                //         y: low_threshold,
                                //         y2: high_threshold,
                                //         strokeDashArray: 5,
                                //         borderColor: 'red',
                                //         fillColor: '',
                                //         borderWidth: '15px',
                                //         opacity: 0.3,
                                //         // offsetX: 0,
                                //         // offsetY: -3,
                                //         width: '100%',
                                //         label: {
                                //             // borderColor: '#c2c2c2',
                                //             // borderWidth: 1,
                                //             // borderRadius: 2,
                                //             text: 'Thresholds',
                                //             textAnchor: 'end',
                                //             position: 'right',
                                //             // offsetX: 0,
                                //             // offsetY: 0,
                                //             // mouseEnter: undefined,
                                //             //  mouseLeave: undefined,
                                //             // text: 'Y-axis range'
                                //         }
                                //     }]
                                // }
                            };

                            var chart = new ApexCharts(document.querySelector("#columnChart"), options);

                            chart.render();

                            function generateDayWiseTimeSeries(timestamp, temp) {

                                var i = 0;
                                var series = [];
                                var count = temp.length;
                                // var x = new Date("11 Nov 2012").getTime();
                                while (i < count) {
                                    series.push([timestamp[i], temp[i]]);
                                    //x += 86400000;
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



                //     }

                // });
            }));
        });


        $(document).ready(function(e) {
            $("#export").on('click', (function(e) {

                // $("#tcpl").html('<tr><td></td></tr>');
                $("#tcplist").load(location.href + " #tcplist");
                var output = [];
                // var imei = $("#imei").val();
                // var alarm = $("#alarm").val();
                //   var fromdate = $("#fromdate").val();
                // var todate = $("#todate").val();

                // console.log(ptype+"..."+machine+"..."+brand+"..."+user+"..."+country+"..."+state+"..."+city);  
                // var dataString={ptype:ptype};//+"&machine="+machine+"&brand="+brand+"&user="+user+"&country="+country+"&state="+state+"&city="+city+"&fromdate="+fromdate+"&todate="+todate;
                var data = $('form').serialize();
                $.ajax({

                    type: 'post',
                    url: 'reports/tcp_export.php',
                    data: data,
                    cache: false,
                    processData: false,
                    success: function(responce) {

                        // console.log(responce);
                        var obj = jQuery.parseJSON(responce);
                        //console.log(obj);
                        //var string1 = obj.error;
                        output = obj.result;
                        // console.log(output);
                        if (obj.error == 0 && output[0] != '') {
                            //swal(output);


                            var k = 0;
                            $.each(output, function(i, item) {
                                //$('#brandlist').append('<br/>');
                                // $.each(dates, function(i, field) {
                                // if (field != '' && item.data[i] != 0) {
                                k++;
                                var date = item.rct_timestamp;
                                var d = new Date(date);
                                var seconds = d.getTime();
                                // console.log(seconds);
                                var d = new Date(seconds);
                                var datestring = d.toLocaleString();
                                //var datestring = d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear() + " " +d.getHours() + ":" + d.getMinutes()+ ":" + d.getSeconds();
                                var imei = item.imei;
                                var alarm = item.alarm_type;

                                if (alarm == 'aa') {
                                    alarm = 'Interval Data';
                                } else
                                if (alarm == '10') {
                                    alarm = 'Low Battery Alarm';
                                } else
                                if (alarm == 'a0') {
                                    alarm = 'Temperature Over Threshold';
                                } else
                                if (alarm == 'a1') {
                                    alarm = 'Temperature sensor abnormal';
                                } else
                                if (alarm == '61') {
                                    alarm = 'External Power Disconnected';
                                }
                                var wifi = item.wifi;
                                var ws = item.wifistatus;
                                var tmp = item.temp;
                                var bv = item.battery_voltage;
                                $('#tcpl').append('<tr><th scope="row">' + k + '</th><td>' + datestring + '</td><td>' + imei + '</td><td>' + alarm + '</td><td>' + wifi + '</td><td>' + ws + '</td><td>' + tmp + '</td><td>' + bv + '</td></tr>');
                                //  }
                                // $.each(item.data, function(i, data) {

                                // });
                                // });
                            });

                            $(function() {

                                $("#tcplist").table2excel({
                                    filename: "TCP-PORT-MACHINE-DATA.xls"
                                });

                            });




                        } else if (obj.error == 2) {
                            swal(output);
                        }
                    },
                    error: function() {}

                });
            }));
        });





        // $(document).ready(function() {

        //     $("#submit").on('click', (function(e) {

        //         var data = $('form').serialize();
        //         var imei = $("#imei").val();
        //         var alarm = $("#alarm").val();
        //         var fromdate = $("#fromdate").val();
        //         var todate = $("#todate").val();
        //         //$("#brandlist").load(location.href + " #brandlist");


        //         $.ajax({

        //             type: 'post',
        //             url: 'reports/tcp_chart.php',
        //             data: data,
        //             success: function(responce) {

        //                 // console.log(responce);
        //                 var obj = jQuery.parseJSON(responce);
        //                  //console.log(obj);
        //                 var temp = obj.temp;
        //                 var timestamp = obj.dateInLocal;
        //                 // var dates = obj.dates;
        //                 // var monthwiserc = obj.monthlywiserc;
        //                 // var month = obj.monthly;
        //                 // console.log(temp[0]);
        //                 // console.log(timestamp[0]);
        //                 // month.forEach(dateconvert);

        //                 // function dateconvert(item, index) {
        //                 //     // var dt = new Date(item);
        //                 //     var date = new Date(item);
        //                 //     // console.log();
        //                 //     // var d = new Date(dt.setDate(date.getDate() + 0));
        //                 //     // var curr_date = d.getDate();

        //                 //     // var curr_month = d.getMonth() + 1;

        //                 //     // var curr_year = d.getFullYear();

        //                 //     // curr_year = curr_year.toString().substr(2, 2);

        //                 //     var v = date.getTime();
        //                 //     var datenew = date.toString("MMM yyyy");
        //                 //     month[index] = datenew; //curr_date + "-" + curr_month + "-" + curr_year;
        //                 // }
        //                 // if ( temp[0] != '') {




        //                 document.addEventListener("DOMContentLoaded", () => {
        //                     const series = {
        //                         "monthDataSeries1": {
        //                             "prices": temp,
        //                             "dates": timestamp
        //                         },

        //                     }
        //                     new ApexCharts(document.querySelector("#columnChart"), {
        //                         series: [{
        //                             name: "STOCK ABC",
        //                             data: series.monthDataSeries1.prices
        //                         }],
        //                         chart: {
        //                             type: 'area',
        //                             height: 350,
        //                             zoom: {
        //                                 enabled: false
        //                             }
        //                         },
        //                         dataLabels: {
        //                             enabled: false
        //                         },
        //                         stroke: {
        //                             curve: 'straight'
        //                         },
        //                         subtitle: {
        //                             text: 'Price Movements',
        //                             align: 'left'
        //                         },
        //                         labels: series.monthDataSeries1.dates,
        //                         xaxis: {
        //                             type: 'datetime',
        //                         },
        //                         yaxis: {
        //                             opposite: true
        //                         },
        //                         legend: {
        //                             horizontalAlign: 'left'
        //                         }
        //                     }).render();
        //                 });


        //                 // } else if (obj.error == 2) {
        //                 //     swal(output);
        //                 // } else {

        //                 //     swal("no data found");

        //                 // }

        //             },
        //             error: function() {}

        //         });




        //         //     }

        //         // });
        //     }));
        // });
    </script>
    <script src="assets/js/table2excel.js" type="text/javascript"></script>
    <script type="text/javascript">

    </script>
    <!-- <script src='https://code.jquery.com/jquery-1.12.3.js'></script>
    <script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js'></script>
    <script src="assets/js/script_tcp.js"></script> -->
</body>

</html>