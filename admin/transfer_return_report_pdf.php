<html>
<body>
<center><img src="img/Header.jpg">
</center>

<hr/>
<?php 
require_once("database/connect.php");
$db=new Database;
$db->connect();

$ret_no=$_GET['ret_no'];

//echo $ret_no.'<br>';

$asd =(' SELECT  COUNT(wo.prod_name) as qty,se.`se_no`,se.`billno`,t.`seno`,t.` return_number`,t.`reason`,t.fromdep,t.date_time,(wo.prod_name) as item_name, wo.product_spec as item_desc,c.dep_name,s.name as supplier_name,se.`store_id` from 

`store_entry` as se 

inner join `transfer` as t on t.`seno`=se.`se_no` 

INNER join work_order as wo on wo.wo_id =se.po_id 

INNER join client as c on c.cl_id =t.fromdep

INNER join suplier as s on s.sup_id =wo.suplier_id 

where t.` return_number`="'.$ret_no.'" group by item_name ');
       
//echo $asd; 

	$i=0;
	$prdt_data = $db->query($asd);
		
$i=1;
$tr2="";

 $sno = 0;
 
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
		<center><h3>Return Slip</h3></center>
		
				
	

		
	<div style=\"text-align:right;\"><b> Dated: ".date("d-m-Y",strtotime($prd['date_time']))."</b></div>

	<b>The following goods mentioned below are Returned To Store. <b><br>
	<br>
			

		
	<div style=\"text-align:left;\"><b> Reason: ".$prd['reason']."</b></div><br>
			
	
				
		<div style='border: 1px solid black;'>
		<table style='width:100%;' border=1>
		<thead>
		<tr>
		<td style='font-weight:bold ; text-align:center;'>S.No</td>
		<td style='font-weight:bold ; text-align:center;'>Department Name</td>
		<td style='font-weight:bold ; text-align:center;'>Supplier Name</td>
		<td style='font-weight:bold ; text-align:center;'>Product Name</td>
		<td style='font-weight:bold ; text-align:center;'>Product Specification</td>
		<td style='font-weight:bold ; text-align:center;'>Qty </td>

		
		</tr>
		</thead>
		<tbody>
		";
		++$i;
	}
	
		$tr2=$tr2."<tr>
	
	   	<td>&nbsp".(++$sno)." </td>
	   	<td>&nbsp".$prd['dep_name']."</td>
	   	<td>&nbsp".$prd['supplier_name']."</td>
		<td>&nbsp".$prd['item_name']."</td>
		<td>&nbsp".$prd['item_desc']."</td>
		<td>&nbsp".$prd['qty']."</td>

		</tr>";
	
}
echo $tr1.$tr2."
</tbody></table>
<br><br><br>

<table width=100% class='mb-5'><tr>

<td><b>Signature of Store Officer </b></td>   

<td style='text-align:center;'><b>The above mentioned goods have been received in good condition</b></td>

<td style='text-align:right;'><b>Signature of the Giver</b><td></td>
</tr></table></div>";


?>


</body>
</html>