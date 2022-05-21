<?php

require_once "../controller/functions.php";

//print_r($_POST);exit;

// Array
// (
//     [ptype] => 
//     [machine] => 
//     [brand] => 
//     [user] => 
//     [store] => 
//     [country] => 
//     [fromdate] => 
//     [todate] => 
// )
$query = "";
if (!empty($_POST["fromdate"])) {
    $fromdate = $_POST["fromdate"];
} else {
    $response["error"] = 2;
    $response["error_msg"] = "Enter From-Date";
    echo json_encode($response);
    exit;
}


if (!empty($_POST["todate"])) {
    $todate = $_POST["todate"];
    $to_date = date('Y-m-d', strtotime($todate . ' +1 day'));
    $date1 = date_create($fromdate);
    $date2 = date_create($todate);
    $diff = date_diff($date1, $date2);
    // echo $diff->format("%R%a days");exit;
    //print_r($diff);exit;
    if (($diff->d > 0 || $diff->d == 0) && $diff->invert == 0) {
        // if (($diff->d < 8 || $diff->d == 0) && $diff->invert == 0) {
        // } else {
        //     $response["error"] = 2;
        //     $response["error_msg"] = "You can enter Max 7 days";
        //     echo json_encode($response);
        //     exit;
        // } 
        $query .= "AND `rcpdata`.`timestamp` BETWEEN '$fromdate' AND '$to_date'";
    } else {
        $response["error"] = 2;
        $response["error_msg"] = "To Date should be equal or greater than From date";
        echo json_encode($response);
        exit;
    }
} else {
    $response["error"] = 2;
    $response["error_msg"] = "Enter To-Date";
    echo json_encode($response);
    exit;
}





if ($_POST["city"]) {
    $city = $_POST["city"];
    $query .= "AND `store`.`city`='$city'";
} else {
    $query .= "";
}

if ($_POST["state"]) {
    $state = $_POST["state"];
    $query .= "AND `store`.`state`='$state'";
} else {
    $query .= "";
}

if ($_POST["country"]) {
    $country = $_POST["country"];
    $query .= "AND `store`.`country`='$country'";
} else {
    $query .= "";
}

if ($_POST["store"]) {
    $store = $_POST["store"];
    $query .= "AND `store`.`id`='$store'";
} else {
    $query .= "";
}
if ($_POST["user"]) {
    $user = $_POST["user"];
    $query .= "AND `users`.`user_id`='$user'";
} else {
    $query .= "";
}
if ($_POST["brand"]) {
    $brand = $_POST["brand"];
    $query .= "AND `brand_tbl`.`id`='$brand'";
} else {
    $query .= "";
}
if ($_POST["machine"]) {
    $machine = $_POST["machine"];
    $query .= "AND `machines`.`id`='$machine'";
}else {
    $query .= "";
}
if ($_POST["ptype"]) {
    $ptype = $_POST["ptype"];
    $query .= "AND `machines`.`ptype_id`='$ptype'";
} else {
    $query .= "";
}
//print_r($query);exit;

$getValues = getCountReport($query);
//print_r($getValues);
//exit;


$j = 0;
foreach ($getValues as $value) {
    //if($unirecipe['rcptype']==$value['rectype']){
    //  $product[$i]['name'] = $value['rectype'];


  
       $rcptype[$j]=$value['rcptype'];
        $product[$j] = $value['count'];
        $j++;
  
}


// $unique = getUniqueRecepeType();
// //print_r($unique);exit;
// $j = 0;
// foreach ($getValues as $value) {
//     //if($unirecipe['rcptype']==$value['rectype']){
//     //  $product[$i]['name'] = $value['rectype'];


//     if (!in_array($value['date'], $dates) && !empty($value['date'])) {
       
//         $dates[$j] = $value['date'];
//         $j++;
//     }
  
//     //}
//     // print_r($product[$i]['name']);exit;
// }
// $i = 0;
// $dates[] = "";

// foreach ($unique as $unirecipe) {
//    // print_r($unirecipe);

//     $j = 0;
    
   
//     foreach ($dates as $date) {
//         //print_r($date);
//         $k = 0;
//         $product_data = 0;
//         foreach ($getValues as $value) {
//             //if($unirecipe['rcptype']==$value['rectype']){
//               $product[$i]['name'] = $unirecipe['rcptype'];
//                 if($date==$value['date'] && $unirecipe['rcptype']==$value['rectype']){
//                     $product_data +=$value['rc'];
//                 }
           
           
//             $k++;
//             //}
//             // print_r($product[$i]['name']);exit;
//         }
//         $product[$i]['data'][$j]=$product_data ;
//         $j++;
//     }
//     $i++;
// }
//print_r($product);
//print_r($dates);`date` BETWEEN '2022-01-04' AND '2022-01-12'
$response["error"] = 0;
$response["error_msg"] = $product;
$response["dates"] = $rcptype;
echo json_encode($response);
exit;





if (!empty($store) && !empty($user) && !empty($brand) && !empty($ptype)) {
    $assigneddata = getMachinesBybranduserstore($brand, $user, $store);
    $i = 0;
    foreach ($assigneddata as $assign) {
        $machinename[$i] = getSingleMachine($assign['machine_id']);
        $i++;
    }
    $i = 0;
    foreach ($machinename as $products) {
        $j = 0;
        if ($products['ptype_id'] == $ptype) {
            $dailyProductData = getProductsByName($products['name']);
            //print_r($dailyProductData);
            foreach ($dailyProductData as $pdata) {
                $product[$i]['name'] = $pdata['SLN'];
                $product[$i]['data'][$j] = $pdata['rc'];

                if (!in_array($pdata['date'], $dates)) {
                    $dates[$j] = $pdata['date'];
                }
                $j++;
            }

            $i++;
        }
    }

    //print_r($product);
    //exit;
    $response["error"] = 0;
    $response["error_msg"] = $product;
    $response["dates"] = $dates;
    echo json_encode($response);
    exit;
} else
if (!empty($store) && !empty($user) && !empty($brand) && empty($ptype)) {
    $assigneddata = getMachinesBybranduserstore($brand, $user, $store);
    $i = 0;
    foreach ($assigneddata as $assign) {
        $machinename[$i] = getSingleMachine($assign['machine_id']);
        $i++;
    }
    $i = 0;
    foreach ($machinename as $products) {
        $j = 0;
        // if($products['ptype_id']==$ptype){
        $dailyProductData = getProductsByName($products['name']);
        //print_r($products);
        foreach ($dailyProductData as $pdata) {
            $product[$i]['name'] = $pdata['SLN'];
            $product[$i]['data'][$j] = $pdata['rc'];

            if (!in_array($pdata['date'], $dates)) {
                $dates[$j] = $pdata['date'];
            }
            $j++;
        }

        $i++;
        // }
    }

    //print_r($product);
    //exit;
    $response["error"] = 0;
    $response["error_msg"] = $product;
    $response["dates"] = $dates;
    echo json_encode($response);
    exit;
} else
if (!empty($machine)) {

    $machine = getSingleMachine($machine);

    $m_name = $machine['name'];
    //print_r($m_name);exit;
    $dates = getUniqueDates($fromdate, $todate);
    // $recipes = getRecipeByMachineId($m_name, $fromdate, $todate);
    // $k = 0;
    // foreach ($recipes as $recipe) {


    //     if (!in_array($recipe['date'], $dates)) {


    //         $dates[$k] = $recipe['date'];
    //         $k++;
    //     }
    // }


    $unique = getUniqueRecepeType();
    //print_r($unique);exit;
    $i = 0;
    $dates[] = "";
    foreach ($unique as $unirecipe) {
        $product[$i]['name'] = $unirecipe['rcptype'];
        $k = 0;
        foreach ($dates as $date) {
            // print_r($date);exit;
            // $recipecount=getrcByDate($date['date'],$unirecipe['rcptype']);
            $recipecount = recipeCountByTypeDate($date['date'], $unirecipe['rcptype'], $m_name);
            //print_r($recipecount);exit;
            $datesv[$k] = $date['date'];

            if (!empty($recipecount)) {
                foreach ($recipecount as $count) {
                    $product[$i]['data'][$k] += $count['rc'];
                }

                $k++;
            } else {
                $product[$i]['data'][$k] += 0;
                $k++;
            }
        }
        $i++;
        //exit;
        // SELECT * FROM `recepe_count_sln` WHERE `rectype` LIKE 'MFPL Recipes' AND `date` = '2022-01-05' ORDER BY `date` DESC
        //  $j = 0;$k=-1;$recipe1=0;$dates[]=0;
        //   foreach ($recipes as $recipe) {
        //print_r($recipe['rcptype']);
        // print_r($recipe['rcpname']);
        // print_r($recipe);
        // $response["top"]


        //  if (!strcmp($recipe['rectype'],$unirecipe['rcptype'])) {
        //      $product[$i]['name'] = $recipe['rectype'];
        // if (!strcmp($recipe['rcpname'], $unirecipe['rcpname'])) {

        //print_r($recipe['rcpname'] . " " . $recipe['rectype']);

        //.",".$product[$i]['count'];

        // if (!in_array($recipe['date'], $dates)) {

        //     $recipe1=0;
        //     $recipe1 = $recipe['rc'];

        //     $k++;
        //     $dates[$k] = $recipe['date'];
        // }else{
        //     $recipe1 +=  $recipe['rc'];
        // }

        // $product[$i]['data'][$k] = $recipe1;

        // $j++;
        // }


        //  }
        //$dates[$i]=$recipe['date'];
        //  }
        // $i++;
    }
    $response["error"] = 0;
    $response["error_msg"] = $product;
    $response["dates"] = $datesv;
    echo json_encode($response);
    exit;
} else
if (!empty($ptype) && empty($machine)) {
    $machines = getMachinesByPtype($ptype);
    // print_r($product_types);exit;
    $dates = getUniqueDates($fromdate, $todate);
    $ptypes = getUniqueRecepeType();
    //print_r($ptypes);exit;
    $i = 0;
    foreach ($ptypes as $ptype) {
        $product[$i]['name'] = $ptype['rcptype'];
        $j = 0;
        foreach ($dates as $date) {
            $rcvalues = getrcByDate($date['date'], $ptype['rcptype']);
            //print_r($rcvalues);
            $k = 0;
            foreach ($rcvalues as $rcvalue) {
                if (!empty($rcvalue['rc'])) {
                    $product[$i]['data'][$j] = $rcvalue['rc'];
                } else {
                    $product[$i]['data'][$j] = 0;
                }

                $datesv[$j] = $date['date'];
                //print_r($rcvalue);exit;
                $j++;
            }
            // $j++;
        }
        $i++;
    }
   
    $response["error"] = 0;
    $response["error_msg"] = $product;
    $response["dates"] = $datesv;
    echo json_encode($response);
    exit;
} 
//else
// if (!empty($city) && !empty($state) && !empty($country) && !empty($store) && !empty($user) && !empty($brand) && !empty($machine) && !empty($ptype)) {
// } else
// if (!empty($city) && !empty($state) && !empty($country) && !empty($store) && !empty($user) && !empty($brand) && !empty($machine) && !empty($ptype)) {
// } else
// if (!empty($city) && !empty($state) && !empty($country) && !empty($store) && !empty($user) && !empty($brand) && !empty($machine) && !empty($ptype)) {
// } else
// if (!empty($city) && !empty($state) && !empty($country) && !empty($store) && !empty($user) && !empty($brand) && !empty($machine) && !empty($ptype)) {
// } else
// if (!empty($city) && !empty($state) && !empty($country) && !empty($store) && !empty($user) && !empty($brand) && !empty($machine) && !empty($ptype)) {
// }
