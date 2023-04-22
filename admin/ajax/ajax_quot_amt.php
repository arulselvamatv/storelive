<?php

require_once("../database/connect.php");

$db=new Database;

$con=$db->connect();



$quo_no=$_GET['quo_no'];

$sup_name=$_GET['sup_name'];



$HTML="";

if($con){

	$emp_data =$db->query('SELECT (count(`qsa_id`)), timelinedays FROM `quot_sup_amt` WHERE `suplier_id`="'.$sup_name.'" and `quo_no`="'.$quo_no.'" and `active_record`=1');

    $result = $emp_data->fetch();

    $count = $result[0];

	if($count==0){

		$asd =('SELECT `qu_id`, `code`, `serial_no`, `pro_id`, `pro_name`, `pro_quantity`, `pro_spec`, `pro_unit`,`bill_type`, `active_record`, `time_date` FROM `quotation` WHERE `serial_no`="'.$quo_no.'"');

		$i=0;

		$prdt_data = $db->query($asd);

		while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC)){

			$i = ++$i;

			echo 

			'<tr>'.

			'<th>'.$i.' <input type="hidden" class="form-control" name="bill_type[]" id="bill_type_'.$i.'" value="'.$prd['bill_type'].'" readonly="readonly" />.</th>'.

			'<th>'.$prd['pro_name'].

			'<input type="hidden" class="form-control" name="prod_name[]" id='.$i.' value="'.$prd['pro_name'].'" readonly="readonly" />'.

			'</th>'.

			'<th>Per '.$prd['pro_unit'].

			'<input type="hidden" class="form-control" name="ddl_pro_qty[]" id="iqty_'.$i.'" value="'.$prd['pro_quantity'].'" readonly="readonly" /><input type="hidden" class="form-control" name="ddl_pro_unit[]" id="iunit_'.$i.'" value="'.$prd['pro_unit'].'" readonly="readonly" /><input class="form-control" type="hidden" name="ddl_pro_unt[]" id="iunt_'.$i.'" value="Per '.$prd['pro_unit'].'" readonly="readonly" /></th>'.

			'<th colspan="2">'.$prd['pro_spec'].'<input type="hidden" class="form-control" name="ddl_pro_spec[]" id="ispec_'.$i.'" value="'.$prd['pro_spec'].'" readonly="readonly" />'.

			'</th>'.

			'<th><input class="form-control supplier_amt" name="supplier_amt[]" id="supplier_amt_'.$i.'" value="0"/>'.

			'</th>'.

			'<th><input class="form-control disc_amt" name="disc_amt[]" id="disc_amt_'.$i.'" value="0"/>'.

			'</th>'.

			'<th><input class="form-control gst_amt" name="gst_amt[]" id="gst_amt_'.$i.'" value="0"/>'.

			'</th>'.

			'<th><input class="form-control" name="tot[]" id="tot_'.$i.'" readonly="readonly" />'.

			'</th>'.

			'</tr>';

		}

    	echo '<tr><td colspan=10 style="vertical-align:middle;justify-content:center;align-items:center">Delivery timeline from the date of Work Order: <input style="width:130px" type=text class="form-control" id="timeline" name="timelinedays" value="0" ><span> days</span></td></tr> ';

    }

	else{

	$asd =('SELECT `qsa_id`, `code`, `suplier_id`, `po_no`, `quo_no`, `product_name`, `product_quantity`, `product_spec`, `ddl_pro_unit`, `suplier_name`, `suplier_amt`, `date_time`, `active_record`, disc_amt, gst_amt, tot, timelinedays FROM `quot_sup_amt` WHERE `suplier_id`="'.$sup_name.'" and `quo_no`="'.$quo_no.'" and `active_record`=1');

		//echo $asd; exit;

		$i=0;

		$prdt_data = $db->query($asd);

		while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC)){

			$i = ++$i;

			echo '<tr>'.

			'<th>'.$i.'.</th>'.

			'<th>'.$prd['product_name'].

			'<input type="hidden" class="form-control" name="prod_name[]" id='.$i.' value="'.$prd['product_name'].'" readonly="readonly" />'.

			'</th>'.

			'<th>Per '.$prd['ddl_pro_unit'].

			'<input type="hidden" class="form-control" name="ddl_pro_qty[]" id="iqty_'.$i.'" value='.$prd['product_quantity'].' readonly="readonly" /><input type="hidden" class="form-control" name="ddl_pro_unit[]" id="iunit_'.$i.'" value="'.$prd['ddl_pro_unit'].'" readonly="readonly" /><input type="hidden" class="form-control" name="ddl_pro_unt[]" id="iunt_'.$i.'" value="Per '.$prd['ddl_pro_unit'].'" readonly="readonly" /></th>'.

			'<th colspan="2">'.$prd['product_spec'].'<input type="hidden" class="form-control" name="ddl_pro_spec[]" id="ispec_'.$i.'" value="'.$prd['product_spec'].'" readonly="readonly" />'.

			'</th>'.

			'<th><input  class="form-control supplier_amt" name="supplier_amt[]" id="supplier_amt_'.$i.'" value="'.$prd['suplier_amt'].'" readonly="readonly" />'.

			'</th>'.

			'<th><input class="form-control disc_amt" name="disc_amt[]" id="disc_amt_'.$i.'" value="'.$prd['disc_amt'].'" readonly="readonly"/>'.

			'</th>'.

			'<th><input class="form-control gst_amt" name="gst_amt[]" id="gst_amt_'.$i.'" value="'.$prd['gst_amt'].'" readonly="readonly"/>'.

			'</th>'.

			'<th><input class="form-control" name="tot[]" id="tot_'.$i.'" value="'.$prd['tot'].'" readonly="readonly" />'.

			'</th>'.

			'<th><input type="button" class="edit" name="edit-button[]" id="edit-button_'.$i.'" value="Edit" />

			<input type="button" class="done" name="end-editing[]" id="end-editing_'.$i.'" value="Done" style="visibility:hidden" />'.

			'</th>'.

			'</tr>';

		}

			echo ' <tr><td colspan = "10" style="vertical-align:middle;justify-content:center;align-items:center">Delivery timeline from the date of Work Order: <input style="width:130px" type=text class=form-control id=timeline name=timelinedays value="0" ><span> days</span> </td>

        </tr>';

	}

	}



?>

 