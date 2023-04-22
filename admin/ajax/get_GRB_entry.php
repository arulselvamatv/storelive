<?php 
require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$inv=$_GET['inv'];
$a=$_GET['a'];
if($a==1){
   $html=' <form  target="_blank" method="post" action="grb_preview.php?inv='.$inv.'">';
}
else{
    $html=' <form  target="_blank" method="post" action="grb_edit.php?inv='.$inv.'">';
}
$html=$html.='

<table class="table table-stripped table-bordered table-hover">
<thead>
	<tr>
		
		<td>GRB No</td>
		<td>PO No.</td>
		<td>Bill Number</td>
	    <td>Bill Amount</td>

		<td>Bill Generation Date</td>
	</tr>
</thead>';
if($con)
	{
		//$db->mquery('work_order','*','po_no=\''.$po.'\'','date_time');
		$asd =('SELECT wo.dep_no,st.`store_id`, st.code, st.invoice_no, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`, count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`grand_total`,st.`bill_amt`as bill_amt, st.`received_date` as po_date, st.`u_id`,wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,wo.suplier_id, st.se_no as se_no , wo.po_no as po_no FROM `po_entry` as st 
                            INNER join work_order1 as wo on wo.po_no =st.po_id
                            INNER join suplier as s on s.sup_id =wo.suplier_id
                            WHERE wo.`active_record` =1 and s.`active_record` =1 and wo.dep_no="'.$inv.'"  group by st.invoice_no');
//  		echo $asd; exit;
		$data = $db->query($asd);
		while($row = $data->fetch(PDO::FETCH_ASSOC))
            {
			$html=$html."<tr>";
			$html=$html.'
			<td>
			<input  type="radio" checked value="'.$row['invoice_no'].'" id="chk_'.$row['invoice_no'].'" name="grb" >
			<input type="hidden" name="bill_no[]" value="'.$row['invoice_no'].'"> '.$row['invoice_no'].'</td>
			
			<td>'.$inv.'</td> ';

			$overall_total=( $row['bill_tot'] + $row['transport'] + $row['packing'] + $row['ins_amt']) * $row['ins_qty'];
// 			$html=$html."<td>".$overall_total."</td>";

			$html=$html."<td>".$row['billno']."</td>";
			$html=$html."<td>".$row['grand_total']."</td>";

			$html=$html."<td>".date("d-m-Y",strtotime($row['po_date']))."</td>";
			$html=$html."</tr>";
		}
		
		
	}
$html=$html."</table>";
if($a==1){
  $html=$html."<center><input type='submit' value='Get GRB PDF'></center></form>";
}
else{
   $html=$html."<center><input type='submit' value='Edit GRB PDF'></center></form>";
}

echo $html;
?>