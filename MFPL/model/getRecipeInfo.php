<?php

require_once "../controller/functions.php";
// print_r($_POST);exit;
$id=0;
if(!empty($_POST['Vid'])){

    $id=$_POST['Vid'];

}
// print_r($id);exit;


$allData=fetchRcpData($id);
// print_r($allData);exit;

echo json_encode($allData);





// foreach($allData as $Data){

//     $rct1=$Data['rct_1'];
//     $total_T1_1=$Data['total_T1_1'];
//     $total_HT_1=$Data['total_HT_1'];
//     $total_T2_1=$Data['total_T2_1'];
//     // print_r($total_T2_1);exit;
    
//     $rct2=$Data['rct_2'];
//     $total_T1_2=$Data['total_T1_2'];
//     $total_HT_2=$Data['total_HT_2'];
//     $total_T2_2=$Data['total_T2_2'];
    
    
//     $rct3=$Data['rct_3'];
//     $total_T1_3=$Data['total_T1_3'];
//     $total_HT_3=$Data['total_HT_3'];
//     $total_T2_3=$Data['total_T2_3'];
    
    
//     $rct4=$Data['rct_4'];
//     $total_T1_4=$Data['total_T1_4'];
//     $total_HT_4=$Data['total_HT_4'];
//     $total_T2_4=$Data['total_T2_4'];
    
    
//     $rct5=$Data['rct_5'];
//     $total_T1_5=$Data['total_T1_5'];
//     $total_HT_5=$Data['total_HT_5'];
//     $total_T2_5=$Data['total_T2_5'];

// }

// // Responses
// $response['rct_1']=$rct1;
// $response['total_T1_1']=$total_T1_1;
// $response['total_HT_1']=$total_HT_1;
// $response['total_T2_1']=$total_T2_1;

// $response['rct_2']=$rct2;
// $response['total_T1_2']=$total_T1_2;
// $response['total_HT_2']=$total_HT_2;
// $response['total_T2_2']=$total_T2_2;

// $response['rct_3']=$rct3;
// $response['total_T1_3']=$total_T1_3;
// $response['total_HT_3']=$total_HT_3;
// $response['total_T2_3']=$total_T2_3;

// $response['rct_4']=$rct4;
// $response['total_T1_4']=$total_T1_4;
// $response['total_HT_4']=$total_HT_4;
// $response['total_T2_4']=$total_T2_4;

// $response['rct_5']=$rct5;
// $response['total_T1_5']=$total_T1_5;
// $response['total_HT_5']=$total_HT_5;
// $response['total_T2_5']=$total_T2_5;

// print_r($response);


