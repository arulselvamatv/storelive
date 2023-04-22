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
		$e=0;
		$prdt_data = $db->query($asd);
		while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))
		{ 
			//st.nos_qty,st.nosunit
			$amt= (($prd['per_amt']  * $prd['received_qty']) );
			++$e;
			echo '<tr>'.
			'<th><input  type="checkbox" id="chk_'.$e.'" name="chk_'.$e.'" value="'.$e.'"><input type="hidden" name="po_row_id[]" value="'.$e.'"></th>'.
			'<input type="hidden" class="form-control" name="se_no_'.$e.'" id="se_no_'.$e.'" value="'.$prd['se_no'].'" readonly="readonly" />'.
			'<th>'.$prd['quo_no'].
			'<input type="hidden" class="form-control" name="quo_no_'.$e.'" id="quo_no_'.$e.'" value="'.$prd['quo_no'].'" readonly="readonly" />'.
			'</th>'.
			'<th>'.$prd['po_no'].
			'<input type="hidden" class="form-control" name="po_no_'.$e.'" id="po_no_'.$e.'" value="'.$prd['po_no'].'" readonly="readonly" />'.
			'</th>'.
			'<th>'.$prd['item_name'].
			'<input type="hidden" class="form-control" name="prod_name_'.$e.'" id="prod_name_'.$e.'" value="'.$prd['item_name'].'" readonly="readonly" />'.
			'</th>'.
			'<th>'.$prd['item_desc'].'<input type="hidden" class="form-control" name="ddl_pro_spec_'.$e.'" id="ispec_'.$e.'" value="'.$prd['item_desc'].'" readonly="readonly" />'.
			'</th>'.
			'<th>'.$prd['supplier_name'].'<input type="hidden" class="form-control" name="supname_'.$e.'" id="supname_'.$e.'" value="'.$prd['suplier_id'].'" readonly="readonly" /><input type="hidden"  class="form-control" name="supliername_'.$e.'" id="supliername_'.$e.'" value="'.$prd['supplier_name'].'" readonly="readonly" />'.
			'</th>'.
			'<th>'.$prd['per_amt'].'<input type="hidden" class="form-control" name="perrate_'.$e.'" id="perrate_'.$e.'" value="'.$prd['per_amt'].'" readonly="readonly" />'.
			'</th>'.
			'<th>'.$prd['received_qty'].'<input type="hidden" class="form-control" name="totqty_'.$e.'" id="totqty_'.$e.'" value="'.$prd['received_qty'].'" readonly="readonly" />'.
			'</th>'.
			'<th>'.
			'<select class="js-example-basic-multiple qty" name="ddl_pro_qty_'.$e.'" id="iqty_'.$e.'" required="required">';
			$qty=$prd['received_qty'] + 1;
					for($i=0;$i<$qty;$i++)
					{
						echo'<option value="'.$i.'">'.$i.'</option>';
					}
					
					echo '</select></th>'.
            
            '<th>'.$amt.'<input type="hidden" class="form-control" name="rate_'.$e.'" id="rate_'.$e.'" value="'.$amt.'" readonly="readonly" />'.
			'</th>'.
            '<th>'.$prd['po_date'].'<input type="hidden" class="form-control" name="date_time_'.$e.'" id="date_time_'.$e.'" value="'.$prd['po_date'].'" readonly="readonly" />'.
			'</th>'.

			'</tr>';
		}
	}
	

	
	    
?>
<script src="../../assets/node_modules/jquery/dist/jquery.min.js"></script>
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
<script type="text/javascript">
	$(document).ready(function() {
  $("input[type='checkbox']").on('click', function() {
	  
    if ($(this).is(":checked")) {
		
     	$(this).closest('tr').addClass("highlight");
		//  alert('hii');
	  	var this_attr_id = $.trim($(this).attr("id"));
    	var splt_this_id = this_attr_id.split("_");
        var splt_this_id_ar = splt_this_id[1];
		// $(this).val(1);
		// var qty = document.getElementById("iqty_"+splt_this_id_ar); 
		// 	qty.disabled = false;
		

    } else {
      $(this).closest('tr').removeClass("highlight");
	  var this_attr_id = $.trim($(this).attr("id"));
    	var splt_this_id = this_attr_id.split("_");
        var splt_this_id_ar = splt_this_id[1];
		// $(this).val(0);
		// var qty = document.getElementById("iqty_"+splt_this_id_ar); 
		// 	qty.disabled = true;
		
    }
  });

});

	</script>
	<script>
		$(document).ready(function() {
		$('#example thead tr')
            //   .clone(true)
              .addClass('filters')
              .appendTo('#example thead');
      
          var table = $('#example').DataTable({
              orderCellsTop: true,
              fixedHeader: true,
              initComplete: function () {
                  var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();
 
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
 
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                                                    });
                                          });
                                      },
                                });
							});
	</script>

	