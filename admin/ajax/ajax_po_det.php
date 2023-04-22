<?php

require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$PRO=$_GET['PRO'];
//echo $PRO; exit;
$PRO_TY=$_GET['PRO_TY'];

$HTML="";
	if($con)
	{
		
		
		$asd =('SELECT pdi.`pro_code`,pdi.`pro_name`, pdi.`pro_desc` FROM `product_details_info` as pdi inner JOIN product_details as pd on pd.`pro_id` = pdi.`pro_id` WHERE  pd.`cat_name` = "'.$PRO.'" and pd.`pro_ty` ="'.$PRO_TY.'"');
		//echo $asd; exit;
		$datd = $db->query($asd);
		while($data=$datd->fetch(PDO::FETCH_ASSOC))
		{
			echo "<option value=".$data['pro_code']." - ".$data['pro_name']." - ".$data['pro_desc'].">".''.$data['pro_code']." - ".$data['pro_name']." - ".$data['pro_desc']."</option>";
		}
		
	}

	
	    
?>
 