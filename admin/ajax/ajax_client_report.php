<?php

require_once("../database/connect.php");
$db=new Database;
$con=$db->connect();

$po_no=$_GET['po_no'];

$HTML="";
if ($con) {
    $asd = ('SELECT `cl_id`, `dep_name`, `room_no`, `block`, `date_time`, `active_record` FROM `client` WHERE active_record=1');
		$e=0;
		$prdt_data = $db->query($asd);
    while ($prd = $prdt_data->fetch(PDO::FETCH_ASSOC)) {
			++$e;
			echo '<tr>'.
            '<th>'.$e.'</th>'.
            '<th>'.$prd['dep_name'].'</th>'.
            '<th>'.$prd['block'].'</th>'.
            '<th>'.$prd['room_no'].'</th>'.
            '<th>'.'<a href="client_item_history.php?clid='.$prd['cl_id'].'" target="_blank" class="btn btn-default btn-sm item_view_btn">View</a>'.
//            '<th>'.'<button type="button" class="btn btn-default btn-sm item_view_btn" data-clientid="'.$prd['cl_id'].'">View</button>'.'</th>'.
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
                api.columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );

                    var title = $(cell).text();
                        if(!$(cell).hasClass('no-flt')){
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
                        }else{
                            $(cell).html('');
                        }
 
                    // On every keypress in this input
                        $('input',$('.filters th').eq($(api.column(colIdx).header()).index()))
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

        // $('.item_view_btn').on('click',function (e){
        //     e.preventDefault();
        //     var btnelem = $(this);
        //     var client_elem = btnelem.data('clientid');
        //
        //     $("#myModal").modal();
        //
        //     alert(client_elem);
        // });
							});
</script>