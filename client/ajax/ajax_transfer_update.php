<?php
error_reporting(0);
if (session_status() === PHP_SESSION_NONE) {session_start();}
require_once("../database/connect.php");

$db = new Database;
$db->connect();

$frmclient = $_POST['frmclient'];
$seno_arr = explode(',',$_POST['seno']);
$reason = $_POST['reason'];
$toclient = $_POST['toclient'];

$response = array('status'=>false);

if(empty($reason)){
    $response['err'] = 'reason_empty';
    $response['err_msg'] = 'Reason is required for Transfer';
}else if($reason === 'client' && empty($toclient)){
    $response['err'] = 'client_empty';
    $response['err_msg'] = 'Client is required for Transfer';
}else {

    if($reason == 'client' && !empty($toclient)){
        foreach ($seno_arr as $seno){
            $field_values = array();
            $field_values[0] = htmlentities(($seno), ENT_QUOTES);
            $field_values[1] = htmlentities(($reason), ENT_QUOTES);
            $field_values[2] = htmlentities(($frmclient), ENT_QUOTES);
            $field_values[3] = htmlentities(($toclient), ENT_QUOTES);
            $field_values[4] = 0;

            $PRO_ID = $db->insertreturnid('transfer', $field_values, 'seno, reason, fromdep, todep,  active_record');
            if ($PRO_ID) {
                $datd = $db->query('UPDATE store_entry SET history = 1, dep="' . $toclient . '" WHERE `se_no`="' . $seno . '"');

                $response['status'] = true;
            } else {
                $response['err'] = 'client_transfer_fail';
                $response['err_msg'] = 'Failed to Transfer';
            }
        }
    }else{
        foreach ($seno_arr as $seno){
            $field_values = array();
            $field_values[0] = htmlentities(($seno), ENT_QUOTES);
            $field_values[1] = htmlentities(($reason), ENT_QUOTES);
            $field_values[2] = htmlentities(($frmclient), ENT_QUOTES);

            $PRO_ID = $db->insertreturnid('transfer', $field_values, 'seno, reason, fromdep');
            if ($PRO_ID) {
                $datd = $db->query('UPDATE store_entry SET history = 1, tranf = 1 WHERE `se_no`="' . $seno . '"');

                $response['status'] = true;
            } else {
                $response['err'] = 'transfer_fail';
                $response['err_msg'] = 'Failed to Transfer';
            }
        }
    }
}

echo json_encode($response);