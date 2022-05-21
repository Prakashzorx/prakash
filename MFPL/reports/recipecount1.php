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

    $date1 = date_create($fromdate);
    $date2 = date_create($todate);
    $diff = date_diff($date1, $date2);
    // echo $diff->format("%R%a days");exit;
    //print_r($diff);exit;
    if (($diff->d > 0 || $diff->d == 0) && $diff->invert == 0) {
        if (($diff->d < 8 || $diff->d == 0) && $diff->invert == 0) {
        } else {
            $response["error"] = 2;
            $response["error_msg"] = "You can enter Max 7 days";
            echo json_encode($response);
            exit;
        }
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






// if ($_POST["city"]) {
//     $city = $_POST["city"];
// }

// if ($_POST["state"]) {
//     $city = $_POST["city"];
// }

// if ($_POST["country"]) {
//     $city = $_POST["city"];
// }

if ($_POST["store"]) {
    $store = $_POST["store"];
}
if ($_POST["user"]) {
    $user = $_POST["user"];
}
if ($_POST["brand"]) {
    $brand = $_POST["brand"];
}
if ($_POST["machine"]) {
    $machine = $_POST["machine"];
}
if ($_POST["ptype"]) {
    $ptype = $_POST["ptype"];
}

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
            $recipecount = recipeCountByTypeDate($date['date'],$unirecipe['rcptype'],$m_name);
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
    $ptypes=getUniqueRecepeType();
    //print_r($ptypes);exit;
    $i = 0;
    foreach ($ptypes as $ptype) {
        $product[$i]['name'] = $ptype['rcptype'];
        $j=0;
        foreach ($dates as $date) {
           $rcvalues=getrcByDate($date['date'],$ptype['rcptype']);
           //print_r($rcvalues);
           $k=0;
           foreach ($rcvalues as $rcvalue) {
               if(!empty($rcvalue['rc'])){
                $product[$i]['data'][$j] = $rcvalue['rc'];
               }else{
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
   // print_r($product);
   // print_r($dates);
    //exit;
        // $j = 0;
        // $dailyProductData = getProductsByName($products['name']);
        // //print_r($dailyProductData);
        // foreach ($dailyProductData as $pdata) {
            
        //     $product[$i]['name'] = $pdata['SLN'];
        //     $product[$i]['data'][$j] = $pdata['rc'];

        //     if (!in_array($pdata['date'], $dates)) {
        //         $dates[$j] = $pdata['date'];
        //     }
        //     $j++;
        // }
        //$machine = getSingleMachine($machine);
       // SELECT SUM(`rc`),`date` FROM (`recepe_count_sln` INNER JOIN `machines` ON `machines`.`name`=`recepe_count_sln`.`SLN` AND `recepe_count_sln`.`rectype`='MFPL Recipes' AND `recepe_count_sln`.`date`='2022-01-03' AND `machines`.`assign_status`=1);
        //$m_name = $machine['name'];
        //print_r($m_name);exit;
        // $m_name = $products['name'];
        // $recipes = getRecipeByMachineId($m_name, $fromdate, $todate);
        // $k = 0;
        // foreach ($recipes as $recipe) {
    
    
        //     if (!in_array($recipe['date'], $dates)) {
    
    
        //         $dates[$k] = $recipe['date'];
        //         $k++;
        //     }
        // }
    
    
        // $unique = getUniqueRecepeType();
        // //print_r($unique);exit;
        // $i = 0;
        // $dates[] = "";
        // foreach ($unique as $unirecipe) {
        //     $product[$i]['name'] = $unirecipe['rcptype'];
        //     $k = 0;
        //     foreach ($dates as $date) {
        //         // print_r($date);exit;
        //         $recipecount = recipeCountByTypeDate($unirecipe['rcptype'], $date);
        //         // print_r($recipecount);
        //         if (!empty($recipecount)) {
        //             foreach ($recipecount as $count) {
        //                 $product[$i]['data'][$k] += $count['rc'];
        //             }
    
        //             $k++;
        //         } else {
        //             $product[$i]['data'][$k] += 0;
        //             $k++;
        //         }
        //     }
        //     $i++;
        // }
        //$i++;
    //}

    
    //print_r($product);
    //print_r($dates);exit;
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
