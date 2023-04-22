<?php

require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$po_no=$_GET['po_no'];

$HTML="";
	if($con)
	{
		
		
		$asd =('SELECT pd.`pro_id`, pd.`cat_name`, pd.`pro_ty`, pd.`active_record`, pd.`date_time`, pdi.`proi_id`, pdi.`pro_id`, pdi.`pro_code`, pdi.`pro_name`, pdi.`pro_desc`, pdi.`unit`, pdi.`active_record`, (pdi.`date_time`) as date FROM `product_details`as pd 
        inner join product_details_info as pdi on pdi.pro_id= pd.pro_id 
        where pd.active_record=1 and pdi.active_record=1');
		//echo $asd; exit;
		$e=0;
		$prdt_data = $db->query($asd);
		while($prd = $prdt_data->fetch(PDO::FETCH_ASSOC))
		{ 
			++$e;
			echo '<tr>'.
			'<th>'.
			$e.
			'</th>'.
			'<th>'.
			$prd['cat_name'].
			'</th>'.
			'<th>'.
			$prd['pro_ty'].
			'</th>'.
			'<th>'.
			$prd['pro_code'].
			'</th>'.
			'<th>'.$prd['pro_name'].
			'</th>'.
			'<th>'.$prd['pro_desc'].
			'</th>'.
			'<th>'.$prd['unit'].
			'</th>'.
            '<th>'.$prd['date'].
			'</th>'.

			'</tr>';
		}
	}
	

	
	    
?>
<script src="../../assets/node_modules/jquery/dist/jquery.min.js"></script>
<script>
	$(document).ready(function() {
	$('#trn_dlr_pi_inv thead tr')
              .clone(true)
              .addClass('filters')
              .appendTo('#trn_dlr_pi_inv thead');
      
          var table = $('#trn_dlr_pi_inv').DataTable({
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