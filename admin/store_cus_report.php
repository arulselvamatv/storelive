<html>
<body>
<center><img src="img/Header.jpg">
</center>

<hr/>
<?php 
require_once("database/connect.php");
$db=new Database;
$db->connect();
$code=$_GET['pid'];

	$asd =('SELECT  (select `dep_name` from client where `cl_id`=sl.`dep_name`  )as d_name ,sl.`sl_id`, sl.`code`, sl.`sl_no`, sl.`se_no`, sl.`quo_no`, sl.`po_no`, sl.`prod_name`, sl.`pro_ty`, sl.`ddl_pro_qty`, sl.`ddl_pro_spec`,se.nosunit, sl.`supname`, sl.`rate`,sl.`indent_no`, sl.`date_time`, 

     SUBSTRING_INDEX (`prod_name`, "-" ,1) AS `procode` , SUBSTRING_INDEX (`prod_name`, "-" ,-1) AS proname ,

	sl.`dep_name`, sl.`crn_date_time`, sl.`active_record`, s.company_name FROM `store_list` as sl 
	
	INNER join store_entry as se on se.se_no=sl.se_no

	INNER JOIN suplier as s on s.sup_id = sl.supname
	WHERE sl.`active_record`= 1 and sl.code='.$code.' group by sl.`prod_name`');
                            
// 		echo $asd; exit;
		$i=0;
		$prdt_data = $db->query($asd);
		
$i=1;

$s=1;

$tr2="";

while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))
		{
	if($i==1)
	{
		$tr1="
		<style>
			@media{
				size:A4 Portrait;
			}
		</style>
		<center><h3>Delivery Slip</h3></center>
		
				
	

		
	<div style=\"text-align:right;\"><b> Dated: ".date("d-m-Y",strtotime($prd['crn_date_time']))."</b></div>
	<div style=\"text-align:right;\"><b> Delivery Bill No: ".$prd['sl_no']."</b></div>

	<span style='color:#ff0000'>*</span> <b>The following goods mentioned below are delivered as requested in the Indent no :".$prd['indent_no']." <b><br>
	<br>
			

		
	<div style=\"text-align:left;\"><b> Company Name: ".$prd['company_name']."</b></div>
			
	<div style=\"text-align:left;\"><b> Department Name: ".$prd['d_name']."</b></div>
				
		<div style='border: 1px solid black;'>
		<table style='width:100%;' border=1>
		<thead>
		<tr>
		
	
	

		<td style='font-weight:bold ; text-align:center;'>S.No</td>
		<td style='font-weight:bold ; text-align:center;'>Product Code</td>
		<td style='font-weight:bold ; text-align:center;'>Product Name</td>
		<td style='font-weight:bold ; text-align:center;'>Unit</td>
		<td style='font-weight:bold ; text-align:center;'>Qty </td>

		
		</tr>
		</thead>
		<tbody>
		";
		$i++;
	}
	$s=0;
	
		$tr2=$tr2."<tr>
		<td>&nbsp".(++$sno)."</td>
		<td>&nbsp".$prd['procode']."</td>
		<td>&nbsp".$prd['proname']."</td>
		<td>&nbsp".$prd['nosunit']."</td>
		<td>&nbsp".$prd['ddl_pro_qty']."</td>

		</tr>";
	
}
echo $tr1.$tr2."
</tbody></table>
<br><br><br>

<table width=100% class='mb-5'><tr>

<td><b>Signature of Store Officer </b></td>   

<td style='text-align:center;'><b>The above mentioned goods have been received in good condition</b></td>

<td style='text-align:right;'><b>Signature of the Receiver</b><td></td>
</tr></table></div>";


?>


</body>
</html>