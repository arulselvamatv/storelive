<?php

require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$po_no=$_GET['po_no'];

$HTML="";
	if($con)
	{
		
		
		$asd =('SELECT `pq_id`, `quo_no`, `po_no`, `product_name`, `product_quantity`, `product_spec`, `supliername`, `suplier_amount`, `date_time`, `active_record` FROM `po_quotation` WHERE `po_no`="'.$po_no.'"');
		//echo $asd; exit;
		$i=0;
		$prdt_data = $db->query($asd);
		while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))
		{
			
			$i = ++$i;
			echo '<tr>'.
			'<th>'.$i.'.</th>'.
            '<th>'.
			'<input class="form-control" name="quo_no[]" id='.$i.' value='.$prd['quo_no'].' readonly="readonly" />'.
			'</th>'.
            '<th>'.
			'<input class="form-control" name="po_no[]" id="po_no_'.$i.'" value='.$prd['po_no'].' readonly="readonly" />'.
			'</th>'.
			'<th>'.
			'<input class="form-control" name="prod_name[]" id="prod_name_'.$i.'" value="'.$prd['product_name'].'" readonly="readonly" />'.
			'</th>'.
			'<th>'.
			'<input class="form-control" name="ddl_pro_qty[]" id="iqty_'.$i.'" value='.$prd['product_quantity'].' readonly="readonly" /></th>'.
			'<th><input class="form-control" name="ddl_pro_spec[]" id="ispec_'.$i.'" value='.$prd['product_spec'].' readonly="readonly" />'.
			'</th>'.
            '<th><input class="form-control" name="supliername[]" id="supliername_'.$i.'" value='.$prd['supliername'].' readonly="readonly" />'.
			'</th>'.
            '<th><input class="form-control" name="rate[]" id="rate_'.$i.'" value='.$prd['suplier_amount'].' readonly="readonly" />'.
			'</th>'.

			'</tr>';
		}
	}

	
	    
?>