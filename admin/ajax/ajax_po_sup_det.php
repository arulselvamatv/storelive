<?php

require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$c_name=$_GET['c_name'];
//echo $PRO; exit;

$HTML="";
	if($con)
	{
		
		
		$asd =('SELECT  `company_name`, `name`, `mobile`, `address`, `gstin_no`, `pan_no`, `bank1`, `bank2` FROM `suplier` WHERE `company_name` ="'.$c_name.'"' );
		//echo $asd; exit;
								 $datd = $db->query($asd);
		while($data=$datd->fetch(PDO::FETCH_ASSOC))
		{
			echo "<option>--Select Name--</option>";
			echo "<option value=".$data['name']." data-mobile=".$data['mobile']." data-address=".$data['address']." data-gstin_no=".$data['gstin_no']." data-pan_no=".$data['pan_no']." data-bank1=".$data['bank1']." data-bank2=".$data['bank2'].">".''.$data['name']."</option>";
		}
	}

	
	//echo "<option value=".$formtp_row['adrtpid']." data-prof_id=".$formtp_row['prof_id']." data-prd_id=".$formtp_row['hsn_code']." data-adv_prdt_fnl_dtls='".$formtp_row['adrtno']."_".$formtp_row['adrtdate']."_".$formtp_row['adv_amnt']."_".$formtp_row['prod_nm_id']."_".$formtp_row['part_no']."_".$formtp_row['model_no']."_".$formtp_row['hsn']."' data-adrtno='".$formtp_row['adrtno']."' data-adrtdate='".$formtp_row['adrtdate']."' data-adv_amnt='".$formtp_row['adv_amnt']."' data-adv_trnsfr_no='".$formtp_row['adv_trnsfr_no']."' data-adv_pymnt_md=".$formtp_row['adv_pymnt_md'].">".$formtp_row['adrtno']." (".$formtp_row['adrtdate'].") (Adv. Rs.: ".$formtp_row['adv_amnt'].") (".$formtp_row['prod_nm_id'].") (".$formtp_row['part_no'].") (".$formtp_row['model_no'].") HSN CODE (".$formtp_row['hsn'].")</option>";
    
?>
 