<?php
require_once "../controller/recipe_update_functions.php";



// print_r($_POST);
$recipe_id=0;
$vid=0;

$recipe_id=$_POST['recipe_id'];
$vid=$_POST['vid'];
// $rid=$_POST['v_r_id'];
// print_r(($recipe_ID));exit;






$versionportion=select_portions($recipe_id,$vid);
// print_r($versionportion);exit;

$i=0;


$rct_1=0;
$total_T1_1=0;
$total_HT_1=0;
$total_T2_1=0;


$rct_2=0;
$total_T1_2=0;
$total_HT_2=0;
$total_T2_2=0;


$rct_3=0;
$total_T1_3=0;
$total_HT_3=0;
$total_T2_3=0;
                                    

$rct_4=0;
$total_T1_4=0;
$total_HT_4=0;
$total_T2_4=0;


$rct_5=0;
$total_T1_5=0;
$total_HT_5=0;
$total_T2_5=0;


// $recipe_ID=$_POST['recipeid'];


    $recipe_name=$versionportion['recipe_name'];

// portion 1
    $rct_1=$versionportion['rct_1'];

    $total_T1_1=$versionportion['total_T1_1'];
    $T1Min_P1 = floor((int)$total_T1_1/60);
    $T1Sec_P1 = ((int)$total_T1_1%60);
    
    $total_HT_1=$versionportion['total_HT_1'];
    $HTMin_P1 = floor((int)$total_HT_1/60);
    $HTSec_P1 = ((int)$total_HT_1%60);

    $total_T2_1=$versionportion['total_T2_1'];
    $T2Min_P1 = floor((int)$total_T2_1/60);
    $T2Sec_P1 = ((int)$total_T2_1%60);


    // Portion 2
    $rct_2=$versionportion['rct_2'];

    $total_T1_2=$versionportion['total_T1_2'];
    $T1Min_P2 = floor((int)$total_T1_2/60);
    $T1Sec_P2 = ((int)$total_T1_2%60);

    
    $total_HT_2=$versionportion['total_HT_2'];
    $HTMin_P2 = floor((int)$total_HT_2/60);
    $HTSec_P2 = ((int)$total_HT_2%60);

    $total_T2_2=$versionportion['total_T2_2'];
    $T2Min_P2 = floor((int)$total_T2_2/60);
    $T2Sec_P2 = ((int)$total_T2_2%60);


    // Portion 3
    $rct_3=$versionportion['rct_3'];

    $total_T1_3=$versionportion['total_T1_3'];
    $T1Min_P3 = floor((int)$total_T1_3/60);
    $T1Sec_P3 = ((int)$total_T1_3%60);

    
    $total_HT_3=$versionportion['total_HT_3'];
    $HTMin_P3 = floor((int)$total_HT_3/60);
    $HTSec_P3 = ((int)$total_HT_3%60);

    $total_T2_3=$versionportion['total_T2_3'];
    $T2Min_P3 = floor((int)$total_T2_3/60);
    $T2Sec_P3 = ((int)$total_T2_3%60);


    // Portion 4
    $rct_4=$versionportion['rct_4'];

    $total_T1_4=$versionportion['total_T1_4'];
    $T1Min_P4 = floor((int)$total_T1_4/60);
    $T1Sec_P4 = ((int)$total_T1_4%60);

    
    $total_HT_4=$versionportion['total_HT_4'];
    $HTMin_P4 = floor((int)$total_HT_4/60);
    $HTSec_P4 = ((int)$total_HT_4%60);

    $total_T2_4=$versionportion['total_T2_4'];
    $T2Min_P4 = floor((int)$total_T2_4/60);
    $T2Sec_P4 = ((int)$total_T2_4%60);


    // Portion 4
    $rct_5=$versionportion['rct_5'];

    $total_T1_5=$versionportion['total_T1_5'];
    $T1Min_P5 = floor((int)$total_T1_5/60);
    $T1Sec_P5 = ((int)$total_T1_5%60);

    
    $total_HT_5=$versionportion['total_HT_5'];
    $HTMin_P5 = floor((int)$total_HT_5/60);
    $HTSec_P5 = ((int)$total_HT_5%60);

    $total_T2_5=$versionportion['total_T2_5'];
    $T2Min_P5 = floor((int)$total_T2_5/60);
    $T2Sec_P5 = ((int)$total_T2_5%60);








    // Responses    
    $response['recipe_name']=$recipe_name;

    // Response Portion 1
    $response['rct_1']=$rct_1;

    
    $response['T1Min_P1']=$T1Min_P1;
    $response['T1Sec_P1']=$T1Sec_P1;

    $response['HTMin_P1']=$HTMin_P1;
    $response['HTSec_P1']=$HTSec_P1;

    $response['T2Min_P1']=$T2Min_P1;
    $response['T2Sec_P1']=$T2Sec_P1;



    // Response Portion 2
    $response['rct_2']=$rct_2;

    
    $response['T1Min_P2']=$T1Min_P2;
    $response['T1Sec_P2']=$T1Sec_P2;

    $response['HTMin_P2']=$HTMin_P2;
    $response['HTSec_P2']=$HTSec_P2;

    $response['T2Min_P2']=$T2Min_P2;
    $response['T2Sec_P2']=$T2Sec_P2;
    


    // Response Portion 3
    $response['rct_3']=$rct_3;

    
    $response['T1Min_P3']=$T1Min_P3;
    $response['T1Sec_P3']=$T1Sec_P3;

    $response['HTMin_P3']=$HTMin_P3;
    $response['HTSec_P3']=$HTSec_P3;

    $response['T2Min_P3']=$T2Min_P3;
    $response['T2Sec_P3']=$T2Sec_P3;


    // Response Portion 4
    $response['rct_4']=$rct_4;

    
    $response['T1Min_P4']=$T1Min_P4;
    $response['T1Sec_P4']=$T1Sec_P4;

    $response['HTMin_P4']=$HTMin_P4;
    $response['HTSec_P4']=$HTSec_P4;

    $response['T2Min_P4']=$T2Min_P4;
    $response['T2Sec_P4']=$T2Sec_P4;


    // Response Portion 5
    $response['rct_5']=$rct_5;

    
    $response['T1Min_P5']=$T1Min_P5;
    $response['T1Sec_P5']=$T1Sec_P5;

    $response['HTMin_P5']=$HTMin_P5;
    $response['HTSec_P5']=$HTSec_P5;

    $response['T2Min_P5']=$T2Min_P5;
    $response['T2Sec_P5']=$T2Sec_P5;
  
   
    echo json_encode($response);

    ?>