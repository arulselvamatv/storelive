<?php

require_once("database/connect.php");
$db=new Database;
$db->connect();
if(session_status()===PHP_SESSION_NONE){session_start();}
 try
{ 
	$emp_data =$db->query('SELECT count(1) FROM `suplier_quotaion_url_generation` WHERE `sup_id`="'.$_POST['supplier_name'].'" and quo_no ="'.$_POST['quo_no'].'" and active_record=1');
	$result = $emp_data->fetch();
	$count = $result[0];
	if($count==0)
	{
		if($_POST['supplier_name'] != "" && $_POST['quo_no'] != "" )
		{
			
		}
		else
		{
			echo "Some Fields Are Missing"; exit;
		}
			$url="http://lafs-atv.com/karestore1/admin/suplier_quotation_amt.php?sup_id=".base64_encode($_POST['supplier_name'])."&quo_no=".base64_encode($_POST['quo_no']);
			// echo "asdasd"; exit;
			$field_values=array();
			$field_values[0]=htmlentities(($_POST['supplier_name']),ENT_QUOTES);
			$field_values[1]=htmlentities(($_POST['quo_no']),ENT_QUOTES);
			$field_values[2]=htmlentities(($url),ENT_QUOTES);
			
			
			$PRO_ID=$db->insertreturnid('suplier_quotaion_url_generation',$field_values,'sup_id,quo_no,genertated_url');
			
			if($PRO_ID)
					{
						echo "Url Genertated Sucessfully."; exit;
					}
			else{
				echo "Error! Please try again."; exit;
			}
		
	}
	else
	{
		echo "Already Generated Url To Suplier on Quotation No".$_POST['quo_no']; exit; 
	}
		
 }
catch(Exception $my_e)
{
	echo "err";
	echo $my_e->getMessage();
} 

?>