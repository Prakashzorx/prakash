<?php
require_once "../controller/recipe_update_functions.php";

$tcp_instaltablbe_E=0;
// $id=0;
// // print_r($_POST);exit;
// if(isset($_POST['id'])){
//     $id='id';
// }
// print_r($id);
 $id=$_POST['editid'];
$imei_E=$_POST['imeiedit'];
$tcp_machine_type_E=$_POST['tcp_machine_typeedit'];
$tcp_sr_E=$_POST['tcp_sredit'];

if(isset($_POST['tcp_instaldateedit'])){
    $tcp_instaltablbe_E=$_POST['tcp_instaldateedit'];
}
// $tcp_instaltablbe_E=$_POST['tcp_instaltableedit'];

$tcp_low_threshold=$_POST['tcp_low_thresholdedit'];
$tcp_high_threshold=$_POST['tcp_high_thresholdedit'];


$x=edit_tcp($id,$imei_E,$tcp_machine_type_E,$tcp_sr_E,$tcp_instaltablbe_E,$tcp_low_threshold,$tcp_high_threshold);
// print_r($x);exit;
if ($x == 1) {
    // user already existed

    // echo ("<script LANGUAGE='JavaScript'>
    //     window.alert('Succesfully Updated');
    //     window.location.href='../add_product.php?display=1';
    //     </script>");
    $response["error"] = 0;
    $response["error_msg"] = "TCP Updated successfuly";
    echo json_encode($response);
    // exit;
} 




?>