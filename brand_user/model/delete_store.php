<?php

require_once "../controller/functions.php";

//$response = array("error" => 0);
//print_r($_POST);exit;
//print_r($_FILES);

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}





 if(!empty($_POST['id']) ) {

    // receiving the post params
    $id=test_input($_POST['id']);
    
   
// print_r($id);
// print_r($brandname);exit;
    
$x=deleteStore($id);
//echo($x);exit;
if ($x==2) {
    // user already existed

// echo ("<script LANGUAGE='JavaScript'>
//     window.alert('Succesfully Updated');
//     window.location.href='../add_product.php?display=1';
//     </script>");
 $response["error"] = 0;
    $response["error_msg"] = "This Store Contains Some Assigned Devices... First Delete Them..";
    echo json_encode($response);


}
else
if ($x==1) {
        // user already existed
    
    // echo ("<script LANGUAGE='JavaScript'>
    //     window.alert('Succesfully Updated');
    //     window.location.href='../add_product.php?display=1';
    //     </script>");
     $response["error"] = 0;
        $response["error_msg"] = "Store deleted successfully ";
        echo json_encode($response);


}
else{

    // echo ("<script LANGUAGE='JavaScript'>
    //     window.alert('unknown error occurred in adding');
    //     window.location.href='../add_product.php';
    //     </script>");
     $response["error"] = 1;
            $response["error_msg"] = " store not deleted";
            echo json_encode($response);
}



} else {
 // echo ("<script LANGUAGE='JavaScript'>
 //    window.alert('required parameters are missing');
 //    window.location.href='../add_product.php';
 //    </script>");
  $response["error"] = 3;
    $response["error_msg"] = "Required parameters  is missing!";
    echo json_encode($response);
}

?>
