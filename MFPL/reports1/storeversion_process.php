<?php
require_once "../controller/recipe_update_functions.php";
if (isset($_POST)) {


    // print_r($_POST);exit;
    // $selectversionID = $_POST['rversion'];

    if (!empty($_POST['selectversion'])) {
        $selectversion = $_POST['selectversion'];
        // print_r($selectversion);exit;
    }else{
        $response["error"] = 2;
        $response["error_msg"] = "Please select Version";
        echo json_encode($response);
        exit;
    }

    
    if (!empty($_POST['recipeid'])) {
        $recipeid = $_POST['recipeid'];
        // print_r($selectversion);exit;
    }else{
        $response["error"] = 2;
        $response["error_msg"] = "Please select Recipe ID";
        echo json_encode($response);
        exit;
    }

    if (!empty($_POST['recipe_name'])) {
        $recipe_name = $_POST['recipe_name'];
        // print_r($selectversion);exit;
    }else{
        $response["error"] = 2;
        $response["error_msg"] = "Please Enter Recipe Name";
        echo json_encode($response);
        exit;
    }
   
    // $portion = $_POST['portion'];

    // print_r($rct_1);

    //Start of Portion 1 
    if (!empty($_POST['rct_1'])) {
        $rct_1 = $_POST['rct_1'];
    } else {
        $rct_1 = 0;
    }


    $T1Min_1 = $_POST['T1Min_1'];
    $T1Sec_1 = $_POST['T1Sec_1'];
    $total_T1_1 = ((int)$T1Min_1 * 60) + (int)$T1Sec_1;


    $htMin_1 = $_POST['htMin_1'];
    $htSec_1 = $_POST['htSec_1'];
    $total_HT_1 = ((int)$htMin_1 * 60) + (int)$htSec_1;

    // print_r($total_HT_1);exit;
    // print_r($htSec_1);exit;
    $T2Min_1 = $_POST['T2Min_1'];
    $T2Sec_1 = $_POST['T2Sec_1'];
    $total_T2_1 = ((int)$T2Min_1 * 60) + (int)$T2Sec_1;
    //End of Portion 1 



    //Start of Portion 2 
    if (!empty($_POST['rct_2'])) {
        $rct_2 = $_POST['rct_2'];
    } else {
        $rct_2 = 0;
    }


    $T1Min_2 = $_POST['T1Min_2'];
    $T1Sec_2 = $_POST['T1Sec_2'];
    $total_T1_2 = ((int)$T1Min_2 * 60) + (int)$T1Sec_2;

    $htMin_2 = $_POST['htMin_2'];
    $htSec_2 = $_POST['htSec_2'];
    $total_HT_2 = ((int)$htMin_2 * 60) + (int)$htSec_2;


    $T2Min_2 = $_POST['T2Min_2'];
    $T2Sec_2 = $_POST['T2Sec_2'];
    $total_T2_2 = ((int)$T2Min_2 * 60) + (int)$T2Sec_2;
    //End of Portion 2



    //Start of Portion 3
    if (!empty($_POST['rct_3'])) {
        $rct_3 = $_POST['rct_3'];
    } else {
        $rct_3 = 0;
    }


    $T1Min_3 = $_POST['T1Min_3'];
    $T1Sec_3 = $_POST['T1Sec_3'];
    $total_T1_3 = ((int)$T1Min_3 * 60) + (int)$T1Sec_3;

    $htMin_3 = $_POST['htMin_3'];
    $htSec_3 = $_POST['htSec_3'];
    $total_HT_3 = ((int)$htMin_3 * 60) + (int)$htSec_3;


    $T2Min_3 = $_POST['T2Min_3'];
    $T2Sec_3 = $_POST['T2Sec_3'];
    $total_T2_3 = ((int)$T2Min_3 * 60) + (int)$T2Sec_3;
    //End of Portion 3




    //Start of Portion 4
    if (!empty($_POST['rct_4'])) {
        $rct_4 = $_POST['rct_4'];
    } else {
        $rct_4 = 0;
    }


    $T1Min_4 = $_POST['T1Min_4'];
    $T1Sec_4 = $_POST['T1Sec_4'];
    $total_T1_4 = ((int)$T1Min_4 * 60) + (int)$T1Sec_4;

    $htMin_4 = $_POST['htMin_4'];
    $htSec_4 = $_POST['htSec_4'];
    $total_HT_4 = ((int)$htMin_4 * 60) + (int)$htSec_4;


    $T2Min_4 = $_POST['T2Min_4'];
    $T2Sec_4 = $_POST['T2Sec_4'];
    $total_T2_4 = ((int)$T2Min_4 * 60) + (int)$T2Sec_4;
    //End of Portion 4 



    //Start of Portion 5 
    if (!empty($_POST['rct_5'])) {
        $rct_5 = $_POST['rct_5'];
    } else {
        $rct_5 = 0;
    }


    $T1Min_5 = $_POST['T1Min_5'];
    $T1Sec_5 = $_POST['T1Sec_5'];
    $total_T1_5 = ((int)$T1Min_5 * 60) + (int)$T1Sec_5;

    $htMin_5 = $_POST['htMin_5'];
    $htSec_5 = $_POST['htSec_5'];
    $total_HT_5 = ((int)$htMin_5 * 60) + (int)$htSec_5;


    $T2Min_5 = $_POST['T2Min_5'];
    $T2Sec_5 = $_POST['T2Sec_5'];
    $total_T2_5 = ((int)$T2Min_5 * 60) + (int)$T2Sec_5;
    //End of Portion 5
















    $x = addVersion($selectversion, $recipeid, $recipe_name, $rct_1, $total_T1_1, $total_HT_1, $total_T2_1, $rct_2, $total_T1_2, $total_HT_2, $total_T2_2, $rct_3, $total_T1_3, $total_HT_3, $total_T2_3, $rct_4, $total_T1_4, $total_HT_4, $total_T2_4, $rct_5, $total_T1_5, $total_HT_5, $total_T2_5);
    // echo($x);exit;
    if ($x == 0) {
        // user already existed

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('Succesfully Updated');
        //     window.location.href='../add_product.php?display=1';
        //     </script>");
        $response["error"] = 0;
        $response["error_msg"] = "Version added successfully ";
        echo json_encode($response);
    } else  if ($x == 2) {

        // echo ("<script LANGUAGE='JavaScript'>
        //     window.alert('unknown error occurred in adding');
        //     window.location.href='../add_product.php';
        //     </script>");
        $response["error"] = 2;
        $response["error_msg"] = " Version Not Inserted";
        echo json_encode($response);
    }
}
