<?php
require_once("database/connect.php");
$db=new Database;
$db->connect();
if(session_status()===PHP_SESSION_NONE){session_start();}

 try { 
    $signature = $_FILES["signature"]["name"];
    $tempname = $_FILES["signature"]["tmp_name"];
    $folder = "assets/" . $signature;
	$field_values=array();
	$field_values[0]=htmlentities(($signature),ENT_QUOTES);
	
	$PRO_ID=$db->insertreturnid('role',$field_values,'signature');
    if (move_uploaded_file($tempname, $folder)) {
        echo "success";
    }else {
        echo "failed";
    }
}
catch(Exception $my_e){
	echo "err";
	echo $my_e->getMessage();
} 
?>