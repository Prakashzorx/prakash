<?php

// session_start(); 

include "functions.php";



$data = getRcpdata();


if ($data) {

    foreach ($data as $value) {

        // print_r($data);exit;

        $recepes = getUniqueRecepe();
        //print_r($recepes);
        $i = 0;
        foreach ($recepes as $recepe) {
            //print_r($product['SLN']);
            $recepes_types[$i] = $recepe['rcptype'];
            $i++;
        }
        //print_r($recepes_types);exit;
        if (in_array($value['rcptype'], $recepes_types)) {
            // echo "its there"."\n";

            $y = 0;
            foreach ($recepes as $recepe) {
                //print_r($product['SLN']);
                $recepes_names[$y] = $recepe['rcpname'];
                //print_r($recepes_names[$y]);
                $y++;
            }

            if (in_array($value['rcpname'], $recepes_names)) {
                // print_r($value['rcpname'].$recepes_names);
                //echo $value."its name there"."\n";
                $update_rcp = updateUniqueRecepe($value);

                $products = getSLNfromRecepeCountSlnTable($value['rcptype'], $value['rcpname']);

                $i = 0;
                foreach ($products as $product) {
                    //print_r($product['SLN']);
                    $products_SLN[$i] = $product['SLN'];
                    // print_r($products_SLN[$i]); 
                    $i++;
                }
                //exit;
                if (in_array($value['SLN'], $products_SLN)) {
                    //echo $value['SLN']."its there"."\n";
                    //$result=updateNewProduct($value);
                    
                    $result_rcp_sln = updateRcpSLN($value);
                } else {
                    // echo $value."its not there"."\n";
                    //print_r($value);
                    //$result=insertNewProduct($value);
                    $rcp_sln = insertRcpSLN($value);
                }
            } else {
                //echo $value."its name not there"."\n";
                $recepe = insertNewUniqueRecepe($value);
                $rcp_sln = insertRcpSLN($value);
            }
        } else {
            //echo $value."its type not there"."\n";
            //print_r($value);
            $recepe = insertNewUniqueRecepe($value);
            $rcp_sln = insertRcpSLN($value);
        }

        

        $rcpdataUpdate = updateRcpdataToOne($value);
    }
} else {
    //print_r($data);
}
