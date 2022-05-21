<?php
require_once 'controller/functions.php';
require_once 'controller/tcp_function.php';
//Start the session.
session_start();
print_r($_SESSION);
//If the session variable does not exist,
//presume that the page has not been refreshed yet.
if (!isset($_SESSION['already_refreshed'])) {

  //Number of seconds to refresh the page after.
  $refreshAfter = 5;

  //Send a Refresh header.
  //header('Refresh: ' . $refreshAfter);

  //Set the session variable so that we don't
  //refresh again.
  $_SESSION['already_refreshed'] = true;
}

if (isset($_GET["prod"])) {

  $prod = $_GET["prod"];

  if ($prod == 'all') {
    $value = getdistinctdate();


    $i = 0;
    foreach ($value as $date) {
      //print_r($data['rec_count']);
      //print_r($date['date']);
      $count = 0;
      $sort = getdata();
      foreach ($sort as $data) {

        if ($data['date'] == $date['date']) {
          $count = $data['rec_count'] + $count;
        }
      }
      $dataPoints[$i] = array("x" => $date['date'], "y" => $count);
      $i++;
    }
  } else {
    $value = getdatasingle($prod);

    $i = 0;

    foreach ($value as $data) {
      //print_r($data['rec_count']);

      //if($data=='')

      $dataPoints[$i] = array("x" => $data['date'], "y" => $data['rec_count']);
      $i++;
    }
  }

  $xyz = json_encode($dataPoints);
  //print_r();
}
$brand1=0;

// print_r($_SESSION);exit;
if(isset($_SESSION['brand1'])){
  $brand1=$_SESSION['brand1'];

}
// print_r($brand1 );exit;
$query1 = "AND `brand_tbl`.`id`='$brand1'";

if (isset($_POST)) {




  // if ($_POST["city"]) {
  //     $city = $_POST["city"];
  //     $query .= "AND `store`.`city`='$city'";
  // } else {
  //     $query .= "";
  // }

  // if ($_POST["state"]) {
  //     $state = $_POST["state"];
  //     $query .= "AND `store`.`state`='$state'";
  // } else {
  //     $query .= "";
  // }

  // if ($_POST["country"]) {
  //     $country = $_POST["country"];
  //     $query .= "AND `store`.`country`='$country'";
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

  <main id="main" class="main">

    <!-- <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div> -->
    <!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">

                <div class="col-lg-3">
                  <!-- <div class="card">
                    <div class="card-body"> -->
                  <h5 class="card-title" style="text-align: center; font-size:24px;">All</h5>

                  <!-- Radial Bar Chart -->
                  <div id="radialBarChart"></div>
                  <?php

                  $data[0] = 0;
                  $data[1] = 0;
                  $data[2] = 0;
                  // print_r($query);exit;
                  $result = getLivemachines($query1);
                  //$result = getLivemachines();
                  $i = 0;
                  $k = 0;
                  $x=0;
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
                    //print_r($interval->days); print_r("  ");
                    if ($interval->days > 3) {

                      $data[2] += 1;
                      $x++;
                    } else if ($interval->days >= 1) {
                      $data[1] += 1;
                      $x++;
                    } else {
                      $data[0] += 1;
                      $x++;
                    }
                  }
                  $total = $x;
                  $name = ['live ('.$data[0].')', 'Idle ('.$data[1].')', 'Down ('.$data[2].')'];
                  // print_r($data); //exit;
                  ?>
                  <script>
                    var dataTotal = <?php echo $total; ?>;
                    var data = <?php echo json_encode($data); ?>;
                    var name0 = <?php echo json_encode($name); ?>;
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#radialBarChart"), {
                        series: data,
                        chart: {
                          //height: 350,
                          type: 'donut',

                        },

                        legend: {
                          show: true,
                          showForSingleSeries: false,
                          showForNullSeries: true,
                          showForZeroSeries: true,
                          position: 'bottom',
                          horizontalAlign: 'center',
                          floating: false,

                          onItemClick: {
                            toggleDataSeries: true
                          },
                          onItemHover: {
                            highlightDataSeries: true
                          },
                        },

                        // dataLabels: {

                        //   enabled: true,
                        //   enabledOnSeries: undefined,
                        //   formatter: function(value, {
                        //     seriesIndex,
                        //     dataPointIndex,
                        //     w
                        //   }) {
                        //     return value
                        //   },
                        // },
                        // title: {
                        //   text: 'total ' + dataTotal,

                        //   align: 'center',

                        dataLabels: {
                              //offset: 20,
                              enabled: false,
                              //enabledOnSeries: undefined,
                              // formatter: function(value, {
                              //   seriesIndex,
                              //   dataPointIndex,
                              //   w
                              //}) {
                              //   return value
                              // },
                            },

                        plotOptions: {
                          pie: {
                            expandOnClick: false,
                            

                            customScale: 1,
                            donut: {
                              size: "70%",
                              labels: {
                                show: true,
                                value: {
                                  show: true,
                                  fontSize: "36px",
                                  color: "#6a6a6a",
                                },
                                total: {
                                  showAlways: true,
                                  show: true,
                                  label: "Total",
                                  fontSize: "16px",
                                  fontWeight: "normal",
                                  color: "#707070",
                                  formatter: function(w) {
                                    return w.globals.seriesTotals.reduce((a, b) => {
                                      return a + b ;
                                      return dataTotal;
                                    }, 0);
                                  },
                                },
                              },

                            },
                          },
                        },


                        labels: name0,
                      }).render();
                    });
                  </script>
                  <!-- End Radial Bar Chart -->

                  <!-- </div>
                  </div> -->
                </div>

                <!-- <div class="col-lg-3">

                  <h5 class="card-title" style="padding: 11px 0 9px 0px;text-align: center;color:black;font-size:30px;">All</h5>

                  
                  <div id="donutChart4" style="border: groove;"></div>

                  <script>
                    var dataTotal = 112;
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#donutChart4"), {
                        series: [44, 55, 13],
                        chart: {
                          //height: 350,
                          type: 'donut',
                          toolbar: {
                            show: true
                          }
                        },
                        title: {
                          text: 'total ' + dataTotal,

                          align: 'center',



                        },
                        total: {
                          show: false,
                          showAlways: false,
                          label: 'Total',
                          fontSize: '22px',
                          fontFamily: 'Helvetica, Arial, sans-serif',
                          fontWeight: 600,
                          color: '#373d3f',
                          formatter: function(w) {
                            return w.globals.seriesTotals.reduce((a, b) => {
                              return a + b
                            }, 0)
                          }
                        },
                        labels: ['Live', 'Idle', 'Down'],
                      }).render();
                    });
                  </script>
                 
                </div> -->

                <div class="col-lg-3">
                  <!-- <div class="card">
                <div class="card-body"> -->
                  <h5 class="card-title" style="text-align: center;">WOKIE</h5>

                  <!-- Donut Chart -->
                  <div id="donutChart1"></div>
                  <?php
                  $query = "AND `product_type`.`name` LIKE 'WOKIE' ".$query1;
                  $data[0] = 0;
                  $data[1] = 0;
                  $data[2] = 0;
                  //print_r($query);exit;
                  //$query = "AND `brand_tbl`.`id`='$brand1'";
                  $result = getLivemachines($query);
                  //$result = getLivemachines();
                  $i = 0;
                  $k = 0;
                  $x = 0;
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
                    if ($interval->days > 3) {

                      $data[2] += 1;
                      $x++;
                    } else if ($interval->days >= 1) {
                      $data[1] += 1;
                      $x++;
                    } else {
                      $data[0] += 1;
                      $x++;
                    }
                    //$name = ['live ('.$data[0].')', 'Idle ('.$data[1].')', 'Down ('.$data[2].')'];
                   
                  }
                  $total = $x;
                  $name = ['live ('.$data[0].')', 'Idle ('.$data[1].')', 'Down ('.$data[2].')'];
                  //print_r($name);//exit;
                  ?>
                  <script>
                    var dataTotal1 = <?php echo $total; ?>;
                    var data1 = <?php echo json_encode($data); ?>;
                    var name1 = <?php echo json_encode($name); ?>;
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#donutChart1"), {
                        series: data1,
                        chart: {
                          //height: 350,
                          type: 'donut',

                        },

                        legend: {
                          show: true,
                          showForSingleSeries: false,
                          showForNullSeries: true,
                          showForZeroSeries: true,
                          position: 'bottom',
                          horizontalAlign: 'center',
                          floating: false,

                          onItemClick: {
                            toggleDataSeries: true
                          },
                          onItemHover: {
                            highlightDataSeries: true
                          },
                        },

                        // dataLabels: {

                        //   enabled: true,
                        //   enabledOnSeries: undefined,
                        //   formatter: function(value, {
                        //     seriesIndex,
                        //     dataPointIndex,
                        //     w
                        //   }) {
                        //     return value
                        //   },
                        // },
                        // title: {
                        //   text: 'total ' + dataTotal,

                        //   align: 'center',

                        dataLabels: {
                              //offset: 20,
                              enabled: false,
                              //enabledOnSeries: undefined,
                              // formatter: function(value, {
                              //   seriesIndex,
                              //   dataPointIndex,
                              //   w
                              //}) {
                              //   return value
                              // },
                            },

                        plotOptions: {
                          pie: {
                            expandOnClick: false,
                            

                            customScale: 1,
                            donut: {
                              size: "70%",
                              labels: {
                                show: true,
                                value: {
                                  show: true,
                                  fontSize: "36px",
                                  color: "#6a6a6a",
                                },
                                total: {
                                  showAlways: true,
                                  show: true,
                                  label: "Total",
                                  fontSize: "16px",
                                  fontWeight: "normal",
                                  color: "#707070",
                                  formatter: function(w) {
                                    return w.globals.seriesTotals.reduce((a, b) => {
                                      return a + b ;
                                    }, 0);
                                  },
                                },
                              },

                            },
                          },
                        },


                        labels: name1,
                      }).render();
                    });
                    // document.addEventListener("DOMContentLoaded", () => {
                    //   new ApexCharts(document.querySelector("#donutChart1"), {
                    //     series: [44, 55, 67],
                    //     chart: {
                    //       //height: 350,
                    //       type: 'radialBar',
                    //       // toolbar: {
                    //       //   show: true
                    //       // }
                    //     },

                    //     legend: {
                    //       show: true,
                    //       showForSingleSeries: false,
                    //       showForNullSeries: true,
                    //       showForZeroSeries: true,
                    //       position: 'bottom',
                    //       horizontalAlign: 'center',
                    //       floating: false,
                    //       fontSize: '14px',
                    //       fontFamily: 'Helvetica, Arial',
                    //       fontWeight: 400,
                    //       formatter: undefined,
                    //       inverseOrder: false,
                    //       width: undefined,
                    //       height: undefined,
                    //       tooltipHoverFormatter: undefined,
                    //       customLegendItems: [],
                    //       offsetX: 0,
                    //       offsetY: 0,
                    //       labels: {
                    //         colors: undefined,
                    //         useSeriesColors: false
                    //       },
                    //       markers: {
                    //         width: 12,
                    //         height: 12,
                    //         strokeWidth: 0,
                    //         strokeColor: '#fff',
                    //         fillColors: undefined,
                    //         radius: 12,
                    //         customHTML: undefined,
                    //         onClick: undefined,
                    //         offsetX: 0,
                    //         offsetY: 0
                    //       },
                    //       itemMargin: {
                    //         horizontal: 5,
                    //         vertical: 0
                    //       },
                    //       onItemClick: {
                    //         toggleDataSeries: true
                    //       },
                    //       onItemHover: {
                    //         highlightDataSeries: true
                    //       },
                    //     },
                    //     plotOptions: {
                    //       radialBar: {
                    //         dataLabels: {
                    //           name: {
                    //             fontSize: '18px',
                    //           },
                    //           value: {
                    //             fontSize: '16px',
                    //           },
                    //           total: {
                    //             show: true,
                    //             label: 'Total',
                    //             formatter: function(w) {
                    //               // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                    //               return 249
                    //             }
                    //           }
                    //         }
                    //       }
                    //     },
                    //     labels: ['Live', 'Idle', 'Down'],
                    //   }).render();
                    // });
                  </script>
                  <!-- End Donut Chart -->

                  <!-- </div>
              </div> -->
                </div>

                <div class="col-lg-3">
                  <!-- <div class="card">
                <div class="card-body"> -->
                  <h5 class="card-title" style="text-align: center;">EPAN</h5>

                  <!-- Donut Chart -->
                  <div id="donutChart2"></div>

                  <?php
                  $query = "AND `product_type`.`name` LIKE 'EPan' ".$query1;
                  $data[0] = 0;
                  $data[1] = 0;
                  $data[2] = 0;
                  $data=[0,0,0];
                  $name=['Live', 'Idle', 'Down'];
                  //print_r($query);exit;
                  $result = getLivemachines($query);
                  //$result = getLivemachines();
                  $i = 0;
                  $k = 0;
                  $x = 0;
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

                    if ($interval->days > 3) {

                      $data[2] += 1;
                      $x++;
                    } else if ($interval->days >= 1) {
                      $data[1] += 1;
                      $x++;
                    } else {
                      $data[0] += 1;
                      $x++;
                    }
                    //$name = ['live ('.$data[0].')', 'Idle ('.$data[1].')', 'Down ('.$data[2].')'];
                  }
                  $total = $x;
                  $name = ['live ('.$data[0].')', 'Idle ('.$data[1].')', 'Down ('.$data[2].')'];
                  //print_r($data);//exit;
                  ?>
                  <script>
                    var dataTotal2 = <?php echo json_encode($total); ?>;
                    var data2 = <?php echo json_encode($data); ?>;
                    var name2 = <?php echo json_encode($name); ?>;
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#donutChart2"), {
                        //series: data2,
                        series: data2,
                        chart: {
                          //height: 350,
                          type: 'donut',

                        },

                        legend: {
                          show: true,
                          showForSingleSeries: false,
                          showForNullSeries: true,
                          showForZeroSeries: true,
                          position: 'bottom',
                          horizontalAlign: 'center',
                          floating: false,

                          onItemClick: {
                            toggleDataSeries: true
                          },
                          onItemHover: {
                            highlightDataSeries: true
                          },
                        },

                        // dataLabels: {

                        //   enabled: true,
                        //   enabledOnSeries: undefined,
                        //   formatter: function(value, {
                        //     seriesIndex,
                        //     dataPointIndex,
                        //     w
                        //   }) {
                        //     return value
                        //   },
                        // },
                        // title: {
                        //   text: 'total ' + dataTotal,

                        //   align: 'center',

                        dataLabels: {
                              //offset: 20,
                              enabled: false,
                              //enabledOnSeries: undefined,
                              // formatter: function(value, {
                              //   seriesIndex,
                              //   dataPointIndex,
                              //   w
                              //}) {
                              //   return value
                              // },
                            },

                        plotOptions: {
                          pie: {
                            expandOnClick: false,
                            

                            customScale: 1,
                            donut: {
                              size: "70%",
                              labels: {
                                show: true,
                                value: {
                                  show: true,
                                  fontSize: "36px",
                                  color: "#6a6a6a",
                                },
                                total: {
                                  showAlways: true,
                                  show: true,
                                  label: "Total",
                                  fontSize: "16px",
                                  fontWeight: "normal",
                                  color: "#707070",
                                  formatter: function(w) {
                                    return w.globals.seriesTotals.reduce((a, b) => {
                                      return a + b ;
                                    }, 0);
                                  },
                                },
                              },

                            },
                          },
                        },



                        labels: name2,
                      }).render();
                    });
                  </script>
                </div>

                <div class="col-lg-3">
                  <!-- <div class="card">
                <div class="card-body"> -->
                  <h5 class="card-title" style="text-align: center;">FRYER</h5>

                  <!-- Donut Chart -->
                  <div id="donutChart3"></div>

                  <?php
                  $query = "AND `product_type`.`name` LIKE 'FRYER' ".$query1;
                  $data[0] = 0;
                  $data[1] = 0;
                  $data[2] = 0;
                  $data=[0,0,0];
                  $name=['Live', 'Idle', 'Down'];
                  //print_r($query);exit;
                  $result = getLivemachines($query);
                  //$result = getLivemachines();
                  $i = 0;
                  $k = 0;
                  $x = 0;
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

                    if ($interval->days > 3) {

                      $data[2] += 1;
                      $x++;
                    } else if ($interval->days >= 1) {
                      $data[1] += 1;
                      $x++;
                    } else {
                      $data[0] += 1;
                      $x++;
                    }
                    //$name = ['live ('.$data[0].')', 'Idle ('.$data[1].')', 'Down ('.$data[2].')'];
                  }
                  $total = $x;
                  $name = ['live ('.$data[0].')', 'Idle ('.$data[1].')', 'Down ('.$data[2].')'];
                  //print_r($name3);//exit;
                  ?>
                  <script>
                    var dataTotal3 = <?php echo json_encode($total); ?>;
                    var data3 = <?php echo json_encode($data); ?>;
                    var name3 = <?php echo json_encode($name); ?>;
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#donutChart3"), {
                        //series: data3,
                        series: data3,
                        chart: {
                          //height: 350,
                          type: 'donut',

                        },

                        legend: {
                          show: true,
                          showForSingleSeries: false,
                          showForNullSeries: true,
                          showForZeroSeries: true,
                          position: 'bottom',
                          horizontalAlign: 'center',
                          floating: false,

                          onItemClick: {
                            toggleDataSeries: true
                          },
                          onItemHover: {
                            highlightDataSeries: true
                          },
                        },

                        // dataLabels: {

                        //   enabled: true,
                        //   enabledOnSeries: undefined,
                        //   formatter: function(value, {
                        //     seriesIndex,
                        //     dataPointIndex,
                        //     w
                        //   }) {
                        //     return value
                        //   },
                        // },
                        // title: {
                        //   text: 'total ' + dataTotal,

                        //   align: 'center',

                        dataLabels: {
                              //offset: 20,
                              enabled: false,
                              //enabledOnSeries: undefined,
                              // formatter: function(value, {
                              //   seriesIndex,
                              //   dataPointIndex,
                              //   w
                              //}) {
                              //   return value
                              // },
                            },

                        plotOptions: {
                          pie: {
                            expandOnClick: false,
                            

                            customScale: 1,
                            donut: {
                              size: "70%",
                              labels: {
                                show: true,
                                value: {
                                  show: true,
                                  fontSize: "36px",
                                  color: "#6a6a6a",
                                },
                                total: {
                                  showAlways: true,
                                  show: true,
                                  label: "Total",
                                  fontSize: "16px",
                                  fontWeight: "normal",
                                  color: "#707070",
                                  formatter: function(w) {
                                    return w.globals.seriesTotals.reduce((a, b) => {
                                      return a + b ;
                                    }, 0);
                                  },
                                },
                              },

                            },
                          },
                        },



                        labels: name3,
                      }).render();
                    });
                  </script>
                  <!-- </div>
              </div> -->
                </div>
<div class="col-lg-12">
                <div class="col-lg-3">
                  <!-- <div class="card">
                <div class="card-body"> -->
                  <h5 class="card-title" style="text-align: center;">TCP REPORT</h5>

                  <!-- Donut Chart -->
                  <div id="donutChart11"></div>
                  <?php
                 // $query = "AND `product_type`.`name` LIKE 'WOKIE'";
                  $data[0] = 0;
                  $data[1] = 0;
                  $data[2] = 0;
                  //print_r($query);exit;
             
                  //$result = getLivemachines();
                  $i = 0;
                  $k = 0;
                  $x = 0;
                  $imei=0;
                  
                //  print_r($result);
                  //exit;
                //  print_r($brand1);
                  $brandtcpimei=getbrandtcpimei($brand);
               if($brandtcpimei>0)
               {
                  foreach($brandtcpimei as $imeis)
                  {
                    $i++;
                    $brandimei=$imeis['imei'];
                  //  print_r($brandimei . " wer");
                    $resultl = getnooftcpdatabranduser($brandimei);
                    foreach($resultl as $row)
                    {
                    $time= strtotime($row['timestamp']);
                 //   print_r($tcpd . " wer");
                   // $i++;
                   // $time = strtotime($tcpd['timestamp']);
                   // $imei+=$tcpd['imei'];
                 //   print_r($time . " qqq");
                   // print_r($imei . " ");
                   // $resultl = getLivemachinestcpdata($imei);
                    if($resultl>0)
                    {
                      
                  //  $machines = getSingleMachineByName($row['SLN']);
                   // $machines = $machines[1];
                    //print_r($machines);
                   // $device = getAssignedDevice($machines['id']);
                    //print_r($device);//exit;
                    //$device = $device[1];
                   // $brand = getBrand($device['brand_id']);

                    //print_r($brand);
                   // $user = getSingleuser($device['user_id']);
                   // $store = getSingleStore($device['store_id']);
                    //$ptype = $machines['ptype_id'];
                   // $ptype_name = getptype($ptype);
                    //print_r($ptype_name);
                   // $countryname = getCountriesById($store['country']);
                  //  $statename = getStatesById($store['state']);
                  //  $cityname = getCityById($store['city']);
                    //print_r($countryname['name']);
                  //  $time = strtotime($row['timestamp']);
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
                    if ($interval->days > 3) {

                      $data[2] += 1;
                      $x++;
                    } else if ($interval->days >= 1) {
                      $data[1] += 1;
                      $x++;
                    } else {
                      $data[0] += 1;
                      $x++;
                    }
                    //$name = ['live ('.$data[0].')', 'Idle ('.$data[1].')', 'Down ('.$data[2].')'];
                  }
                }
                  }
                }    
                  $total = $x;
                  $name = ['live ('.$data[0].')', 'Idle ('.$data[1].')', 'Down ('.$data[2].')'];
                  //print_r($name);//exit;
                  ?>
                  <script>
                    var dataTotalb111 = <?php echo $total; ?>;
                    var datab111 = <?php echo json_encode($data); ?>;
                    var nameb111 = <?php echo json_encode($name); ?>;
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#donutChart11"), {
                        series: datab111,
                        chart: {
                          //height: 350,
                          type: 'donut',

                        },

                        legend: {
                          show: true,
                          showForSingleSeries: false,
                          showForNullSeries: true,
                          showForZeroSeries: true,
                          position: 'bottom',
                          horizontalAlign: 'center',
                          floating: false,

                          onItemClick: {
                            toggleDataSeries: true
                          },
                          onItemHover: {
                            highlightDataSeries: true
                          },
                        },

                  

                        dataLabels: {
                              //offset: 20,
                              enabled: false,
                              //enabledOnSeries: undefined,
                              // formatter: function(value, {
                              //   seriesIndex,
                              //   dataPointIndex,
                              //   w
                              //}) {
                              //   return value
                              // },
                            },

                        plotOptions: {
                          pie: {
                            expandOnClick: false,
                            

                            customScale: 1,
                            donut: {
                              size: "70%",
                              labels: {
                                show: true,
                                value: {
                                  show: true,
                                  fontSize: "36px",
                                  color: "#6a6a6a",
                                },
                                total: {
                                  showAlways: true,
                                  show: true,
                                  label: "Total",
                                  fontSize: "16px",
                                  fontWeight: "normal",
                                  color: "#707070",
                                  formatter: function(w) {
                                    return w.globals.seriesTotals.reduce((a, b) => {
                                      return a + b ;
                                    }, 0);
                                  },
                                },
                              },

                            },
                          },
                        },


                        labels: nameb111,
                      }).render();
                    });
                
                  </script>
                  <!-- End Donut Chart -->

                  <!-- </div>
              </div> -->
                </div>
                    </div>


                <br>
                <div class="col-lg-6">
                  <!-- <div class="card">
                    <div class="card-body"> -->
                  <!-- <h5 class="card-title">India</span></h5> -->


                  <link rel="stylesheet" href="assets/india_heatmap/style.css">


                  <script src="https://www.amcharts.com/lib/4/core.js"></script>
                  <script src="https://www.amcharts.com/lib/4/maps.js"></script>
                  <script src="https://www.amcharts.com/lib/4/geodata/india2019High.js"></script>
                  <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
                  <div id="chartdivindia"></div>

                  <!-- <script src="assets/india_heatmap/script.js"></script> -->
                  <?php
                  $query = " ";
                  $data[0] = 0;
                  $data[1] = 0;
                  $data[2] = 0;
                  //print_r($query);exit;
                  $result = getLivemachines($query);
                  //$result = getLivemachines();
                  $i = 0;
                  $k = 0;
                  $x = 0;
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
                    //$brand = getBrand($device['brand_id']);

                    //print_r($brand);
                    //$user = getSingleuser($device['user_id']);
                    $store = getSingleStore($device['store_id']);
                    //$ptype = $machines['ptype_id'];
                    // $ptype_name = getptype($ptype);
                    //print_r($ptype_name);
                    $countryname = getCountriesById($store['country']);
                    $statename = getStatesById($store['state']);
                    //print_r($countryname);print_r($statename);exit;
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

                    $name = ['live', 'Idle', 'Down'];
                    if ($interval->days > 3) {

                      $data[2] += 1;
                      $x++;
                    } else if ($interval->days > 1) {
                      $data[1] += 1;
                      $x++;
                    } else {
                      $data[0] += 1;
                      $x++;
                    }
                  }
                  $total = $x;
                  //print_r($data);//exit;
                  ?>
                  <script>
                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    // Create map instance
                    var chart = am4core.create("chartdivindia", am4maps.MapChart);

                    // Set map definition
                    chart.geodata = am4geodata_india2019High;



                    // Create map polygon series
                    var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());

                    //Set min/max fill color for each area
                    polygonSeries.heatRules.push({
                      property: "fill",
                      target: polygonSeries.mapPolygons.template,
                      min: chart.colors.getIndex(1).brighten(1),
                      max: chart.colors.getIndex(1).brighten(-0.3)
                    });

                    // Make map load polygon data (state shapes and names) from GeoJSON
                    polygonSeries.useGeodata = true;

                    // Set heatmap values for each state
                    polygonSeries.data = [{
                        id: "IN-JK",
                        value: 0
                      },
                      {
                        id: "IN-MH",
                        value: 6
                      },
                      {
                        id: "IN-UP",
                        value: 0
                      },
                      {
                        id: "IN-AR",
                        value: 0
                      },
                      {
                        id: "IN-RJ",
                        value: 0
                      },
                      {
                        id: "IN-AP",
                        value: 0
                      },
                      {
                        id: "IN-MP",
                        value: 0
                      },
                      {
                        id: "IN-TN",
                        value: 4
                      },
                      {
                        id: "IN-JH",
                        value: 0
                      },
                      {
                        id: "IN-WB",
                        value: 0
                      },
                      {
                        id: "IN-GJ",
                        value: 0
                      },
                      {
                        id: "IN-BR",
                        value: 0
                      },
                      {
                        id: "IN-TG",
                        value: 0
                      },
                      {
                        id: "IN-GA",
                        value: 0
                      },
                      {
                        id: "IN-DN",
                        value: 0
                      },
                      {
                        id: "IN-DL",
                        value: 0
                      },
                      {
                        id: "IN-DD",
                        value: 0
                      },
                      {
                        id: "IN-CH",
                        value: 0
                      },
                      {
                        id: "IN-CT",
                        value: 0
                      },
                      {
                        id: "IN-AS",
                        value: 0
                      },
                      {
                        id: "IN-AR",
                        value: 0
                      },
                      {
                        id: "IN-AN",
                        value: 0
                      },
                      {
                        id: "IN-KA",
                        value: 12
                      },
                      {
                        id: "IN-KL",
                        value: 0
                      },
                      {
                        id: "IN-OR",
                        value: 0
                      },
                      {
                        id: "IN-SK",
                        value: 0
                      },
                      {
                        id: "IN-HP",
                        value: 0
                      },
                      {
                        id: "IN-PB",
                        value: 0
                      },
                      {
                        id: "IN-HR",
                        value: 0
                      },
                      {
                        id: "IN-UT",
                        value: 0
                      },
                      {
                        id: "IN-LK",
                        value: 0
                      },
                      {
                        id: "IN-MN",
                        value: 0
                      },
                      {
                        id: "IN-TR",
                        value: 0
                      },
                      {
                        id: "IN-MZ",
                        value: 0
                      },
                      {
                        id: "IN-NL",
                        value: 0
                      },
                      {
                        id: "IN-ML",
                        value: 0
                      }
                    ];



                    // Configure series tooltip
                    var polygonTemplate = polygonSeries.mapPolygons.template;
                    polygonTemplate.tooltipText = "{name}: {value}";
                    polygonTemplate.nonScalingStroke = true;
                    polygonTemplate.strokeWidth = 0.5;

                    // Create hover state and set alternative fill color
                    var hs = polygonTemplate.states.create("hover");
                    hs.properties.fill = am4core.color("#3c5bdc");
                  </script>
                  <!-- </div>
                  </div> -->
                </div>

                <div class="col-lg-6">
                  <!-- <div class="card">
                    <div class="card-body"> -->
                  <!-- <h5 class="card-title">WORLD</span></h5> -->

                  <link rel="stylesheet" href="assets/world_heatmap/style.css">

                  <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
                  <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
                  <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
                  <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>


                  <div id="world"></div>
                  <script src="assets/world_heatmap/script.js"></script>
                  <!-- </div>
                  </div> -->
                </div>



              </div>
            </div>
            <!-- End Left side columns -->



          </div>
    </section>

  </main><!-- End #main -->

  <?php include "footer.php"; ?>

</body>

</html>