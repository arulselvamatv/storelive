<?php

require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$po_no=$_GET['po_no'];

$HTML="";
	if($con)
	{
		
		
		$asd =('SELECT st.`store_id`, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`,st.nos_qty,st.nosunit, count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt, st.`received_date` as po_date, st.`u_id`, st.`grb_id` as grb_id, g.overall_total as overall_total,wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,wo.suplier_id, st.se_no as se_no , wo.po_no as po_no,wo.po_status FROM `store_entry` as st 
		INNER join grb as g on g.grb_no =st.grb_id
		INNER join work_order as wo on wo.wo_id =st.po_id
		INNER join suplier as s on s.sup_id =wo.suplier_id
		WHERE wo.`active_record` =1 and s.`active_record` =1 and st.dep=0 group by wo.prod_name');
		//echo $asd; exit;
		$i=0;
		$prdt_data = $db->query($asd);
		while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))
		{ 
			//st.nos_qty,st.nosunit
			$amt_nos_qty= ((($prd['per_amt']  * $prd['po_status']) / $prd['received_qty']) );
			$amt= (($prd['per_amt']  * $prd['po_status']) );
			$i = ++$i;
			echo '<tr>'.
			'<th><input  type="checkbox" id="chk_'.$i.'" name="chk[]" class="chk" ></th>'.
			'<input type="hidden" class="form-control" name="se_no[]" id="se_no_'.$i.'" value="'.$prd['se_no'].'" readonly="readonly" />'.
			'<th>'.
			'<input class="form-control" name="quo_no[]" id="quo_no_'.$i.'" value="'.$prd['quo_no'].'" readonly="readonly" />'.
			'</th>'.
			'<th>'.
			'<input class="form-control" name="po_no[]" id="po_no_'.$i.'" value="'.$prd['po_no'].'" readonly="readonly" />'.
			'</th>'.
			'<th>'.
			'<input class="form-control" name="prod_name[]" id="prod_name_'.$i.'" value="'.$prd['item_name'].'" readonly="readonly" />'.
			'</th>'.
			'<th><input class="form-control" name="ddl_pro_spec[]" id="ispec_'.$i.'" value='.$prd['item_desc'].' readonly="readonly" />'.
			'</th>'.
			'<th><input type="hidden" class="form-control" name="supname[]" id="supname_'.$i.'" value='.$prd['suplier_id'].' readonly="readonly" /><input  class="form-control" name="supliername[]" id="supliername_'.$i.'" value='.$prd['supplier_name'].' readonly="readonly" />'.
			'</th>'.
			'<th><input class="form-control" name="perrate[]" id="perrate_'.$i.'" value='.$amt_nos_qty.' readonly="readonly" />'.
			'</th>'.
			'<th>'.
			'<select class="js-example-basic-multiple qty" name="ddl_pro_qty[]" id="iqty_'.$i.'" required="required">';
			$qty=$prd['received_qty'];
					for($i=0;$i<$qty;$i++)
					{
						echo'<option value="'.$i.'">'.$i.'</option>';
					}
					
					echo '<option value="'.$prd['received_qty'].'" selected="selected">'.$prd['received_qty'].'</option></select></th>'.
            
            '<th><input class="form-control" name="rate[]" id="rate_'.$i.'" value='.$amt.' readonly="readonly" />'.
			'</th>'.
            '<th><input class="form-control" name="date_time[]" id="date_time_'.$i.'" value='.$prd['po_date'].' readonly="readonly" />'.
			'</th>'.

			'</tr>';
		}
	}
	

	
	    
?>
<script src="../../assets/node_modules/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
  $("input[type='checkbox']").on('change', function() {
    if ($(this).is(":checked")) {
     	$(this).closest('tr').addClass("highlight");
	  	var this_attr_id = $.trim($(this).attr("id"));
    	var splt_this_id = this_attr_id.split("_");
        var splt_this_id_ar = splt_this_id[1];
		// var qty = document.getElementById("iqty_"+splt_this_id_ar); 
		// 	qty.disabled = false;
		

    } else {
      $(this).closest('tr').removeClass("highlight");
	  var this_attr_id = $.trim($(this).attr("id"));
    	var splt_this_id = this_attr_id.split("_");
        var splt_this_id_ar = splt_this_id[1];
		// var qty = document.getElementById("iqty_"+splt_this_id_ar); 
		// 	qty.disabled = true;
		
    }
  });
});

	</script>

	<link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <script src="../assets/global/plugins/select2/js/select2.min.js"></script>
	<script>
   $(document).ready(function() {
    $(".js-example-basic-multiple").select2();
    });
    </script>

	

	<style>
		.highlight {
  background-color: #03a9f3
}
		</style>