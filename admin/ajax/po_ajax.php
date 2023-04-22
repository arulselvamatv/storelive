<?php 
require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$po=$_GET['po_no'];
$po_no = "PO_".$po;
$html='<form  target="_blank" method="post" action="po_view.php?po='.$po_no.'">

<table class="table table-stripped table-bordered table-hover">
<thead>
	<tr>
		<td>PO No.</td>
		<td>Received Date</td>
	</tr>
</thead>';
if($con)
	{
		//$db->mquery('work_order','*','po_no=\''.$po.'\'','date_time');
		$asd =('SELECT s.company_name,`wo_id`, `po_no`, `wo_no`, `quo_no`, `prod_name`, `ddl_pro_unit`, sum(`ddl_pro_qty`) as qty, `product_spec`, `suplier_id`, `sup_amt`, `disc_amt`, sum(`tot`) as tot, work_order.`active_record`, work_order.`date_time` FROM `work_order` 
		inner join suplier as s on s.sup_id = work_order.suplier_id
		WHERE work_order.`active_record`=1 and work_order.po_no ="'.$po_no.'"  group by work_order.po_no');
		//echo $asd; exit;
		$data = $db->query($asd);
		while($row = $data->fetch(PDO::FETCH_ASSOC))
            {
			$html=$html."<tr>";
			$html=$html.'
			<td>
			<input  type="radio" checked value="'.$po_no.'" id="chk_'.$po_no.'" name="grb" >
			<input type="hidden" name="bill_no[]" value="'.$po_no.'"> '.$po_no.'</td>
			
			';
			$html=$html."<td>".date("d-m-Y",strtotime($row['date_time']))."</td>";
			$html=$html."</tr>";
		}
		
		
	}
$html=$html."</table>
</form>";
echo $html;
?>
<!-- <center><input type='submit' value='Get PO Print'></center> -->