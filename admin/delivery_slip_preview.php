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

$asd =('SELECT wo.dep_no,wo.remarks,st.`store_id`, st.code, st.invoice_no, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`, count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt, st.`received_date` as po_date, st.`u_id`,wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,wo.suplier_id, st.se_no as se_no ,wo.location, wo.po_no as po_no FROM `store_entry` as st 
                            INNER join work_order as wo on  wo.wo_id =st.po_id
                            INNER join suplier as s on s.sup_id =wo.suplier_id
                            WHERE wo.`active_record` =1 and s.`active_record` =1 and st.code ="'.$code.'"  group by wo.prod_name');
                            
// 		echo $asd; exit;
		$i=0;
		$prdt_data = $db->query($asd);
		
$i=1;
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
		<center><h3>Goods Inward Slip</h3></center>
		
	<div style=\"text-align:left;\"><b>Department Po-No :<span style='padding-left:5px'> ".$prd['dep_no']."</span> </b></div>
	
	<div style=\"text-align:left;\"><b>Department Name :<span style='padding-left:5px'>".$prd['location']."</span></b></div>

	

		
	<div style=\"text-align:right;\"><b>Bill Dated: ".date("d-m-Y",strtotime($prd['po_date']))."</b></div>

	<div style=\"text-align:right;\"><b> Store in entry slip Number/Bill Number : ".$prd['invoice_no']."/".$prd['billno']."</b></div>
		
	<span style='color:#ff0000'>*</span> <b>The following goods are recevied from M/s ".$prd['supplier_name']." 
	
	on ".date("d-m-Y",strtotime($prd['bill_date']))." .<b><br>

	
				

			
		<br>

		
		<div style='border: 1px solid black;'>
		<table style='width:100%;' border=1>
		<thead>
		<tr>
		<td style='text-align:center;'>S.No</td>
		<td style='text-align:center;'>Product Name</td>
		<td style='text-align:center;'>Ordered Quantity</td>
		<td style='text-align:center;'>Delivered Quantity</td>
		<td style='text-align:center;'>Per Amount</td>
		
		<td style='text-align:center;'> Total Amount</td>
		
		</tr>
		</thead>
		<tbody>
		";
		$i++;
	}
	$qty=$prd['qty'];
	$per_amt=$prd['per_amt'];
	
	$amt  = $qty *$per_amt ;
	
		$tr2=$tr2."<tr>
		<td>".(++$sno)."</td>
		<td><b>&nbsp".$prd['item_name']."</b><br>".$prd['item_desc']."</td>
		<td>&nbsp".$prd['actual_qty']."</td>
		<td>&nbsp".$prd['qty']."</td>
		<td>&nbsp".$prd['per_amt']."</td>
		<td>&nbsp".$amt."</td>
		</tr>";
	
}
echo $tr1.$tr2."
</tbody></table>

<br><br><br>

<table width=100%>

<tr class='text-right'>
<span style='color:#ff0000'>*</span> 	<b>The quantity and quality  have been verified and found to  be correct<b>
<br>
<br>
<br>
<br>
<br>



<td class=' fw-bold'><b> Signature of the Department Representative<b></td>
<td style='text-align:right;'><b>Signature of the Store Officer</b></td>

</tr></table></div>";


?>


</body>
</html>