<html>
<body>
<center><img src="img/Header.jpg">
</center>

<hr/>
<?php 
require_once("database/connect.php");
$db=new Database;
$db->connect();
$inv1=$_GET['inv'];
// print_r($_POST);
	 $inv=$_POST['grb'];
	
// 	$no_rows=count($bill_no);
// 	$bill_id="(";
// 	$k=0;
// 	for($i=0;$i<$no_rows;$i++)
// 	{
// 		if(isset($_POST['chk_'.$bill_no[$i]]) and $_POST['chk_'.$bill_no[$i]])
// 		{
// 			if($k==0)
// 			{
// 				$bill_id=$bill_id."'".$bill_no[$i]."'";
// 				$k++;
// 			}
// 			else
// 				$bill_id=$bill_id.",'".$bill_no[$i]."'";
// 		}
// 	}
// 	$bill_id=$bill_id.")"; 
// 	echo $bill_id; exit;
	
	
	$asd =('SELECT st.`billno`,st.`gst_amt`,st.`disc_amt`,round(st.`per_amt`)as per_amt_round,wo.dep_no,st.`store_id`, st.code, st.invoice_no,
	 st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`, count(st.`store_id`)  as received_qty, 
	 st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt, st.`received_date` as po_date, st.`u_id`,wo.suplier_id as suplier_id,
	  s.name as supplier_name,s.company_name,s.address,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,
	  wo.product_spec as item_desc,wo.suplier_id, st.se_no as se_no , wo.po_no as po_no,
	  st.`dis_amt_value`

	   FROM `po_entry` as st 
                            INNER join work_order1 as wo on wo.wo_id = st.p_row_id
                            INNER join suplier as s on s.sup_id =wo.suplier_id
                            WHERE wo.`active_record` =1 and s.`active_record` =1 and st.invoice_no="'.$inv.'"  group by wo.`prod_name`');
 //	echo $asd; 
	$data = $db->query($asd);
$i=0;
$tr2="";
$j=1;
$rowcnt=1;
$tr1="";
while($row = $data->fetch(PDO::FETCH_ASSOC))
            {
	if($i==0)
	{
		$tr1="
		<style>
			@media{
				size:A4 Portrait;
			}
		</style>
		<center><h3>========== General Stores ==========</h3></center>
		<div style='text-align:right'>Date:".date("d-m-Y",strtotime($row['po_date']))."</div>
	

		To, <br>
		The Chairman <br>
		Kalasalingam University <br>
		Old. No.14 / New No.52 Sriman Srinivasan Road, <br>
		Alwarpet, Chennai 600 018. <br>
		<br>
		
		Through, <br>
		The Finance Officer <br>
		<br>
		
		Respected Sir,<br>
		
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sub: General Stores - Acknowledgement for Kalasalingam University - Reg.,<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ref:<b> GRB No:".$inv."/ PO Number :".$inv1."  </b><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> Bill No:".$row['billno']."  </b>

		<br>
		<br>
		
		With reference to the above, the receipt of materials is acknowledged as per Bill / Invoice of M/s. <b>".$row['company_name'].", ".$row['address']."</b>
		<br>
		<div style='border: 1px solid black;'>
		<table style='width:100%;' border=1>
		<thead>
		<tr>
		<td>Sl.No.</td>
		<td>Bill No.</td>
		<td>Bill Date</td>
		<td>Product</td>
		<td>Supplier Amount.</td>
		<td>Discount value</td>
		<td>Discount Command</td>
		<td>GST %</td>
		<td>Per Product Amount.</td>
		<td>Qty.</td>
		<td>Total Amount</td>
		
		</tr>
		</thead>
		<tbody>
		";
		$i++;
	}
	
		if($j==1)
			{
					$tr='<tr>
						<td>'.$i.'</td>
						<td rowspan='.$rowcnt.'>'.$row['billno'].'</td>
						<td style="width:10%;" rowspan='.$rowcnt.'>'.date("d-m-Y",strtotime($row['bill_date'])).'</td>
						
						
						';	
						
			}
			else
			{
				$tr='<tr><td>'.$i.'</td>';
			}

			$tot=$row['per_amt'] * $row['qty'];

			$billamt=$row['bill_amt'] * $row['qty'];

		   $tr2=$tr2.$tr.	"<td>".$row['item_name'].", ".$row['item_desc']."</td>".

		   "<td>".$row['bill_amt']."<input type='hidden' class='bill_amt' id='bill_amt_".$i."' value=".$row['bill_amt']." ></td>".
			
		   "<td>".$row['dis_amt_value']."<input type='hidden' class='dis_amt_value' id='dis_amt_value_".$i."' value=".$row['dis_amt_value']." ></td>".
			
		   "<td>".$row['discamt']."<input type='hidden' class='discamt' id='discamt_".$i."' value=".$row['discamt']." ></td>".
						
						// "<td>".$row['disc_amt']."<input type='hidden' class='disc_amt' id='disc_amt_".$i."' value=".$row['disc_amt']." ><input type='hidden' class='billamt' id='billamt_".$i."' value=".$billamt." ></td>".
						"<td>".$row['gst_amt']."<input type='hidden' class='gst_amt' id='gst_amt_".$i."' value=".$row['gst_amt']." ></td>".
						"<td>".$row['per_amt_round']."<input type='hidden' class='sup_amt' id='sup_amt_".$i."' value=".$row['per_amt_round']." ></td>".
						"<td>".$row['qty']."</td>".
						"<!--<td style='width:10%;'>".date("d-m-Y",strtotime($row['date_time']))."</td>-->".
						"<td>".$tot."<input type='hidden' class='tots' id='tots_".$i."' value=".$tot." ></td>
						</tr>";
		
		if($rowcnt==1 or $rowcnt==$j)
			{
				$j=1;
			}
			else{
				$j=$j+1;
			}
		$i++;
	
}
echo $tr1.$tr2."
</tbody></table>
</div>";
$asda =('SELECT st.`billno`,st.`gst_amt`,st.`disc_amt`,st.`per_amt`,wo.dep_no,st.`store_id`, st.code, st.invoice_no, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`, count(st.`store_id`) as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt, st.`received_date` as po_date, st.`u_id`,st.`tran_charge_gst`,st.`ser_charge_gst`,st.`adv`,wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,wo.suplier_id, st.se_no as se_no , wo.po_no as po_no  ,st.`grand_total` FROM `po_entry` as st INNER join work_order1 as wo on wo.po_no =st.po_id INNER join suplier as s on s.sup_id =wo.suplier_id WHERE wo.`active_record` =1 and s.`active_record` =1 and st.invoice_no="'.$inv.'" group by st.`invoice_no`
');
// 	echo $asda;"'.$inv.'"
	$dataa = $db->query($asda);
	while($rows = $dataa->fetch(PDO::FETCH_ASSOC))
	{
		$grand_total= ($rows['bill_tot'] + $rows['packing'] + $rows['tran_charge_gst']);
	echo "<table style='width:100%;' border=0>
	<tr>
		<td>GRB Date :</td><td>".date("d-m-Y",strtotime($rows['po_date']))."</td>
		<td>Total Goods Value :</td><td class='goods_value'></td>
		
	</tr>
	<tr>
	<td>Discount Amount :</td><td>".$rows['disc_amt']."<input type='hidden' class='disc_amt' value=".$rows['disc_amt']." ></td></td>		<td>GST Amount :</td><td class='gst'></td>
	</tr>
	<tr>
		<td>Packing and Forwarding Charges :</td><td>".$rows['packing']."<input type='hidden' class='packing' value=".$rows['packing']." ></td>
		<td>Service Charges :</td><td>".$rows['ser_charge_gst']."<input type='hidden' class='ins_amt' value=".$rows['ser_charge_gst']." ></td>
	</tr>
	<tr>
		
		<td>Transportation Charges :</td><td>".$rows['tran_charge_gst']."<input type='hidden' class='transport' value=".$rows['tran_charge_gst']." ></td>
		<td>Grant Total :</td><td class='grand_total'></td>
	</tr>
	<tr>
		<td>Advance Payment :</td><td>".$rows['adv']."<input type='hidden' class='advance' value=".$rows['adv']." ></td>
		<td>Amount Payable :</td><td>".$rows['grand_total']."<input type='hidden' class='advance' value=".$rows['grand_total']." ></td>
		
	</tr>";
		$asdaa =('SELECT `grb_id`, `payment_mode`, `transaction_no`, `payment_amount`, `inv_no` FROM `grb_payment` WHERE `inv_no` ="'.$inv.'" ');
	//echo $asdaa; exit;
	$dataaa = $db->query($asdaa);
	while($rowsaa = $dataaa->fetch(PDO::FETCH_ASSOC))
	{
	echo "<tr>
	<td>Payment Mode :</td><td>".$rowsaa['payment_mode']."</td>
	<td>Transaction no/bill no :</td><td>".$rowsaa['transaction_no']."</td>
	<td>Payment Amount:</td><td>".$rowsaa['payment_amount']."</td>
    </tr>";
	}
	echo "</table>
	";
	echo "
	<br>
	<div style='border: 1px solid black; height:150pt;'>
	<center>-------------------------------Comments--------------------------</center>
	</div>

	";
}

?>

Certified that entries were made in concerned account section. Hence the bill may be passed.
<div>
<br>
<br>
<br>
<table width="100%"><tr><td>FINANCE OFFICER</td><td style="text-align:right;">STORE OFFICER</td></tr></table>
</div>
</body>

<script src="../assets/node_modules/jquery/dist/jquery.min.js"></script>
<script>
	$(document).ready(function() {				
		var total = 0;

				$(".tots").each(function (index, element) {
					
					total = Number(total) + Number($(element).val());
					
				});

				$(".goods_value").html(total);

		var discount = 0;

				$(".disc_amt").each(function (index, element) {
					var this_attr_id = $.trim($(this).attr("id"));
                	var splt_this_id = this_attr_id.split("_");
                	var splt_this_id_ar = splt_this_id[2];
					var tots = $('#billamt_'+splt_this_id_ar).val();
					var disc_amt = $(element).val();
					
  					var dec = (disc_amt/100).toFixed(2); //its convert 10 into 0.10
 					var mult = Number(tots)*Number(dec);
					
					 discount = Number(discount) + Number(mult);
					
				});
	// $tmp_disc=($temp*$row->disc/100);
	// $disc=$disc+$tmp_disc;
	
	// $gst=$gst+(($temp-$tmp_disc)*$row->gst/100);	
		
		$(".disc").html(discount .toFixed(2));
		var gst = 0;

		$(".gst_amt").each(function (index, element) {

			var this_attr_id = $.trim($(this).attr("id"));
			var splt_this_id = this_attr_id.split("_");
			var splt_this_id_ar = splt_this_id[2];
			var tots = $('#billamt_'+splt_this_id_ar).val();
			var gst_amt = $(element).val();
			
			var dec = (gst_amt/100).toFixed(2); //its convert 10 into 0.10
			var mult = Number(tots)*Number(dec);
			
			gst = Number(gst) + Number(mult);
			
		});
		$(".gst").html(gst.toFixed(2));


		$packing= $(".packing").val();
		$ins_amt= $(".ins_amt").val();
		$transport= $(".transport").val();

		$grand_total= Number($packing) + Number($ins_amt) + Number($transport)+ Number(total) ;

		$(".grand_total").html($grand_total .toFixed(2));
		$advance= $(".advance").val();
		$overall_total=Number($grand_total) ;
		$(".overall_total").html($overall_total .toFixed(2));



		});
	</script>
</html>

<!-- / Dated: ".date("d-m-Y",strtotime($row['date_time']))." -->