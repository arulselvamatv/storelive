<?php

require_once("database/connect.php");
$db=new Database;
$db->connect();
if(session_status()===PHP_SESSION_NONE){session_start();}
 try
{ 
	$emp_data =$db->query('SELECT count(`sup_id`) FROM `suplier` WHERE `company_name`="'.$_POST['c_name'].'" and active_record=1');
	$result = $emp_data->fetch();
	$count = $result[0];
	if($count==0)
	{
		if($_POST['c_name'] != ""  && $_POST['mobile'] !="" && $_POST['address'] !="")
		{
			
		}
		else
		{
			echo "Some Fields Are Missing"; exit;
		}
				
			// echo "asdasd"; exit;
			$field_values=array();
			$field_values[0]=htmlentities(($_POST['c_name']),ENT_QUOTES);
			$field_values[1]=htmlentities(($_POST['name']),ENT_QUOTES);
			$field_values[2]=htmlentities(($_POST['mobile']),ENT_QUOTES);
			$field_values[3]=htmlentities(($_POST['address']),ENT_QUOTES);
			$field_values[4]=htmlentities(($_POST['gstin_no']),ENT_QUOTES);
			$field_values[5]=htmlentities(($_POST['pan_no']),ENT_QUOTES);
			$field_values[6]=htmlentities(($_POST['bank1']),ENT_QUOTES);
			$field_values[7]=htmlentities(($_POST['bank2']),ENT_QUOTES);
            $field_values[8]=htmlentities(($_POST['email']),ENT_QUOTES);
            $field_values[9]=htmlentities(($_POST['password']),ENT_QUOTES);
            $field_values[10]=htmlentities((implode(',', $_POST['supliercat'])),ENT_QUOTES);
            
            
        	$userfield_values=array();
            $userfield_values[0] = htmlentities($_POST['c_name'],ENT_QUOTES);
            $userfield_values[1] = htmlentities($_POST['email'],ENT_QUOTES);
            $userfield_values[2] = htmlentities($_POST['password'],ENT_QUOTES);
            $userfield_values[3] = '5';
            $userfield_values[4] ='suplier';
       
			
			
			$PRO_ID=$db->insertreturnid('suplier',$field_values,'company_name,name,mobile,address,gstin_no,pan_no,bank1,bank2,email,password,supliercat');
			$userfield_insert = $db->insertreturnid('users',$userfield_values,'name,email,pass,user_type,user_role');

			if($PRO_ID)	{
						echo "Suplier Details Entered Sucessfully."; exit;
					}
			else{
				echo "Error! Please try again."; exit;
			}
		
	}
	else
	{
		echo "Error! ".$_POST['c_name']." Already Exists Try Again"; exit; 
	}
		
 }
catch(Exception $my_e)
{
	echo "err";
	echo $my_e->getMessage();
} 

?>