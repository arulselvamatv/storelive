<?php



require_once("../database/connect.php");

$db=new Database;

$con=$db->connect();



$quo_no=$_GET['quo_no'];



$HTML="";

	if($con)

	{

		echo '<thead>

		<tr>

		  <th class="text-center">No</th>

		  <th class="text-center">Product Name</th>

		  <th class="text-center">Quantity</td>

		  <th class="text-center">Specification needed</th>';

		  

				$asd =('SELECT s.company_name, qsa.suplier_id FROM `quot_sup_amt` as qsa

				inner join suplier as s on s.sup_id= qsa.suplier_id

				WHERE `quo_no`="'.$quo_no.'" group by suplier_name order by suplier_name desc');

				//echo $asd; exit;

				$datd = $db->query($asd);

				while($data=$datd->fetch(PDO::FETCH_ASSOC))

					{

						echo "<th class='text-center'><input type='checkbox'>".''.$data['company_name']."<input type='hidden' name='sup_name[]' id='sup_name_".$i."' value='".$data['suplier_id']."' /></th>";

					}



					echo '</tr>

	  </thead>

	  <tbody id="tbody">';



	  

		

		

		$asd =('SELECT `qsa_id`, `quo_no`,`bill_type`,`product_name`, `product_quantity`, `product_spec`, `ddl_pro_unit`, `suplier_name`, `suplier_amt`, `date_time`, `active_record`, tot FROM `quot_sup_amt` WHERE `quo_no`="'.$quo_no.'" group by product_name');

		//echo $asd; exit;

		$i=0;

		$prdt_data = $db->query($asd);

		while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))

		{

			$product_name =$prd['product_name'];

			

			$i = ++$i;

			echo '<tr>'.

			'<td>'.$i.'.<input  type="hidden" class="form-control" name="bill_type[]" id='.$i.' value="'.$prd['bill_type'].'" readonly="readonly" /></td>'.

			'<td>'.

			'<input class="form-control" name="prod_name[]" id='.$i.' value="'.$prd['product_name'].'" readonly="readonly" />'.

			'</td>'.

			'<td>'.$prd['product_quantity'].'('.$prd['ddl_pro_unit'].')'.

			'<input  type="hidden" class="form-control" name="ddl_pro_unt[]" id="iunt_'.$i.'" value="Per '.$prd['ddl_pro_unit'].'" readonly="readonly" /><input  type="hidden" class="form-control" name="ddl_pro_qty[]" id="iqty_'.$i.'" value="'.$prd['product_quantity'].'" readonly="readonly" /><input  type="hidden" class="form-control" name="ddl_pro_unit[]" id="iunit_'.$i.'" value="'.$prd['ddl_pro_unit'].'" readonly="readonly" /></td>'.

			'<td><input class="form-control" name="ddl_pro_spec[]" id="ispec_'.$i.'" value="'.$prd['product_spec'].'" readonly="readonly" />'.

			'</td>';

		

			$asdf =('SELECT `qsa_id`, `suplier_id`, `quo_no`, `product_name`, `product_quantity`, `product_spec`, `suplier_name`, `suplier_amt`, `date_time`, `active_record`, `gst_amt`, `disc_amt`, `tot` FROM `quot_sup_amt` WHERE `quo_no`="'.$quo_no.'" and  product_name="'.$product_name.'" order by suplier_name desc');

			//echo $asdf; exit;

			$e=0;

			$prdt_dataa = $db->query($asdf);

			while($prda = $prdt_dataa->fetch(PDO::FETCH_ASSOC))

			{

				$e = ++$e;

			echo '<td><input  type="checkbox" name="check[]" id='.$i.' class="check" value="'.$prda['qsa_id'].'" />&nbsp;</br>

			<input type="hidden" name="sup_id'.$prda['qsa_id'].'" id="sup_id_'.$prda['qsa_id'].'" value="'.$prda['suplier_id'].'" readonly="readonly" />

			Suplier Per Amt:<input class="form-control"  name="sup_amt'.$prda['qsa_id'].'" id="sup_amt_'.$prda['qsa_id'].'" value="'.$prda['suplier_amt'].'" readonly="readonly" />

			Discount Percent:<input class="form-control"  name="disc_amt'.$prda['qsa_id'].'" id="disc_amt_'.$prda['qsa_id'].'" value="'.$prda['disc_amt'].'" readonly="readonly" />

			GST Percent:<input class="form-control" name="gst_amt'.$prda['qsa_id'].'" id="gst_amt_'.$prda['qsa_id'].'" value="'.$prda['gst_amt'].'" readonly="readonly" />

			

			Total:';

			$bill_value= $prda['suplier_amt'] * $prda['product_quantity'];

			// $temp=($row['ddl_pro_qty'] * $row->unit_price);

			//$vat=$vat+($temp*$row->vat/100);

			$tmp_disc=($bill_value*$prda['disc_amt']/100);

			// $disc=$disc+$tmp_disc;

			

			$gst=(($bill_value-$tmp_disc)*$prda['gst_amt']/100);

			$total_value=$bill_value-$tmp_disc+$gst;

	 		echo '<input  name="tot_va_'.$prda['qsa_id'].'" id="tot_va_'.$prda['qsa_id'].'" class="form-control" value="'.round($total_value,2).'" readonly="readonly"/><input type="hidden"  name="tot'.$prda['qsa_id'].'" id="tot_'.$prda['qsa_id'].'" class="form-control" value="'.$prda['tot'].'" readonly="readonly"/></td>';

			

			}

			echo '</tr>';

		}



		echo '</tbody>';

		

	}



	

	    

?>

<script src="../../assets/node_modules/jquery/dist/jquery.min.js"></script>

<script>

	$("th input[type='checkbox']").on("change", function() {

		// alert("hii"); exit;

   var cb = $(this),          //checkbox that was changed

       th = cb.parent(),      //get parent th

       col = th.index() + 1;  //get column index. note nth-child starts at 1, not zero

   $("tbody td:nth-child(" + col + ") input").prop("checked", this.checked);  //select the inputs and [un]check it

});

</script>