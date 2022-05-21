<?php 

// session_start(); 

include "functions.php";



        $data=getRaawdata();

      
        if($data){
           // print_r($data);exit;
            foreach($data as $value){

               

                $products=getUniqueProducts();
                //print_r($products);exit;
                $rc=0;
                $i=0;
                foreach($products as $product){
                    //print_r($product['rc']);
                    $products_SLN[$i]=$product['SLN'];
                    $product_rc[$i]=$product['rc'];
                    $i++;

                } 

                if(in_array($value['SLN'], $products_SLN)){
                   // echo $value['SLN']."its there"."\n";
                    $result=updateNewProduct($value);
                }else{
                   // echo $value."its not there"."\n";
                   // print_r($value);
                    $result=insertNewProduct($value);
                }
                //exit;

                $result=dayWiseProductRC($value);
                $updateRawdata=updateRawdataToOne($value); 
            }

           
               

                


          
            
        }else{
           // print_r($data);
        }

   

?>