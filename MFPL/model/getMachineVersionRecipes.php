<?php
require_once "../controller/recipe_update_functions.php";



// print_r($_POST);
$recipe_id = 0;
$vid = 0;
$mid = 0;

// $recipe_id=$_POST['recipe_id'];
// $vid=$_POST['vid'];
$mid = $_POST['id'];







$version = selectMachineVersionPortion($mid);
// print_r($version);

$i = 0;


$version_name = 0;
$id = 0;
$pre_heating_temp = 0;
$sleep_time_temp = 0;
$sleep_time = 0;
$deep_sleep_time = 0;
// $recipe_ID=$_POST['recipeid'];


$version_name = $version['recipe_version'];
$id = $version['versionid'];
$pre_heating_temp = $version['pre_heating_temp'];
$sleep_time_temp = $version['sleep_time_temp'];
$sleep_time = $version['sleep_time'];
$deep_sleep_time = $version['deep_sleep_time'];
// print_r($id);
$recipes = getrecpid($id);
// print_r($recipes);
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






echo json_encode($response);
