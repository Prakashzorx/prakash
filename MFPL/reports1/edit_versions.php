<?php
require_once "../controller/recipe_update_functions.php";

$id_for_update=0;


$heatingtempediting = $_POST["heatingtempediting"];
$vtemp1editing = $_POST["vtemp1editing"];
$vsleeptimeediting =$_POST["vsleeptimeediting"];
$deepsleepediting = $_POST["deepsleepediting"];
$id_for_update = $_POST["version_id"];







$x=Update_recipe_versions($heatingtempediting, $vtemp1editing,$vsleeptimeediting,$deepsleepediting,$id_for_update);

if ($x == 1) {
    // user already existed

    // echo ("<script LANGUAGE='JavaScript'>
    //     window.alert('Succesfully Updated');
    //     window.location.href='../add_product.php?display=1';
    //     </script>");
    $response["error"] = 0;
    $response["error_msg"] = "Recipe Updated successfuly";
    echo json_encode($response);
} 








?>