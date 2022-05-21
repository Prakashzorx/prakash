<?php
//exit;
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
    'TableName' => 'machineData',

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

            $message = json_encode($json['machine'], JSON_FORCE_OBJECT);
            $v = json_decode($message, true);

            $PType = $v['pt'];
            $MACID = $v['macId'];
            $SV = $v['sv'];

            $AV = $v['av'];
            $ApNme = $v['an'];
            $LOC = $v['ln'];
            $HB = $v['hb'];
            $EC = $v['ec'];
            $RC = $v['rc'];
            $CC = $v['ccc'];
            $EODCC = $v['ecc'];

              //print_r($time);
            $mil = $time;
            $seconds = ceil($mil / 1000);
            //print_r(date("d-m-Y H:i:s", $seconds));
            // $rc = 1;
            // $dateonly = strtotime(date("d-m-Y H:i:s", $seconds));
            //$dateonly=strtotime('2021-11-26 13:04:48');
            // $date = date('Y-m-d', $dateonly);
            // $time = date('H:i:s', $dateonly);
            $timestamp = date("Y-m-d H:i:s", $seconds);




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

            if (!empty($json['machine'])) {
                $sql = "INSERT INTO `rawdata`(`time`, `SLN`, `ptype`, `macid`, `sv`, `av`, `appname`, `location`, `hb`, `ec`, `rc`, `cc`, `eodcc`,`timestamp`, `sts`) 
            VALUES ($time, '$SLN', '$PType','$MACID','$SV','$AV','$ApNme','$LOC','$HB','$EC','$RC','$CC','$EODCC','$timestamp', 0)";
                //$sql = "INSERT INTO `rawdata`( `time`, `SLN`, `sts`) VALUES ($time, '$SLN', 0);
                //print_r($sql);exit;

                if (mysqli_query($conn, $sql)) {
                    //echo "New record created successfully";
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
                        'TableName' => 'machineData',
                        'Key' => $keynew,
                        'UpdateExpression' =>
                        'set sts = :s',
                        'ExpressionAttributeValues' => $eavnew,
                        'ReturnValues' => 'UPDATED_NEW'
                    ];

                    //echo $paramsnew;

                    $result = $dynamodb->updateItem($paramsnew);
                } else {
                    //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    $keynew = $marshaler->marshalJson('
                    {
                            "time": ' . $time . ', 
                            "sln": "' . $SLN . '"
                     }
                     ');

                    $eavnew = $marshaler->marshalJson('
                        {
                            ":s": 2 
                        }
                        ');

                    $paramsnew = [
                        'TableName' => 'machineData',
                        'Key' => $keynew,
                        'UpdateExpression' =>
                        'set sts = :s',
                        'ExpressionAttributeValues' => $eavnew,
                        'ReturnValues' => 'UPDATED_NEW'
                    ];

                    //echo $paramsnew;

                    $result = $dynamodb->updateItem($paramsnew);
                }
            }
            mysqli_close($conn);

            // $recpack = json_encode($json['recipe'], JSON_FORCE_OBJECT);
            // $pack = json_decode($recpack, true);

            // // echo $pack[0]['Fnlop'];

            // $PType = $pack[0]['PType'];
            // $MACID = $pack[0]['MACID'];
            // $Rcpcry = $pack[0]['Rcpcry'];
            // $Rcpnme = $pack[0]['Rcpnme'];
            // $Rcpsrttme = $pack[0]['Rcpsrttme'];
            // $Rcpendtme = $pack[0]['Rcpendtme'];
            // $Rcpercd = $pack[0]['Rcpercd'];
            // $Fnlop = $pack[0]['Fnlop'];
            // //$RC = $pack[0]['RC'];

            // if (!empty($json['recipe'])) {
            //     $sql1 = "INSERT INTO `rcpdata`( `time`, `SLN`, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`) 
            // VALUES ($time, '$SLN', '$PType','$MACID','$Rcpcry','$Rcpnme','$Rcpsrttme','$Rcpendtme','$Rcpercd','$Fnlop',$RC)";
            //     //print_r($sql1);
            //     if (mysqli_query($conn, $sql1)) {
            //         echo "New record created successfully";
            //     } else {
            //         echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
            //     }

            //     mysqli_close($conn);
            //     //echo $time."\n".$SLN."\n";
            // }


            //echo "Updated item.\n";





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
