<?php

require_once "../controller/functions.php";









if (!empty($_POST['id']) ) {

    $id = $_POST["id"];

$machine = getSingleMachine($id);

    //print_r($machine);
    $mid = $machine['ptype_id'];
    $ptype = getptype($mid);
    //print_r($ptype['name']." " .$ptype['version']);exit;
       
        $response["error"] = 0;
        $response["error_msg"] = $ptype['name']." " .$ptype['version'];
        echo json_encode($response);
  

     
      
} else {
    // echo ("<script LANGUAGE='JavaScript'>
    //    window.alert('required parameters are missing');
    //    window.location.href='../add_product.php';
    //    </script>");
    $response["error"] = 3;
    $response["error_msg"] = "Required parameters  are missing!";
    echo json_encode($response);
} 


?>