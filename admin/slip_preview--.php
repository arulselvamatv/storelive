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

$asd =('SELECT st.`store_id`,  st.code, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`, st.installation, count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt,st.disc_amt as disc_amt, st.gst_amt as gst_amt, st.unit as unit,st.`received_date` as po_date, st.`u_id`, st.`grb_id` as grb_id, g.overall_total as overall_total,wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as prod_name,wo.ddl_pro_qty,wo.product_spec as product_spec,wo.suplier_id, st.se_no as se_no , wo.po_no as po_no FROM `store_entry` as st 
        INNER join grb as g on g.grb_no =st.grb_id
        INNER join work_order as wo on wo.wo_id =st.po_id
        INNER join suplier as s on s.sup_id =wo.suplier_id
        WHERE wo.`active_record` =1 and s.`active_record` =1 and st.dep=0 and st.code ="'.$code.'" group by st.grb_id');
		//echo $asd; exit;
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
		<center><h3>Verification Slip Dated:".date("d-m-Y")."</h3></center>
		<div style=\"text-align:right;\"><b>PO Order No:".$prd['po_no']." / Dated: ".date("d-m-Y H:m",strtotime($prd['po_date']))."</b></div>
		This is to certify that the below mentioned goods have been received and the working condition of the goods have also been verified.<br>
		<div style='border: 1px solid black;'>
		<table style='width:100%;' border=1>
		<thead>
		<tr>
		
		<td>Product</td>
		<td>Quantity</td>
		<td>Qty. Received</td>
		<td>Condition</td>
		<td>Signature</td>
		
		</tr>
		</thead>
		<tbody>
		";
		$i++;
	}
	
		$tr2=$tr2."<tr><td><b>".
		$prd['prod_name']."</b><br>".$prd['product_spec']."</td><td>".
		$prd['received_qty']."</td>
		<td></td>
		<td style='width:10%;'></td>
		<td style='width:10%;'></td>
		</tr>";
	
}
echo $tr1.$tr2."
</tbody></table>
<br><br><br>
<table width=100%><tr>
<td><b>Signature of Technical Officer </b></td><td style='text-align:right;'><b>Signature of the head of Department</b><td></td>
</tr></table></div>";


?>


</body>
</html>