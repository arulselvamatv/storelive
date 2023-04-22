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
		
		<td>Invoice No.</td>
		
		<td>Bill Value</td>
		<td>Received Date</td>
	</tr>
</thead>';
if($con)
	{
		//$db->mquery('work_order','*','po_no=\''.$po.'\'','date_time');
		$asd =('SELECT  sl.`invoice_no`, sl.code, sl.`ddl_pro_qty`, sl.`ins_id`, sl.`installation`, sum(sl.`tran_charge`) as transport, sum(sl.`packing`) as packing, sl.`advance`, sum(ins.ins_qty) as ins_qty, sum(ins.ins_amt) as ins_amt, s.company_name, s.name, sl.date_time, sl.bill_tot FROM `slip_list` as sl
		inner join installtion as ins on ins.ins_id =  sl.ins_id
		inner join suplier as s on s.sup_id =  sl.sup_id
		WHERE sl.`active_record`=1 and sl.`invoice_no` ="'.$inv.'"  group by sl.`invoice_no`');
// 		echo $asd; exit;
		$data = $db->query($asd);
		while($row = $data->fetch(PDO::FETCH_ASSOC))
            {
			$html=$html."<tr>";
			$html=$html.'
			<td>
			<input  type="radio" checked value="'.$row['invoice_no'].'" id="chk_'.$row['invoice_no'].'" name="grb" >
			<input type="hidden" name="bill_no[]" value="'.$row['invoice_no'].'"> '.$row['invoice_no'].'</td>
			
			';

			$overall_total=( $row['bill_tot'] + $row['transport'] + $row['packing'] + $row['ins_amt']) * $row['ins_qty'];
			$html=$html."<td>".$overall_total."</td>";
			$html=$html."<td>".date("d-m-Y",strtotime($row['date_time']))."</td>";
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