<?php
 require_once 'functions.php';
//echo '<pre>'.print_r(json_decode(file_get_contents("php://input")),1).'</pre>';
$jsonStr = file_get_contents("php://input"); //read the HTTP body.
$json = json_decode($jsonStr,true);
//$singleArrayForCategory = array_reduce($json, 'array_merge', array());
//print_r($json);exit;
//print_r($json);

//$json = json_decode($jsonStr);

// $arr=[];
// array_walk_recursive($json, function($k){global $arr; $arr[]=$k;});
// print_r($arr);


$product=$json['Machine on Packet'];

$product=$product['0'];
//print_r($product);
if(!empty($product)){
    
//     [slnum] => ZF0GTY2304
// [SwVer] => 1.0
// [AppVer] => 1.0
// [RcpVer] => 0.1
// [ApNme] => MFPL
// [ApLcn] => [23,24]
// [Serialnum] => ZF0GTY2304
// [HrtBt] => connected
// [ErrCnt] => 123
// [RcpCnt] => 11
// [ClgCnt] => 123
// [eClgCnt] => 123
    
    $slnum=$product['slnum'];
    $software_v=$product['SwVer'];
    $app_v=$product['AppVer'];
    $recipe_v=$product['RcpVer'];
    $app_name=$product['ApNme'];
    $app_location=$product['ApLcn'];
    //print_r($app_location);
    $Serial_number=$product['Serialnum'];
    $heartbeat=$product['HrtBt'];
    $error_count=$product['ErrCnt'];
    $recipe_count=$product['RcpCnt'];
    $cleaning_counter=$product['ClgCnt'];
    $eod_cleaning_counter=$product['eClgCnt'];
    
$edit=insertraw($slnum,$software_v,$app_v,$recipe_v,$app_name,$app_location,$Serial_number,$heartbeat,$error_count,$recipe_count,$cleaning_counter,$eod_cleaning_counter);

$FlowControl=$json['PACKET AFTER 5-MINS'];
//print_r($FlowControl);
//$Mode=$json['ManualMode'];


// if(!empty($Mode)){
    
//     //print_r($Mode);
//     $displaytext=$Mode['displaytext'];
//     $actiontype=$Mode['actiontype'];
    
//     //print_r($actiontype);
    
//     if(!empty($actiontype)){
    
//     //print_r($Mode);
//     //$actiontype=$actiontype;
//     foreach($actiontype as $action)
//     {
//     //print_r($action);
//     $action_hit=$action['action'];
//     if($action_hit=="send"){
//         $device_name=$action['device'];
//         $parameters=$action['parameters'];
       
//         //print_r($parameters);
//         if(!empty($parameters)){
            
//             foreach($parameters as $para){
//              $temp=$para['Temperature'];
//              $hum=$para['humidity'];
//              //print_r($temp);
//              $edit=insertraw($product,$FlowControl,$displaytext,$action_hit,$device_name,$temp,$hum);
             
//               // print_r($edit);//exit;
            
            if($edit==NULL){
            
                 $response["error"] = 1;
                 
                    $response["Message"] = "Product not found";
                    echo json_encode($response);
                //$link="view_products.php";
                //header("Location:" .$link);
            
            }else{
                     $response["error"] = 0;
                     //$response["Device"] =$edit;
                    $response["Message"] = "added to db";
                    echo json_encode($response);
            }
//         }
            
//         }
        
//     }

//     }
    
//     }else{
        
//         echo "no action type";
        
//     }
    
// }else{
//     echo "no data";
// }
}
?>

