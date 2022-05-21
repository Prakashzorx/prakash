<?php
require_once "../controller/recipe_update_functions.php";

$portion_id=0;
$Update_total_HT_P2=0;
$update_HT_Min_P2=0;
$recipeid=0;
$version_id=$_POST['version_id'];


$recipeid=$_POST['recipeidviewediit'];
// print_r($_POST);exit;
// Posrtion 1
$update_rct_P1 = $_POST['rct_1vedit'];

$update_T1Min_P1 = $_POST['T1Min_1vedit'];
$update_T1Sec_P1 = $_POST['T1Sec_1vedit'];
$Update_total_T1_P1=((int)$update_T1Min_P1*60)+(int)$update_T1Sec_P1;


$update_HT_min_P1 = $_POST['htMin_1vedit'];
$update_HT_Sec_P1 = $_POST['htSec_1vedit'];
$Update_total_HT_P1=((int)$update_HT_min_P1*60)+(int)$update_HT_Sec_P1;


$update_T2_min_P1 = $_POST['T2Min_1vedit'];
$update_T2_Sec_P1 = $_POST['T2Sec_1vedit'];
$Update_total_T2_P1=((int)$update_T2_min_P1*60)+(int)$update_T2_Sec_P1;



// Posrtion 2
$update_rct_P2 = $_POST['rct_2vedit'];


$update_T1Min_P2 = $_POST['T1Min_2vedit'];
$update_T1Sec_P2 = $_POST['T1Sec_2vedit'];
$Update_total_T1_P2=((int)$update_T1Min_P2*60)+(int)$update_T1Sec_P2;


$update_HT_min_P2 = $_POST['htMin_2vedit'];
$update_HT_Sec_P2 = $_POST['htSec_2vedit'];
$Update_total_HT_P2=((int)$update_HT_Min_P2*60)+(int)$update_HT_Sec_P2;


$update_T2_min_P2 = $_POST['T2Min_2vedit'];
$update_T2_Sec_P2 = $_POST['T2Sec_2vedit'];
$Update_total_T2_P2=((int)$update_T2_min_P2*60)+(int)$update_T2_Sec_P2;




// Posrtion 3
$update_rct_P3 = $_POST['rct_3vedit'];


$update_T1Min_P3 = $_POST['T1Min_3vedit'];
$update_T1Sec_P3 = $_POST['T1Sec_3vedit'];
$Update_total_T1_P3=((int)$update_T1Min_P3*60)+(int)$update_T1Sec_P3;



$update_HT_min_P3 = $_POST['htMin_3vedit'];
$update_HT_Sec_P3 = $_POST['htSec_3vedit'];
$Update_total_HT_P3=((int)$update_HT_min_P3*60)+(int)$update_HT_Sec_P3;



$update_T2_min_P3 = $_POST['T2Min_3vedit'];
$update_T2_Sec_P3 = $_POST['T2Sec_3vedit'];
$Update_total_T2_P3=((int)$update_T2_min_P3*60)+(int)$update_T2_Sec_P3;



// Posrtion 4
$update_rct_P4 = $_POST['rct_4vedit'];


$update_T1Min_P4 = $_POST['T1Min_4vedit'];
$update_T1Sec_P4 = $_POST['T1Sec_4vedit'];
$Update_total_T1_P4=((int)$update_T1Min_P4*60)+(int)$update_T1Sec_P4;



$update_HT_min_P4 = $_POST['htMin_4vedit'];
$update_HT_Sec_P4 = $_POST['htSec_4vedit'];
$Update_total_HT_P4=((int)$update_HT_min_P4*60)+(int)$update_HT_Sec_P4;



$update_T2_min_P4 = $_POST['T2Min_4vedit'];
$update_T2_Sec_P4 = $_POST['T2Sec_4vedit'];
$Update_total_T2_P4=((int)$update_T2_min_P4*60)+(int)$update_T2_Sec_P4;



// Posrtion 5
$update_rct_P5 = $_POST['rct_5vedit'];


$update_T1Min_P5 = $_POST['T1Min_5vedit'];
$update_T1Sec_P5 = $_POST['T1Sec_5vedit'];
$Update_total_T1_P5=((int)$update_T1Min_P5*60)+(int)$update_T1Sec_P5;



$update_HT_min_P5 = $_POST['htMin_5vedit'];
$update_HT_Sec_P5 = $_POST['htSec_5vedit'];
$Update_total_HT_P5=((int)$update_HT_min_P5*60)+(int)$update_HT_Sec_P5;



$update_T2_min_P5 = $_POST['T2Min_5vedit'];
$update_T2_Sec_P5 = $_POST['T2Sec_5vedit'];
$Update_total_T2_P5=((int)$update_T2_min_P5*60)+(int)$update_T2_Sec_P5;




$x=update_recipe_portions($version_id,$recipeid,$update_rct_P1,$Update_total_T1_P1,$Update_total_HT_P1,$Update_total_T2_P1,$update_rct_P2,$Update_total_T1_P2,$Update_total_HT_P2,$Update_total_T2_P2,$update_rct_P3,$Update_total_T1_P3,$Update_total_HT_P3,$Update_total_T2_P3,
                          $update_rct_P4,$Update_total_T1_P4,$Update_total_HT_P4,$Update_total_T2_P4,$update_rct_P5,$Update_total_T1_P5,$Update_total_HT_P5,$Update_total_T2_P5);


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