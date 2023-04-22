<html>
<body>
<center><img src="img/Header.jpg">
</center>

<hr/>
<?php 
require_once("database/connect.php");
$db=new Database;
$db->connect();
$inv=$_GET['inv'];
//print_r($_POST);
	/* $bill_no=$_POST['bill_no'];
	
	$no_rows=count($bill_no);
	$bill_id="(";
	$k=0;
	for($i=0;$i<$no_rows;$i++)
	{
		if(isset($_POST['chk_'.$bill_no[$i]]) and $_POST['chk_'.$bill_no[$i]])
		{
			if($k==0)
			{
				$bill_id=$bill_id."'".$bill_no[$i]."'";
				$k++;
			}
			else
				$bill_id=$bill_id.",'".$bill_no[$i]."'";
		}
	}
	$bill_id=$bill_id.")"; */
	
	
	$asd =('SELECT  sl.`invoice_no`, sl.code, sl.`ddl_pro_qty`, sl.`ins_id`, sl.`installation`, sum(sl.`tran_charge_gst`) as transport, sum(sl.`packing`) as packing, sl.`advance`, sum(ins.ins_qty) as ins_qty, sum(ins.ins_amt) as ins_amt, s.company_name, s.name, s.address, sl.date_time, sl.bill_tot
	,sl.`prod_name`,sl.ddl_pro_qty, sl.ddl_pro_spec, sl.sup_amt,sl.disc_amt,sl.gst_amt,sl.per_tot,sl.bill_tot FROM `slip_list` as sl
	inner join installtion as ins on ins.ins_id =  sl.ins_id
	inner join suplier as s on s.sup_id =  sl.sup_id
	WHERE sl.`active_record`=1 and sl.`invoice_no` ="'.$inv.'"  group by sl.`prod_name`');
	//echo $asd; exit;
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
		<div style='text-align:right'>Dated:".date("d-m-Y")."</div>
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
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ref:<b> Invoice No:".$inv." / Dated: ".date("d-m-Y H:m",strtotime($row['date_time']))."</b>
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
		<td>Discount %</td>
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
						<td rowspan='.$rowcnt.'>'.$inv.'</td>
						<td style="width:10%;" rowspan='.$rowcnt.'>'.date("d-m-Y",strtotime($row['date_time'])).'</td>
						
						
						';	
						
			}
			else
			{
				$tr='<tr><td>'.$i.'</td>';
			}
			$tot=$row['sup_amt'] * $row['ddl_pro_qty'];
		$tr2=$tr2.$tr.	"<td>".$row['prod_name'].", ".$row['ddl_pro_spec']."</td>".
						
						"<td>".$row['disc_amt']."<input type='hidden' class='disc_amt' id='disc_amt_".$i."' value=".$row['disc_amt']." ></td>".
						"<td>".$row['gst_amt']."<input type='hidden' class='gst_amt' id='gst_amt_".$i."' value=".$row['gst_amt']." ></td>".
						"<td>".$row['sup_amt']."<input type='hidden' class='sup_amt' id='sup_amt_".$i."' value=".$row['sup_amt']." ></td>".
						"<td>".$row['ddl_pro_qty']."</td>".
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
$asda =('SELECT  sl.`invoice_no`, sl.code, sl.`ddl_pro_qty`, sl.`ins_id`, sl.`installation`, sl.`tran_charge_gst`, sl.`packing`, sl.`advance`, sum(ins.ins_qty) as ins_qty, sum(ins.ins_amt) as ins_amt, s.company_name, s.name, s.address, sl.date_time, sl.bill_tot
,sl.`prod_name`,sl.ddl_pro_qty, sl.ddl_pro_spec, sl.sup_amt,sl.disc_amt,sl.gst_amt,sl.per_tot,sl.bill_tot FROM `slip_list` as sl
inner join installtion as ins on ins.ins_id =  sl.ins_id
inner join suplier as s on s.sup_id =  sl.sup_id
WHERE sl.`active_record`=1 and sl.`invoice_no` ="'.$inv.'"  group by sl.`invoice_no`');
	//echo $asd; exit;
	$dataa = $db->query($asda);
	while($rows = $dataa->fetch(PDO::FETCH_ASSOC))
	{
		$grand_total= ($rows['bill_tot'] + $rows['packing'] + $rows['tran_charge_gst']);
	echo "<table style='width:100%;' border=0>
	<tr>
		<td>Verfication Slip Date :</td><td>".date("d-m-Y",strtotime($rows['date_time']))."</td>
		<td>Total Goods Value :</td><td class='goods_value'></td>
		
	</tr>
	<tr>
		<td>Discount Amount :</td><td class='disc'></td>
		<td>GST Amount :</td><td class='gst'></td>
	</tr>
	<tr>
		<td>Packing and Forwarding Charges :</td><td>".$rows['packing']."<input type='hidden' class='packing' value=".$rows['packing']." ></td>
		<td>Service Charges :</td><td>".$rows['ins_amt']."<input type='hidden' class='ins_amt' value=".$rows['ins_amt']." ></td>
	</tr>
	<tr>
		
		<td>Transportation Charges :</td><td>".$rows['tran_charge_gst']."<input type='hidden' class='transport' value=".$rows['tran_charge_gst']." ></td>
		<td>Grant Total :</td><td class='grand_total'></td>
	</tr>
	<tr>
		<td>Advance Payment :</td><td>".$rows['advance']."<input type='hidden' class='advance' value=".$rows['advance']." ></td>
		<td>Amount Payable :</td><td class='overall_total'></td>
		
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
					var tots = $('#tots_'+splt_this_id_ar).val();
					var disc_amt = $(element).val();
					
  					var dec = (disc_amt/100).toFixed(2); //its convert 10 into 0.10
 					var mult = Number(tots)*Number(dec);
					
					 discount = Number(discount) + Number(mult);
					
				});
	// $tmp_disc=($temp*$row->disc/100);
	// $disc=$disc+$tmp_disc;
	
	// $gst=$gst+(($temp-$tmp_disc)*$row->gst/100);	
		
		$(".disc").html(discount);
		var gst = 0;

		$(".gst_amt").each(function (index, element) {

			var this_attr_id = $.trim($(this).attr("id"));
			var splt_this_id = this_attr_id.split("_");
			var splt_this_id_ar = splt_this_id[2];
			var tots = $('#tots_'+splt_this_id_ar).val();
			var gst_amt = $(element).val();
			
			var dec = (gst_amt/100).toFixed(2); //its convert 10 into 0.10
			var mult = Number(tots)*Number(dec);
			
			gst = Number(gst) + Number(mult);
			
		});
		$(".gst").html(gst);


		$packing= $(".packing").val();
		$ins_amt= $(".ins_amt").val();
		$transport= $(".transport").val();

		$grand_total= Number($packing) + Number($ins_amt) + Number($transport)+ Number(total) - Number(discount) + Number(gst) ;

		$(".grand_total").html($grand_total);
		$advance= $(".advance").val();
		$overall_total=Number($grand_total) - Number($advance);
		$(".overall_total").html($overall_total);



		});
	</script>
</html>