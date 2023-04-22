<?php

require_once("database/connect.php");
$db=new Database;
$db->connect();
if(session_status()===PHP_SESSION_NONE){session_start();}
 try
{ //echo $_POST['u_name']exit;
	$emp_data =$db->query('SELECT count(`u_id`) FROM `category` WHERE `u_name`="'.$_POST['u_name'].'" and active_record=1');
	$result = $emp_data->fetch();
	$count = $result[0];
	if($count==0)
	{
		$field_values=array();
		$field_values[0]=htmlentities(($_POST['u_name']),ENT_QUOTES);
		
		$PRO_ID=$db->insertreturnid('unit',$field_values,'u_name');
		
		if($PRO_ID)
		{
            echo "Unit Detail Entered Sucessfully.";
        }
        else
		{
            echo "Error! Please try again.";
        }
	}
	else{
		echo "Error! ".$_POST['u_name']." Already Exists Try Again"; exit; 
	}
		
		
 }
catch(Exception $my_e)
{
	echo "err";
	echo $my_e->getMessage();
} 

?>