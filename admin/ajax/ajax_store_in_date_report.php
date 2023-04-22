<?php

require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$po_no=$_GET['po_no'];

$HTML="";
	if($con)
	{
		
		
		$asd =('SELECT  sum(st.`per_amt`) as sum_amt,st.`store_id`, st.`po_id`, st.`p_row_id`, st.`actual_qty`, st.`received_qty` as qty, st.`per_amt` as `per_amt`,st.nos_qty,st.nosunit, count(st.`store_id`)  as received_qty, st.`billno`, st.`bill_date`, st.`bill_amt`as bill_amt, st.`received_date` as po_date, st.`u_id`, st.`grb_id` as grb_id, g.overall_total as overall_total,wo.suplier_id as suplier_id, s.name as supplier_name,wo.quo_no as quo_no,(wo.prod_name) as item_name,wo.ddl_pro_qty,wo.product_spec as item_desc,wo.suplier_id, st.se_no as se_no , wo.po_no as po_no,wo.po_status FROM `store_entry` as st 
        INNER join grb as g on g.grb_no =st.grb_id
        INNER join work_order as wo on wo.wo_id =st.po_id
        INNER join suplier as s on s.sup_id =wo.suplier_id
        WHERE wo.`active_record` =1 and s.`active_record` =1 and st.dep=0 group by date(st.received_date)');
		//echo $asd; exit;
		$e=0;
		$prdt_data = $db->query($asd);
		while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))
		{ 
			++$e;
			echo '<tr>'.
			'<th>'.$e.
			'</th>'.
			'<th>'.
			$prd['po_date'].
			'</th>'.
			'<th>'.
			$prd['sum_amt'].
			'</th>'.
            '</tr>';
		}
	}
	

	
	    
?>
<!-- <script src="../../assets/node_modules/jquery/dist/jquery.min.js"></script> -->
<script>
	$(document).ready(function() {
	$('#trn_dlr thead tr')
              .addClass('filters')
              .appendTo('#trn_dlr thead');
      
          var table = $('#trn_dlr').DataTable({
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