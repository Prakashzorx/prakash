<?php
require '../vendor/autoload.php';

use Aws\Iot\IotClient;
use Aws\Exception\AwsException;
use Aws\IotDataPlane\Exception;

a1bmjgj4h06eyc-ats.iot.ap-south-1.amazonaws.com

try{
    $result = $client->publish([
        'payload' => '{name:"bapu"}',
        'qos' => 1,
        'retain' => true || false,
        'topic' => '<string>', // REQUIRED
    ]);
} catch (Exception $e) {

}

?>