<?php

require 'vendor/autoload.php';

date_default_timezone_set('Asia/Kolkata');

use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;

$sdk = new Aws\Sdk([
    'region' => 'ap-south-1',
    'version' => 'latest',
]);


$dynamodb = $sdk->createDynamoDb();

$marshaler = new Marshaler();

$eav = $marshaler->marshalJson('
    {
        ":sts": 0
        
    }
');

$params = [
    'TableName' => 'recipeData',

    'FilterExpression' => '#yr = :sts',
    'ExpressionAttributeNames' => ['#yr' => 'sts'],
    'ExpressionAttributeValues' => $eav
];

try {
    while (true) {
        $result = $dynamodb->scan($params);
        //echo "<pre>".$result;
        foreach ($result['Items'] as $i) {
            $value = $marshaler->unmarshalJson($i);
            $json = json_decode($value, true);
            //echo $json['time']."\n".$json['SLN'];
            //echo $json;
            $time = $json['time'];
            $SLN = $json['sln'];

            // $message = json_encode($json['MACHINE_ON_PACKET'], JSON_FORCE_OBJECT);
            // $v = json_decode($message, true);

            // $PType = $v['0']['PType'];
            // $MACID = $v['0']['MACID'];
            // $SV = $v['0']['SV'];

            // $AV = $v['0']['AV'];
            // $ApNme = $v['0']['ApNme'];
            // $LOC = $v['0']['LOC'];
            // $HB = $v['0']['HB'];
            // $EC = $v['0']['EC'];
            // $RC = $v['0']['RC'];
            // $CC = $v['0']['CC'];
            // $EODCC = $v['0']['EODCC'];

            //print_r($v);




            $servername = "localhost";
            $username = "root";
            $password = "Mukunda@123";
            $dbname = "mk_db";

            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // if (!empty($json['MACHINE_ON_PACKET'])) {
            //     $sql = "INSERT INTO `rawdata`(`time`, `SLN`, `ptype`, `macid`, `sv`, `av`, `appname`, `location`, `hb`, `ec`, `rc`, `cc`, `eodcc`, `sts`) 
            // VALUES ($time, '$SLN', '$PType','$MACID','$SV','$AV','$ApNme','$LOC','$HB','$EC','$RC','$CC','$EODCC', 0)";
            //     //$sql = "INSERT INTO `rawdata`( `time`, `SLN`, `sts`) VALUES ($time, '$SLN', 0);
            //     //print_r($sql);

            //     if (mysqli_query($conn, $sql)) {
            //         echo "New record created successfully";
            //     } else {
            //         echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            //     }
            // }
            //mysqli_close($conn);

            $recpack = json_encode($json['recipe'], JSON_FORCE_OBJECT);
            $pack = json_decode($recpack, true);

            // echo $pack[0]['Fnlop'];

            $PType = $pack['pt'];
            $MACID = $pack['macId'];
            $Rcpcry = $pack['cat'];
            $Rcpnme = $pack['rcp'];
            $Rcpsrttme = $pack['rst'];
            $rcpstarttime = date("Y-m-d H:i:s", strtotime($Rcpsrttme));
            $Rcpendtme = $pack['ret'];
            $rcpendtime = date("Y-m-d H:i:s", strtotime($Rcpendtme));
            $Rcpercd = $pack['rec'];
            $Fnlop = $pack['rt'];
            $appName = $pack['an'];
            $cooktype = $pack['toc'];
            $RC = 1;
            $mil = $time;
            $seconds = ceil($mil / 1000);
          
            $timestamp = date("Y-m-d H:i:s", $seconds);
        

            if (!empty($json['recipe'])) {
                $sql1 = "INSERT INTO `rcpdata`( `time`, `SLN`, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) 
            VALUES ($time, '$SLN', '$PType','$MACID','$Rcpcry','$Rcpnme','$rcpstarttime','$rcpendtime','$Rcpercd','$Fnlop',$RC,'$appName','$cooktype','$timestamp')";
                // print_r($sql1);
                if (mysqli_query($conn, $sql1)) {
                    echo "New record created successfully";
                    
                    
                    
                    $keynew = $marshaler->marshalJson('
    	            {
       		 	            "time": ' . $time . ', 
        		            "sln": "' . $SLN . '"
    	             }
	               ');

                    $eavnew = $marshaler->marshalJson('
   		             {
        		            ":s": 1
    		        }
		            ');

                    $paramsnew = [
                        'TableName' => 'recipeData',
                        'Key' => $keynew,
                        'UpdateExpression' =>
                        'set sts = :s',
                        'ExpressionAttributeValues' => $eavnew,
                        'ReturnValues' => 'UPDATED_NEW'
                    ];

                    //echo $paramsnew;

                    $result = $dynamodb->updateItem($paramsnew);
                    //echo "Updated item.\n";

                } else {
                    echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
                }

                mysqli_close($conn);
                //echo $time."\n".$SLN."\n";
            }
        }

        if (isset($result['LastEvaluatedKey'])) {
            $params['ExclusiveStartKey'] = $result['LastEvaluatedKey'];
        } else {
            break;
        }
    }
} catch (DynamoDbException $e) {
    echo "Unable to scan:\n";
    echo $e->getMessage() . "\n";
}
