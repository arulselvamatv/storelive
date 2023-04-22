<?php

require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$po_no=$_GET['po_no'];

$HTML="";
	if($con)
	{
		
		
		$asd =('SELECT  `code`, `serial_no`, `active_record`, `time_date` FROM `quotation` WHERE `active_record`=1 group by `serial_no`');
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
			$prd['serial_no'].
            '<th>'.
			$prd['time_date'].
			'</th>'.
			'</th>'.
			'<th><a class=\'btn btn-primary\' href=quotation_pdf.php?pid='.$prd["serial_no"].' target="_blank"> Click here to print</a>'.
			'</th>'.

			'</tr>';
		}
	}
	

	
	    
?>
<!-- <script src="../../assets/node_modules/jquery/dist/jquery.min.js"></script> -->
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