<?php

require_once("database/connect.php");
$db=new Database;
$db->connect();
if(session_status()===PHP_SESSION_NONE){session_start();}
 try
{ //echo $_POST['c_name']exit;
	$emp_data =$db->query('SELECT count(`ca_id`) FROM `category` WHERE `category_name`="'.$_POST['c_name'].'" and active_record=1');
	$result = $emp_data->fetch();
	$count = $result[0];
	if($count==0)
	{
		$field_values=array();
		$field_values[0]=htmlentities(($_POST['c_name']),ENT_QUOTES);
		
		$PRO_ID=$db->insertreturnid('category',$field_values,'category_name');
		
		if($PRO_ID)
		{
            echo "Category Details Entered Sucessfully.";
        }
        else
		{
            echo "Error! Please try again.";
        }
	}
	else{
		echo "Error! ".$_POST['c_name']." Already Exists Try Again"; exit; 
	}
		
		
 }
catch(Exception $my_e)
{
	echo "err";
	echo $my_e->getMessage();
} 

?>