<?php
require_once "../controller/recipe_update_functions.php";

// print_r(($_POST));exit;
$id = $_POST['id'];
// print_r(($recipe_ID));exit;



$version = [];
$recipes = [];

$version = select_version_ID($id);
$recipes = getrecpid($id);
// print_r($recipes);exit;
$i = 0;


$version_name = 0;
$id = 0;
$pre_heating_temp = 0;
$sleep_time_temp = 0;
$sleep_time = 0;
$deep_sleep_time = 0;
// $recipe_ID=$_POST['recipeid'];


$version_name = $version['recipe_version'];
$id = $version['id'];
$pre_heating_temp = $version['pre_heating_temp'];
$sleep_time_temp = $version['sleep_time_temp'];
$sleep_time = $version['sleep_time'];
$deep_sleep_time = $version['deep_sleep_time'];
$x = 0;
foreach ($recipes as $row) {
    $rcpids[$x] = $row['rcpid'];
    $x++;
}


$response['version_name'] = $version_name;
$response['id'] = $id;
$response['pre_heating_temp'] = $pre_heating_temp;
$response['sleep_time_temp'] = $sleep_time_temp;
$response['sleep_time'] = $sleep_time;
$response['deep_sleep_time'] = $deep_sleep_time;
$response['rcpids'] = $rcpids;








//     deep_sleep_time: "3"
// id: "20"
// pre_heating_temp: "299"
// sleep_time: "3"
// sleep_time_temp: "3"
// version_name: "fr4"
// [[Prototype]]: Object
// $recipe_ID[$i]=$version['recipeid'];
// $recipe_name[$i]=$version['recipe_name'];

// $rct_1[$i]=$version['rct_1'];
// $total_T1_1[$i]=$version['total_T1_1'];
// $total_HT_1[$i]=$version['total_HT_1'];
// $total_T2_1[$i]=$version['total_T2_1'];


// $rct_2[$i]=$version['rct_2'];
// $total_T1_2[$i]=$version['total_T1_2'];
// $total_HT_2[$i]=$version['total_HT_2'];
// $total_T2_2[$i]=$version['total_T2_2'];


// $rct_3[$i]=$version['rct_3'];
// $total_T1_3[$i]=$version['total_T1_3'];
// $total_HT_3[$i]=$version['total_HT_3'];
// $total_T2_3[$i]=$version['total_T2_3'];


// $rct_4[$i]=$version['rct_4'];
// $total_T1_4[$i]=$version['total_T1_4'];
// $total_HT_4[$i]=$version['total_HT_4'];
// $total_T2_4[$i]=$version['total_T2_4'];


// $rct_5[$i]=$version['rct_5'];
// $total_T1_5[$i]=$version['total_HT_5'];
// $total_HT_5[$i]=$version['total_T1_5'];
// $total_T2_5[$i]=$version['total_T2_5'];

//     $i++;
// }






echo json_encode($response);
