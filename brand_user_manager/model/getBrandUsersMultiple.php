<?php

require_once "../controller/functions.php";











$id = $_POST["id"];
$userid = $_POST["userid"];
//print_r($_POST['usropt1']);

$brandusers = getBrandUsers($id);
//print_r($brandusers);exit;
if ($brandusers == false) {
    $responce['id'][0] = '';
    $responce['name'][0] = '';
} else {
    if (isset($_POST['useropt1']) && !empty($_POST['useropt1'])) {

        $i = 0;
        foreach ($brandusers as $row) {
            if (strcmp($row['user_id'], $userid) == 0) { 
            } else
            if (strcmp($row['user_id'], $_POST['useropt1']) == 0) {
            } else {
                $responce['id'][$i] = $row['user_id'];
                $responce['name'][$i] = $row['name'];
                $i++;
            }
        }
    } else {
        $i = 0;
        foreach ($brandusers as $row) {
            if (strcmp($row['user_id'], $userid) == 0) {
            } else {
                $responce['id'][$i] = $row['user_id'];
                $responce['name'][$i] = $row['name'];
                $i++;
            }
        }
    }
}




///print_r($responce);exit;
echo json_encode($responce);
