<?php
require_once("database/connect.php");
$db=new Database;
$db->connect();
if(session_status()===PHP_SESSION_NONE){session_start();}
try
{ 		
	if($_POST['e_c_id'] != "" && $_POST['e_c_name'] != ""  && $_POST['e_mobile'] !="" )
		{
			
		}
		else
		{
			echo "Some Fields Are Missing"; exit;
		}
		
		$e_c_id=$_POST['e_c_id'];
		$e_c_name=$_POST['e_c_name'];
		$e_name=$_POST['e_name'];
		$e_mobile=$_POST['e_mobile'];
		$e_address=$_POST['e_address'];
		$e_email=$_POST['e_email'];
		$e_password=$_POST['e_password'];
		$e_gstin_no=$_POST['e_gstin_no'];
		$e_pan_no=$_POST['e_pan_no'];
		$e_bank1=$_POST['e_bank1'];
		$e_bank2=$_POST['e_bank2'];
		$e_supliercat = implode(',', $_POST['e_supliercat']);

		
		//echo $e_bank2;exit;
		
		
		$asd =('UPDATE suplier SET company_name="'.$e_c_name.'", name="'.$e_name.'", mobile="'.$e_mobile.'", address="'.$e_address.'", email="'.$e_email.'",password="'.$e_password.'",gstin_no="'.$e_gstin_no.'", pan_no="'.$e_pan_no.'", bank1="'.$e_bank1.'", bank2="'.$e_bank2.'", supliercat="'.$e_supliercat.'" WHERE `sup_id`="'.$e_c_id.'"');
		$datd = $db->query($asd);
		
		
		if($datd)
		{
				echo "Suplier Details Updated Sucessfully."; exit;
		}
			else
		{
				echo "Error! Please try again."; exit;
		}
}
catch(Exception $my_e)
{
	echo "err";
	echo $my_e->getMessage();
} 

?>