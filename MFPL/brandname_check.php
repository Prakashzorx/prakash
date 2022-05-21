<?php
require_once "controller/functions.php";
$brandname = $_POST["brandname"];
//print_r($brandname);exit;
$result = brandname_check($brandname);


    if($result){
        echo 1;
    }else{
        echo 0;
    }

    
    

?>