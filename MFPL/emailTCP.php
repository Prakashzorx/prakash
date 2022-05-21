<?php
 //header("Refresh: 60");
require_once "controller/functions.php";
require_once "controller/tcp_function.php";
require_once "controller/recipe_update_functions.php";
//print_r('dgfd');
$tcpdata = [];
$imeiusers = [];
$to      = 'bapukhatavi@gmail.com';
            $subject = 'the subject';
            $message = 'hello';
            $headers = array(
                'From' => 'bapukhatavi1992@gmail.com',
                'Reply-To' => 'bapu@braveryes.com',
                'X-Mailer' => 'PHP/' . phpversion()
            );
            
            mail($to, $subject, $message, $headers);
//$tcpdata=getallTcpDataBySts();
//$uniqueusers = uniqueAssignedUsers();
//$imeiusers=select_tcp_assignedmachines();


//date_default_timezone_set("Asia/Kolkata");
//$datetoday=date("Y/m/d H:i:s", strtotime("-10 minute"));
//print_r($tcpdata);
//  print_r($uniqueusers);
//  print_r($imeiusers);exit;
// $datetoday = "2022/04/14 10:35:42";
// foreach ($uniqueusers as $imei) {
//     print_r($imei['imei']);exit;
//     $tcpdata = getallTcpDataBySts($imei['imei'], $datetoday);
//     //print_r($tcpdata[1]);
//     $tcp = $tcpdata[1];
//     if ($tcp['alarm_type'] == 'a0') {
//         $imeiusers = select_tcp_assignedmachines($imei['imei']);
        //print_r($imeiusers[1]);exit;
//         foreach ($imeiusers as $imeiuser) {
//   $emailuser = 'bapukhatavi@gmail.com';
//   print_r($imeiuser);

//             //$emailuser = $imeiuser['email'];
           
//             //print_r($emailuser);exit;

//             $to      = 'bapukhatavi@gmail.com';
//             $subject = 'the subject';
//             $message = 'hello';
//             $headers = array(
//                 'From' => 'bapukhatavi1992@gmail.com',
//                 'Reply-To' => 'bapu@braveryes.com',
//                 'X-Mailer' => 'PHP/' . phpversion()
//             );
            
//             mail($to, $subject, $message, $headers);
          
//            print_r('mail sent');
//         }

        //$emailuser= $imeiuser['email'];

        //print_r($emailuser);exit;
   // }

    //  foreach ($tcpdata as $tcp) {
    //     //print_r($tcp);exit;
    //     if($tcp['imei']==$imei['imei']){
    //         // print_r($tcp);exit;
    //     }
    //  }
//}

?>
